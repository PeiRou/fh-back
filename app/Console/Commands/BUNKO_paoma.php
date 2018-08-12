<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunPaoma;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_paoma extends Command
{
    protected $gameId = 99;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_paoma';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '跑马-定时结算';

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
        $table = 'game_paoma';
        $excel = new Excel();
//        $get = $excel->getNeedBunkoIssue($table);
        $get = DB::table($table)->where("is_open",1)->where('bunko',0)->orderBy('opentime','desc')->first();
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunPaoma($get->opennum, $get->issue, $this->gameId, $get->id, false)); //新--结算
        }
    }
}
