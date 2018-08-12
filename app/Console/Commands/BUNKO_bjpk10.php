<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunPk10;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_bjpk10 extends Command
{
    protected $gameId = 50;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_bjpk10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '北京PK10-定时结算';

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
        $table = 'game_bjpk10';
        $excel = new Excel();
//        $get = $excel->getNeedBunkoIssue($table);
        $get = DB::table($table)->where("is_open",1)->where('bunko',0)->orderBy('opentime','desc')->first();
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunPk10($get->opennum, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}
