<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_ksft extends Command
{
    protected  $code = 'ksft';
    protected $signature = 'next_issue_ksft';
    protected $description = '快速飞艇-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_ksft';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('ksft:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-3)=='277'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'001';
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 07:25:30';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 07:30:30';
        }

        $redis->set('ksft:nextIssue',(int)$New_nextIssue);
        $redis->set('ksft:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('ksft:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
