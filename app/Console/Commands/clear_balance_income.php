<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class clear_balance_income extends Command
{

    protected $signature = 'clear_balance_income';
    protected $description = '清除馀额宝';
    protected $stoptime = '';
    protected $time = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        ini_set('memory_limit','2048M');
        $redis = Redis::connection();
        $redis->select(5);
        $keyEx = 'clearing_balance_income';
        if($redis->exists($keyEx)){
            return "";
        }
        $redis->setex($keyEx,30,'on');
        $this->stoptime = date('Y-m-d H:i:s',strtotime(date('Y-m-d 23:59:59'))+7200);                                 //卡redis时间，改成两点之后才开始移数据
        $this->time = strtotime($this->stoptime) - time();                                                      //卡redis时间，剩馀时间
        $clearDate1 = date('Y-m-d 23:59:59',strtotime("-1 days"));        //1天
        $clearDate2 = date('Y-m-d 23:59:59',strtotime("-2 days"));        //2天

        if($redis->exists($keyEx.'_maxid')){
            $res = (int)$redis->get($keyEx.'_maxid');        //取得馀额宝最大的id，再往下删除
        }else{
            $res = (int)DB::table('balance_income')->where('updated_at','<=',$clearDate2)->max('id');        //取得馀额宝最大的id，再往下删除
        }
        echo date("Y-m-d H:i:s").' MAX_ID:'.$res.PHP_EOL;
        writeLog('clear',$keyEx.' MAX_ID:'.$res);
        if(!is_int($res) || empty($res) || $res == 0){
            $redis->setex($keyEx,$this->time,$this->stoptime);
        }else{
            $redis->setex($keyEx.'_maxid',100,$res);         //取得馀额宝最大的id，存到缓存里
            DB::table('balance_income')->where('id','<=',$res)->limit(20000)->delete();       //如果删除成功，则继续下一轮
            $resExe = DB::table('balance_income')->where('id','<=',$res)->exists();
            if($resExe){
                echo date("Y-m-d H:i:s").'res:'.$res.' continue...'.PHP_EOL;
                writeLog('clear',$keyEx.$this->stoptime.'continue...');
                //最后做完把redis给删了
                $redis->del($keyEx);
            }else{
                $redis->setex($keyEx,$this->time,$this->stoptime);
            }
        }
        writeLog('clear','balance_income..Ok');
        echo date("Y-m-d H:i:s"). 'Ok'.PHP_EOL;
    }
}
