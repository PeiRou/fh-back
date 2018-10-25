<?php

namespace App\Console\Commands;

use App\Events\RunGZK3;
use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_gzk3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_gzk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '贵州快3-定时结算';

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
        $table = 'game_gzk3';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunGZK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
