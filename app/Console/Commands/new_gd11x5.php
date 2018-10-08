<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_gd11x5 extends Command
{
    protected $signature = 'new_gd11x5';
    protected $description = '广东11选5';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $getFile    = Storage::disk('gameTime')->get('gd11x5.json');
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
            $getIssue = DB::table('game_gd11x5')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('23:00:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:08:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:10:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addMinutes(8)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            Redis::set('gd11x5:nextIssue',(int)$nextIssue+1);
            Redis::set('gd11x5:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('gd11x5:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'gd11x5';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('gd11x5:issue');
        if($redis_issue !== $html[0]['issue']){
            try{
                $up = DB::table('game_gd11x5')->where('issue',$html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'opennum' => $html[0]['nums']
                    ]);
                if($up == 1){
                    $key = 'gd11x5:issue';
                    Redis::set($key,$html[0]['issue']);
                }
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
