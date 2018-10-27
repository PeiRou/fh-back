<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GZK3 extends Command
{
    protected $signature = 'ISSUE_SEED_GZK3';
    protected $description = '贵州快3期数生成-78';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('09:00:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_gzk3 (issue,opentime) VALUES ";
        for($i=1;$i<=78;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
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

        if($checkUpdate->gzk3 == $curDate){
            \Log::info(date('Y-m-d').'贵州快3期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'gzk3' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('贵州快3error');
                }
            } else {
                \Log::info('贵州快3error');
            }
        }
    }
}
