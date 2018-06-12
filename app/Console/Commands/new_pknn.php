<?php

namespace App\Console\Commands;

use App\Events\RunPk10;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_pknn extends Command
{
    protected  $code = 'pknn';
    protected  $gameId = 90;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_pknn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PK10牛牛';

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
        $getFile    = Storage::disk('gameTime')->get('pknn.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            if(strtotime($value['time']) === strtotime($nowTime)){
                return $value;
            }
        });
        if($filtered!=null){
            $nowIssueTime = strtotime(date('Y-m-d').' '.$filtered['time']);
            $getIssue = DB::table('game_pknn')->whereRaw('unix_timestamp(opentime) = '.$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('23:57:30')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:07:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:07:30';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(270)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(5)->toDateTimeString();
            }

            Redis::set('pknn:nextIssue',(int)$nextIssue+1);
            Redis::set('pknn:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('pknn:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'pknn';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('pknn:issue');
        if($redis_issue !== $html[0]['issue']){
            try{
                $up = DB::table('game_pknn')->where('issue',$html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year'=> date('Y'),
                        'month'=> date('m'),
                        'day'=>  date('d'),
                        'opennum' => $html[0]['nums'],
                        'niuniu' => $html[0]['pknn_nums']
                    ]);
                if($up == 1){
                    $key = 'pknn:issue';
                    Redis::set($key,$html[0]['issue']);
                }
            } catch (\Exception $exception) {
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
