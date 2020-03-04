<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

class clear_daily extends Command
{

    protected $signature = 'clear_daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '每日清除';

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
        $redis->select(9);
        $redis->flushdb();        //清除所有聊天室红包跟公告 相关redis
        //---将 杀率 的ID重置
        $this->resetId('excel_game');
        //---将 长龙 的ID重置
        $this->resetId('clong_kaijian2');
        //---将 意见反馈的ID重置
        $this->resetId('feedback_message');
        //---将 游戏表 的ID重置
        $Games = new Games();
        $res = $Games->games;
        foreach ($res as $key => $val){
            $this->resetId($val['table']);
        }
        ///---将 计画试算 的ID重置
        $this->resetId('plan_record');
        ///---将 推送消息 的ID重置
//        $this->resetId('message_push');
        $this->resetId('user_messages');
    }
    private function resetId($table,$field = 'id'){
        $sql = 'SET @num := 0';
        $res = DB::connection('mysql::write')->statement($sql);
        $sql = 'UPDATE '.$table.' SET '.$field.' = @num := (@num+1)';
        $res = DB::connection('mysql::write')->statement($sql);
        $sql = 'ALTER TABLE '.$table.' AUTO_INCREMENT =1';
        $res = DB::connection('mysql::write')->statement($sql);
    }
}
