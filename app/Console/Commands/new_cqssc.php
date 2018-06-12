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

class new_cqssc extends Command
{
    protected  $code = 'cqssc';
    protected  $gameId = 1;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_cqssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-重庆时时彩';

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
        $getFile    = Storage::disk('gameTime')->get('cqssc.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            if(strtotime(date('H:i:s',strtotime($value['time']))) === strtotime($nowTime)){
                return $value;
            }
        });
        if($filtered!=null){
            $nowIssueTime = strtotime(date('Y-m-d').' '.$filtered['time']);
            $getIssue = DB::table('game_cqssc')->whereRaw('unix_timestamp(opentime) = '.$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime(date('H:i:s')) >= strtotime('00:00:00') && strtotime(date('H:i:s')) <= strtotime('01:55:00')){
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(255)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(5)->toDateTimeString();
            }
            if(strtotime(date('H:i:s')) >= strtotime('10:00:00') && strtotime(date('H:i:s')) <= strtotime('22:00:00')){
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(555)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(10)->toDateTimeString();
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(255)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(5)->toDateTimeString();
            }

            if($filtered['issue'] == '023'){
                $nextIssueTime = date('Ymd').'024';
                Redis::set('cqssc:nextIssue',(int)$nextIssueTime);
            } else {
                Redis::set('cqssc:nextIssue',(int)$nextIssue+1);
            }

            Redis::set('cqssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('cqssc:nextIssueEndTime',strtotime($nextIssueEndTime));
            //\Log::info('符合重庆时时彩时间：'.$filtered['time']);
        }
        $url = Config::get('website.guanServerUrl').'cqssc';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('cqssc:issue');
        if($redis_issue !== $html[0]['issue']){
            try{
                $up = DB::table('game_cqssc')->where('issue',$html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'opennum' => $html[0]['nums']
                    ]);
                if($up == 1){
                    $key = 'cqssc:issue';
                    Redis::set($key,$html[0]['issue']);
                    $this->clong->setKaijian('cqssc',1,$html[0]['nums']);
                    $this->clong->setKaijian('cqssc',2,$html[0]['nums']);
                }
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
            //\Log::info('读取重庆时时彩Mysql数据');
        }
    }
}
