<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_xyft extends Command
{
    protected  $code = 'xyft';
    protected $signature = 'next_issue_xyft';
    protected $description = '幸运飞艇-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_xyft';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('xyft:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(4)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-3)=='181'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'001';
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 13:08:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 13:09:00';
        }

        $redis->set('xyft:nextIssue',(int)$New_nextIssue);
        $redis->set('xyft:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('xyft:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
