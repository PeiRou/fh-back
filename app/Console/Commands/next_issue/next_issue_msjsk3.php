<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_msjsk3 extends Command
{
    protected  $code = 'msjsk3';
    protected $signature = 'next_issue_msjsk3';
    protected $description = '秒速快三-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_msjsk3';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('msjsk3:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(50)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addSeconds(60)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-4)=='1441'){
            //只有秒速快3特例，他的跨日是當日00:00，所以用計算後的開獎日期去算明天第一期
            $New_nextIssue = date("Ymd",strtotime($nextIssueLotteryTime)).'0001';
        }

        $redis->set('msjsk3:nextIssue',(int)$New_nextIssue);
        $redis->set('msjsk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('msjsk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
