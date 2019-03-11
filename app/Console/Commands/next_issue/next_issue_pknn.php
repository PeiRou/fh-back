<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_pknn extends Command
{
    protected  $code = 'pknn';
    protected $signature = 'next_issue_pknn';
    protected $description = 'PK10牛牛-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_pknn';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('pknn:nextIssueEndTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        if(substr($openTime,-8) == '23:50:00'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:29:30';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:30:00';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(1170)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
        }
        $redis->set('pknn:nextIssue',(int)$nextIssue+1);
        $redis->set('pknn:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('pknn:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
