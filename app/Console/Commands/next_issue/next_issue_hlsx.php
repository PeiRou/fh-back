<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_hlsx extends Command
{
    protected  $code = 'hlsx';
    protected $signature = 'next_issue_hlsx';
    protected $description = '欢乐生肖-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_hlsx';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('hlsx:nextIssueEndTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = (string)$res->opentime;
        $issuenum = substr($nextIssue,-3);

        $nextIssueTime = (int)$nextIssue+1;
        if((int)$issuenum == 9){
            $nextIssueEndTime = date('Y-m-d 07:29:20');
            $nextIssueLotteryTime = date('Y-m-d 07:30:00');
        }else if((int)$issuenum == 59){
            $nextIssueTime = date('Ymd',strtotime($openTime)+1000).'001';
            $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(38)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(40)->toDateTimeString();
        }else{
            $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(18)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
        }

        $redis->set('hlsx:nextIssue',$nextIssueTime);
        $redis->set('hlsx:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('hlsx:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
