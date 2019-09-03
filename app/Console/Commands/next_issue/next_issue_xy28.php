<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_xy28 extends Command
{
    protected  $code = 'xy28';
    protected $signature = 'next_issue_xy28';
    protected $description = '幸运28-产下一期开盘';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_xy28';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('xy28:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;


        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-3)=='271'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'001';
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 08:04:30';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 08:05:00';
        }

        $redis->set('xy28:nextIssue',(int)$New_nextIssue);
        $redis->set('xy28:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('xy28:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
