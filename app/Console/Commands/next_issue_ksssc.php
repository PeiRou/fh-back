<?php

namespace App\Console\Commands;

use App\Excel;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class next_issue_ksssc extends Command
{
    protected  $code = 'ksssc';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_issue_ksssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '快速时时彩-產下一期開盤';

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
        $table = 'game_ksssc';
        $excel = new Excel();
        $res = $excel->getNextBetIssue($table);
        if(!$res)
            return 'Fail';
        $redis = Redis::connection();
        $redis->select(0);
        $beforeLotteryTime = $redis->get('ksssc:nextIssueLotteryTime');
        if($beforeLotteryTime>time())
            return 'no need';
        //下一期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
        $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();

        $New_nextIssue = $nextIssue+1;
        if(substr($New_nextIssue,-4)=='1106'){
            $New_nextIssue = date("ymd",strtotime($openTime)).'0001';
        }

        $redis->set('ksssc:nextIssue',(int)$New_nextIssue);
        $redis->set('ksssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        $redis->set('ksssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        return 'Ok';
    }
}
