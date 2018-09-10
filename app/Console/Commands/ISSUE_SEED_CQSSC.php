<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_CQSSC extends Command
{
    protected $signature = 'ISSUE_SEED_CQSSC';
    protected $description = '重庆时时彩期数生成-120';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp_Lingcheng = date('Y-m-d 00:00:00');
        $timeUp_baitian = date('Y-m-d 09:50:00');
        $timeUp_yejian = date('Y-m-d 21:55:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_cqssc (issue,opentime) VALUES ";
        for($i=1;$i<=23;$i++){
            $timeUp_Lingcheng = Carbon::parse($timeUp_Lingcheng)->addMinutes(5);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $issue = date('Ymd').$i;
            $sql .= "('$issue','$timeUp_Lingcheng'),";
        }
        for($i=1;$i<=72;$i++){
            $timeUp_baitian = Carbon::parse($timeUp_baitian)->addMinutes(10);
            $num = 23 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $issue = date('Ymd').$num;
            $sql .= "('$issue','$timeUp_baitian'),";
        }
        for($i=1;$i<=24;$i++){
            $timeUp_yejian = Carbon::parse($timeUp_yejian)->addMinutes(5);
            $num = 95 + $i;
            if(strlen($num) == 2){
                $num = '0'.$num;
            }
            $issue = date('Ymd').$num;
            $sql .= "('$issue','$timeUp_yejian'),";
        }
        $lastIssue = date('Ymd').'120';
        $lastDate = date('Y-m-d 23:59:59');
        $sql .= "('$lastIssue','$lastDate'),";
        if($checkUpdate->cqssc == $curDate){
            \Log::info(date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'cqssc' => $curDate
                ]);
                if($update == 1){
                    $delClong1 = DB::table('clong_kaijian1')->where('lotteryid',1)->delete();
                    if($delClong1 == 1){
                        $delClong2 = DB::table('clong_kaijian2')->where('lotteryid',1)->delete();
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
