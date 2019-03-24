<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use App\Events\RunMsnn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_msnn extends Command
{
    protected $gameId = 91;
    protected $signature = 'BUNKO_msnn';
    protected $description = '秒速牛牛-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_mssc';
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
                event(new RunMsnn($get->opennum,$get->niuniu, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}
