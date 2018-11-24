<?php

namespace App\Console\Commands;

use App\Events\RunPk10;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class next_issue_pk10 extends Command
{
    protected  $code = 'bjpk10';
    protected  $gameId = 50;
    protected  $clong;
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
    protected $description = '新-北京赛车';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
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
            return false;
        $nextIssue = $res->issue;
        $openTime = $res->opentime;

        if(date('H:i:s',strtotime($openTime)) == '23:57:30'){
            $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
            $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:07:00';
            $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:07:30';
        } else {
            $nextIssueEndTime = Carbon::parse($openTime)->addSeconds(270)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($openTime)->addMinutes(5)->toDateTimeString();
        }

        Redis::set('pk10:nextIssue',(int)$nextIssue+1);
        Redis::set('pk10:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
        Redis::set('pk10:nextIssueEndTime',strtotime($nextIssueEndTime));
    }
}
