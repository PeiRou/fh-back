<?php

namespace App\Console\Commands\BUNKO;

use App\Events\RunGZK3;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_gzk3 extends Command
{
    protected $gameId = 18;
    protected $signature = 'BUNKO_gzk3';
    protected $description = '贵州快3-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_gzk3';
        $excel = new Excel();
        $get = $excel->stopBunko($this->gameId,60);
        if($get)
            return 'ing';
        $get = $excel->getNeedBunkoIssue($table);
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunGZK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
