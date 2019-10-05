<?php

namespace App\Console\Commands\BUNKO;

use App\Http\Controllers\Bet\New_nlhc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

class BUNKO_lhc extends Command
{
    protected $signature = 'BUNKO_lhc';
    protected $description = '六合彩-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = 'lhc';
        $Games = new Games();
        $lotterys = $Games->games[$code]??'';
        if(empty($lotterys))
            return false;
        $excel = new New_nlhc();
        $get = $excel->getNeedBunkoIssueLhc($lotterys['table']);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Bunko:'.$lotterys['gameId'].'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,80,'ing');
            $update = DB::table($lotterys['table'])->where('id', $get->id)->where('bunko', 2)->update([
                'bunko' => 3
            ]);
            if($update)
                $excel->all($get->open_num,$get->issue,$get->id,false,$code,$lotterys);
        }
    }
}
