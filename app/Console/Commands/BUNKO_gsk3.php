<?php

namespace App\Console\Commands;

use App\Events\RunGSK3;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_gsk3 extends Command
{
    protected $gameId = 16;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_gsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '甘肃快3-定时结算';

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
        $table = 'game_gsk3';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunGSK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
