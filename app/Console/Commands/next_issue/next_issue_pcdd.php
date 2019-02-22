<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_pcdd extends Command
{
    protected  $code = 'pcdd';
    protected $signature = 'next_issue_pcdd';
    protected $description = 'PC蛋蛋-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_pcdd';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('pcdd:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        if(substr($openTime,-8) == '23:55:00'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:03:30';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:05:00';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(210)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();
        }
        $redis->set('pcdd:nextIssue',(int)$nextIssue+1);
        $redis->set('pcdd:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('pcdd:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
