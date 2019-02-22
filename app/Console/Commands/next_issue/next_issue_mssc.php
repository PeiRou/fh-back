<?php

namespace App\Console\Commands\next_issue;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_mssc extends Command
{
    protected  $code = 'mssc';
    protected $signature = 'next_issue_mssc';
    protected $description = '秒速赛车+秒速牛牛-產下一期開盤';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_mssc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('mssc:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(60)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addSeconds(75)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-4)=='1106'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'0001';
        }

        $redis->set('mssc:nextIssue',(int)$New_nextIssue);
        $redis->set('mssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('mssc:nextIssueEndTime',strtotime($nextIssueEndTime));

        $redis->set('msnn:nextIssue',(int)$New_nextIssue);
        $redis->set('msnn:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('msnn:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
