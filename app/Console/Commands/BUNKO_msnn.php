<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunMsnn;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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
        $table = 'game_mssc';
        $excel = new Excel();
        $get = $excel->getNeedNNBunkoIssue($table);
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
                'nn_bunko' => 2
            ]);
            if($update)
                event(new RunMsnn($get->opennum,$get->niuniu, $get->issue, $this->gameId, $get->id)); //新--结算
        }
    }
}
