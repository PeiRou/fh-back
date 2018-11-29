<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_xjssc extends Command
{
    protected  $code = 'xjssc';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_xjssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新疆时时彩-產下一期開盤';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = 'game_xjssc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('xjssc:nextIssueEndTime');
        if($beforeLotteryTime>=time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $New_nextIssue = $nextIssue+1;
        if(substr($openTime,-8) == '02:00:00'){
            $New_nextIssue = date("Ymd",strtotime($openTime)).'01';                         //奖期
            $nextIssueEndTime = date('Y-m-d',strtotime($openTime)).' 10:08:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($openTime)).' 10:10:00';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addMinute(8)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(10)->toDateTimeString();
        }

        $redis->set('xjssc:nextIssue',(int)$New_nextIssue);
        $redis->set('xjssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('xjssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
