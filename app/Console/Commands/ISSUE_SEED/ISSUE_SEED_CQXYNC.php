<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_CQXYNC extends Command
{
    protected $signature = 'ISSUE_SEED_CQXYNC';
    protected $description = '重庆幸运农场-奖期';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 00:00:00');
        $timeUp2 = date('Y-m-d 07:00:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_cqxync (issue,opentime) VALUES ";

//        $date = date('Y-m-d');
//        $firstIssue = $curDate.'001';
//        $sql .= "('$firstIssue','$date 00:20:00'),";
        for($i=1;$i<=9;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(20);
            $num = $i;

            if(strlen($num) == 1){
                $num = '00'.$num;
            }
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $issue = date('ymd').$num;
            $sql .= "('$issue','$timeUp'),";
        }
        for($i=1;$i<=50;$i++){
            $timeUp2 = Carbon::parse($timeUp2)->addMinutes(20);
            $num = 9 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $issue = date('ymd').$num;
            $sql .= "('$issue','$timeUp2'),";
        }

        if($checkUpdate->cqxync == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'重庆幸运农场期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'cqxync' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', '重庆幸运农场error');
                }
            } else {
                writeLog('ISSUE_SEED', '重庆幸运农场error');
            }
        }
    }
}
