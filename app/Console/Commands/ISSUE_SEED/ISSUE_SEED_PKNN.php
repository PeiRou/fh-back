<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_PKNN extends Command
{
    protected $signature = 'ISSUE_SEED_PKNN';
    protected $description = 'PK10牛牛期数生成-179';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 09:10:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
//        $checkLastIssue = DB::table('game_pknn')->select(DB::raw('MAX(id) as maxid'),'issue')->where('opentime',date('Y-m-d 23:50:00',strtotime('-1 days')))->first();
//        $lastIssue = @$checkLastIssue->issue;
        $checkLastIssue = DB::table('game_pknn')->max('issue');
        $lastIssue = $checkLastIssue?$checkLastIssue:0;
        if(empty($lastIssue)){
            writeLog('ISSUE_SEED', date('Y-m-d').$this->signature.'期数不可为0');
            echo '期数不可为0';
            return '';
        }
        $sql = "INSERT INTO game_pknn (issue,opentime) VALUES ";
        for($i=1;$i<=44;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(20);
            $issue = (int)$lastIssue + (int)$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }
        if($checkUpdate->pknn == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'pknn' => $curDate
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
