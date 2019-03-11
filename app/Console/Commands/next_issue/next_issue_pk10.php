<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_pk10 extends Command
{
    protected  $code = 'bjpk10';
    protected $signature = 'next_issue_pk10';
    protected $description = '北京赛车-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_bjpk10';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('pk10:nextIssueEndTime');
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
        $redis->set('pk10:nextIssue',(int)$nextIssue+1);
        $redis->set('pk10:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('pk10:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
