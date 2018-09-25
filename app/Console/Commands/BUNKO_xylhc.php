<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunXYLHC;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_xylhc extends Command
{
    protected $gameId = 85;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_xylhc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '幸运六合彩-定时结算';

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
        $table = 'game_xylhc';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunXYLHC($get->open_num,$get->issue,$this->gameId,$get->id, false)); //新--结算
        }
    }
}
