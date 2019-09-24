<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;

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
        $games = Config::get('games.'.$code);
        if(empty($games))
            return false;
        $excel = new Excel();
        $excel = $excel->newObject($code);
        $table = $games['table'];
        $type = $games['type'];
        $gameId = $games['gameId'];
        $gameName = $games['name'];
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
            $opennum = $type=='lhc'?$get->open_num:$get->opennum;
            if($update)
                $excel->all($opennum,$get->issue,$gameId,$get->id,false,$table,$gameName);
        }
    }
}
