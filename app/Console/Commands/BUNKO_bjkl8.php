<?php

namespace App\Console\Commands;

use App\Events\RunBjkl8;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_bjkl8 extends Command
{
    protected $gameId = 65;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_bjkl8';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '北京快乐8-定时结算';

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
        $get = DB::table('game_bjkl8')->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        if($get){
            if($get->bunko !== 1){
                event(new RunBjkl8($get->opennum,$get->issue,$this->gameId)); //新--结算
                $update = DB::table('game_bjkl8')->where('id',$get->id)->update([
                    'bunko' => 1
                ]);
                if($update !== 1){
                    \Log::info("北京快乐8".$get->issue."结算出错");
                }
            }
        }
    }
}
