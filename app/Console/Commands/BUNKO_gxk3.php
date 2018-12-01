<?php

namespace App\Console\Commands;

use App\Excel;
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
        $table = 'game_gxk3';
        $excel = new Excel();
        $get = $excel->getNeedBunkoIssue($table);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Bunko:'.$this->gameId.'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            $update = DB::table($table)->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            if($update)
                event(new RunGXK3($get->opennum,$get->issue,$this->gameId,$get->id)); //新--结算
        }
    }
}
