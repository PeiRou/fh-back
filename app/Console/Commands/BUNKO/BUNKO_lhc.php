<?php

namespace App\Console\Commands\BUNKO;

use App\Http\Controllers\Bet\New_nlhc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_lhc extends Command
{
    protected $gameId = 70;
    protected $signature = 'BUNKO_lhc';
    protected $description = '六合彩-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = 'lhc';
        $games = Config::get('games.'.$code);
        if(empty($games))
            return false;
        $table = $games['table'];
        $gameId = $games['gameId'];
        $gameName = $games['lottery'];
        $excel = new New_nlhc();
        $get = $excel->getNeedBunkoIssueLhc($table);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Bunko:'.$this->gameId.'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,80,'ing');
            $update = DB::table($table)->where('id', $get->id)->where('bunko', 2)->update([
                'bunko' => 3
            ]);
            if($update)
                $excel->all($get->open_num,$get->issue,$gameId,$get->id,false,$table,$gameName);
        }
    }
}
