<?php

namespace App\Console\Commands;

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
        $get = DB::table('game_paoma')->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        if($get){
            if($get->bunko !== 1){
                event(new RunPaoma($get->opennum,$get->issue,$this->gameId)); //新--结算
                $update = DB::table('game_paoma')->where('id',$get->id)->update([
                    'bunko' => 1
                ]);
                if($update !== 1){
                    \Log::info("跑马".$get->issue."结算出错");
                }
            }
        }
    }
}
