<?php

namespace App\Console\Commands\Jq;

use Illuminate\Console\Command;
use App\Http\Controllers\GamesApi\Card\PrivodeController;

class GameApiGetBet extends Command
{
    protected $signature = 'GameApiGetBet {g_id?} {endTime?}';
    protected $description = '对接游戏注单定时获取';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $param = [];
        if($g_id = $this->argument('g_id'))
        $param['g_id'] = $g_id;
        if($endTime = $this->argument('endTime'))
        $param['toTime'] = strtotime($endTime);
        (new PrivodeController())->getBet($param);
    }
}
