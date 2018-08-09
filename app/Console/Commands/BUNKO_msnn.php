<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMsnn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_msnn extends Command
{
    protected $gameId = 91;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_msnn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速牛牛-定时结算';

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
        $table = 'game_mssc';
        $excel = new Excel();
        $get = $excel->getNeedNNBunkoIssue($table);
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunMsnn($get->opennum,$get->niuniu, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}
