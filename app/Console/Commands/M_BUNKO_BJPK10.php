<?php

namespace App\Console\Commands;

use App\Excel;
use App\Events\RunPk10;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class M_BUNKO_BJPK10 extends Command
{
    protected $gameId = 50;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'M_BUNKO_BJPK10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '手动结算-北京赛车';

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
        $openNum = '01,08,02,09,05,03,10,06,04,07';
        $openIssue = '698882';
        $id = 11198;
        event(new RunPk10($openNum, $openIssue, $this->gameId, $id)); //新--结算
    }
}
