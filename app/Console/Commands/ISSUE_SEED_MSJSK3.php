<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_MSJSK3 extends Command
{
    protected $signature = 'ISSUE_SEED_MSJSK3';
    protected $description = '秒速快3期数生成-1440-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $timeUp = Carbon::parse(date('Y-m-d 23:59:00'))->addDay(-1)->toDateTimeString();
//        $timeUp = date('2018-08-03 23:59:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_msjsk3 (issue,opentime) VALUES ";
        for($i=1;$i<=1440;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(60);
            if(strlen($i) == 1){
                $i = '000'.$i;
            }
            if(strlen($i) == 2){
                $i = '00'.$i;
            }
            if(strlen($i) == 3){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }
        if($checkUpdate->msjsk3 == $curDate){
            \Log::info(date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'msjsk3' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('error');
                }
            } else {
                \Log::info('error');
            }
        }
    }
}
