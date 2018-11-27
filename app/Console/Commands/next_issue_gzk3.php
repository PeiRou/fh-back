<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_gzk3 extends Command
{
    protected  $code = 'gzk3';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_gzk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '贵州快3-產下一期開盤';

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
        $table = 'game_gzk3';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('gzk3:nextIssueLotteryTime');
        if($beforeLotteryTime>=time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $New_nextIssue = $nextIssue+1;
        if(substr($openTime,-8) == '22:00:00'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $New_nextIssue = date("ymd",strtotime($nextDay)).'001';                         //奖期
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:08:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:10:00';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addMinute(8)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(10)->toDateTimeString();
        }

        $redis->set('gzk3:nextIssue',(int)$New_nextIssue);
        $redis->set('gzk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('gzk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
