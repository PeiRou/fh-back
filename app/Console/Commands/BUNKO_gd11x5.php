<?php

namespace App\Console\Commands;

use App\Events\RunCqxync;
use App\Events\RunGd11x5;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_gd11x5 extends Command
{
    protected $gameId = 21;
    protected $signature = 'BUNKO_gd11x5';
    protected $description = '广东11选5-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_gd11x5';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunGd11x5($get->opennum,$get->issue,$this->gameId,$get->id)); //结算
        }
    }
}
