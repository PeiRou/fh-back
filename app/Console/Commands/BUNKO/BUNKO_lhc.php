<?php

namespace App\Console\Commands\BUNKO;

use App\Events\RunLHC;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_lhc extends Command
{
    protected $gameId = 70;
    protected $signature = 'BUNKO_lhc';
    protected $description = '六合彩-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_lhc';
        $excel = new Excel();
        $get = $excel->stopBunko($this->gameId,80);
        if($get)
            return 'ing';
        $get = $excel->getNeedBunkoIssueLhc($table);
        if($get){
//            $update = DB::table($table)->where('id', $get->id)->update([
//                'bunko' => 2
//            ]);
            event(new RunLHC($get->open_num,$get->issue,$this->gameId,$get->id)); //新--结算
//            if($update)
//                event(new RunLHC($get->open_num,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
