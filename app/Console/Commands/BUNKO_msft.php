<?php

namespace App\Console\Commands;

use App\Events\RunMstf;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BUNKO_msft extends Command
{
    protected $gameId = 82;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_msft';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速飞艇-定时结算';

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
        $get = DB::table('game_msft')->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        if($get){
            if($get->bunko !== 1){
                event(new RunMstf($get->opennum,$get->issue,$this->gameId,true)); //新--结算
                $update = DB::table('game_msft')->where('id',$get->id)->update([
                    'bunko' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速飞艇".$get->issue."结算出错");
                }
            }
        }
    }
}
