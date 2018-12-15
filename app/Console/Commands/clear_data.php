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

        $redis = Redis::connection();
        $redis->select(5);
        $keyEx = 'clearing';
        if($redis->exists($keyEx)){
            echo "ing";
            return "";
        }
        $redis->setex($keyEx,5,'on');
        $clearDate = date('Y-m-d 23:59:59',strtotime("-31 days")-300);
        //清-游客
//        $sql = "delete from users where testFlag = 1 and loginTime <='".date("Y-m-d H:i:s",strtotime('-1 day'))."' LIMIT 1000";
//        $res = DB::connection('mysql::write')->statement($sql);
//        echo 'table bet :'.$res.PHP_EOL;
        //清-投注表
        $sql = "DELETE FROM bet WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table bet :'.$res.PHP_EOL;
        //清-资金明细
        $sql = "DELETE FROM capital WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table capital :'.$res.PHP_EOL;
        //清-充值
        $sql = "DELETE FROM recharges WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table recharges :'.$res.PHP_EOL;
        //清-提款
        $sql = "DELETE FROM drawing WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table drawing :'.$res.PHP_EOL;
        //清-活动
        $sql = "DELETE FROM activity_send WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table activity_send :'.$res.PHP_EOL;
        //清-活动
        $sql = "DELETE FROM activity_sign_qiandao WHERE created_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table activity_sign_qiandao :'.$res.PHP_EOL;
        //清-错误日志
        $sql = "DELETE FROM log_abnormal WHERE create_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table log_abnormal :'.$res.PHP_EOL;
        //清-操作日志
        $sql = "DELETE FROM log_handle WHERE create_at<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table log_handle :'.$res.PHP_EOL;
        //清-会员登陆日志
        $sql = "DELETE FROM log_login WHERE login_time<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table log_login :'.$res.PHP_EOL;
        //清-秒速赛车
        $sql = "DELETE FROM game_mssc WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_mssc :'.$res.PHP_EOL;
        //清-秒速时时彩
        $sql = "DELETE FROM game_msssc WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_msssc :'.$res.PHP_EOL;
        //清-秒速飞艇
        $sql = "DELETE FROM game_msft WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_msft :'.$res.PHP_EOL;
        //清-秒速快三
        $sql = "DELETE FROM game_msjsk3 WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_msjsk3 :'.$res.PHP_EOL;
        //清-香港跑马
        $sql = "DELETE FROM game_paoma WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_paoma :'.$res.PHP_EOL;
        //清-幸运六合彩
        $sql = "DELETE FROM game_xylhc WHERE opentime<='{$clearDate}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        echo 'table game_xylhc :'.$res.PHP_EOL;
        echo 'Ok';
    }
}
