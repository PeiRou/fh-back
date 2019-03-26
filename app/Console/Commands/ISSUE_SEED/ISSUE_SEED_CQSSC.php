<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_CQSSC extends Command
{
    protected $signature = 'ISSUE_SEED_CQSSC';
    protected $description = '重庆时时彩期数生成-59';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp_Lingcheng = date('Y-m-d 00:10:00');
        $timeUp_baitian = date('Y-m-d 07:10:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_cqssc (issue,opentime) VALUES ";
        for($i=1;$i<=9;$i++){
            $timeUp_Lingcheng = Carbon::parse($timeUp_Lingcheng)->addMinutes(20);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            $issue = date('Ymd').$i;
            $sql .= "('$issue','$timeUp_Lingcheng'),";
        }
        for($i=10;$i<=59;$i++){
            $timeUp_baitian = Carbon::parse($timeUp_baitian)->addMinutes(20);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $issue = date('Ymd').$i;
            $sql .= "('$issue','$timeUp_baitian'),";
        }
        if($checkUpdate->cqssc == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').$this->description.'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'cqssc' => $curDate
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
