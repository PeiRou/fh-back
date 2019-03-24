<?php

namespace App\Console\Commands\BUNKO;

use App\Events\RunXJSSC;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_xjssc extends Command
{
    protected $gameId = 4;
    protected $signature = 'BUNKO_xjssc';
    protected $description = '新疆时时彩-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_xjssc';
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
                event(new RunXJSSC($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
