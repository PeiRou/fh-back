<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_jsk3 extends Command
{
    protected  $code = 'jsk3';
    protected  $gameId = 10;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_jsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-江苏快3';

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
        $getFile    = Storage::disk('gameTime')->get('jsk3.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4){
                return $value;
            }
        });
        if($filtered!=null){
            $nowIssueTime = date('Y-m-d').' '.$filtered['time'];
            $getIssue = DB::table('game_jsk3')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            $New_nextIssue = $nextIssue+1;
            if(strtotime($filtered['time']) == strtotime('22:09:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $New_nextIssue = date("ymd",strtotime($nextDay)).'001';                         //奖期
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 08:36:10';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 08:38:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(490)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            Redis::set('jsk3:nextIssue',(int)$New_nextIssue);
            Redis::set('jsk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('jsk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'jsk3';
        try{
            $html = json_decode(file_get_contents($url),true);
            $redis_issue = Redis::get('jsk3:issue');
            if($redis_issue !== $html[0]['issue']) {
                try {
                    $up = DB::table('game_jsk3')->where('issue', $html[0]['issue'])
                        ->update([
                            'is_open' => 1,
                            'year' => date('Y'),
                            'month' => date('m'),
                            'day' => date('d'),
                            'opennum' => $html[0]['nums']
                        ]);
                    if ($up == 1) {
                        $key = 'jsk3:issue';
                        Redis::set($key, $html[0]['issue']);
                    }
                } catch (\Exception $exception) {
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception) {
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
