<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_gsk3 extends Command
{
    protected  $code = 'gsk3';
    protected $signature = 'next_issue_gsk3';
    protected $description = '甘肃快3-產下一期開盤';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_gsk3';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('gsk3:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $New_nextIssue = $nextIssue+1;
        if(substr($openTime,-8) == '22:00:00'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $New_nextIssue = date("ymd",strtotime($nextDay)).'001';                         //奖期
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 10:18:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 10:20:00';
        } else {
//            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(490)->toDateTimeString();
            $nextIssueEndTime = Carbon::parse($openTime)->addMinute(18)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
        }

        $redis->set('gsk3:nextIssue',(int)$New_nextIssue);
        $redis->set('gsk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('gsk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
