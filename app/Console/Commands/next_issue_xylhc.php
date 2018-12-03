<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_xylhc extends Command
{
    protected  $code = 'xylhc';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_xylhc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '幸运六合彩开奖-產下一期開盤';

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
        $table = 'game_xylhc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('xylhc:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;
        $New_nextIssue = $nextIssue+1;

        if(substr($New_nextIssue,-3)=='240'){
            $dateIssue = substr($nextIssue,strlen($nextIssue)-4);
            $New_nextIssue = date("Ymd",strtotime($dateIssue)+86400).'001';
        }

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addSeconds(300)->toDateTimeString();

        $redis = Redis::connection();
        $redis->select(0);
        $redis->set('xylhc:nextIssue',(int)$New_nextIssue);
        $redis->set('xylhc:nextIssueEndTime',strtotime($nextIssueEndTime));
        $redis->set('xylhc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        return 'Ok';
    }
}
