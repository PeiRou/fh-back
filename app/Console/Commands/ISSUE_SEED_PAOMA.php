<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_PAOMA extends Command
{
    protected $signature = 'ISSUE_SEED_PAOMA';
    protected $description = '跑马期数生成-985';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 07:28:45');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_paoma (issue,opentime) VALUES ";
        for($i=1;$i<=985;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(75);
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
        if($checkUpdate->paoma == $curDate){
            \Log::info(date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'paoma' => $curDate
                ]);
                if($update == 1){
                    $delClong1 = DB::table('clong_kaijian1')->where('lotteryid',99)->delete();
                    if($delClong1 == 1){
                        $delClong2 = DB::table('clong_kaijian2')->where('lotteryid',99)->delete();
                        if($delClong2 == 1){
                            \Log::info(date('Y-m-d').'已更新');
                        }
                    }
                }
            } else {
                \Log::info('error');
            }
        }
    }
}
