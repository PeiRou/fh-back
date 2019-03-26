<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_JSK3 extends Command
{
    protected $signature = 'ISSUE_SEED_JSK3';
    protected $description = '江苏骰宝（快3）期数生成-41';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 08:30:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_jsk3 (issue,opentime) VALUES ";
        for($i=1;$i<=41;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(20);
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

        if($checkUpdate->jsk3 == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'江苏骰宝期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'jsk3' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', '江苏骰宝error');
                }
            } else {
                writeLog('ISSUE_SEED', '江苏骰宝error');
            }
        }
    }
}
