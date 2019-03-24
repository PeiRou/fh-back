<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunGXK3;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_gxk3 extends Command
{
    protected $gameId = 12;
    protected $signature = 'BUNKO_gxk3';
    protected $description = '广西快3-定时结算';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_gxk3';
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
                event(new RunGXK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
