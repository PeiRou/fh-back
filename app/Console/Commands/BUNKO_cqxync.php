<?php

namespace App\Console\Commands;

use App\Events\RunCqxync;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_cqxync extends Command
{
    protected $gameId = 61;

    protected $signature = 'BUNKO_cqxync';
    protected $description = '重庆幸运农场-定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_cqxync';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunCqxync($get->opennum,$get->issue,$this->gameId,$get->id)); //结算
        }
    }
}
