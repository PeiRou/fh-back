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
        echo 'BUNKO-'.$code.PHP_EOL;
        $Games = new Games();
        $games = $Games->games[$code]??'';
        if(empty($games))
            return false;
        $table = $games['table'];
        $gameId = $games['gameId'];
        $gameName = $games['lottery'];
        $excel = new New_msnn();
        $get = $excel->getNeedNNBunkoIssue($table);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            $redis->del($code.':needbunko--'.$get->issue);
            //阻止進行中
            $key = 'Bunko:'.$gameId.'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            $update = DB::table($table)->where('id', $get->id)->update([
                'nn_bunko' => 2
            ]);
            if($update)
                $excel->all($get->opennum,$get->niuniu, $get->issue, $gameId, $get->id,$code,$table,$gameName); //新--结算
            $get = $excel->getNeedNNBunkoIssueAll($table);
            if($get) {
                foreach ($get as $k => $one) {
                    $redis->set($code . ':needbunko--' . $one->issue, $one->issue);
                }
            }
        }
    }
}
