<?php

namespace App;

use Illuminate\Support\Facades\DB;

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
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        $getDt = DB::connection('mysql::write')->table('bet')->select('bunko','user_id','order_id','issue')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->get();
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
            //新增有返奖的用户的资金明细
            foreach ($getDt as $i){
                $capUsers[$i->user_id] += $i->bunko; //累加馀额
                $tmpCap = [];
                $tmpCap['to_user'] = $i->user_id;
                $tmpCap['user_type'] = 'user';
                $tmpCap['order_id'] = $i->order_id;
                $tmpCap['type'] = 't09';
                $tmpCap['money'] = $i->bunko;
                $tmpCap['balance'] = round($capUsers[$i->user_id],3);
                $tmpCap['operation_id'] = 0;
                $tmpCap['content'] = $gameName.' 第'.$i->issue.'期 返奖';
                $tmpCap['created_at'] = date('Y-m-d H:i:s');
                $tmpCap['updated_at'] = date('Y-m-d H:i:s');
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
        $exceBase = DB::table('excel_base')->select('excel_base_idx','count_date')->where('game_id',$gameId)->first();
        if(empty($exceBase))
            return false;
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
            }
        }
        DB::table('excel_base')->where('excel_base_idx', $exceBase->excel_base_idx)->update($data);
    }
    private function countAllLoseWin($gameId,$where=''){
        $strSql = "SELECT sum(bet_money) as sumBet_money,sum(case when bunko >0 then bunko-bet_money else 0 end) as sumBunkoWin,sum(case when bunko < 0 then bunko else 0 end) as sumBunkoLose FROM bet WHERE game_id = '{$gameId}' and testFlag = 0 ".$where;
        $sql = DB::connection('mysql::write')->select($strSql);
        return $sql;
    }
    //计算是否开杀
    public function kill_count($table,$issue,$gameId,$opencode){
        $killopennum = DB::table($table)->select('excel_opennum')->where('issue',$issue)->first();
        $is_killopen = DB::table('excel_base')->select('is_open','count_date','kill_rate','bet_lose','bet_win')->where('game_id',$gameId)->first();
        $opennum = '';
        if(!empty($killopennum->excel_opennum)&&($is_killopen->is_open==1)&&!empty($is_killopen->count_date)){
            $total = $is_killopen->bet_lose + $is_killopen->bet_win;
            if($total>0)
                $lose_losewin_rate = $is_killopen->is_open?(($is_killopen->bet_lose-$is_killopen->bet_win)/$total):0;
            else
                $lose_losewin_rate = 0;
            $opennum = $lose_losewin_rate>$is_killopen->kill_rate?'':$killopennum->excel_opennum;
            \Log::info($table.':杀率设置'.json_encode($is_killopen));
            \Log::info($table.':输赢比 '.$lose_losewin_rate);
            \Log::info($table.' 获取KILL开奖'.$issue.'--'.$opennum);
            \Log::info($table.' 获取origin开奖'.$issue.'--'.$opencode);
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
        $tmp = DB::select("SELECT id,issue,excel_num FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='{$today}' and is_open=0 and excel_num=".$status.") and is_open=0 and bunko=0 and excel_num=".$status);
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
        $tmp = DB::select("SELECT excel_num FROM excel_base WHERE game_id = ".$gameId);
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
    //取得目前未开奖奖期
    public function getNextIssue($table){
        if(empty($table))
            return false;
        $today = date('Y-m-d H:i:s',time());
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MAX(id) FROM {$table} WHERE opentime <='".$today."' and is_open=0)");
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
        $tmp = DB::select("SELECT * FROM {$table} WHERE id = (SELECT MIN(id) FROM {$table} WHERE opentime <='".$today."' and is_open=0)");
        if(empty($tmp))
            return false;
        foreach ($tmp as&$value)
            $res = $value;
        return $res;
    }
    //根据类别回传开奖格式
    public function opennum($type){
        switch ($type){
            case 'game_msjsk3':
                return $this->opennum_k3();
                break;
            case 'game_paoma':
            case 'game_msft':
            case 'game_mssc':
                return $this->opennum_pk10();
                break;
            case 'game_msssc':
                return $this->opennum_ssc();
                break;
            case 'game_bjkl8':
                return $this->opennum_kl8();
            case 'game_xylhc':
                return $this->opennum_lhc();
                break;
        }
        return false;
    }
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
    private function opennum_ssc(){
        return rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9).','.rand(0,9);
    }
    private function opennum_kl8(){
        $arr = range(1,80,1);
        shuffle($arr);   //打乱数组
        $newarr = array_splice($arr,0,20);
        sort($newarr);
        return implode(",",$newarr);
    }
    private function opennum_lhc(){
        $arr = range(1,49,1);
        shuffle($arr);   //打乱数组
        $newarr = array_splice($arr,0,7);
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
}