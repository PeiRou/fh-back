<?php

namespace App\Console\Commands\KILL;

use App\Excel;
use App\Events\RunKsssc;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class KILL_ksssc extends Command
{
    protected $gameId = 803;
    protected $signature = 'KILL_ksssc';
    protected $description = '快速时时彩-定时杀率';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_ksssc';
        $excel = new Excel();
        $get = $excel->stopBunko($this->gameId,60,'Kill');
        if($get)
            return 'ing';
        $get = $excel->getNeedKillIssue($table);
        $exeBase = $excel->getKillBase($this->gameId);
        if(isset($get) && $get && !empty($exeBase)){
            //开奖号码
            $opennum = $excel->opennum($table);
            if(isset($get->excel_num) && $get->excel_num == 0){
                $update = DB::table($table)->where('id',$get->id)->update([
                    'excel_num' => 2
                ]);
                if($update)
                    event(new RunKsssc($opennum,$get->issue,$this->gameId,$get->id,true)); //新--结算
            }
        }
    }
}

