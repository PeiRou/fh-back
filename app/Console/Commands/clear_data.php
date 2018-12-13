<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class clear_data extends Command
{

    protected $signature = 'clear_data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '清除缓存';

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
        $clearDate = date('Y-m-d 23:59:59',strtotime(date('Y-m-1 00:00:00',strtotime("-1 month")))-300);
        $sql = "DELETE FROM bet WHERE created_at<='{$clearDate}' LIMIT 500";
        $res = DB::connection('mysql::write')->statement($sql);
        echo $res.PHP_EOL;
        echo 'Ok';
    }
}
