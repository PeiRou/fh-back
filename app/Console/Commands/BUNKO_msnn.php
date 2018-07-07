<?php

namespace App\Console\Commands;

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
        $get = DB::table('game_mssc')->where('is_open',1)->orderBy('opentime','desc')->take(1)->first();
        if($get){
            if($get->nn_bunko !== 1){
                $opencode = '5,4,7,10,1,6,3,2,9,8';
//                event(new RunMsnn($get->opennum,$get->niuniu,$get->issue,$this->gameId)); //新--结算
                event(new RunMsnn($opencode,$get->niuniu,$get->issue,$this->gameId)); //新--结算
                $update = DB::table('game_mssc')->where('id',$get->id)->update([
                    'nn_bunko' => 1
                ]);
                if($update !== 1){
                    \Log::info("秒速牛牛".$get->issue."结算出错");
                }
            }
        }
    }
}
