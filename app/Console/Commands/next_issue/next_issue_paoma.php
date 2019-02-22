<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_paoma extends Command
{
    protected  $code = 'paoma';
    protected $signature = 'next_issue_paoma';
    protected $description = '跑马-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_paoma';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('paoma:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(60)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addSeconds(75)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-3)=='986'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'001';
        }

        $redis->set('paoma:nextIssue',(int)$New_nextIssue);
        $redis->set('paoma:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('paoma:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
