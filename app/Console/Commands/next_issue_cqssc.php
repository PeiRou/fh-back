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
        if($beforeLotteryTime>=time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $issuenum = substr($nextIssue,-3);

        if((int)$issuenum >= '24'){
            if($issuenum == '120')
                $nextIssueTime = date('Ymd').'001';
            else
                $nextIssueTime = (int)$nextIssue+1;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(555)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addMinutes(10)->toDateTimeString();
        } else if((int)$issuenum == '23'){
            $nextIssueTime = date('Ymd').'024';
            $nextIssueEndTime = date('Y-m-d',strtotime($res->opentime))." 10:00:00";
            $nextIssueLotteryTime = date('Y-m-d',strtotime($res->opentime))." 09:59:15";
        }else{
            $nextIssueTime = (int)$nextIssue+1;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(255)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addMinutes(5)->toDateTimeString();
        }
        $redis->set('cqssc:nextIssue',$nextIssueTime);
        $redis->set('cqssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('cqssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
