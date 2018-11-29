<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\GamesApi;
use App\Jobs\GameApiSports_TCZS as jobs_GameApiSports_TCZS;

class GameApiSports_TCZS extends Command
{
    protected $signature = 'GameApiSports_TCZS';
    protected $description = '体育游戏获取竞彩指数';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $list = GamesApi::getTcList();
//        foreach ($list as $k=>$v){
//            $res = $this->action($v->g_id, 'getTCZS');
//        }
        jobs_GameApiSports_TCZS::dispatch(18,'getTCZS')->onQueue(setQueueRealName('GameApiSports_ISSUE'));
//        return $this->action(18, 'getRes');
    }
}
