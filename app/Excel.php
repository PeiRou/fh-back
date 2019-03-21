<?php

namespace App;

use App\Events\BackPusherEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;

class Excel
{
    /**
     * 更新赢钱的用户馀额
     * @param $gameId
     * @param $issue
     * @param string $gameName
     * @return int
     */
    public function updateUserMoney($gameId,$issue,$gameName=''){
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('status',1)->where('bunko','>',0)->groupBy('user_id')->get();
        $getDt = DB::connection('mysql::write')->table('bet')->select('bunko','user_id','game_id','playcate_id','play_name','order_id','issue','playcate_name','play_name','play_odds','order_id','bet_money','unfreeze_money','nn_view_money')->where('game_id',$gameId)->where('issue',$issue)->where('status',1)->where('bunko','>',0)->get();
        if($get){
            //更新返奖的用户馀额
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->s ";
            }
            $getAfterUser = DB::connection('mysql::write')->table('users')->select('id','money')->whereIn('id',$users)->get();
            $ids = implode(',',$users);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                $up = DB::connection('mysql::write')->statement($sql);
                if($up != 1){
                    return 1;
                }
            }
            $capData = [];
            $capUsers = [];
            $ii = 0;
            foreach ($getAfterUser as&$val){
                $capUsers[$val->id] = $val->money;
            }
            $redis = Redis::connection();
            $redis->select(5);
            //新增有返奖的用户的资金明细
            foreach ($getDt as $i){
                if(in_array($i->game_id,array(90,91))){ //根据牛牛翻倍玩法增加解冻的资金明细
                    $capUsers[$i->user_id] += $i->unfreeze_money;
                    $tmpCap = [];
                    $tmpCap['to_user'] = $i->user_id;
                    $tmpCap['user_type'] = 'user';
                    $tmpCap['order_id'] = 'UF'.substr($i->order_id,2);
                    $tmpCap['type'] = 't26';
                    $tmpCap['money'] = $i->unfreeze_money;
                    $tmpCap['balance'] = round($capUsers[$i->user_id],3);
                    $tmpCap['operation_id'] = 0;
                    $tmpCap['issue'] = $i->issue;
                    $tmpCap['game_id'] = $i->game_id;
                    $tmpCap['game_name'] = $gameName;
                    $tmpCap['playcate_id'] = $i->playcate_id;
                    $tmpCap['playcate_name'] = $i->playcate_name;
                    $tmpCap['content'] = $gameName.'-'.$i->play_name.'-'.$i->play_odds;
                    $tmpCap['created_at'] = date('Y-m-d H:i:s');
                    $tmpCap['updated_at'] = date('Y-m-d H:i:s');
                    $capData[$ii] = $tmpCap;
                    $ii++;
                    if($i->nn_view_money<0){
                        continue;
                    }
                    $bunko = $i->nn_view_money + $i->bet_money;
                    $winBunko = $i->nn_view_money;
                }else{
                    $bunko = $i->bunko;
                    $winBunko = $i->bunko - $i->bet_money;
                }
                $capUsers[$i->user_id] += $bunko; //累加馀额
                $tmpCap = [];
                $tmpCap['to_user'] = $i->user_id;
                $tmpCap['user_type'] = 'user';
                $tmpCap['order_id'] = 'W'.substr($i->order_id,1);
                $tmpCap['type'] = 't09';
                $tmpCap['money'] = $bunko;
                $tmpCap['balance'] = round($capUsers[$i->user_id],3);
                $tmpCap['operation_id'] = 0;
                $tmpCap['issue'] = $i->issue;
                $tmpCap['game_id'] = $i->game_id;
                $tmpCap['game_name'] = $gameName;
                $tmpCap['playcate_id'] = $i->playcate_id;
                $tmpCap['playcate_name'] = $i->playcate_name;
                $tmpCap['content'] = $gameName.'-'.$i->play_name.'-'.$i->play_odds;
                $tmpCap['created_at'] = date('Y-m-d H:i:s');
                $tmpCap['updated_at'] = date('Y-m-d H:i:s');
                $capData[$ii] = $tmpCap;
                $ii ++;
                $keyEx = 'winInfo'.$i->order_id;
                if($redis->exists($keyEx))
                    continue;
                $redis->setex($keyEx,60,'on');
                $content = ' 第'.$i->issue.'期 '.$i->playcate_name.' '.$i->play_name;
                $tmpContent = '<div><span style="color: red">'.$gameName.'</span>'.$content. '已中奖，中奖金额 <span style="color:#8d71ff">' .round($winBunko,3).'元</span></div>';
                event(new BackPusherEvent('win','中奖通知',$tmpContent,array('fnotice-'.$i->user_id)));
            }
            krsort($capData);
            $capIns = DB::table('capital')->insert($capData);
            if($capIns != 1){
                return 1;
            }
        } else {
            \Log::info($gameName.'已结算过，已阻止！');
        }
        //普通模式才会退水
        if(env('AGENT_MODEL',1) == 1) {
            //退水
            $this->reBackUser($gameId, $issue, $gameName);
        }
        return 0;
    }
    private function reBackUser($gameId,$issue,$gameName=''){
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("SUM(bet.bet_money * bet.play_rebate) AS back_money"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('play_rebate','>=',0.00000001)->groupBy('user_id')->get();
        if($get){
            if (count($get)==0)
                return 1;
            //更新返奖的用户馀额
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->back_money ";
            }
            $getAfterUser = DB::connection('mysql::write')->table('users')->select('id','money')->whereIn('id',$users)->get();
            $ids = implode(',',$users);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                $up = DB::connection('mysql::write')->statement($sql);
                if($up != 1){
                    return 1;
                }
            }
            $capData = [];
            $capUsers = [];
            $ii = 0;
            foreach ($getAfterUser as&$val){
                $capUsers[$val->id] = $val->money;
            }
            //新增有返奖的用户的资金明细
            foreach ($get as $i){
                $tmpCap = [];
                $tmpCap['to_user'] = $i->user_id;
                $tmpCap['user_type'] = 'user';
                $tmpCap['order_id'] = $this->randOrder('BW');
                $tmpCap['type'] = 't14';
                $tmpCap['money'] = $i->back_money;
                $tmpCap['balance'] = round($capUsers[$i->user_id]+$i->back_money,3);
                $tmpCap['operation_id'] = 0;
                $tmpCap['issue'] = $issue;
                $tmpCap['game_id'] = $gameId;
                $tmpCap['game_name'] = $gameName;
                $tmpCap['playcate_id'] = 0;
                $tmpCap['playcate_name'] = '';
                $tmpCap['content'] = '';
                $tmpCap['created_at'] = date('Y-m-d H:i:s',time()+1);
                $tmpCap['updated_at'] = date('Y-m-d H:i:s',time()+1);
                $capData[$ii] = $tmpCap;
                $ii ++;
            }
            krsort($capData);
            $capIns = DB::table('capital')->insert($capData);
            if($capIns != 1){
                return 1;
            }
        } else {
            \Log::info($gameName.'已结算过，已阻止！');
        }
        return 0;
    }
    //计算当日总输赢
    public function bet_total($issue,$gameId){
        $exceBase = DB::table('excel_base')->select('excel_base_idx','count_date','is_user')->where('game_id',$gameId)->first();
        if(empty($exceBase))
            return false;
        $dataUnity = [];
        if(empty($exceBase->count_date) || $exceBase->count_date!=date("Y-m-d")){
            $todaystart = date("Y-m-d 00:00:00");
            $todayend = date("Y-m-d 23:59:59");
            $where = " and created_at BETWEEN '{$todaystart}' and '{$todayend}' and bunko != 0 ";
            $tmp = $this->countAllLoseWin($gameId,$where);
            foreach ($tmp as&$todayBet){
                $data = array();
                $todayBet->sumBet_money = !isset($todayBet->sumBet_money)||empty($todayBet->sumBet_money)?0:$todayBet->sumBet_money;
                $todayBet->sumBunkoWin = !isset($todayBet->sumBunkoWin)||empty($todayBet->sumBunkoWin)?0:$todayBet->sumBunkoWin;
                $todayBet->sumBunkoLose = !isset($todayBet->sumBunkoLose)||empty($todayBet->sumBunkoLose)?0:$todayBet->sumBunkoLose;
                $data['count_date'] = date("Y-m-d");
                $data['bet_money'] = $todayBet->sumBet_money;
                $data['bet_win'] = $todayBet->sumBunkoWin;
                $data['bet_lose'] = abs($todayBet->sumBunkoLose);
                if(isset($exceBase->is_user) && $exceBase->is_user == 0){   //增加统一杀率，如果是此栏位为0时，为统一控制杀率
                    $dataUnity['bet_money'] = $todayBet->sumBet_money;
                    $dataUnity['bet_win'] = $todayBet->sumBunkoWin;
                    $dataUnity['bet_lose'] = abs($todayBet->sumBunkoLose);
                }
            }
        }else{
            $where = " and issue = '{$issue}' ";
            $tmp = $this->countAllLoseWin($gameId,$where);
            foreach ($tmp as&$excBunko){
                $data = array();
                $excBunko->sumBet_money = !isset($excBunko->sumBet_money)||empty($excBunko->sumBet_money)?0:$excBunko->sumBet_money;
                $excBunko->sumBunkoWin = !isset($excBunko->sumBunkoWin)||empty($excBunko->sumBunkoWin)?0:$excBunko->sumBunkoWin;
                $excBunko->sumBunkoLose = !isset($excBunko->sumBunkoLose)||empty($excBunko->sumBunkoLose)?0:$excBunko->sumBunkoLose;
                $data['bet_money'] = DB::raw('bet_money + '.$excBunko->sumBet_money);
                $data['bet_win'] = DB::raw('bet_win + '.$excBunko->sumBunkoWin);
                $data['bet_lose'] = DB::raw('bet_lose + '.abs($excBunko->sumBunkoLose));
                if(isset($exceBase->is_user) && $exceBase->is_user == 0){   //增加统一杀率，如果是此栏位为0时，为统一控制杀率
                    $dataUnity['bet_money'] = $excBunko->sumBet_money;
                    $dataUnity['bet_win'] = $excBunko->sumBunkoWin;
                    $dataUnity['bet_lose'] = abs($excBunko->sumBunkoLose);
                }
            }
        }
        DB::table('excel_base')->where('excel_base_idx', $exceBase->excel_base_idx)->update($data);
        if($exceBase->is_user == 0){    //增加统一杀率，如果是此栏位为0时，为统一控制杀率
            $dataUnity['game'] = $gameId;
            $this->setWinIssueNum($dataUnity);
        }
    }
    private function countAllLoseWin($gameId,$where=''){
        $strSql = "SELECT sum(bet_money) as sumBet_money,sum(case when bunko >0 then bunko-bet_money else 0 end) as sumBunkoWin,sum(case when bunko < 0 then bunko else 0 end) as sumBunkoLose FROM bet WHERE game_id = '{$gameId}' and testFlag = 0 ".$where;
        $sql = DB::connection('mysql::write')->select($strSql);
        return $sql;
    }
    //计算是否开杀
    public function kill_count($table,$issue,$gameId,$opencode){
        $killopennum = DB::connection('mysql::write')->table($table)->select('excel_opennum')->where('issue',$issue)->first();
        $is_killopen = DB::connection('mysql::write')->table('excel_base')->select('is_open','count_date','kill_rate','bet_lose','bet_win','is_user')->where('game_id',$gameId)->first();
        $opennum = '';

        if(!empty($killopennum->excel_opennum)&&($is_killopen->is_open==1) && $is_killopen->is_user){
            writeLog('serfKill',$table.' 获取KILL'.$issue.'--'.@$killopennum->excel_opennum);
            $opennum = isset($killopennum->excel_opennum)&&!empty($killopennum->excel_opennum)?$killopennum->excel_opennum:$this->opennum($table);
            $total = $is_killopen->bet_lose + $is_killopen->bet_win;
            $lose_losewin_rate = $total>0?($is_killopen->bet_lose-$is_killopen->bet_win)/$total:0;
            writeLog('serfKill',$table.':杀率设置'.json_encode($is_killopen));
            writeLog('serfKill',$table.':输赢比 '.$lose_losewin_rate);
            writeLog('serfKill',$table.' 获取KILL开奖'.$issue.'--'.$opennum);
            writeLog('serfKill',$table.' 获取origin开奖'.$issue.'--'.$opencode);
        }else if(isset($is_killopen->is_user) && $is_killopen->is_user == 0){//增加统一杀率，如果是此栏位为0时，为统一控制杀率
            $opennum = $this->opennum($table,$is_killopen->is_user,$issue);
        }
        return $opennum;
    }
    //取得杀率信息
    public function getKillBase($gameId){
        $exeBase = DB::table('excel_base')->select('excel_num')->where('is_open',1)->where('game_id',$gameId)->first();
        return $exeBase;
    }
    //取得最新的需要计算杀率
    public function getNeedKillIssue($table,$status=0){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time()+9);
        $sql = "SELECT id,issue,excel_num FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='{$today}' and is_open=0 and excel_num=".$status.") and is_open=0 and bunko=0 and excel_num=".$status;
        $tmp = DB::connection('mysql::write')->select($sql);
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得需要计算杀率BASE
    public function getNeedKillBase($gameId){
        if(empty($gameId))
            return false;
        $tmp = DB::connection('mysql::write')->select("SELECT * FROM excel_base WHERE game_id = ".$gameId);
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得最新的需要结算奖期
    public function getNeedBunkoIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 0)");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得最新的需要结算奖期
    public function getNeedBunkoIssueLhc($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
//        writeLog('New_Bet1',  "SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 2)");
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 2)");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得最新的需要结算NN奖期
    public function getNeedNNBunkoIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1 and nn_bunko = 0)");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得最新的开奖奖期
    public function getOpenIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1)");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得目前奖期
    public function getNowIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."')");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得统一杀率开奖
    public function getZiYingIssueNum($api='',$needOpenIssue=''){
        $key = $api.'?issue='.$needOpenIssue;
        $redis = Redis::connection();
        $redis->select(5);
        if($redis->exists($key)){
            return '';
        }
        $redis->setex($key,3,'ing');
        $url = Config::get('website.guanIssueServerUrl').'ziyingIssue/'.$key;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 2);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($tmpInfo,true);
        writeLog('sameKill','getZiYingIssueNum - '.'url:'.$url.' res:'.json_encode($res));
        return $res;
    }
    //取得统一杀率试算开号
    private function getKillIssueNum($api,$needOpenIssue,$num){
        $key = $api.'?issue='.$needOpenIssue.'&num='.$num.'&logo='.env('logo','');
        $redis = Redis::connection();
        $redis->select(5);
        if($redis->exists($key)){
            return '';
        }
        $redis->setex($key,3,'ing');
        $url = (empty(Config::get('website.setGuanIssueServerUrl'))?Config::get('website.guanIssueServerUrl'):Config::get('website.setGuanIssueServerUrl')).'getBunko/'.$key;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 2);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($tmpInfo,true);
        writeLog('sameKill','getKillIssueNum - '.'url:'.$url.' res:'.json_encode($res));
        return $res;
    }
    //对统一杀率传试算比值
    public function setKillIssueNum($game,$needOpenIssue,$num,$opencode,$win){
        if(!isset($this->kill_lottery[$game]))
            return '';
        $key = $this->kill_lottery[$game]['api'];
        $params['issue'] = $needOpenIssue;
        $params['num'] = $num;
        $params['logo'] = env('logo','');
        $params['open'] = $opencode;
        $params['win'] = $win;
        $url = (empty(Config::get('website.setGuanIssueServerUrl'))?Config::get('website.guanIssueServerUrl'):Config::get('website.setGuanIssueServerUrl')).'setBunko/'.$key;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 2);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($tmpInfo,true);
        writeLog('sameKill','setKillIssueNum - '.'url:'.$url.' post:'.json_encode($params).' res:'.json_encode($res));
        return $res;
    }
    //对统一杀率传当期输赢
    private function setWinIssueNum($params){
        $url = (empty(Config::get('website.setGuanIssueServerUrl'))?Config::get('website.guanIssueServerUrl'):Config::get('website.setGuanIssueServerUrl')).'setLastBunko';
        writeLog('sameKill','setWinIssueNum - '.'url:'.$url);
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 2);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($tmpInfo,true);
        return $res;
    }
    //取得官方开奖
    public function getGuanIssueNum($needOpenIssue,$type){
        $key = $type.'?issue='.$needOpenIssue;
        $redis = Redis::connection();
        $redis->select(5);
        if($redis->exists($key)){
            return '';
        }
        $redis->setex($key,3,'ing');
        $url = Config::get('website.guanIssueServerUrl').'guanIssue/'.$key;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 2);
        $tmpInfo = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($tmpInfo,true);
        return $res;
    }
    //取得目前未开奖奖期
    public function getNextIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time()+2);
        $yesterday = date('Y-m-d H:i:s',time()-21600);
        $tmp = DB::connection('mysql::write')->select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE is_open=0 and opentime >='".$yesterday."' and opentime <='".$today."')");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得目前未开奖奖期
    public function getNeedMinIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $yesterday = date('Y-m-d H:i:s',strtotime('-1 day'));
        $tmp = DB::connection('mysql::write')->select("SELECT * FROM {$table} WHERE id = (SELECT MIN(id) FROM {$table} WHERE is_open=0 and opentime >='".$yesterday."' and opentime <='".$today."')");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得目前未开奖奖期组
    public function getNeedAarrayIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $yesterday = date('Y-m-d H:i:s',strtotime('-1 day'));
        $res = DB::connection('mysql::write')->select("SELECT issue,opentime FROM {$table} WHERE is_open=0 and opentime >='".$yesterday."' and opentime <='".$today."'");
        if(empty($res))
            return array();
        return $res;
    }
    //取得目前开盘奖期
    public function getNextBetIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::connection('mysql::write')->select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."')");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得目前需要开奖奖期
    public function getNeedtIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::connection('mysql::write')->select("SELECT * FROM {$table} WHERE id = (SELECT MIN(id) FROM {$table} WHERE is_open=0 and opentime <='".$today."')");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //根据类别回传开奖格式
    public function opennum($game,$is_user=1,$needOpenIssue='',$num=0){
        if($is_user){
            switch ($game){
                case 'game_msjsk3':
                    return $this->opennum_k3();
                    break;
                case 'game_paoma':
                case 'game_msft':
                case 'game_mssc':
                case 'game_sfsc':
                    return $this->opennum_pk10();
                    break;
                case 'game_msssc':
                case 'game_qqffc':
                case 'game_sfssc':
                    return $this->opennum_ssc($num);
                    break;
                case 'game_msqxc':
                    return $this->opennum_qxc();
                    break;
                case 'game_cqxync':
                    return $this->opennum_xync();
                    break;
                case 'game_gdklsf':
                    return $this->opennum_xync();
                    break;
                case 'game_bjkl8':
                    return $this->opennum_kl8();
                case 'game_xylhc':
                case 'game_sflhc':
                case 'game_jslhc':
                    return $this->opennum_lhc($num);
                    break;

            }
        }else if(isset($this->kill_lottery[$game])){
            $api = $this->kill_lottery[$game]['api'];
            if($num>0){
                $res = $this->getKillIssueNum($api,$needOpenIssue,$num);
                return isset($res['data'])?$res['data']:'';
            }else{
                if(empty($api)||empty($needOpenIssue))
                    return '';
                $res = $this->getZiYingIssueNum($api,$needOpenIssue);
                return isset($res['opennum'])?$res['opennum']:'';
            }
        }
        return '';
    }

    private $kill_lottery = array(
        'game_mssc' => array('id'=>80,'api'=>'mssc'),     //秒速赛车
        'game_msft' => array('id'=>82,'api'=>'msft'),     //秒速飞艇
        'game_msssc' => array('id'=>81,'api'=>'msssc'),     //秒速时时彩
        'game_paoma' => array('id'=>99,'api'=>'paoma'),     //香港跑马
        'game_xylhc' => array('id'=>85,'api'=>'xylhc'),     //幸运六合彩
        'game_msjsk3' => array('id'=>86,'api'=>'msjsk3'),     //秒速快三
        'game_qqffc' => array('id'=>113,'api'=>'qqffc'),     //QQ分分彩
        'game_kssc' => array('id'=>801,'api'=>'kssc'),     //快速赛车
        'game_ksft' => array('id'=>802,'api'=>'ksft'),     //快速飞艇
        'game_ksssc' => array('id'=>803,'api'=>'ksssc'),    //快速时时彩
        'game_twxyft' => array('id'=>804,'api'=>'twxyft'),    //台湾幸运飞艇
    );

    private function opennum_pk10(){
        $tmpArray = [0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>10];
        for ($i=0;$i<10;$i++){
            $tmpLegth = count($tmpArray);
            $tmpRand = rand(0,$tmpLegth-1);
            $res[] = $tmpArray[$tmpRand];
            unset($tmpArray[$tmpRand]);
            $tmpArray2 = [];
            foreach ($tmpArray as&$value)
                $tmpArray2[] = $value;
            $tmpArray = $tmpArray2;
        }
        return implode(',',$res);
    }
    private function opennum_k3(){
        $postArray['n1'] = rand(1,6);
        $postArray['n2'] = rand(1,6);
        $postArray['n3'] = rand(1,6);
        asort($postArray);
        foreach ($postArray as&$v)
            $tmpArray1[] = $v;
        return implode(',',$tmpArray1);
    }
    private function opennum_ssc($num=0){
        $arrNumber = [rand(0,9),rand(0,9),rand(0,9),rand(0,9),rand(0,9)];
        $number = implode(',',$arrNumber);
        switch ($num){
            case 2:
                shuffle($arrNumber);
                $number = implode(',',$arrNumber);
                break;
            case 3:
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $number = implode(',',$arrNumber);
                break;
            case 4:
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $number = implode(',',$arrNumber);
                break;
            case 5:
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $number = implode(',',$arrNumber);
                break;
            case 6:
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $rd_limit = rand(0,4);
                $arrNumber[$rd_limit] = rand(0,9);
                shuffle($arrNumber);
                $number = implode(',',$arrNumber);
                break;
        }
        return $number;
    }
    private function opennum_qxc(){
        return rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9);
    }
    private function opennum_kl8(){
        $arr = range(1,80,1);
        shuffle($arr);   //打乱数组
        $newarr = array_splice($arr,0,20);
        sort($newarr);
        return implode(",",$newarr);
    }
    private function opennum_lhc($num=0){
        $arr = range(1,49,1);
        shuffle($arr);   //打乱数组
        switch ($num){
            case 2:
                shuffle($arr);   //打乱数组
                break;
            case 3:
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
            case 4:
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
            case 5:
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
            case 6:
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
        }
        $newarr = array_splice($arr,0,7);
        return implode(",",$newarr);
    }
    private function opennum_xync(){
        $newarr = [];
        for ($i = 1; $i <= 20; $i++){
            $newarr[] = rand(1, 20);
        }
        return implode(",",$newarr);
    }
    //处理秒速牛牛
    public function exePK10nn($opencode){
        if(empty($opencode))
            return false;
        $replace = str_replace('10','0',$opencode);
        $explodeNum = explode(',',$replace);
        $banker = (int)$explodeNum[0].(int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4];
        $player1 = (int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5];
        $player2 = (int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6];
        $player3 = (int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7];
        $player4 = (int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8];
        $player5 = (int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8].(int)$explodeNum[9];
        return [$banker,$player1,$player2,$player3,$player4,$player5];
    }

    public function nn($num){
        $aNumber = str_split($num);
        $nSame = array();
        $stop = false;
        $nSp = 0;
        for ($yy = 0;$yy<5;$yy++){
            for ($ii = 0;$ii<5;$ii++){
                for ($xx = 0;$xx<5;$xx++){
                    if($xx==$yy ||$xx==$ii ||$ii==$yy )
                        continue;
                    $nn = str_split($yy.$ii.$xx);
                    sort($nn);
                    $nn = implode("",$nn);
                    if( in_array($nn,$nSame))
                        continue;
                    $nSum = $aNumber[$yy]+$aNumber[$ii]+$aNumber[$xx];
                    if($nSum%10==0){
                        unset($aNumber[$yy]);
                        unset($aNumber[$ii]);
                        unset($aNumber[$xx]);
                        $stop = true;
                        break;
                    }
                    $nSame[] = $nn;
                }
                if($stop)
                    break;
            }
            if($stop)
                break;
        }
        if(!$stop){
            $total = -1; //无牛
        } else {
            foreach ($aNumber as $val)
                $nSp+=$val;  //牛1～牛9&牛牛
            $nSp = $nSp%10==0?10:$nSp%10;
            $total = $nSp;
        }
        return $total;
    }

    public function bunko($win,$gameId,$issue,$excel=false){
        try {
            if ($excel) {
                $table = 'excel_bet';
                $getUserBets = DB::connection('mysql::write')->table('excel_bet')->where('game_id', $gameId)->where('issue', $issue)->where('bunko', '=', 0.00)->get();
            } else {
                $table = 'bet';
                $getUserBets = Bets::where('game_id', $gameId)->where('issue', $issue)->where('bunko', '=', 0.00)->get();
            }
            $id = [];
            foreach ($win as $k => $v) {
                $id[] = $v;
            }
            if ($getUserBets) {
                $sql_upd = "UPDATE " . $table . " SET bunko = CASE ";
                $sql_upd_lose = "UPDATE " . $table . " SET bunko = CASE ";
                $ids = implode(',', $id);
                if ($ids && isset($ids)) {
                    $sql = "";
                    $sql_lose = "";
                    foreach ($getUserBets as $item) {
                        $bunko = $item->bet_money * $item->play_odds;
                        $bunko_lose = 0 - $item->bet_money;
                        $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                        $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    }
                    $sql_upd .= $sql . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId ";
                    $sql_upd_lose .= $sql_lose . "END, status = 1 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `play_id` NOT IN ($ids) AND `issue` = $issue AND `game_id` = $gameId ";
                    if (!isset($bunko) || empty($bunko))
                        return 0;
                    $run = empty($sql) ? 1 : DB::statement($sql_upd);
                    if ($run == 1) {
                        $run2 = empty($sql_lose) ? 1 : DB::statement($sql_upd_lose);
                        if ($run2 == 1) {
                            return 1;
                        }
                    }
                }
            }
        }catch (\exception $exception){
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            DB::table($table)->where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => 0]);
            return 0;
        }
    }

    private function randOrder($fix)
    {
        $order_id_main = date('YmdHis').rand(10000000,99999999);
        $order_id_len = strlen($order_id_main);
        $order_id_sum = 0;
        for($i=0; $i<$order_id_len; $i++){
            $order_id_sum += (int)(substr($order_id_main,$i,1));
        }
        $order_id = $order_id_main . str_pad((100 - $order_id_sum % 100) % 100,2,'0',STR_PAD_LEFT);
        return $fix.$order_id;
    }

    //官方彩种获取开号
    public function checkOpenGuan($table,$needOpenIssue,$code,$gapnum,$redis_gapnum,$redis){
        $html = $this->getGuanIssueNum($needOpenIssue,$code);       //获取官方号码
        //如果官方數據庫已經查不到需要追朔的獎期，則停止追朔
        if(!isset($html['issue'])){                         //先从最新需要开奖的奖期查起
            if(($gapnum == $redis_gapnum) && !empty($redis_gapnum)){
                $redis->set($code.':needopen','on');
                return 'no have';
            }else{
                //检查不是当期需要追号的开奖
                $res = $this->getNeedAarrayIssue($table);     //在从旧的需要开奖的奖期查起
                for($i=0; $i<count($res); $i++){
                    $needOpenIssue = $res[$i]->issue;
                    $html = $this->getGuanIssueNum($needOpenIssue,$code);       //获取官方号码
                    if(isset($html['issue']))
                        $i = count($res);
                }
            }
        }
        if(isset($html['issue']))
            $html['needOpenIssue'] = $needOpenIssue;
        else{
            $html = [];
            $html['needOpenIssue'] = $needOpenIssue;
        }
        return $html;
    }
    //开奖阻止
    public function stopIng($code,$issue,$redis){
        $key = $code.'ing:'.$issue;
        if($redis->exists($key)){
            return 1;
        }
        $redis->setex($key,5,'ing');
        $redis->set($code.':needopen','');
        return 0;
    }
    //试算杀率共用方法
    public function excel($openCode,$exeBase,$issue,$gameId,$table = '',$lotterytype = ''){
        if(empty($table))
            return false;
        writeLog('New_Kill', $table.' issue:'.$issue);
        for($i=1;$i<= (int)$exeBase->excel_num;$i++){
            if($i==1){
                $exeBet = DB::table('excel_bet')->where('issue','=',$issue)->where('game_id',$gameId)->first();
                if(empty($exeBet))
                    DB::connection('mysql::write')->select("INSERT INTO excel_bet  SELECT * FROM bet WHERE bet.issue = '{$issue}' and bet.game_id = '{$gameId}' and bet.testFlag = 0");
            }else{
                DB::connection('mysql::write')->table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->update(["bunko"=>0]);
            }
            $openCode = $this->opennum($table,$exeBase->is_user,$issue,$i);
            if($lotterytype=='lhc'){                                        //根据六合彩的系列另外有bunko
                $resData = $this->exc_play($openCode,$gameId);
                $win = @$resData['win'];
                $he = isset($resData['ids_he'])?$resData['ids_he']:array();
                $bunko = $this->BUNKO_LHC($openCode, $win, $gameId, $issue, $he, true);
            }else{
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,true);
            }
            if($bunko == 1){
                $tmp = DB::connection('mysql::write')->select("SELECT sum(bunko) as sumBunko FROM excel_bet WHERE issue = '{$issue}' and game_id = '{$gameId}'");
                foreach ($tmp as&$value)
                    $excBunko = $value->sumBunko;
                writeLog('New_Kill', $table.' :'.$openCode.' => '.$excBunko);
                $dataExcGame['game_id'] = $gameId;
                $dataExcGame['issue'] = $issue;
                $dataExcGame['opennum'] = $openCode;
                $dataExcGame['bunko'] = $excBunko;
                $dataExcGame['excel_num'] = $i;
                $dataExcGame['created_at'] = date('Y-m-d H:i:s');
                $dataExcGame['updated_at'] = date('Y-m-d H:i:s');
                DB::table('excel_game')->insert([$dataExcGame]);
                if($exeBase->is_user==0)
                    $this->setKillIssueNum($table,$issue,$dataExcGame['excel_num'],$openCode,$excBunko);
            }
        }
//        $aSql = "SELECT opennum FROM excel_game WHERE bunko = (SELECT min(bunko) FROM excel_game WHERE game_id = ".$gameId." AND issue ='{$issue}') and game_id = ".$gameId." AND issue ='{$issue}' LIMIT 1";
//        $tmp = DB::select($aSql);
//        foreach ($tmp as&$value)
//            $openCode = $value->opennum;
        $exeData = DB::table('excel_game')->select(DB::raw('opennum,issue,bunko'))->where('issue',$issue)->where('game_id',$gameId)->groupBy('issue','excel_num')->get();
        $arrLimit = array();
        foreach ($exeData as $key => $val) {
            $arrLimit[(string)$val->bunko] = $val->opennum;
        }
        asort($arrLimit);                //将计算后的杀率值，由小到大排序
        if($exeBase->is_open==1){
            $iLimit = count($arrLimit)==1?1:count($arrLimit)+1;
            if($exeBase->count_date==date('Y-m-d')){            //如果当日的已有计算，则开始以比试算值选号
                $total = $exeBase->bet_lose + $exeBase->bet_win;
                $lose_losewin_rate = $total>0?($exeBase->bet_lose-$exeBase->bet_win)/$total:0;
                if($lose_losewin_rate>$exeBase->kill_rate){            //如果当日的输赢比高于杀率，则选给用户吃红
                    $openCode = $this->opennum($table);
//                    arsort($arrLimit);
//                    $ii = 0;
//                    $randNum = rand(0,10);                              //定一个随机数，随机期数让用户有最大的吃红
//                    if($randNum<=5)
//                        $iLimit = 1;
//                    foreach ($arrLimit as $key2 =>$va2){
//                        $ii++;
//                        if($ii==$iLimit) {
//                            $openCode = $va2;
//                            break;
//                        }
//                    }
                }else{
                    foreach ($arrLimit as $key2 =>$va2){               //如果当日的输赢比低于杀率，则选给杀率号
                        $openCode = $va2;
                        break;
                    }
                }
            }else{                                                     //如果当日的尚未计算，则给中间值
                $ii = 0;
                foreach ($arrLimit as $key2 =>$va2){
                    $ii++;
                    if($ii==$iLimit){
                        $openCode = $va2;
                        break;
                    }
                }
            }
        }else
            $openCode = '';
        writeLog('New_Kill', $table.' :'.$openCode);
        DB::table($table)->where('issue',$issue)->update(["excel_opennum"=>$openCode]);
        DB::table("excel_bet")->where('issue',$issue)->where('game_id',$gameId)->delete();
        DB::table("excel_game")->where('created_at','<=',date('Y-m-d H:i:s',time()-600))->where('game_id',$gameId)->delete();
    }
    //试算杀率个别取用方法，用来继承的父类
    protected function exc_play($openCode,$gameId){
        return '';
    }
    //试算杀率个别取用方法，用来继承的父类
    protected function BUNKO_LHC($openCode, $win, $gameId, $issue, $he, $excel){
        return '';
    }
}