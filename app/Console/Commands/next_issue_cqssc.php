<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_cqssc extends Command
{
    protected  $code = 'cqssc';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_cqssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重庆时时彩-產下一期開盤';

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
        $table = 'game_cqssc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('cqssc:nextIssueEndTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = (string)$res->opentime;
        $issuenum = substr($nextIssue,-3);

        $nextIssueTime = (int)$issuenum+1;
        if((int)$nextIssueTime == 10){
            $nextIssueEndTime = date('Y-m-d 07:29:20');
            $nextIssueLotteryTime = date('Y-m-d 07:30:00');
        }else if((int)$nextIssueTime == 60){
            $nextIssueTime = date('Ymd',strtotime($openTime)+1000).'001';
            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(2360)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(40)->toDateTimeString();
        }else{
            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(1160)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(20)->toDateTimeString();
        }

        $redis->set('cqssc:nextIssue',$nextIssueTime);
        $redis->set('cqssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('cqssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
