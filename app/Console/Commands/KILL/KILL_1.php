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
        $redis = Redis::connection();
        $redis->select(0);
        $nextIssueLotteryTime = $redis->exists($code.':nextIssueLotteryTime')?$redis->get($code.':nextIssueLotteryTime'):0;
        if(empty($nextIssueLotteryTime) || time() < ($nextIssueLotteryTime-7))
            return false;

        $excel = new Excel();
        $excel = $excel->newObject($code);
        $get = $excel->getNeedKillIssue($games['table']);
        $exeBase = $excel->getKillBase($games['gameId']);
        if(isset($get) && $get && !empty($exeBase)){
            //阻止進行中
            $excel->stopBunko($games['gameId'], 10,'Kill:'.$get->issue);
            //开奖号码
            $opennum = $excel->opennum($code,$games['type']);
            if(isset($get->excel_num) && $get->excel_num == 0){
                $update = DB::table($games['table'])->where('id',$get->id)->where('is_open',0)->where('bunko',0)->where('opentime','>=',date('Y-m-d H:i:s'))->update([
                    'excel_num' => 2
                ]);
                if($update)
                    $excel->all($opennum,$get->issue,$get->id,true,$code,$games);
            }
        }
    }
}