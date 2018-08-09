<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_msft extends Command
{
    protected  $code = 'msft';
    protected  $gameId = 82;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_msft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-秒速飞艇';

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
        $getFile    = Storage::disk('gameTime')->get('msft.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $nowTimeAdd1 = Carbon::parse($nowTime)->addSeconds(1);
        $nowTimeAdd2 = Carbon::parse($nowTime)->addSeconds(2);
        $nowTimeAdd3 = Carbon::parse($nowTime)->addSeconds(3);
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime, $nowTimeAdd1, $nowTimeAdd2, $nowTimeAdd3) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3){
                return $value;
            }
//            if(strtotime($value['time']) == strtotime($nowTime) || strtotime($value['time']) == strtotime($nowTimeAdd1) || strtotime($value['time']) == strtotime($nowTimeAdd2) || strtotime($value['time']) == strtotime($nowTimeAdd3)){
//                return $value;
//            }
        });
//        \Log::info('当前文件时间：'.$nowTime);
//        \Log::info('开奖时间'.$filtered['time']);
//        \Log::info('误差时间'.$nowTimeAdd1.'=='.$nowTimeAdd2.'=='.$nowTimeAdd3);
        if($filtered!=null){
//            \Log::info('秒速飞艇'.$filtered['issue']);
            if($filtered['issue'] >= 793 && $filtered['issue'] <= 985){
                $date = Carbon::parse(date('Y-m-d'))->addDays(-1);
                $params =  [
                    'issue' => date('ymd',strtotime($date)).$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time']
                ];
            } else {
                $params =  [
                    'issue' => date('ymd').$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time']
                ];
            }
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);

            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(75)->toDateTimeString();
            Redis::set('msft:nextIssue',(int)$nextIssue+1);
            Redis::set('msft:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msft:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            //---kill start
            $table = 'game_msft';
            $excel = new Excel();
            $opennum = $excel->kill_count($table,$res->expect,$this->gameId,$res->opencode);
            //---kill end
            $opencode = empty($opennum)?$res->opencode:$opennum;
            try{
                DB::table('game_msft')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $opencode
                ]);
                $this->clong->setKaijian('msft',1,$opencode);
                $this->clong->setKaijian('msft',2,$opencode);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
