<?php

namespace App\Console\Commands\BUNKO;

use App\Http\Controllers\Bet\New_pknn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;

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
        $games = Config::get('games.'.$code);
        if(empty($games))
            return false;
        $table = $games['table'];
        $gameId = $games['gameId'];
        $gameName = $games['name'];
        $excel = new New_pknn();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Bunko:'.$gameId.'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                $excel->all($get->opennum,$get->niuniu, $get->issue, $gameId, $get->id,$table,$gameName); //新--结算
        }
    }
}
