<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_cqxync extends Command
{
    protected  $code = 'cqxync';
    protected $signature = 'next_issue_cqxync';
    protected $description = '重庆幸运农场-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_cqxync';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('cqxync:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;
        $issuenum = substr($nextIssue,-3);
        $New_nextIssue = $nextIssue+1;
        if((int)$issuenum == 9){
            $nextIssueEndTime = date('Y-m-d 07:18:00');
            $nextIssueLotteryTime = date('Y-m-d 07:20:00');
        } else {
            if(substr($openTime,-8) =='23:40:00'){
                $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
                $New_nextIssue = date('ymd',strtotime($nextDay)).'001';
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 00:18:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 00:20:00';
            }else{
                $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(18)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
            }
        }
        $redis->set('cqxync:nextIssue',(int)$New_nextIssue);
        $redis->set('cqxync:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('cqxync:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
