<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class clear_data extends Command
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
        $time = date('Y-m-d H:i:s',strtotime("-5 hours"));
        $sql = "DELETE FROM users WHERE testFlag = 1 AND created_at<='{$time}' LIMIT 1000";
        $res = DB::connection('mysql::write')->statement($sql);
        //---将 杀率 的ID重置
        $this->resetId('excel_game');
        //---将 长龙 的ID重置
        $this->resetId('clong_kaijian2');
        //---将 意见反馈的ID重置
        $this->resetId('feedback_message');
        //---将 游戏表 的ID重置
        $this->resetId('game_ahk3');
        $this->resetId('game_bjkl8');
        $this->resetId('game_bjpk10');
        $this->resetId('game_cqssc');
        $this->resetId('game_cqxync');
        $this->resetId('game_gd11x5');
        $this->resetId('game_gdklsf');
        $this->resetId('game_gsk3');
        $this->resetId('game_gxk3');
        $this->resetId('game_gzk3');
        $this->resetId('game_hbk3');
        $this->resetId('game_hebeik3');
        $this->resetId('game_jsk3');
        $this->resetId('game_lhc');
        $this->resetId('game_msft');
        $this->resetId('game_msjsk3');
        $this->resetId('game_mssc');
        $this->resetId('game_msssc');
        $this->resetId('game_paoma');
        $this->resetId('game_pcdd');
        $this->resetId('game_pknn');
        $this->resetId('game_xjssc');
        $this->resetId('game_xylhc');
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
