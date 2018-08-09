<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMSJSK3;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_msjsk3 extends Command
{
    protected $gameId = 86;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_msjsk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速江苏快3-定时结算';

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
        $table = 'game_msjsk3';
        $get = Excel::getNeedBunkoIssue($table);
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            event(new RunMSJSK3($get->opennum, $get->issue, $this->gameId, $get->id, false)); //新--结算
        }
    }
}
