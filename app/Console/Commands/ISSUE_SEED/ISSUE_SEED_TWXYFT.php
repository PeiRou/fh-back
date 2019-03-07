<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_TWXYFT extends Command
{
    protected $signature = 'ISSUE_SEED_TWXYFT';
    protected $description = '台湾幸运飞艇-期数生成-288-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededIssue = @DB::table('issue_seed')->select('twxyft')->where('id',1)->first()->twxyft;
        $issueDate = '';
        if($seededIssue) {
            switch ( (ymdtime($seededIssue)-ymdtime($curDate))/86400 ){
                case 0:     //从明天的奖期开始,生成1天的
                    $issueDate = date('Y-m-d',($dateTime = strtotime('+1 day')) );
                    $curDate = date('ymd',$dateTime);
                    $preDays = 0;
                    break;
                case 1:
                    writeLog('ISSUE_SEED', '明天的奖期已存在');
                    return '';
            }
        }else{     //从今天的奖期开始,生成2天的
            $issueDate = date('Y-m-d');
            $preDays = 1;
        }
        $msg = $preDays == 0 ? $issueDate : $issueDate.' : '.date('Y-m-d',strtotime('+'.$preDays.'day',strtotime($issueDate)));
        echo $msg.'奖期已生成'.PHP_EOL;
        if(empty($issueDate))
            return '';
        for($i=0; $i<=$preDays; $i++){
            $time = strtotime('+'.$i.'day',strtotime($issueDate));
            $this->issueSeed(date('Y-m-d',$time),date('ymd',$time));
        }
    }

    private function issueSeed($issueDate,$curDate,$timeUp = ' 23:55:00')
    {
        $timeUp = Carbon::parse($issueDate.$timeUp)->addDay(-1)->toDateTimeString();
        $sql = "INSERT INTO game_twxyft (issue,opentime) VALUES ";
        for($i=1;$i<=288;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(5);
            $i = str_repeat('0',4-strlen($i)).$i;
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
        }
        $seededIssue = @DB::table('issue_seed')->select('twxyft')->where('id',1)->first()->twxyft;
        if($seededIssue == $curDate){
            writeLog('ISSUE_SEED', $curDate.'期数已存在');
        } else {
            if ( DB::statement(rtrim($sql, ',').";") ){
                if ( !DB::table('issue_seed')->where('id',1)->update(['twxyft' => $curDate]) ) {
                    writeLog('ISSUE_SEED', 'update seeded-issue-date error');
                }
            } else {
                writeLog('ISSUE_SEED', 'issues seed error');
            }
        }
    }
}
