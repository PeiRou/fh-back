<?php

namespace App;

use App\Http\Controllers\Bet\New_msnn;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;
use SameClass\Model\UsersModel;
use SameClass\Config\LotteryGames\Games;

class Excel
{
    /**
     * 更新赢钱的用户馀额
     * @param $gameId
     * @param $issue
     * @param string $gameName
     * @return int
     * 单子状态 0未结算 1已结算 2撤单 3已计算，未反钱 4已返钱，未返水
     */
    public function updateUserMoney($gameId,$issue,$gameName='',$table='',$tableid=0,$is_status=false){
        $betStatus = $is_status?3:1;
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("sum(bunko) as s"),'user_id')->where('status',$betStatus)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>',0)->groupBy('user_id')->get();
        $getDt = DB::connection('mysql::write')->table('bet')->select('bunko','user_id','game_id','playcate_id','play_name','order_id','issue','playcate_name','play_name','play_odds','order_id','bet_money','unfreeze_money','nn_view_money')->where('game_id',$gameId)->where('issue',$issue)->where('status',$betStatus)->where('bunko','>',0)->get();
        if($get){
            //更新返奖的用户馀额
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->s ";
            }
            $capUsers = DB::connection('mysql::write')->table('users')->select('id','money','testFlag')->whereIn('id',$users)->get()->keyBy('id')->toArray();
            $ids = implode(',',$users);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                $up = DB::connection('mysql::write')->statement($sql);
                if($up != 1){
                    return 1;
                }
            }
            $capData = [];
            $push = [];             //组装推送消息的数组
            $ii = 0;

            $redis = Redis::connection();
            $redis->select(5);
            //新增有返奖的用户的资金明细
            foreach ($getDt as $i){
                if(in_array($i->game_id,array(90,91)) && $i->unfreeze_money!=0){ //根据牛牛翻倍玩法增加解冻的资金明细
                    $capUsers[$i->user_id]['money'] += $i->unfreeze_money;
                    $tmpCap = [];
                    $tmpCap['to_user'] = $i->user_id;
                    $tmpCap['user_type'] = 'user';
                    $tmpCap['order_id'] = 'UF'.substr($i->order_id,2);
                    $tmpCap['type'] = 't26';
                    $tmpCap['money'] = $i->unfreeze_money;
                    $tmpCap['balance'] = round($capUsers[$i->user_id]['money'],3);
                    $tmpCap['operation_id'] = 0;
                    $tmpCap['issue'] = $i->issue;
                    $tmpCap['game_id'] = $i->game_id;
                    $tmpCap['game_name'] = $gameName;
                    $tmpCap['playcate_id'] = $i->playcate_id;
                    $tmpCap['playcate_name'] = $i->playcate_name;
                    $tmpCap['content'] = $gameName.'-'.$i->play_name.'-'.$i->play_odds;
                    $tmpCap['testFlag'] = $capUsers[$i->user_id]['testFlag'];
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
                if(!isset($capUsers[$i->user_id]))
                    continue;
                $capUsers[$i->user_id]['money'] += $bunko; //累加馀额
                $tmpCap = [];
                $tmpCap['to_user'] = $i->user_id;
                $tmpCap['user_type'] = 'user';
                $tmpCap['order_id'] = 'W'.substr($i->order_id,1);
                $tmpCap['type'] = ($i->bet_money==$bunko&&!in_array($i->game_id,array(90,91))&&$i->unfreeze_money==0)?'t02':'t09';      //如果投注金额与赢金额一样，就是属于t02退本金
                $tmpCap['money'] = $bunko;
                $tmpCap['balance'] = round($capUsers[$i->user_id]['money'],3);
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
//                $tmpContent = '<div><span style="color: red">'.$gameName.'</span>'.$content. '已中奖，中奖金额 <span style="color:#8d71ff">' .round($winBunko,3).'元</span></div>';
                $tmpContent = "<div><span style='color: red'>".$gameName."</span>".$content. "已中奖，中奖金额 <span style='color:#8d71ff'>" .round($winBunko,3)."元</span></div>";
                $push[] = array('userid'=>$i->user_id,'notice'=>$tmpContent);
            }
            krsort($capData);
            $capIns = DB::table('capital')->insert($capData);
            if($capIns != 1){
                return 1;
            }
            if(!empty(env('PUSHER_APP_ID',''))){
                foreach ($push as $key => $val){
//                    @event(new BackPusherEvent('win','中奖通知',$val['notice'],array('fnotice-'.$val['userid'])));
                    $pushData['notice'] = $val['notice'];
                    $pushData['userid'] = $val['userid'];
                    $this->pushWinInfo($pushData);
                }
            }
        } else {
            writeLog('New_Bet',$gameName.'已结算过，已阻止！');
        }
        if($is_status){
            $res = DB::table('bet')->where('status',$betStatus)->where('game_id',$gameId)->where('issue',$issue)->update(['status' => 1]);
            if(!$res)
                writeLog('New_Bet',$gameName.$issue.'返钱失败！');
        }
        return 0;
    }
    //中奖推送
    private function pushWinInfo($pushData){
        try{
            Artisan::call("PARAM_PUSH_WIN",$pushData);
        }catch (\Exception $exception){
            writeLog('error', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
    //反水
    public function reBackUser($gameId,$issue,$gameName=''){
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("SUM(bet.bet_money * bet.play_rebate) AS back_money"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('play_rebate','>=',0.00000001)->groupBy('user_id')->get();
        if($get){
            if (count($get)==0)
                return 0;
            //更新返奖的用户馀额
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->back_money ";
            }
            $capUsers = DB::connection('mysql::write')->table('users')->select('id','money','testFlag')->whereIn('id',$users)->get()->keyBy('id')->toArray();
            $ids = implode(',',$users);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                $up = DB::connection('mysql::write')->statement($sql);
                if($up != 1){
                    return 1;
                }
            }
            # 反水计算打码
            UsersModel::userCheakDrawings($get->toArray(),'t14',  $users, 'user_id', 'back_money');

            $capData = [];
            $ii = 0;

            //新增有返奖的用户的资金明细
            foreach ($get as $i){
                $tmpCap = [];
                $tmpCap['to_user'] = $i->user_id;
                $tmpCap['user_type'] = 'user';
                $tmpCap['order_id'] = $this->randOrder('BW');
                $tmpCap['type'] = 't14';
                $tmpCap['money'] = $i->back_money;
                $tmpCap['balance'] = round($capUsers[$i->user_id]['money']+$i->back_money,3);
                $tmpCap['operation_id'] = 0;
                $tmpCap['issue'] = $issue;
                $tmpCap['game_id'] = $gameId;
                $tmpCap['game_name'] = $gameName;
                $tmpCap['playcate_id'] = 0;
                $tmpCap['playcate_name'] = '';
                $tmpCap['content'] = '';
                $tmpCap['testFlag'] = $capUsers[$i->user_id]['testFlag'];
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
            writeLog('New_Bet',$gameName.'已结算过，已阻止！');
        }
        return 0;
    }
    //计算当日总输赢
    public function bet_total($issue,$lotterys){
        $gameId = $lotterys['gameId'];
        $havElse = $lotterys['conElseLottery'];
        $betGameWhere = " and bet.game_id = '{$gameId}' ";

        if(!empty($havElse)){       //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
            $Games = new Games();
            $havElseLottery = isset($Games->games[$havElse])?$Games->games[$havElse]:[];
            if(count($havElseLottery)>0)      //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
                $betGameWhere = " and bet.game_id in ('{$gameId}','{$havElseLottery['gameId']}') ";
        }
        $exceBase = DB::table('excel_base')->select('excel_base_idx','count_date','is_user')->where('game_id',$gameId)->first();
        if(empty($exceBase))
            return false;
        $dataUnity = [];
        if(empty($exceBase->count_date) || $exceBase->count_date!=date("Y-m-d")){
            $todaystart = date("Y-m-d 00:00:00");
            $todayend = date("Y-m-d 23:59:59");
            $where = $betGameWhere;
            $where .= " and created_at BETWEEN '{$todaystart}' and '{$todayend}' and status >= 1 ";
            $tmp = $this->countAllLoseWin($where,$havElse);
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
            $where = $betGameWhere;
            $where .= " and issue = '{$issue}' ";
            $tmp = $this->countAllLoseWin($where,$havElse);
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
    private function countAllLoseWin($where='',$havElse){
        if(empty($havElse))
            $strSql = "SELECT sum(bet_money) as sumBet_money,sum(case when bunko >0 then bunko-bet_money else 0 end) as sumBunkoWin,sum(case when bunko < 0 then bunko else 0 end) as sumBunkoLose FROM bet WHERE 1 and testFlag = 0 ".$where;
        else
            $strSql = "SELECT sum(CASE WHEN `game_id` IN(90,91) THEN bet_money+freeze_money else bet_money end ) as sumBet_money,
sum(CASE WHEN `game_id` IN(90,91) THEN case when `nn_view_money` > 0 then `nn_view_money`-`freeze_money` else 0 end ELSE (case when bunko >0 then bunko-bet_money else 0 end) END) as sumBunkoWin,
sum(CASE WHEN `game_id` IN(90,91) THEN case when `nn_view_money` < 0 then `nn_view_money` else 0 end ELSE (case when bunko < 0 then bunko else 0 end) END) as sumBunkoLose 
FROM bet WHERE 1 and testFlag = 0 ".$where;

        $sql = DB::connection('mysql::write')->select($strSql);
        return $sql;
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
    public function getNeedBunkoIssue($table,$code='',$havElse='',$havElseLottery=[]){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        if(empty($havElse) || !isset($havElseLottery['table']))
            $sql = "SELECT * FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 0 order by id desc LIMIT 1";
        else{
            if($code=='mssc')
                $sql = "SELECT * FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 0 and nn_bunko = 1 order by id desc LIMIT 1";
            else{
                $sql = "SELECT {$table}.* FROM {$table} 
                            join {$havElseLottery['table']} on {$table}.issue = {$havElseLottery['table']}.issue
                            WHERE {$table}.opentime <='".$today."' and {$table}.is_open=1 
                             and {$table}.bunko = 0
                             and {$havElseLottery['table']}.bunko = 1 order by {$table}.id desc LIMIT 1";
            }
        }
        $tmp = DB::select($sql);
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得最新的需要结算奖期-All
    public function getNeedBunkoIssueAll($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $sql = "SELECT * FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 0 order by id desc";
        $res = DB::select($sql);
        if(empty($res))
            return false;
        return $res;
    }
    //取得最新的需要结算奖期
    public function getNeedBunkoIssueLhc($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::select("SELECT * FROM {$table} WHERE opentime <='".$today."' and is_open=1 and bunko = 2 order by id desc LIMIT 1");
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
//        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1 and nn_bunko = 0)");
        $sql = "SELECT * FROM {$table} WHERE opentime <='".$today."' and is_open=1 and nn_bunko = 0 order by id desc LIMIT 1";
        $tmp = DB::select($sql);
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //取得最新的需要结算NN奖期-所有的
    public function getNeedNNBunkoIssueAll($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
//        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=1 and nn_bunko = 0)");
        $res = DB::select("SELECT * FROM {$table} WHERE opentime <='".$today."' and is_open=1 and nn_bunko = 0 order by id desc");
        if(empty($res))
            return false;
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
    public function opennum($code,$type,$is_user=1,$needOpenIssue='',$num=0){
        if($is_user){
            switch ($type){
                case 'k3':
                    return $this->opennum_k3();
                    break;
                case 'car':
                    return $this->opennum_pk10();
                    break;
                case 'ssc':
                    return $this->opennum_ssc($num);
                    break;
                case 'qxc':
                    return $this->opennum_qxc();
                    break;
                case 'nc':
                    return $this->opennum_xync();
                    break;
                case 'kl8':
                    return $this->opennum_kl8();
                case 'lhc':
                    return $this->opennum_lhc($num);
                    break;

            }
        }else{
            if($num>0){
                $res = $this->getKillIssueNum($code,$needOpenIssue,$num);
                return isset($res['data'])?$res['data']:'';
            }else{
                if(empty($needOpenIssue))
                    return '';
                $res = $this->getZiYingIssueNum($code,$needOpenIssue);
                return isset($res['opennum'])?$res['opennum']:'';
            }
        }
        return '';
    }

    private $kill_lottery = array(
        'game_mssc' => array('id'=>80,'api'=>'mssc'),       //秒速赛车
        'game_msft' => array('id'=>82,'api'=>'msft'),       //秒速飞艇
        'game_msssc' => array('id'=>81,'api'=>'msssc'),     //秒速时时彩
        'game_paoma' => array('id'=>99,'api'=>'paoma'),     //香港跑马
        'game_xylhc' => array('id'=>85,'api'=>'xylhc'),     //幸运六合彩
        'game_msjsk3' => array('id'=>86,'api'=>'msjsk3'),   //秒速快三
        'game_qqffc' => array('id'=>113,'api'=>'qqffc'),    //QQ分分彩
        'game_kssc' => array('id'=>801,'api'=>'kssc'),      //快速赛车
        'game_ksft' => array('id'=>802,'api'=>'ksft'),      //快速飞艇
        'game_ksssc' => array('id'=>803,'api'=>'ksssc'),    //快速时时彩
        'game_twxyft' => array('id'=>804,'api'=>'twxyft'),  //台湾幸运飞艇
    );

    private function opennum_pk10($num=0){
        $tmpArray = [0=>1,1=>2,2=>3,3=>4,4=>5,5=>6,6=>7,7=>8,8=>9,9=>10];
        switch ($num) {
            case 2:
                $arr = range(1,10,1);
                shuffle($arr);   //打乱数组
                break;
            case 3:
                $arr = range(1,10,1);
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
            case 4:
                $arr = range(1,10,1);
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
            case 5:
                $arr = range(1,10,1);
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                shuffle($arr);   //打乱数组
                break;
            default:
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
                break;
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

    /**
     * 除了六合彩外的彩种结算
     * @param $win
     * @param $gameId
     * @param $issue
     * @param bool $excel
     * @param array $arrPlay_id
     * @return int
     */
    public function bunko($win,$gameId,$issue,$excel=false,$arrPlay_id = [],$is_status=false){
        $betStatus = $is_status?3:1;
        try {
            if ($excel) {
                $table = 'excel_bet';
            } else {
                $table = 'bet';
            }
            $getUserBets = DB::connection('mysql::write')->table($table)->select('bet_id','bet_money','play_odds')->where('status',0)->where('game_id', $gameId)->where('issue', $issue)->where('bunko', '=', 0.00)->get();
            $id = [];
            foreach ($win as $k => $v) {
                $id[] = $v;
            }
            if ($getUserBets) {
                $sql_upd = "UPDATE " . $table . " SET bunko = CASE ";
                $sql_upd_lose = "UPDATE " . $table . " SET bunko = CASE ";
                $ids = implode(',', $id);
                $ids_lose = array_diff($arrPlay_id,$id);
                $ids_lose = implode(',', $ids_lose);
                if ($ids && isset($ids)) {
                    $sql = "";
                    $sql_lose = "";
                    foreach ($getUserBets as $item) {
                        $bunko = $item->bet_money * $item->play_odds;
                        $bunko_lose = 0 - $item->bet_money;
                        $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                        $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    }
                    $sql_upd .= $sql . "END, status = ".$betStatus." , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids)";
                    $sql_upd_lose .= $sql_lose . "END, status = ".$betStatus." , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids_lose)";
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
            }else
                return 0;
        }catch (\exception $exception){
            writeLog('error',__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            DB::table($table)->where('status',$betStatus)->where('issue',$issue)->where('game_id',$gameId)->update(['bunko' => 0,'status' => 0]);
            return 0;
        }
    }

    /**
     * 产生订单号
     * @param $fix
     * @return string
     */
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
    //结算阻止
    public function stopBunko($gameId,$time=1,$strBunko='Bunko'){
        $redis = Redis::connection();
        $redis->select(0);
        //阻止進行中
        $key = $strBunko.':'.$gameId.'ing:';
        if($redis->exists($key)){
            return '1';
        }
        $redis->setex($key,$time,'ing');
        return '0';
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
    public function excel($openCode,$exeBase,$issue,$code,$lotterys){
        $type = $lotterys['type'];
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $havElse = $lotterys['conElseLottery'];
        $havElseLottery = [];
        $betGameWhere = " and bet.game_id = '{$gameId}' ";
        $betExeGameWhere = " and excel_bet.game_id = '{$gameId}' ";

        writeLog('New_Kill', $code.'-- issue:'.$issue);
        if(!empty($havElse)){       //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
            $Games = new Games();
            $havElseLottery = isset($Games->games[$havElse])?$Games->games[$havElse]:[];
            if(count($havElseLottery)>0){      //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
                $betGameWhere = " and bet.game_id in ('{$gameId}','{$havElseLottery['gameId']}') ";
                $betExeGameWhere = " and excel_bet.game_id in ('{$gameId}','{$havElseLottery['gameId']}') ";
            }
        }

        $param['lottery'] = $lotterys;
        $param['lotteryElse'] = $havElseLottery;
        $bet = DB::table('bet')->select('bet_id')->where('status',0)
            ->where(function ($sql) use ($param) {
                if(count($param['lotteryElse'])>0)      //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
                    return $sql->whereIn('game_id',[$param['lottery']['gameId'],$param['lotteryElse']['gameId']]);
                else
                    return $sql->where('game_id',$param['lottery']['gameId']);
            })->where('issue','=',$issue)->where('testFlag',0)->first();
        if(empty($bet))
            return false;

        for($i=1;$i<= (int)$exeBase->excel_num;$i++){
            if($i==1){
                $exeBet = DB::table('excel_bet')->select('bet_id')->where('status',0)
                    ->where(function ($sql) use ($param) {
                        if(count($param['lotteryElse'])>0)      //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
                            return $sql->whereIn('game_id',[$param['lottery']['gameId'],$param['lotteryElse']['gameId']]);
                        else
                            return $sql->where('game_id',$param['lottery']['gameId']);
                    })->where('issue','=',$issue)->where('testFlag',0)->first();
                if(empty($exeBet)){
                    DB::connection('mysql::write')->select("INSERT INTO excel_bet  SELECT * FROM bet WHERE 1 and bet.status = 0 ".$betGameWhere." and bet.issue = '{$issue}' and bet.testFlag = 0");
                }
            }else{
                DB::connection('mysql::write')->table("excel_bet")->where(function ($sql) use ($param) {
                    if(count($param['lotteryElse'])>0)      //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
                        return $sql->whereIn('game_id',[$param['lottery']['gameId'],$param['lotteryElse']['gameId']]);
                    else
                        return $sql->where('game_id',$param['lottery']['gameId']);
                })->where('issue',$issue)->update(['status' => 0,'bunko' => 0,'nn_view_money' => 0]);
            }
            $openCode = $this->opennum($code,$type,$exeBase->is_user,$issue,$i);
            $nnBunko = 1;
            if($type=='lhc'){                                        //根据六合彩的系列另外有bunko
                $resData = $this->exc_play($openCode,$gameId);
                $win = @$resData['win'];
                $he = isset($resData['ids_he'])?$resData['ids_he']:array();
                $LHC = isset($resData['LHC'])?$resData['LHC']:null;
                $bunko = $this->BUNKO_LHC($openCode, $win, $gameId, $issue, $he, true, $LHC);
            }else{
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,true,$this->arrPlay_id);
                if($havElse=='msnn' && $havElseLottery['type']=='nn'){   //只有秒速赛车需要额外加秒速牛牛的杀率
                    $msnn = new New_msnn();
                    $niuniu = $this->exePK10nn($openCode);
                    $openniuniu =$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]);
                    $nnBunko = $msnn->all($openCode,$openniuniu, $issue, 0, true,$havElse,$havElseLottery); //新--结算
                }
            }
            if($bunko == 1 && $nnBunko){
                $sql = "SELECT SUM(`bunko`) AS `sumBunko` FROM excel_bet WHERE 1 ".$betExeGameWhere." and issue = '{$issue}'";
                $tmp = DB::connection('mysql::write')->select($sql);
                $excBunko = 0;
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
        //开启智能杀率
        if(isset($exeBase->is_ai)&&$exeBase->is_ai){
            if($exeBase->is_open==1){
                $exeData = DB::table('excel_game')->select(DB::raw('opennum,issue,bunko'))->where('game_id',$gameId)->where('issue',$issue)->groupBy('issue','excel_num')->get();
                writeLog('New_Kill', $table.' :'.$issue.' origin-'.json_encode($exeData));
                $arrLimit = array();
                foreach ($exeData as $key => $val) {
                    $arrLimit[(string)$val->bunko] = $val->opennum;
                }
                ksort($arrLimit);                //将计算后的杀率值，由小到大排序
                writeLog('New_Kill', $table.' :'.$issue.' s-to-b-'.json_encode($arrLimit));
                $ii = 0;
                $randNum = rand(0,10);                              //定一个随机数，随机期数让用户有最大的吃红
                if($exeBase->count_date==date('Y-m-d')){            //如果当日的已有计算，则开始以比试算值选号
                    $total = $exeBase->bet_lose + $exeBase->bet_win;
                    $lose_losewin_rate = $total>0?($exeBase->bet_lose-$exeBase->bet_win)/$total:0;
                    writeLog('New_Kill', $table.' :'.$issue.' now: '.$lose_losewin_rate.' target: '.$exeBase->kill_rate);
                    $randRate = rand(1000,1999)/1000;
                    if($lose_losewin_rate>($exeBase->kill_rate*$randRate)){            //如果当日的输赢比高于杀率，则选给用户吃红
                        $openCode = $this->opennum($code,$type,$exeBase->is_user,$issue,$i);
                    }else{
                        if($lose_losewin_rate<=0.1 || (!in_array($randNum,array(3,5,7)))) {                        //如果当日的输赢比低于0，则选平台最好的营利值
                            $iLimit = 1;
                            foreach ($arrLimit as $key2 =>$va2){               //如果当日的输赢比低于杀率，则选给杀率号
                                $ii++;
                                if($ii==$iLimit) {
                                    $openCode = $va2;
                                    break;
                                }
                            }
                        }else
                            $openCode = $this->opennum($code,$type,$exeBase->is_user,$issue,$i);
                    }
                }else{                                        //如果当日的尚未计算，则给中间值
                    foreach ($arrLimit as $key2 =>$va2){
                        $openCode = $va2;
                        break;
                    }
                }
            }else {
                $openCode = '';
            }
        }else{  //传统模式
            if($exeBase->is_open==1) {
                $total = $exeBase->bet_lose + $exeBase->bet_win;
                $lose_losewin_rate = $total>0?($exeBase->bet_lose-$exeBase->bet_win)/$total:0;
                writeLog('New_Kill', $table.' :'.$issue.' now: '.$lose_losewin_rate.' target: '.$exeBase->kill_rate);
                if($lose_losewin_rate<=($exeBase->kill_rate)) {            //平台最大营利去选杀号
                    $aSql = "SELECT opennum FROM excel_game WHERE bunko = (SELECT min(bunko) FROM excel_game WHERE game_id = " . $gameId . " AND issue ='{$issue}') and game_id = " . $gameId . " AND issue ='{$issue}' LIMIT 1";
                    $tmp = DB::select($aSql);
                    foreach ($tmp as &$value)
                        $openCode = $value->opennum;
                }else
                    $openCode = $this->opennum($code,$type,$exeBase->is_user,$issue,$i);
            }else{
                $openCode = '';
            }
        }
        writeLog('New_Kill', $table.' :'.$openCode);
        DB::table($table)->where('issue',$issue)->update(["excel_opennum"=>$openCode]);
        DB::table("excel_bet")->where('created_at','<=',date('Y-m-d H:i:s',time()-600))->limit(1000)->delete();
        DB::table("excel_game")->where('created_at','<=',date('Y-m-d H:i:s',time()-600))->limit(1000)->delete();
    }
    //试算杀率个别取用方法，用来继承的父类
    protected function exc_play($openCode,$gameId){
        return '';
    }
    //试算杀率个别取用方法，用来继承的父类
    protected function exc_play_nn($openCode,$gameId,$nn){
        return '';
    }

    /**
     * 六合彩类结算
     * @param $openCode
     * @param $win
     * @param $gameId
     * @param $issue
     * @param $he
     * @param $excel
     * @param null $LHC
     * @return int
     */
    protected function BUNKO_LHC($openCode, $win, $gameId, $issue, $he, $excel, $LHC = null){
        $bunko_index = 0;
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }

        if($excel) {
            $table = 'excel_bet';
        }else{
            $table = 'bet';
        }
        $getUserBets = DB::connection('mysql::write')->table($table)->select('bet_id','bet_money','play_odds','playcate_id','play_id','bet_info')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();

        if($getUserBets){
            $sql = "UPDATE ".$table." SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE ".$table." SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE ".$table." SET bunko = CASE "; //和局的SQL语句

            $win = $id;
            $lose = $id;
            $sql_bets = '';
            $sql_bets_lose = '';
            $sql_bets_he = '';
            $arrLHC_Cate = [];
            foreach ($getUserBets as $item){
                $bunko = ($item->bet_money * $item->play_odds);
                $bunko_lose = (0-$item->bet_money);
                $bunko_he = $item->bet_money * 1;
                $sql_bets .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                $sql_bets_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                $sql_bets_he .= "WHEN `bet_id` = $item->bet_id THEN $bunko_he ";
                $arrLHC_Cate[$item->playcate_id][] = $item;
            }
            if(count($he)>0) {
                $ids_he = [];
                foreach ($he as $k=>$v){
                    $ids_he[] = $v;
                    unset($win[$v]);
                    $lose[] = $v;
                }
                $ids_he = implode(',', $ids_he);
                $sql_he .= $sql_bets_he . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids_he)";
            }else
                $sql_he = '';
            $ids = implode(',', $win);
            $ids_lose = array_diff($this->arrPlay_id,$lose);
            $ids_lose = implode(',', $ids_lose);
            $sql .= $sql_bets . "END, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids)";
            $sql_lose .= $sql_bets_lose . "END, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($ids_lose)";
            if(!empty($sql_bets)) {
                $run = DB::statement($sql);
                if($run == 1)
                    $bunko_index++;
            }
            if(!empty($sql_he)){
                $runhe = DB::connection('mysql::write')->statement($sql_he);
                if($runhe == 1)
                    $bunko_index++;
            }

            //自选不中------开始
            $playCate = $this->arrPlayCate['ZIXUANBUZHONG']; //特码分类ID
            $ids_else = array();
            if(isset($arrLHC_Cate[$playCate]))
                $ids_else = $LHC->LHC_ZXBZH($openCode,$ids_else,$arrLHC_Cate[$playCate]);
            //自选不中------结束
            //合肖-----开始
            $playCate = $this->arrPlayCate['HEXIAO']; //分类ID
            if(isset($arrLHC_Cate[$playCate]))
                $ids_else = $LHC->LHC_HX($ids_else,$arrLHC_Cate[$playCate]);
            //合肖-----结束
            //正肖-----开始
            $playCate = $this->arrPlayCate['ZHENGXIAO']; //分类ID
            $sql_zx = '';
            if(isset($arrLHC_Cate[$playCate]))
                $sql_zx = $LHC->LHC_ZX($gameId,$table,$playCate,$arrLHC_Cate[$playCate]);
            //正肖-----结束
            //连肖连尾-----开始
            $playCate = $this->arrPlayCate['LIANXIAOLIANWEI']; //分类ID
            if(isset($arrLHC_Cate[$playCate]))
                $ids_else = $LHC->LHC_LXLW($gameId,$ids_else,$playCate,$arrLHC_Cate[$playCate]);
            //连肖连尾-----结束

            //连码-----开始
            $playCate = $this->arrPlayCate['LIANMA']; //分类ID
            $sql_lm = '';
            if(isset($arrLHC_Cate[$playCate]))
                $sql_lm = $LHC->LHC_LIANMA($openCode,$gameId,$table,$arrLHC_Cate[$playCate]);
            //连码-----结束

            if(!empty($sql_bets_lose)){
                $run = DB::connection('mysql::write')->statement($sql_lose);
                if($run == 1){
                    $bunko_index++;
                }
            }
            if(!empty($sql_zx)){
                $run = DB::connection('mysql::write')->statement($sql_zx);
                if($run == 1){
                    $bunko_index++;
                }
            } else {
                $bunko_index++;
            }
            if(!empty($sql_lm)){
                $run = DB::connection('mysql::write')->statement($sql_lm);
                if($run == 1){
                    $bunko_index++;
                }
            } else {
                $bunko_index++;
            }
            if(count($ids_else)>0){
                $ids_else = implode(',', $ids_else);
                $sql_else = "UPDATE ".$table." SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_else)"; //中奖的SQL语句
                $run3 = DB::connection('mysql::write')->statement($sql_else);
                if($run3 == 1){
                    $bunko_index++;
                }
            } else {
                $bunko_index++;
            }
        }

        if($bunko_index !== 0){
            return 1;
        }
        return 0;
    }
    //试算杀率个别取用方法，用来继承的父类
    protected $arrPlay_id = [];
    protected $arrPlayCate = [];

    /**
     * 农场类结算
     * @param $win
     * @param $gameId
     * @param $issue
     * @param $openCode
     * @param $he
     * @param $NC
     * @return int
     */
    protected function bunko_nc($win,$gameId,$issue,$openCode,$he,$NC){
        $bunko_index = 0;
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $table = 'bet';
        $getUserBets = DB::connection('mysql::write')->table($table)->select('bet_id','bet_money','play_odds')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            $sql = "UPDATE bet SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE bet SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE bet SET bunko = CASE "; //和局的SQL语句

            $ids = implode(',', $id);
            $ids_lose = array_diff($this->arrPlay_id,$id);
            $sql_bets = '';
            $sql_bets_lose = '';
            $sql_bets_he = '';
            foreach ($getUserBets as $item){
                $bunko = $item->bet_money * $item->play_odds;
                $bunko_lose = 0-$item->bet_money;
                $bunko_he = $item->bet_money * 1;
                $sql_bets .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                $sql_bets_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                $sql_bets_he .= "WHEN `bet_id` = $item->bet_id THEN $bunko_he ";
            }
            if(count($he)>0) {
                $ids_he = [];
                $tmpids = explode(',',$ids);
                foreach ($he as $k=>$v){
                    $ids_he[] = $v;
                    unset($tmpids[$v]);
                    unset($ids_lose[$v]);
                }
                $ids = implode(',', $tmpids);
                $ids_he = implode(',', $ids_he);
                $sql_he .= $sql_bets_he . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `status` = 0 AND  `issue` = $issue AND `game_id` = $gameId AND `play_id` IN ($ids_he)";
            }else
                $sql_he = '';
            $ids_lose = implode(',', $ids_lose);
            $sql .= $sql_bets . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `status` = 0 AND  `issue` = $issue AND `game_id` = $gameId AND `play_id` IN ($ids)";
            $sql_lose .= $sql_bets_lose . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `status` = 0 AND `issue` = $issue AND `game_id` = $gameId AND `play_id` IN ($ids_lose)";
            if(!empty($sql_bets)){
                $run = DB::statement($sql);
                if($run == 1) {
                    $bunko_index++;
                }
            }

            //连码-----开始
            $sql_lm = $NC->NC_LIANMA($openCode,$gameId,$table,$issue);
            //连码-----结束

            if(!empty($sql_he)){
                $runhe = DB::connection('mysql::write')->statement($sql_he);
                if($runhe == 1)
                    $bunko_index++;
            }
            if(!empty($sql_bets_lose)){
                $run2 = DB::connection('mysql::write')->statement($sql_lose);
                if($run2 == 1)
                    $bunko_index++;
            }
            if(!empty($sql_lm)){
                $run3 = DB::connection('mysql::write')->statement($sql_lm);
                if($run3 == 1){
                    $bunko_index++;
                }
            } else {
                $bunko_index++;
            }

            if($bunko_index !== 0){
                return 1;
            }
        }
    }

    /**
     * 牛牛类结算
     * @param $win
     * @param $lose
     * @param $gameId
     * @param $issue
     * @return int
     */
    protected function bunko_nn($win,$lose,$gameId,$issue,$excel=false)
    {
        $in = 0;
        $loseArr = [];
        $winArr = [];

        if($excel) {
            $table = 'excel_bet';
        }else{
            $table = 'bet';
        }
        $getUserBets = DB::table($table)->select('bet_id','play_id','playcate_id','bet_money','freeze_money')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            if(count($win) !== 0){
                $sql_win = "UPDATE ".$table." SET bunko = CASE ";
                $sql_nn_money = " , nn_view_money = CASE ";
                $sql_unfreeze_win = " , unfreeze_money = CASE ";
                foreach ($getUserBets as $item){
                    foreach ($win as $k=>$v){
                        $v[1] = (int)$v[1];
                        if($v[0] == $item->play_id){
                            $rate = 1;
                            if($this->arrPlayCate['NN'] == $item->playcate_id){
                                switch ($v[1]) {
                                    case 7:
                                    case 8:
                                        $rate = 2;
                                        break;
                                    case 9:
                                        $rate = 3;
                                        break;
                                    case 10:
                                        $rate = 5;
                                        break;
                                }
                            }else
                                $item->freeze_money = 0;
                            $bunko = ($item->bet_money + $item->bet_money * $rate) + $item->freeze_money;
                            $unfreeze = $item->freeze_money;
                            $nn_money = $bunko - $item->bet_money - $item->freeze_money;
                            $sql_win .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                            $sql_unfreeze_win .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                            $sql_nn_money .= "WHEN `bet_id` = $item->bet_id THEN $nn_money ";
                            $winArr[] = $item->play_id;
                        }
                    }
                }
                $WinListIn = implode(',', $winArr);
                if($WinListIn && isset($WinListIn)){
                    $sql_win .= "END ";
                    $sql_nn_money .= "END ";
                    $sql_unfreeze_win .= "END, status = 3, updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($WinListIn)";
//                    writeLog('bunko_nn', 'win:'.$sql_win.$sql_nn_money.$sql_unfreeze_win);
                    $run = DB::statement($sql_win.$sql_nn_money.$sql_unfreeze_win);
                    if($run == 1){
                        $in++;
                    }
                } else {
                    $in++;
                }

            }
            if(count($lose) !== 0){
                $sql_lose = "UPDATE ".$table." SET bunko = CASE ";
                $sql_nn_money = " , nn_view_money = CASE ";
                $sql_unfreeze_lose = " , unfreeze_money = CASE ";
                foreach ($getUserBets as $item){
                    foreach ($lose as $k=>$v){
                        $v[1] = (int)$v[1];
                        if($v[0] == $item->play_id){
                            $v[1] = (int)$v[1];
                            if($this->arrPlayCate['NN'] == $item->playcate_id) {
                                switch ($v[1]) {
                                    case 7:
                                    case 8:
                                        $bunko = ($item->bet_money + $item->freeze_money) - $item->bet_money * 2;
                                        $unfreeze = $item->freeze_money - $item->bet_money;
                                        $nn_money = $bunko - $item->bet_money - $item->freeze_money;
                                        break;
                                    case 9:
                                        $bunko = ($item->bet_money + $item->freeze_money) - $item->bet_money * 3;
                                        $unfreeze = $item->freeze_money - $item->bet_money * 2;
                                        $nn_money = $bunko - $item->bet_money - $item->freeze_money;
                                        break;
                                    case 10:
                                        $bunko = ($item->bet_money + $item->freeze_money) - $item->bet_money * 5;
                                        $unfreeze = 0;
                                        $nn_money = $bunko - $item->bet_money - $item->freeze_money;
                                        if ($bunko == 0) {
                                            $bunko = -1;
                                        }
                                        break;
                                    default:
                                        $bunko = ($item->bet_money + $item->freeze_money) - $item->bet_money;
                                        $unfreeze = $item->freeze_money;
                                        $nn_money = $bunko - $item->bet_money - $item->freeze_money;
                                        break;
                                }
                            }else{
                                $bunko = -$item->bet_money;
                                $unfreeze = 0;
                                $nn_money = $bunko;
                            }
                            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                            $sql_unfreeze_lose .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                            $sql_nn_money .= "WHEN `bet_id` = $item->bet_id THEN $nn_money ";
                            $loseArr[] = $item->play_id;
                        }
                    }
                }
//                writeLog('bunko_nn_lose', 'lose:'.$sql_lose);
                $LoseListIn = implode(',', $loseArr);
                if($LoseListIn && isset($LoseListIn)){
                    $sql_lose .= "END ";
                    $sql_nn_money .= "END ";
                    $sql_unfreeze_lose .= "END, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE status = 0 AND `game_id` = $gameId AND `issue` = $issue AND `play_id` IN ($LoseListIn)";
//                    writeLog('bunko_nn', 'lose:'.$sql_lose.$sql_nn_money.$sql_unfreeze_lose);
                    $run = DB::statement($sql_lose.$sql_nn_money.$sql_unfreeze_lose);
                    if($run == 1){
                        $in++;
                    }
                } else {
                    $in++;
                }

            }
            if($in == 1 || $in == 2){
                return 1;
            }
        }
    }

    /**
     * 11选5类结算
     * @param $win
     * @param $gameId
     * @param $issue
     * @param $openCode
     * @param $he
     * @return int
     */
    protected function bunko_gd11x5($win,$gameId,$issue,$openCode,$he,$a11X5)
    {
        $bunko_index = 0;
        $openCodeArr = explode(',',$openCode);

        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $table = 'bet';
        $getUserBets = DB::connection('mysql::write')->table($table)->select('bet_id','bet_money','play_odds')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            $sql = "UPDATE bet SET bunko = CASE "; //中奖的SQL语句
            $sql_lose = "UPDATE bet SET bunko = CASE "; //未中奖的SQL语句
            $sql_he = "UPDATE bet SET bunko = CASE "; //和局的SQL语句

            $ids = implode(',', $id);
            $ids_lose = array_diff($this->arrPlay_id,$id);
            $sql_bets = '';
            $sql_bets_lose = '';
            $sql_bets_he = '';
            foreach ($getUserBets as $item){
                $bunko = $item->bet_money * $item->play_odds;
                $bunko_lose = 0-$item->bet_money;
                $bunko_he = $item->bet_money * 1;
                $sql_bets .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                $sql_bets_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                $sql_bets_he .= "WHEN `bet_id` = $item->bet_id THEN $bunko_he ";
            }
            if(count($he)>0) {
                $ids_he = [];
                $tmpids = explode(',',$ids);
                foreach ($he as $k=>$v){
                    $ids_he[] = $v;
                    unset($tmpids[$v]);
                    unset($ids_lose[$v]);
                }
                $ids = implode(',', $tmpids);
                $ids_he = implode(',', $ids_he);
                $sql_he .= $sql_bets_he . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `status` = 0 AND  `issue` = $issue AND `game_id` = $gameId AND `play_id` IN ($ids_he)";
            }else
                $sql_he = '';
            $ids_lose = implode(',', $ids_lose);
            $sql .= $sql_bets . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `status` = 0 AND  `issue` = $issue AND `game_id` = $gameId AND `play_id` IN ($ids)";
            $sql_lose .= $sql_bets_lose . "END, status = 3 , updated_at ='" . date('Y-m-d H:i:s') . "' WHERE `status` = 0 AND `issue` = $issue AND `game_id` = $gameId AND `play_id` IN ($ids_lose)";
            if(!empty($sql_bets)){
                $run = DB::statement($sql);
                if($run == 1) {
                    $bunko_index++;
                }
            }
            //直选- Start
            $sql_zhixuan = $a11X5->a11X5_ZH($gameId,$table,$issue);
            //直选 - End

            //连码 - Start
            $sql_lm = $a11X5->a11X5_LIANMA($gameId,$table,$issue);
            //连码 - End

            if(!empty($sql_he)){
                $runhe = DB::connection('mysql::write')->statement($sql_he);
                if($runhe == 1)
                    $bunko_index++;
            }
            if(!empty($sql_bets_lose)){
                $run2 = DB::connection('mysql::write')->statement($sql_lose);
                if($run2 == 1){
                    $bunko_index++;
                    if(!empty($sql_zhixuan)){
                        $run3 = DB::connection('mysql::write')->statement($sql_zhixuan);
                        if($run3 == 1){
                            $bunko_index++;
                        }
                    } else {
                        $bunko_index++;
                    }

                    if(!empty($sql_lm)){
                        $run4 = DB::connection('mysql::write')->statement($sql_lm);
                        if($run4 == 1){
                            $bunko_index++;
                        }
                    } else {
                        $bunko_index++;
                    }
                }
            }

            if($bunko_index !== 0){
                return 1;
            }
        }
    }

    public function newObject($code){
        $excel = null;
        switch ($code){
            case 'cqssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'hlsx':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'jndssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'xjssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'tjssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'jsk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'ahk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'gxk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'hbk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'hebeik3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'gsk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'gzk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'gd11x5':$excel = new \App\Http\Controllers\Bet\New_gd11x5();break;
            case 'fc3d':$excel = new \App\Http\Controllers\Bet\New_fc3d();break;
            case 'jndhl8':$excel = new \App\Http\Controllers\Bet\New_jndhl8();break;
            case 'jnd28':$excel = new \App\Http\Controllers\Bet\New_jnd28();break;
            case 'twbgc':$excel = new \App\Http\Controllers\Bet\New_kl8();break;
            case 'twbg28':$excel = new \App\Http\Controllers\Bet\New_dd();break;
            case 'pk10':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'xyft':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'gdklsf':$excel = new \App\Http\Controllers\Bet\New_gdklsf();break;
            case 'cqxync':$excel = new \App\Http\Controllers\Bet\New_cqxync();break;
            case 'bjkl8':$excel = new \App\Http\Controllers\Bet\New_kl8();break;
            case 'pcdd':$excel = new \App\Http\Controllers\Bet\New_dd();break;
            case 'lhc':$excel = new \App\Http\Controllers\Bet\New_hklhc();break;
            case 'mssc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'msssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'msft':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'xykl8':$excel = new \App\Http\Controllers\Bet\New_kl8();break;
            case 'xy28':$excel = new \App\Http\Controllers\Bet\New_dd();break;
            case 'xylhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'msjsk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'pknn':$excel = new \App\Http\Controllers\Bet\New_pknn();break;
            case 'msnn':$excel = new \App\Http\Controllers\Bet\New_msnn();break;
            case 'paoma':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'txffc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'qqffc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'msqxc':$excel = new \App\Http\Controllers\Bet\New_msqxc();break;
            case 'kssc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'ksft':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'ksssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'twxyft':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'sfsc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'sfssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'jslhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'sflhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'xylsc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'xylft':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'xylssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'yfsc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'yfssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'yflhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'efsc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'efssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'eflhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'wfsc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'wfssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'wflhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'shfsc':$excel = new \App\Http\Controllers\Bet\New_sc();break;
            case 'shfssc':$excel = new \App\Http\Controllers\Bet\New_ssc();break;
            case 'shflhc':$excel = new \App\Http\Controllers\Bet\New_nlhc();break;
            case 'hkk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'yfk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'efk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'sfk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
            case 'wfk3':$excel = new \App\Http\Controllers\Bet\New_k3();break;
        }
        return $excel;
    }
}
