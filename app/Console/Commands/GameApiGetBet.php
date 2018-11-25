<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\GamesApi\Card\PrivodeController;

class GameApiGetBet extends Command
{
    protected $signature = 'GameApiGetBet';
    protected $description = '对接游戏注单定时获取';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        (new PrivodeController())->getBet();
    }
}
