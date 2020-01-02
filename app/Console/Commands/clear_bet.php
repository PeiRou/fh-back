<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class clear_bet extends Command
{

    protected $signature = 'clear_bet {StartTime?} {EndTime?}';
    protected $description = '清除缓存';
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
        $keyEx = 'clear_beting';
        if($redis->exists($keyEx)){     //锁定暂存
            echo 'ing'.PHP_EOL;
            return "";
        }
        $redis->setex('clearing',30,'on');
        $clearDateStart = $this->argument('StartTime');
        $clearDateEnd = $this->argument('EndTime');
        echo "StartTime:".$clearDateStart.PHP_EOL;
        echo "EndTime:".$clearDateEnd.PHP_EOL;
        if(empty($clearDateStart) || empty($clearDateEnd)){
            $clearDateStart = date('Y-m-d H:i:s',strtotime('-4 hours'));
            $clearDateEnd = date('Y-m-d H:i:s',strtotime('-2 hours'));
        }else{
            $clearDateStart = $clearDateStart.' 00:00:00';
            $clearDateEnd = $clearDateEnd.' 23:59:59';
        }
        echo "StartTime:".$clearDateStart.PHP_EOL;
        echo "EndTime:".$clearDateEnd.PHP_EOL;

        echo date("Y-m-d H:i:s")." betTempFile ing...".PHP_EOL;
        //彩票投注转移
        $res = DB::table('bet')->select('bet_id')->where('status',1)->where('updated_at','>=',$clearDateStart)->where('updated_at','<=',$clearDateEnd)->limit(20000)->orderBy('bet_id', 'desc')->get();
        $betTempIds = [];           //需要转移的id数组

        //判断 彩票投注 是否有数据
        if(!$res){
            echo 'bet nohave'.PHP_EOL;
        }else{
            echo date("Y-m-d H:i:s")." betTempFile start...".PHP_EOL;
            foreach ($res as $k => $v){
                $fileId = $v->bet_id;
                if(Storage::disk('betTemp')->exists($fileId)){
                    $betTempNotInIds[] = $fileId;
                    continue;
                }else{
                    $betTempIds[] = $fileId;
                }
            }
            //如果有 需要转移的id数组 则将会把数据开始进行
            if(count($betTempIds)==0)
                echo 'bet file already input'.PHP_EOL;
            else{
                $betTempIds = implode(',',$betTempIds);
                $sql = "SELECT * FROM bet WHERE bet_id in (".$betTempIds.") LIMIT 10000";
                $res = DB::select($sql);
                foreach ($res as $k=> $v)
                    Storage::disk('betTemp')->put($v->bet_id,json_encode($v));
            }
        }

        echo date("Y-m-d H:i:s")." betJqTempFile ing...".PHP_EOL;
        //第三方投注转移
        $res = DB::table('jq_bet')->select('id')->where('flag',1)->where('updated_at','>=',$clearDateStart)->where('updated_at','<=',$clearDateEnd)->limit(20000)->orderBy('id', 'desc')->get();
        $betTempIds = [];

        //判断 第三方投注 是否有数据
        if(!$res){
            echo 'bet jq nohave'.PHP_EOL;
        }else{
            echo date("Y-m-d H:i:s")." betJqTempFile start...".PHP_EOL;
            foreach ($res as $k => $v){
                $fileId = $v->id;
                if(Storage::disk('betJqTemp')->exists($fileId)){
                    continue;
                }else{
                    $betTempIds[] = $fileId;
                }
            }
            if(count($betTempIds)==0){
                echo 'bet jq file already input'.PHP_EOL;
            }else{
                $betTempIds = implode(',',$betTempIds);
                $sql = "SELECT * FROM jq_bet WHERE id in (".$betTempIds.") LIMIT 10000";
                $res = DB::select($sql);
                foreach ($res as $k=> $v)
                    Storage::disk('betJqTemp')->put($v->id,json_encode($v));
            }
        }

        //最后做完把redis给删了
        $redis->del($keyEx);
        echo date("Y-m-d H:i:s").' ok...'.PHP_EOL;
    }
}
