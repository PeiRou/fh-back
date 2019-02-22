<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunBjkl8;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_bjkl8 extends Command
{
    protected $gameId = 65;
    protected $signature = 'BUNKO_bjkl8';
    protected $description = '北京快乐8-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_bjkl8';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if ($get) {
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
                event(new RunBjkl8($get->opennum, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}