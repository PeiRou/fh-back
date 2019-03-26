<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_XYLHC extends Command
{
    protected $signature = 'ISSUE_SEED_XYLHC';
    protected $description = '幸运六合彩期数生成-240';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 08:00:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_xylhc (issue,opentime) VALUES ";
        for($i=1;$i<=240;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(300);
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
        if($checkUpdate->xylhc == $curDate){
            echo '幸运六合彩期数已存在';
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'xylhc' => $curDate
                ]);
                if($update == 1){
                    $delClong1 = DB::table('clong_kaijian1')->where('lotteryid',85)->delete();
                    if($delClong1 == 1){
                        $delClong2 = DB::table('clong_kaijian2')->where('lotteryid',85)->delete();
                        if($delClong2 == 1){
                            writeLog('ISSUE_SEED', date('Y-m-d').'已更新');
                        }
                    }
                }
            } else {
                writeLog('ISSUE_SEED', 'error');
            }
        }
    }
}