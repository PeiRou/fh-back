<?php

namespace App\Console\Commands;

use App\Events\RunGdklsf;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_gdklsf extends Command
{
    protected $gameId = 60;
    protected $signature = 'BUNKO_gdklsf';
    protected $description = '广东快乐十分-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_gdklsf';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get) {
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
            if ($update)
                event(new RunGdklsf($get->opennum, $get->issue, $this->gameId, $get->id)); //结算
                //event(new RunGdklsf('6,2,7,15,19,4,9,16', '20181010085', $this->gameId, 1)); //结算
        }
    }
}
