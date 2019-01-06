<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_BJKL8 extends Command
{
    protected $signature = 'ISSUE_SEED_BJKL8';
    protected $description = '北京快乐8期数生成-179';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 09:00:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $lastDay = Carbon::now()->addDay(-1)->toDateTimeString();
        $checkLastIssue = DB::table('game_bjkl8')->where('is_open',1)->whereDate('opentime',date('Y-m-d',strtotime($lastDay)))->orderBy('issue','desc')->first();
        $lastIssue = $checkLastIssue->issue;
//        $lastIssue = '687326';

        $sql = "INSERT INTO game_bjkl8 (issue,opentime) VALUES ";
        for($i=1;$i<=179;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(5);
            $issue = (int)$lastIssue + (int)$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }
        if($checkUpdate->bjkl8 == $curDate){
            writeLog('bjkl8', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'bjkl8' => $curDate
                ]);
                if($update == 1){
                    writeLog('bjkl8', date('Y-m-d').'已更新');
                }
            } else {
                writeLog('bjkl8', 'error');
            }
        }
    }
}
