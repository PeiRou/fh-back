<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
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
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4 || $timeDiff == 5){
                return $value;
            }
        });
        if($filtered!=null){
//            \Log::info('秒速飞艇'.$filtered['issue']);
            if($filtered['issue'] >= 793 && $filtered['issue'] <= 1105){
                $date = Carbon::parse(date('Y-m-d'))->addDays(-1);
                $params =  [
                    'issue' => date('ymd',strtotime($date)).$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time'],
                    'shareData' => env('SHARE_OPEN_DATA')
                ];
            } else {
                $params =  [
                    'issue' => date('ymd').$filtered['issue'],
                    'openTime' => date('Y-m-d ').$filtered['time'],
                    'shareData' => env('SHARE_OPEN_DATA')
                ];
            }
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);

            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(75)->toDateTimeString();
            $New_nextIssue = $nextIssue+1;
            if(substr($New_nextIssue,-4)=='1106'){
                $dateIssue = substr($nextIssue,strlen($nextIssue)-4);
                $New_nextIssue = date("Ymd",strtotime($dateIssue)+86400).'0001';
            }

            Redis::set('msft:nextIssue',(int)$New_nextIssue);
            Redis::set('msft:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msft:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            //---kill start
            $table = 'game_msft';
            $excel = new Excel();
            $info = DB::connection('mysql::write')->table($table)->where('issue',$res->expect)->where('is_open',0)->first();
            if(empty($info))
                return '';
            $opennum = $excel->kill_count($table,$res->expect,$this->gameId,$res->opencode);
            //---kill end
            $opencode = empty($opennum)?$res->opencode:$opennum;
            //清除昨天长龙，在录第一期的时候清掉
            if($filtered['issue']=='0001'){
                DB::table('clong_kaijian1')->where('lotteryid',82)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',82)->delete();
            }
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
                writeLog('msft', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
//                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
