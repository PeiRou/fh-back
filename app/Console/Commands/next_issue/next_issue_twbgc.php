<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_twbgc extends Command
{
    protected  $code = 'twbgc';
    protected $signature = 'next_issue_twbgc';
    protected $description = '台湾宾果彩-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_twbgc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('twbgc:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();

        if(substr($openTime,-8) == '23:55:00'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 07:04:30';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 07:05:00';
        }

        $redis->set('twbgc:nextIssue',(int)$nextIssue+1);
        $redis->set('twbgc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('twbgc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}