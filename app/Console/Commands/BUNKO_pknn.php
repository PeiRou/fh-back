<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunPknn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_pknn extends Command
{
    protected $gameId = 90;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_pknn';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'PK10牛牛-定时结算';

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
        $table = 'game_pknn';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if ($get) {
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunPknn($get->opennum,$get->niuniu, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}
