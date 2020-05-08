<?php

namespace App\Console\Commands\BUNKO;

use App\Http\Controllers\Bet\New_pknn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

class BUNKO_pknn extends Command
{
    protected $signature = 'BUNKO_pknn';
    protected $description = 'PK10牛牛-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = 'pknn';
        $Games = new Games();
        $lotterys = $Games->games[$code]??'';
        if(empty($lotterys))
            return false;
        $excel = new New_pknn();
        //阻止彩种進行中
        if($excel->stopBunko($code, 1,'BunkoCP'))
            return 'ing';
        $get = $excel->getNeedBunkoIssue($lotterys['table']);
        if($get){
            //阻止進行中
//            if($excel->stopBunko($lotterys['gameId'], 10,'Bunko:'.$get->issue))
//                return 'ing';
            $update = DB::table($lotterys['table'])->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                $excel->all($get->opennum,$get->niuniu, $get->issue, $get->id,$code,$lotterys); //新--结算
        }else{
            //如果现在没有需要开奖的，把下一期时间放到缓存里，减少读取次数
            $excel->setNextBunkoIssue($lotterys['table'],$code,true);
        }
    }
}
