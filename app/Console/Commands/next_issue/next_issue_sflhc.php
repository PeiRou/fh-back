<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_sflhc extends Command
{
    protected  $code = 'sflhc';
    protected $signature = 'next_issue_sflhc';
    protected $description = '三分六合彩-產下一期開盤';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_sflhc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('sflhc:nextIssueLotteryTime');
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
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 06:30:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 06:33:00';
        }

        $redis->set('sflhc:nextIssue',(int)$New_nextIssue);
        $redis->set('sflhc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('sflhc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
