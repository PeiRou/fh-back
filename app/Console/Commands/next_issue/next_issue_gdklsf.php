<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_gdklsf extends Command
{
    protected  $code = 'gdklsf';
    protected $signature = 'next_issue_gdklsf';
    protected $description = '广东快乐十分-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_gdklsf';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('gdklsf:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $New_nextIssue = $nextIssue+1;
        if(substr($openTime,-8) =='23:00:00'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $New_nextIssue = date('Ymd',strtotime($nextDay)).'001';
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:18:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:20:00';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(18)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
        }
        $redis->set('gdklsf:nextIssue',(int)$New_nextIssue);
        $redis->set('gdklsf:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('gdklsf:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
