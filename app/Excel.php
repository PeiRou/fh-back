<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Excel
{
    //计算当日总输赢
    public function bet_total($issue,$gameId){
        $exceBase = DB::table('excel_base')->select('excel_base_idx','count_date')->where('game_id',$gameId)->first();
        if(empty($exceBase))
            return false;
        if(empty($exceBase->count_date) || $exceBase->count_date!=date("Y-m-d")){
            $todaystart = date("Y-m-d 00:00:00");
            $todayend = date("Y-m-d 23:59:59");
            $tmp = DB::select("SELECT sum(bet_money) as sumBet_money,sum(case when bunko >0 then bunko-bet_money else 0 end) as sumBunkoWin,sum(case when bunko < 0 then bunko else 0 end) as sumBunkoLose FROM bet WHERE game_id = '{$gameId}' and created_at BETWEEN '{$todaystart}' and '{$todayend}' and bunko != 0 and testFlag = 0 ");
            foreach ($tmp as&$value)
                $todayBet = $value;
            $data['count_date'] = date("Y-m-d");
            $data['bet_money'] = $todayBet->sumBet_money;
            $data['bet_win'] = $todayBet->sumBunkoWin;
            $data['bet_lose'] = abs($todayBet->sumBunkoLose);
            DB::table('excel_base')->where('excel_base_idx',$exceBase->excel_base_idx)->update($data);
        }
        $tmp = DB::select("SELECT sum(bet_money) as sumBet_money,(case when bunko >0 then bunko-bet_money else bunko end) as sumBunko FROM bet WHERE issue = '{$issue}' and game_id = '{$gameId}'");
        foreach ($tmp as&$value)
            $excBunko = $value;
        $data = [];
        $data['bet_money'] = DB::raw('bet_money + '.$excBunko->sumBet_money);
        if($excBunko->sumBunko>0)
            $data['bet_win'] = DB::raw('bet_win + '.$excBunko->sumBunko);
        else
            $data['bet_lose'] = DB::raw('bet_lose + '.abs($excBunko->sumBunko));
//        \Log::info($gameId.'**'.$exceBase->excel_base_idx.'--'.$excBunko->sumBet_money.'=='.$excBunko->sumBunko);
        DB::table('excel_base')->where('excel_base_idx', $exceBase->excel_base_idx)->update($data);
    }
    //计算是否开杀
    public function kill_count($table,$issue,$gameId,$opencode){
        $killopennum = DB::table($table)->select('excel_opennum')->where('issue',$issue)->first();
        $is_killopen = DB::table('excel_base')->select('is_open','count_date','kill_rate','bet_lose','bet_win')->where('game_id',$gameId)->first();
        $opennum = '';
        if(!empty($killopennum->excel_opennum)&&($is_killopen->is_open==1)&&!empty($is_killopen->count_date)){
            $lose_losewin_rate = $is_killopen->is_open?($is_killopen->bet_lose-$is_killopen->bet_win)/($is_killopen->bet_lose + $is_killopen->bet_win):0;
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
}