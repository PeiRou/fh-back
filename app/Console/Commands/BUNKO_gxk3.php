<?php

namespace App\Console\Commands;

use App\Events\RunGXK3;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_gxk3 extends Command
{
    protected $gameId = 12;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_gxk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '广西快3-定时结算';

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
        $get = DB::table('game_gxk3')->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        if($get){
            if($get->bunko !== 1){
                event(new RunGXK3($get->opennum,$get->issue,$this->gameId)); //新--结算
                $update = DB::table('game_gxk3')->where('id',$get->id)->update([
                    'bunko' => 1
                ]);
                if($update !== 1){
                    \Log::info("广西快3".$get->issue."结算出错");
                }
            }
        }
    }
}
