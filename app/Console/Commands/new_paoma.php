<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;
use Illuminate\Support\Facades\Storage;

class new_paoma extends Command
{
    protected  $code    = 'paoma';
    protected  $gameId  = 99;
    protected $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_paoma';

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
        $getFile = Storage::disk('gameTime')->get('paoma.json');
        $data = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
//            if(strtotime($value['time']) === strtotime($nowTime)){
//                return $value;
//            }
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4 || $timeDiff == 5){
                return $value;
            }
        });
        if($filtered!=null){
            if($filtered['issue'] >= 793 && $filtered['issue'] <= 985){
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
            Redis::set('paoma:nextIssue',(int)$nextIssue+1);
            Redis::set('paoma:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('paoma:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            $info = DB::connection('mysql::write')->table('game_paoma')->where('issue',$res->expect)->where('is_open',0)->first();
            if(empty($info))
                return false;
            //---kill start
            $table = 'game_paoma';
            $excel = new Excel();
            $opennum = $excel->kill_count($table,$res->expect,$this->gameId,$res->opencode);
            //---kill end
            $opencode = empty($opennum)?$res->opencode:$opennum;
            //清除昨天长龙，在录第一期的时候清掉
            if($filtered['issue']=='001'){
                DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
            }
            try{
                DB::table('game_paoma')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $opencode
                ]);
                $this->clong->setKaijian('paoma',1,$opencode);
                $this->clong->setKaijian('paoma',2,$opencode);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
