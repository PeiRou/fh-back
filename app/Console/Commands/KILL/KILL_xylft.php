<?php

namespace App\Console\Commands\KILL;

use App\Excel;
use App\Events\RunXylft;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class KILL_xylft extends Command
{
    protected $gameId = 906;
    protected $signature = 'KILL_xylft';
    protected $description = '匈牙利飞艇-定时杀率';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_xylft';
        $excel = new Excel();
//        $get = $excel->stopBunko($this->gameId,60,'Kill');
//        if($get)
//            return 'ing';
        $get = $excel->getNeedKillIssue($table);
        $exeBase = $excel->getKillBase($this->gameId);
        if(isset($get) && $get && !empty($exeBase)){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Kill:'.$this->gameId.'ing:'.$get->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            //开奖号码
            $opennum = $excel->opennum($table);
            if(isset($get->excel_num) && $get->excel_num == 0){
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 2
                ]);
                if($update)
                    event(new RunXylft($opennum,$get->issue,$this->gameId,$get->id,true)); //新--结算
            }
        }
    }
}