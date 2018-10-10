<?php

namespace App\Console\Commands;

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
        $timeUp = date('Y-m-d 00:02:20');
        $timeUp2 = date('Y-m-d 09:52:20');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_cqxync (issue,opentime) VALUES ";

        $date = date('Y-m-d');
        $sql .= "($curDate.'0001','$date 00:02:20'),";
        for($i=1;$i<=12;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            $num = 1 + $i;
            if(strlen($num) == 1){
                $num = '00'.$num;
            }
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $issue = date('ymd').$num;
            $sql .= "('$issue','$timeUp'),";
        }
        for($i=1;$i<=84;$i++){
            $timeUp2 = Carbon::parse($timeUp2)->addMinutes(10);
            $num = 13 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $issue = date('ymd').$num;
            $sql .= "('$issue','$timeUp2'),";
        }

        if($checkUpdate->cqxync == $curDate){
            \Log::info(date('Y-m-d').'重庆幸运农场期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'cqxync' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('重庆幸运农场error');
                }
            } else {
                \Log::info('重庆幸运农场error');
            }
        }
    }
}
