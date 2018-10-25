<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_xjssc extends Command
{
    protected  $code = 'xjssc';
    protected  $gameId = 4;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_xjssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新疆时时彩';

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
        $getFile    = Storage::disk('gameTime')->get('xjssc.json');
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
            $getIssue = DB::table('game_xjssc')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('02:00:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 10:08:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 10:10:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addMinute(8)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            }

            Redis::set('xjssc:nextIssue',(int)$nextIssue+1);
            Redis::set('xjssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('xjssc:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'xjssc';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('xjssc:issue');
        //清除昨天长龙，在录第一期的时候清掉
        if($filtered['issue']=='01'){
            DB::table('clong_kaijian1')->where('lotteryid',4)->delete();
            DB::table('clong_kaijian2')->where('lotteryid',4)->delete();
        }
        if($redis_issue !== $html[0]['issue']){
            try{
                $up = DB::table('game_xjssc')->where('issue',$html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'opennum' => $html[0]['nums']
                    ]);
                if($up == 1){
                    $key = 'xjssc:issue';
                    Redis::set($key,$html[0]['issue']);
                    $this->clong->setKaijian('xjssc',1,$html[0]['nums']);
                    $this->clong->setKaijian('xjssc',2,$html[0]['nums']);
                }
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
