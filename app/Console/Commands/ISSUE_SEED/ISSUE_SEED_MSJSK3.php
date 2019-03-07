<?php

namespace App\Console\Commands\ISSUE_SEED;

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
        $timeUp = ' 23:59:00';
        $checkUpdate = DB::table('issue_seed')->select('msjsk3')->where('id',1)->first();
        $issueDate = '';
        if(isset($checkUpdate->msjsk3)) {
            if($curDate == $checkUpdate->msjsk3) {
                $issueDate = date('Y-m-d', strtotime('+ 1 day', time()));
                $curDate = date('Ymd', strtotime('+ 1 day', time()));
            }else if($curDate < $checkUpdate->msjsk3)
                writeLog('ISSUE_SEED', $curDate.'秒速快3期数已存在');
            else
                $issueDate = date('Y-m-d',time());
        }else{
            $issueDate = date('Y-m-d',time());
        }
        echo $issueDate;
        if(empty($issueDate))
            return '';
        $timeUp = $issueDate . $timeUp;
        $timeUp = Carbon::parse($timeUp)->addDay(-1)->toDateTimeString();
        $sql = "INSERT INTO game_msjsk3 (issue,opentime) VALUES ";
        for($i=1;$i<=1440;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(60);
            $i = str_repeat('0',4-strlen($i)).$i;
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
        }
        if($checkUpdate->msjsk3 == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'msjsk3' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', 'error');
                }
            } else {
                writeLog('ISSUE_SEED', 'error');
            }
        }
    }
}
