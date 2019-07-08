<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_xykl8 extends Command
{
    protected  $code = 'xykl8';
    protected $signature = 'next_issue_xykl8';
    protected $description = '幸运快乐八-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_xykl8';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('xykl8:nextIssueLotteryTime');
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

        $redis->set('xykl8:nextIssue',(int)$New_nextIssue);
        $redis->set('xykl8:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('xykl8:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
