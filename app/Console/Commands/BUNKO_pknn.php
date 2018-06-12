<?php

namespace App\Console\Commands;

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
        $get = DB::table('game_pknn')->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        if($get){
            if($get->bunko !== 1){
                event(new RunPknn($get->opennum,$get->niuniu,$get->issue,$this->gameId)); //新--结算
                $update = DB::table('game_pknn')->where('id',$get->id)->update([
                    'bunko' => 1
                ]);
                if($update !== 1){
                    \Log::info("PK10牛牛".$get->issue."结算出错");
                }
            }
        }
    }
}
