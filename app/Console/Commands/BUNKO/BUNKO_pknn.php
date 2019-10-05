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
        $get = $excel->getNeedBunkoIssue($lotterys['table']);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            $redis->del($code.':needbunko--'.$get->issue);
            //阻止進行中
            $key = 'Bunko:'.$lotterys['gameId'].'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            $update = DB::table($lotterys['table'])->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                $excel->all($get->opennum,$get->niuniu, $get->issue, $get->id,$code,$lotterys); //新--结算
            $one = $excel->getNeedBunkoIssue($lotterys['table']);
            if($one)
                $redis->set($code.':needbunko--'.$one->issue,$one->issue);
        }
    }
}
