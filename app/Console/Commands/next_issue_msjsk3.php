<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_msjsk3 extends Command
{
    protected  $code = 'msjsk3';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_msjsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速快三-產下一期開盤';

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
        $table = 'game_msjsk3';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('msjsk3:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(50)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addSeconds(60)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-4)=='1441'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $New_nextIssue = date("Ymd",strtotime($nextDay)).'0001';
        }

        $redis->set('msjsk3:nextIssue',(int)$New_nextIssue);
        $redis->set('msjsk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('msjsk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
