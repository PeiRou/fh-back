<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_gzk3 extends Command
{
    protected  $code = 'gzk3';
    protected  $gameId = 18;

    protected $signature = 'new_gzk3';
    protected $description = '新-贵州快3';


    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $getFile    = Storage::disk('gameTime')->get('gzk3.json');
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
            $getIssue = DB::table('game_gzk3')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('22:00:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:08:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:10:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(490)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            Redis::set('gzk3:nextIssue',(int)$nextIssue+1);
            Redis::set('gzk3:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('gzk3:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'gzk3';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('gzk3:issue');
        if($redis_issue !== $html[0]['issue']) {
            try {
                $up = DB::table('game_gzk3')->where('issue', $html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year' => date('Y'),
                        'month' => date('m'),
                        'day' => date('d'),
                        'opennum' => $html[0]['nums']
                    ]);
                if ($up == 1) {
                    $key = 'gzk3:issue';
                    Redis::set($key, $html[0]['issue']);
                }
            } catch (\Exception $exception) {
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
