<?php

namespace App\Console\Commands\BUNKO;

use App\Http\Controllers\Bet\New_msnn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

class BUNKO_msnn extends Command
{
    protected $signature = 'BUNKO_msnn';
    protected $description = '秒速牛牛-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = 'msnn';
        $Games = new Games();
        $lotterys = $Games->games[$code]??'';
        if(empty($lotterys))
            return false;
        $excel = new New_msnn();
        //阻止彩种進行中
        if($excel->stopBunko($code, 1,'BunkoCP'))
            return 'ing';
        $get = $excel->getNeedNNBunkoIssue($lotterys['table']);
        if($get){
            //阻止進行中
//            $excel->stopBunko($lotterys['gameId'], 1,'Bunko:'.$get->issue);
            $update = DB::table($lotterys['table'])->where('id', $get->id)->update([
                'nn_bunko' => 2
            ]);
            if($update)
                $excel->all($get->opennum,$get->niuniu, $get->issue, $get->id, false,$code,$lotterys); //新--结算
        }else{
            //如果现在没有需要开奖的，把下一期时间放到缓存里，减少读取次数
            $excel->setNextNNBunkoIssue($lotterys['table'],$code);
        }
    }
}
