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
        //清-投注表
        $sql = "DELETE FROM bet WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table bet :'.$res.PHP_EOL;
        //清-秒速赛车
        $sql = "DELETE FROM game_mssc WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_mssc :'.$res.PHP_EOL;
        //清-秒速时时彩
        $sql = "DELETE FROM game_msssc WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_msssc :'.$res.PHP_EOL;
        //清-秒速快三
        $sql = "DELETE FROM game_msjsk3 WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_msjsk3 :'.$res.PHP_EOL;
        //清-幸运六合彩
        $sql = "DELETE FROM game_xylhc WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_xylhc :'.$res.PHP_EOL;
        echo 'Ok';
    }
}
