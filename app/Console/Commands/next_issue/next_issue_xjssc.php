<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_xjssc extends Command
{
    protected  $code = 'xjssc';
    protected $signature = 'next_issue_xjssc';
    protected $description = '新疆时时彩-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_xjssc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('xjssc:nextIssueEndTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $New_nextIssue = $nextIssue+1;
        if(substr($openTime,-8) == '02:00:00'){
            $New_nextIssue = date("Ymd",strtotime($openTime)).'01';                         //奖期
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 10:18:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 10:20:00';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(18)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
        }

        $redis->set('xjssc:nextIssue',(int)$New_nextIssue);
        $redis->set('xjssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('xjssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
