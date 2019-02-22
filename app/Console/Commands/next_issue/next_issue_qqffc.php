<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_qqffc extends Command
{
    protected  $code = 'qqffc';
    protected $signature = 'next_issue_qqffc';
    protected $description = 'QQ分分彩-產下一期開盤';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_qqffc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('qqffc:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(50)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addSeconds(60)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-4)=='1441'){
            //只有QQ分分彩特例，他的跨日是當日00:00，所以用計算後的開獎日期去算明天第一期
            $New_nextIssue = date("Ymd",strtotime($nextIssueLotteryTime)).'0001';
        }

        $redis->set('qqffc:nextIssue',(int)$New_nextIssue);
        $redis->set('qqffc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('qqffc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
