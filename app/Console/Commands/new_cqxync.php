<?php

namespace App\Console\Commands;

use App\Events\RunCqssc;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;

class new_cqxync extends Command
{
    protected  $code = 'cqxync';
    protected  $gameId = 61;

    protected $signature = 'new_cqxync';
    protected $description = '新-重庆幸运农场';

    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }

    public function handle()
    {
        $getFile = Storage::disk('gameTime')->get('cqxync.json');
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
            $getIssue = DB::table('game_cqxync')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('23:52:20')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 10:00:20';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 10:02:20';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addMinutes(8)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            if($filtered['issue'] == '013'){
                $nextIssueTime = date('ymd').'014';
                Redis::set('cqxync:nextIssue',(int)$nextIssueTime);
            } else {
                Redis::set('cqxync:nextIssue',(int)$nextIssue+1);
            }
            Redis::set('cqxync:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('cqxync:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'cqxync';
        try{
            $html = json_decode(file_get_contents($url),true);
            $redis_issue = Redis::get('cqxync:issue');
            //清除昨天长龙，在录第一期的时候清掉
            if($filtered['issue']=='001'){
                DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
            }
            if($redis_issue !== $html[0]['issue']){
                try{
                    $up = DB::table('game_cqxync')->where('issue',$html[0]['issue'])
                        ->update([
                            'is_open' => 1,
                            'year'=> date('Y'),
                            'month'=> date('m'),
                            'day'=>  date('d'),
                            'opennum' => $html[0]['nums']
                        ]);
                    if($up == 1){
                        $key = 'cqxync:issue';
                        Redis::set($key,$html[0]['issue']);
                        $this->clong->setKaijian('cqxync',1,$html[0]['nums']);
                        $this->clong->setKaijian('cqxync',2,$html[0]['nums']);
                    }
                } catch (\Exception $exception){
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception){
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
