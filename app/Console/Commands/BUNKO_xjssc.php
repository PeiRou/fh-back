<?php

namespace App\Console\Commands;

use App\Events\RunXJSSC;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_xjssc extends Command
{
    protected $gameId = 4;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_xjssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新疆时时彩-定时结算';

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
        $table = 'game_xjssc';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunXJSSC($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
