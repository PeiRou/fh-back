<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_sfssc extends Command
{
    protected  $code = 'sfssc';
    protected $signature = 'next_issue_sfssc';
    protected $description = '三分时时彩-產下一期開盤';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_sfssc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('sfssc:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(150)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(3)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-3)=='481'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'001';
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 07:15:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 07:18:00';
        }

        $redis->set('sfssc:nextIssue',(int)$New_nextIssue);
        $redis->set('sfssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('sfssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
