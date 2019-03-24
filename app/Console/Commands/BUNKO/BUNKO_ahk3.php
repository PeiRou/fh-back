<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunAHK3;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_ahk3 extends Command
{
    protected $gameId = 11;
    protected $signature = 'BUNKO_ahk3';
    protected $description = '安徽快3-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_ahk3';
        $excel = new Excel();
        $get = $excel->stopBunko($this->gameId,60);
        if($get)
            return 'ing';
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
//            $redis = Redis::connection();
//            $redis->select(0);
//            //阻止進行中
//            $key = 'Bunko:'.$this->gameId.'ing:'.$get->issue;
//            if($redis->exists($key)){
//                return 'ing';
//            }
//            $redis->setex($key,60,'ing');
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunAHK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
