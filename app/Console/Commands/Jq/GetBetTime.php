<?php

namespace App\Console\Commands\Jq;

use App\GamesApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class GetBetTime extends Command
{
    protected $signature = 'JqGetBetTime:build';

    protected $description = 'Command description';

    protected $redis;

    private $setApiTime = [
        15 => 120
    ];
    // 10 18 25 30 是拿id的
    // 15 16 17 18 19 20 21 22 23 24 26
    private $defaultTime = 120;

    public function handle()
    {
        # 获取所有接口
        $this->redis = Redis::connection();
        $this->redis->select(5);
        foreach (GamesApi::whereNotIn('g_id', [18, 10, 25, 30, 31])->pluck('g_id') as $v){
            $this->create($v);
        }
    }

    private function create($g_id)
    {
        $key = $this->signature.'_'.$g_id;
        if(!$this->redis->setnx($key, 'no')){
            echo '重复执行'.PHP_EOL;
            return false;
        }
        $this->redis->expire($key, 60);
        $time = $this->setApiTime[$g_id] ?? $this->defaultTime;
        $table = 'jq_game_issue';
        $startTime = DB::table($table)->where('g_id', $g_id)->orderBy('issue', 'desc')->value('issue') ?? date('Ymd000000');
        $endTime = date('Ymd000000', strtotime('+ 2 day'));
        if($startTime >= $endTime){
            echo $g_id.'不需要执行'.PHP_EOL;
            return true;
        }
        $sql = "INSERT INTO $table (issue,status,g_id) VALUES ";
        $issue = $startTime;
        while($issue < $endTime){
            $issue = date('YmdHis', strtotime($issue) + $time);
            $sql .= "({$issue},0,{$g_id}),";
        }
        $run = DB::statement(rtrim($sql, ',').";");
        if($run){
            echo $g_id.'ok'.PHP_EOL;
            return true;
        }
        echo $g_id.'插入失败'.PHP_EOL;
        return false;
    }


    //队列真实名
    public function setQueueRealName($queue){
        return config('prefix')['queue'] . $queue;
    }
}
