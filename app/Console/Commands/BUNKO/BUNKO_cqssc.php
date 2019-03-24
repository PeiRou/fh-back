<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunCqssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_cqssc extends Command
{
    protected $gameId = 1;
    protected $signature = 'BUNKO_cqssc';
    protected $description = '重庆时时彩-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_cqssc';
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
                event(new RunCqssc($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
