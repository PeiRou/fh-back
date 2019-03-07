<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_AHK3 extends Command
{
    protected $signature = 'ISSUE_SEED_AHK3';
    protected $description = '安徽快3期数生成-80';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('ahk3');
        $sqlH = "INSERT INTO game_ahk3 (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(80,date('Y-m-d 08:40:00'),$curDate,3,600);
        $valuesTomorrow = issueSeedValues(80,date('Y-m-d 08:40:00',($time=strtotime('+1 day'))),date('Ymd',$time),3,600);
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '安徽快3明日期数已存在';
                    break;
                case -1:
                    $sql .= ','.$valuesTomorrow;
                    $this->sqlExec($sql,$time,2);
            }
        } else {
            $sql .= ','.$valuesTomorrow;
            $this->sqlExec($sql,$time,2);
        }
    }

    private function sqlExec($sql,$time,$days=1){
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['ahk3' => date('Ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成安徽快3');
        } else {
            writeLog('ISSUE_SEED', 'error:安徽快3期数生成失败');
        }
    }
}
