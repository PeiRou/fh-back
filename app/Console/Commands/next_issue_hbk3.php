<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_hbk3 extends Command
{
    protected  $code = 'hbk3';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_hbk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '湖北快3-產下一期開盤';

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
        $table = 'game_hbk3';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('hbk3:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $New_nextIssue = $nextIssue+1;
        if(substr($openTime,-8) == '22:00:40'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $New_nextIssue = date("ymd",strtotime($nextDay)).'001';                         //奖期
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:08:40';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:10:40';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addMinute(8)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(10)->toDateTimeString();
        }

        $redis->set('hbk3:nextIssue',(int)$New_nextIssue);
        $redis->set('hbk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('hbk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
