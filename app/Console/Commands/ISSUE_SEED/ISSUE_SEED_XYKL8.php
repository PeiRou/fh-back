<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_XYKL8 extends Command
{
    protected $signature = 'ISSUE_SEED_XYKL8';
    protected $description = '幸运快乐八期数生成-270';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date(' 08:00:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $issueDate = '';
        if(isset($checkUpdate->xykl8)){
            if($curDate == $checkUpdate->xykl8) {
                $issueDate = date('Y-m-d', strtotime('+ 1 day', time()));
                $curDate = date('ymd', strtotime('+ 1 day', time()));
            }else if($curDate < $checkUpdate->xykl8)
                writeLog('ISSUE_SEED', $curDate.$this->description.'期数已存在');
            else
                $issueDate = date('Y-m-d',time());
        }else{
            $issueDate = date('Y-m-d',time());
        }
        echo $issueDate;
        if(empty($issueDate))
            return '';
        $timeUp = $issueDate . $timeUp;
        $sql = "INSERT INTO game_xykl8 (issue,opentime) VALUES ";
        for($i=1;$i<=270;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(5);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }
        if($checkUpdate->xykl8 == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'xykl8' => $curDate
                ]);
                if($update == 1){
                    writeLog('ISSUE_SEED', date('Y-m-d').'已更新');
                }
            } else {
                writeLog('ISSUE_SEED', 'error');
            }
        }
    }
}
