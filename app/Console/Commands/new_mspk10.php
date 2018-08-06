<?php

namespace App\Console\Commands;

use App\Events\RunMssc;
use App\Http\Controllers\Bet\New_Mssc;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Bet\Clong;

class new_mspk10 extends Command
{
    protected  $code    = 'mssc';
    protected  $gameId  = 80;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'new_mspk10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速赛车+秒速牛牛';

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
        $getFile = Storage::disk('gameTime')->get('mssc.json');
        $data = json_decode($getFile,true);
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
            //处理秒速牛牛
            $niuniu = $this->exePK10nn($res->opencode);

            $nextIssue = $res->expect;
            $nextIssueEndTime = Carbon::parse($res->opentime)->addSeconds(60)->toDateTimeString();
            $nextIssueLotteryTime = Carbon::parse($res->opentime)->addSeconds(75)->toDateTimeString();
            Redis::set('mssc:nextIssue',(int)$nextIssue+1);
            Redis::set('mssc:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('mssc:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));

            Redis::set('msnn:nextIssue',(int)$nextIssue+1);
            Redis::set('msnn:nextIssueEndTime',strtotime($nextIssueEndTime));
            Redis::set('msnn:nextIssueLotteryTime',strtotime($nextIssueLotteryTime));
            //---kill start
            $killopennum = DB::table('game_msssc')->select('excel_opennum')->where('issue',$res->expect)->first();
            $opennum = isset($killopennum->excel_opennum)?$killopennum->excel_opennum:'';
            \Log::info('秒速赛车 获取KILL开奖'.$res->expect.'--'.$opennum);
            \Log::info('秒速赛车 获取origin开奖'.$res->expect.'--'.$res->opencode);
//            if(empty($opennum)){
//                $killniuniu = $this->exePK10nn($opennum);
//                \Log::info('秒速牛牛 获取KILL开奖'.$res->expect.'--'.$this->nn($killniuniu[0]).','.$this->nn($killniuniu[1]).','.$this->nn($killniuniu[2]).','.$this->nn($killniuniu[3]).','.$this->nn($killniuniu[4]).','.$this->nn($killniuniu[5]));
//            }

            \Log::info('秒速牛牛 获取origin开奖'.$res->expect.'--'.$this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5]));


            $replace = str_replace('10','0',$res->opencode);
            $explodeNum = explode(',',$replace);
            $banker = (int)$explodeNum[0].(int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4];
            $player1 = (int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5];
            $player2 = (int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6];
            $player3 = (int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7];
            $player4 = (int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8];
            $player5 = (int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8].(int)$explodeNum[9];

            //---kill end
            try{
                \Log::info($niuniu);
                DB::table('game_mssc')->where('issue',$res->expect)->update([
                    'is_open' => 1,
                    'year'=> date('Y'),
                    'month'=> date('m'),
                    'day'=>  date('d'),
                    'opennum'=> $res->opencode,
//                    'niuniu' => $this->nn($niuniu[0]).','.$this->nn($niuniu[1]).','.$this->nn($niuniu[2]).','.$this->nn($niuniu[3]).','.$this->nn($niuniu[4]).','.$this->nn($niuniu[5])
                    'niuniu' => $banker.','.$player1.','.$player2.','.$player3.','.$player4.','.$player5
                ]);
                $this->clong->setKaijian('mssc',1,$res->opencode);
                $this->clong->setKaijian('mssc',2,$res->opencode);
            } catch (\Exception $exception){
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
            }
        }
    }
    //处理秒速牛牛
    private function exePK10nn($opencode){
        $replace = str_replace('10','0',$opencode);
        $explodeNum = explode(',',$replace);
        $banker = (int)$explodeNum[0].(int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4];
        $player1 = (int)$explodeNum[1].(int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5];
        $player2 = (int)$explodeNum[2].(int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6];
        $player3 = (int)$explodeNum[3].(int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7];
        $player4 = (int)$explodeNum[4].(int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8];
        $player5 = (int)$explodeNum[5].(int)$explodeNum[6].(int)$explodeNum[7].(int)$explodeNum[8].(int)$explodeNum[9];
        return [$banker,$player1,$player2,$player3,$player4,$player5];
    }

    function nn($num){
        $aNumber = str_split($num);
        $nSame = array();
        $stop = false;
        $nSp = 0;
        for ($yy = 0;$yy<5;$yy++){
            for ($ii = 0;$ii<5;$ii++){
                for ($xx = 0;$xx<5;$xx++){
                    if($xx==$yy ||$xx==$ii ||$ii==$yy )
                        continue;
                    $nn = str_split($yy.$ii.$xx);
                    sort($nn);
                    $nn = implode("",$nn);
                    if( in_array($nn,$nSame))
                        continue;
                    $nSum = $aNumber[$yy]+$aNumber[$ii]+$aNumber[$xx];
                    if($nSum%10==0){
                        unset($aNumber[$yy]);
                        unset($aNumber[$ii]);
                        unset($aNumber[$xx]);
                        $stop = true;
                        break;
                    }
                    $nSame[] = $nn;
                }
                if($stop)
                    break;
            }
            if($stop)
                break;
        }
        if(!$stop){
            $total = -1; //无牛
        } else {
            foreach ($aNumber as $val)
                $nSp+=$val;  //牛1～牛9&牛牛
            $nSp = $nSp%10==0?10:$nSp%10;
            $total = $nSp;
        }
        return $total;
    }
}
