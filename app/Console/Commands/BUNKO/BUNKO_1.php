<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

class BUNKO_1 extends Command
{
    protected $signature = 'BUNKO_1 {code?}';
    protected $description = '单一定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = $this->argument('code');
        if(in_array($code,['lhc','msnn','pknn']))
            return false;
        $Games = new Games();
        $games = $Games->games[$code]??'';
        if(empty($games) || in_array($code,['lhc','msnn','pknn']))
            return false;
        $excel = new Excel();
        $excel = $excel->newObject($code);
        $table = $games['table'];
        $type = $games['type'];
        $gameId = $games['gameId'];
        $gameName = $games['lottery'];
        $get = $excel->getNeedBunkoIssue($table);
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
                'bunko' => 2
            ]);
            $opennum = $type=='lhc'?$get->open_num:$get->opennum;
            if($update)
                $excel->all($opennum,$get->issue,$gameId,$get->id,false,$code,$table,$gameName);
            $get = $excel->getNeedBunkoIssueAll($table);
            if($get){
                foreach ($get as $k => $one){
                    $redis->set($code.':needbunko--'.$one->issue,$one->issue);
                }
            }
        }
    }
}
