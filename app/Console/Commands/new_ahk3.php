<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_ahk3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_ahk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安徽快3';

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
        $getFile    = Storage::disk('gameTime')->get('ahk3.json');
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
            $getIssue = DB::table('game_ahk3')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            $New_nextIssue = $nextIssue+1;
            if(strtotime($filtered['time']) == strtotime('22:00:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $New_nextIssue = date("Ymd",strtotime($nextDay)).'001';                         //奖期
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 08:48:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 08:50:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addMinute(8)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            Redis::set('ahk3:nextIssue',(int)$New_nextIssue);
            Redis::set('ahk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('ahk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'ahk3';
        try{
            $html = json_decode(file_get_contents($url),true);
            $redis_issue = Redis::get('ahk3:issue');
            if($redis_issue !== $html[0]['issue']){
                try{
                    $up = DB::table('game_ahk3')->where('issue',$html[0]['issue'])
                        ->update([
                            'is_open' => 1,
                            'year'=> date('Y'),
                            'month'=> date('m'),
                            'day'=>  date('d'),
                            'opennum' => $html[0]['nums']
                        ]);
                    if($up == 1){
                        $key = 'ahk3:issue';
                        Redis::set($key,$html[0]['issue']);
                    }
                } catch (\Exception $exception){
//                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    writeLog('game/ahk3', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception){
            writeLog('game/ahk3', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
//            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
