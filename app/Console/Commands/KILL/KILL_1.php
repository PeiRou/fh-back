<?php

namespace App\Console\Commands\KILL;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

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
        $Games = new Games();
        $games = $Games->games[$code]??'';
        if(empty($games))
            return false;
        $excel = new Excel();
        $excel = $excel->newObject($code);
        $table = $games['table'];
        $gameId = $games['gameId'];
        $gameName = $games['lottery'];
        $type = $games['type'];
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
            $opennum = $excel->opennum($code,$type);
            if(isset($get->excel_num) && $get->excel_num == 0){
                $update = DB::table($table)->where('id',$get->id)->where('is_open',0)->where('bunko',0)->where('opentime','>=',date('Y-m-d H:i:s'))->update([
                    'excel_num' => 2
                ]);
                if($update)
                    $excel->all($opennum,$get->issue,$gameId,$get->id,true,$code,$table,$gameName);
            }
        }
    }
}