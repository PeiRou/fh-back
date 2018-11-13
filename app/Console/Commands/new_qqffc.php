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

class new_qqffc extends Command
{
    protected  $code = 'qqffc';
    protected  $gameId = 113;
    protected  $clong;

    protected $signature = 'new_qqffc';
    protected $description = '新-QQ分分彩';

    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }

    public function handle()
    {
        $getFile    = Storage::disk('gameTime')->get('qqffc.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
            if($timeDiff == 0 || $timeDiff == 1 || $timeDiff == 2 || $timeDiff == 3 || $timeDiff == 4 || $timeDiff == 5){
                return $value;
            }
        });
        if($filtered!=null){
            if($filtered['time'] == '0001'){
                \Log::info('QQ分分彩第一期:'.date('Y-m-d ').$filtered['time']);
            }
            $params =  [
                'issue' => date('Ymd').$filtered['issue'],
                'openTime' => date('Y-m-d ').$filtered['time']
            ];
            $res = curl(Config::get('website.openServerUrl').$this->code,$params,1);
            $res = json_decode($res);
            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(50)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $New_nextIssue = $nextIssue+1;
            if(substr($New_nextIssue,-4)=='1441'){
                $dateIssue = substr($nextIssue,strlen($nextIssue)-4);
                $New_nextIssue = date("Ymd",strtotime($dateIssue)+86400).'0001';
            }

            Redis::set('qqffc:nextIssue',(int)$New_nextIssue);
            Redis::set('qqffc:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('qqffc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));

            $table = 'game_qqffc';
            $excel = new Excel();
            //---kill start
            $opennum = $excel->kill_count($table,$res->expect,$this->gameId,$res->opencode);
            //---kill end
            $opencode = empty($opennum)?$res->opencode:$opennum;//清除昨天长龙，在录第一期的时候清掉
            if($filtered['issue']=='0001'){
                DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
            }
            try{
                DB::table('game_qqffc')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $opencode
                ]);
                $this->clong->setKaijian('qqffc',1,$opencode);
                $this->clong->setKaijian('qqffc',2,$opencode);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
