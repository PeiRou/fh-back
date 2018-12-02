<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class BUNKO_mspk10 extends Command
{
    protected $gameId = 80;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'BUNKO_mspk10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '秒速赛车-定时结算';

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
        $get = $excel->getNeedBunkoIssue($table);
        if ($get) {
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
                event(new RunMssc($get->opennum, $get->issue, $this->gameId, $get->id, false)); //新--结算
        }
    }
}
