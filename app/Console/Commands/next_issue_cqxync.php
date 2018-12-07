<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_cqxync extends Command
{
    protected  $code = 'cqxync';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_cqxync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重庆幸运农场-產下一期開盤';

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
        if((int)$issuenum == 13){
            $nextIssueEndTime = date('Y-m-d 10:00:20');
            $nextIssueLotteryTime = date('Y-m-d 10:02:20');
        } else {
            if(substr($openTime,-8) =='23:52:20'){
                $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
                $New_nextIssue = date('ymd',strtotime($nextDay)).'001';
            }
            $nextIssueEndTime = Carbon::parse($openTime)->addMinutes(8)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(10)->toDateTimeString();
        }
        $redis->set('cqxync:nextIssue',(int)$New_nextIssue);
        $redis->set('cqxync:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('cqxync:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
