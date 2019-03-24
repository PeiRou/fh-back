<?php

namespace App\Console\Commands\BUNKO;

use App\Events\RunGSK3;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_gsk3 extends Command
{
    protected $gameId = 16;
    protected $signature = 'BUNKO_gsk3';
    protected $description = '甘肃快3-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_gsk3';
        $excel = new Excel();
//        $get = $excel->stopBunko($this->gameId,60);
//        if($get)
//            return 'ing';
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Bunko:'.$this->gameId.'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
//        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunGSK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
