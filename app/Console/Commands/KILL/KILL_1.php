<?php

namespace App\Console\Commands\KILL;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Config;

class KILL_1 extends Command
{
    protected $signature = 'KILL_1 {code?}';
    protected $description = '定时杀率';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = $this->argument('code');
        $games = Config::get('games.'.$code);
        if(empty($games))
            return false;
        $excel = new Excel();
        $excel = $excel->newObject($code);
        $table = $games['table'];
        $gameId = $games['gameId'];
        $gameName = $games['name'];
        $get = $excel->getNeedKillIssue($table);
        $exeBase = $excel->getKillBase($gameId);
        if(isset($get) && $get && !empty($exeBase)){
            $redis = Redis::connection();
            $redis->select(0);
            //阻止進行中
            $key = 'Kill:'.$gameId.'ing:'.$get->issue;
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
                    $excel->all($opennum,$get->issue,$gameId,$get->id,true,$table,$gameName);
            }
        }
    }
}