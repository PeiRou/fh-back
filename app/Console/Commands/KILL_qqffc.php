<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class KILL_qqffc extends Command
{
    protected $gameId = 113;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'KILL_qqffc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'QQ分分彩-定时杀率';

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

    }
}
