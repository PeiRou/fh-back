<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMsssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_msssc extends Command
{
    protected $gameId = 81;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_msssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速时时彩-定时结算';

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
        $table = 'game_msssc';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunMsssc($get->opennum, $get->issue, $this->gameId, $get->id, false)); //新--结算
        }
    }
}
