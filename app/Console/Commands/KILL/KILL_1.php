<?php

namespace App\Console\Commands\KILL;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

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

        $excel = new Excel();

        //检查是否需要执行杀率
        $checkNeedKill = $excel->checkNeedKill($code,true);
        if($checkNeedKill===false)
            return false;
        else
            $games = $checkNeedKill;
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