<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunPaoma;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_paoma extends Command
{
    protected $gameId = 99;
    protected $signature = 'BUNKO_paoma';
    protected $description = '跑马-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_paoma';
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
                event(new RunPaoma($get->opennum, $get->issue, $this->gameId, $get->id, false)); //新--结算
        }
    }
}
