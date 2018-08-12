<?php

namespace App\Console\Commands;

use App\Events\RunPk10;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_pk10 extends Command
{
    protected  $code = 'bjpk10';
    protected  $gameId = 50;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_pk10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-北京赛车';

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
        $getFile    = Storage::disk('gameTime')->get('bjpk10.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
//            if(strtotime($value['time']) === strtotime($nowTime)){
//                return $value;
//            }
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3){
                return $value;
            }
        });
        if($filtered!=null){
            $nowIssueTime = date('Y-m-d').' '.$filtered['time'];
            $getIssue = DB::table('game_bjpk10')->where('opentime','=',$nowIssueTime)->first();
            $nextIssue = $getIssue->issue;

            if(strtotime($filtered['time']) == strtotime('23:57:30')){
                $nextDay = Carbon::parse(date('Y-m-d'))->addDay(1)->toDateTimeString();
                $nextIssueEndTime = date('Y-m-d',strtotime($nextDay)).' 09:07:00';
                $nextIssueLotteryTime = date('Y-m-d',strtotime($nextDay)).' 09:07:30';
            } else {
                $nextIssueEndTime = Carbon::parse($getIssue->opentime)->addSeconds(270)->toDateTimeString();
                $nextIssueLotteryTime = Carbon::parse($getIssue->opentime)->addMinutes(5)->toDateTimeString();
            }

            Redis::set('pk10:nextIssue',(int)$nextIssue+1);
            Redis::set('pk10:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            Redis::set('pk10:nextIssueEndTime',strtotime($nextIssueEndTime));
        }
        $url = Config::get('website.guanServerUrl').'bjpk10';
        $html = json_decode(file_get_contents($url),true);
        $redis_issue = Redis::get('pk10:issue');
        if($redis_issue !== $html[0]['issue']) {
            try {
                $up = DB::table('game_bjpk10')->where('issue', $html[0]['issue'])
                    ->update([
                        'is_open' => 1,
                        'year' => date('Y'),
                        'month' => date('m'),
                        'day' => date('d'),
                        'opennum' => $html[0]['nums']
                    ]);
                if ($up == 1) {
                    $key = 'pk10:issue';
                    Redis::set($key, $html[0]['issue']);
                    $this->clong->setKaijian('pk10',1,$html[0]['nums']);
                    $this->clong->setKaijian('pk10',2,$html[0]['nums']);
                }
            } catch (\Exception $exception) {
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
