<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunPk10;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_bjpk10 extends Command
{
    protected $gameId = 50;
    protected $signature = 'BUNKO_bjpk10';
    protected $description = '北京PK10-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_bjpk10';
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
                event(new RunPk10($get->opennum, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}
