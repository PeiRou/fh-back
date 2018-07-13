<?php

namespace App\Console\Commands;

use App\Helpers\LHC_SX;
use App\Http\Controllers\Bet\Clong;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class new_xylhc extends Command
{
    protected  $code = 'xylhc';
    protected  $gameId = 85;
//    protected  $clong;
    protected $LHC;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_xylhc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新-幸运六合彩开奖';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(LHC_SX $LHC)
    {
//        $this->clong = $clong;
        $this->LHC = $LHC;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $getFile    = Storage::disk('gameTime')->get('xylhc.json');
        $data       = json_decode($getFile,true);
        $nowTime    = date('H:i:s');
        $nowTimeAdd1 = Carbon::parse($nowTime)->addSeconds(1);
        $nowTimeAdd2 = Carbon::parse($nowTime)->addSeconds(2);
        $nowTimeAdd3 = Carbon::parse($nowTime)->addSeconds(3);
        $filtered = collect($data)->first(function ($value, $key) use ($nowTime, $nowTimeAdd1, $nowTimeAdd2, $nowTimeAdd3) {
            $timeDiff = Carbon::now()->diffInSeconds(Carbon::parse($value['time']));
        });
        if($filtered!=null){
            if($filtered['issue'] >= 192 && $filtered['issue'] <= 240){
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
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(270)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(300)->toDateTimeString();
            Redis::set('xylhc:nextIssue',(int)$nextIssue+1);
            Redis::set('xylhc:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('xylhc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            try{
                $openNum = explode(',',$res->opencode);
                $n1 = $openNum[0];
                $n2 = $openNum[1];
                $n3 = $openNum[2];
                $n4 = $openNum[3];
                $n5 = $openNum[4];
                $n6 = $openNum[5];
                $n7 = $openNum[6];
                $totalNum = (int)$n1+(int)$n2+(int)$n3+(int)$n4+(int)$n5+(int)$n6+(int)$n7;

                DB::table('game_xylhc')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'open_num'=> $res->opencode,
                    'n1' => $n1,
                    'n2' => $n2,
                    'n3' => $n3,
                    'n4' => $n4,
                    'n5' => $n5,
                    'n6' => $n6,
                    'n7' => $n7,
                    'n1_sb' => $this->LHC->sebo($n1),
                    'n2_sb' => $this->LHC->sebo($n2),
                    'n3_sb' => $this->LHC->sebo($n3),
                    'n4_sb' => $this->LHC->sebo($n4),
                    'n5_sb' => $this->LHC->sebo($n5),
                    'n6_sb' => $this->LHC->sebo($n6),
                    'n7_sb' => $this->LHC->sebo($n7),
                    'n1_sx' => $this->LHC->shengxiao($n1),
                    'n2_sx' => $this->LHC->shengxiao($n2),
                    'n3_sx' => $this->LHC->shengxiao($n3),
                    'n4_sx' => $this->LHC->shengxiao($n4),
                    'n5_sx' => $this->LHC->shengxiao($n5),
                    'n6_sx' => $this->LHC->shengxiao($n6),
                    'n7_sx' => $this->LHC->shengxiao($n7),
                    'total_num' => $totalNum,
                ]);
//                $this->clong->setKaijian('msft',1,$res->opencode);
//                $this->clong->setKaijian('msft',2,$res->opencode);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
}
