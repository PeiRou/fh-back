<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_pk10 extends Command
{
    protected  $code = 'bjpk10';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_pk10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '北京赛车-產下一期開盤';

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
        $table = 'game_bjpk10';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('pk10:nextIssueEndTime');
        if($beforeLotteryTime>=time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        if(date('H:i:s',strtotime($openTime)) == '23:57:30'){
            $nextDay = Carbon::parse($openTime)->addDay(1)->toDateTimeString();
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:07:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:07:30';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();
        }
        $redis->set('pk10:nextIssue',(int)$nextIssue+1);
        $redis->set('pk10:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('pk10:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
