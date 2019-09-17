<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunShfssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_shfssc extends Command
{
    protected $gameId = 918;
    protected $signature = 'BUNKO_shfssc';
    protected $description = '十分时时彩-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_shfssc';
        $excel = new Excel();
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
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunShfssc($get->opennum, $get->issue, $this->gameId, $get->id, false)); //新--结算
        }
    }
}
