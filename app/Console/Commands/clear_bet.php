<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;

class clear_bet extends Command
{

    protected $signature = 'clear_bet';
    protected $description = '清除缓存';
    protected $stoptime = '';
    protected $time = '';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $redis = Redis::connection();
        $redis->select(5);
        $keyEx = 'clear_beting';
        if($redis->exists($keyEx)){     //锁定暂存
            return "";
        }
        $redis->setex('clearing',30,'on');
        $clearDateStart = date('Y-m-d H:i:s',strtotime('-3 hours'));
        $clearDateEnd = date('Y-m-d H:i:s',strtotime('-4 hours'));
        $sql = "SELECT bet_id FROM bet WHERE status >=1 AND updated_at >= '{$clearDateEnd}' AND updated_at <= '{$clearDateStart}'";
        $res = DB::select($sql);
        $betTempIds = [];
        if(!$res){
            return false;
        }
        foreach ($res as $k => $v){
            if(Storage::disk('betTemp')->exists($v->bet_id)){
                continue;
            }else{
                $betTempIds[] = $v->bet_id;
            }
        }
        if(count($betTempIds)==0)
            return false;
        $betTempIds = implode(',',$betTempIds);
        $sql = "SELECT * FROM bet WHERE bet_id in (".$betTempIds.") LIMIT 10000";
        $res = DB::select($sql);
        foreach ($res as $k=> $v)
            Storage::disk('betTemp')->put($v->bet_id,json_encode($v));
        $redis->del($keyEx);
    }
}
