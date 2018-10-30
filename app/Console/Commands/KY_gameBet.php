<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\KY\KYActionController;
class KY_gameBet extends Command
{
    protected $signature = 'KY_gameBet';
    protected $description = '开元注单定时获取';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $res = (new KYActionController())->KY_gameBet();
        $this->info($res);
    }
}
