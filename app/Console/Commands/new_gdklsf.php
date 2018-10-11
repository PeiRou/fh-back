<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_gdklsf extends Command
{
    protected $signature = 'new_gdklsf';
    protected $description = '广东快乐十分';

    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }

    public function handle()
    {
        $getFile    = Storage::disk('gameTime')->get('gdklsf.json');
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
            $getIssue = DB::table('game_gdklsf')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('23:00:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:08:30';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:10:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(510)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            Redis::set('gdklsf:nextIssue',(int)$nextIssue+1);
            Redis::set('gdklsf:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('gdklsf:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'gdklsf';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('gdklsf:issue');
        //清除昨天长龙，在录第一期的时候清掉
        if($filtered['issue']=='001'){
            DB::table('clong_kaijian1')->where('lotteryid',60)->delete();
            DB::table('clong_kaijian2')->where('lotteryid',60)->delete();
        }
        if($redis_issue !== $html[0]['issue']){
            try{
                $up = DB::table('game_gdklsf')->where('issue',$html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'opennum' => $html[0]['nums']
                    ]);
                if($up == 1){
                    $key = 'gdklsf:issue';
                    Redis::set($key,$html[0]['issue']);
                    $this->clong->setKaijian('gdklsf',1,$html[0]['nums']);
                    $this->clong->setKaijian('gdklsf',2,$html[0]['nums']);
                }
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
