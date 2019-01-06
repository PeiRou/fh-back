<?php

namespace App\Console\Commands;

use App\Events\RunPk10;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_pcdd extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_pcdd';
    protected $clong;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $getFile    = Storage::disk('gameTime')->get('bjkl8.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3){
                return $value;
            }
//            if(strtotime($value['time']) === strtotime($nowTime)){
//                return $value;
//            }
        });
        if($filtered!=null){
            $nowIssueTime = date('Y-m-d').' '.$filtered['time'];
            $getIssue = DB::table('game_pcdd')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('23:55:00')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:04:30';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:05:00';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(270)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(5)->toDateTimeString();
            }

            $redis = Redis::connection();
            $redis->select(0);
            $redis->set('pcdd:nextIssue',(int)$nextIssue+1);
            $redis->set('pcdd:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            $redis->set('pcdd:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'pcdd';
        try {
            $html = json_decode(file_get_contents($url),true);
            $redis_issue = Redis::get('pcdd:issue');
            //清除昨天长龙，在录第一期的时候清掉
            if($filtered['time']=='09:05:00'){
                DB::table('clong_kaijian1')->where('lotteryid',66)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',66)->delete();
            }
            if($redis_issue !== $html[0]['issue']){
                try{
                    $up = DB::table('game_pcdd')->where('issue',$html[0]['issue'])
                        ->update([
                            'is_open' => 1,
                            'year'=> date('Y'),
                            'month'=> date('m'),
                            'day'=>  date('d'),
                            'opennum' => $html[0]['nums']
                        ]);
                    if($up == 1){
                        $key = 'pcdd:issue';
                        Redis::set($key,$html[0]['issue']);
                        $this->clong->setKaijian('pcdd',2,$html[0]['nums']);
                    }
                } catch (\Exception $exception){
                    writeLog('pcdd', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception){
            writeLog('pcdd', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
