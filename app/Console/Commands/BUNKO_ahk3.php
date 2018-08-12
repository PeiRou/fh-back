<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunAHK3;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_ahk3 extends Command
{
    protected $gameId = 11;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_ahk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '安徽快3-定时结算';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = 'game_ahk3';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunAHK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
