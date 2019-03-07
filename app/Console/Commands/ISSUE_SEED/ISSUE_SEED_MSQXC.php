<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_MSQXC extends Command
{
    protected $signature = 'ISSUE_SEED_MSQXC';
    protected $description = '秒速七星彩期数生成-1105';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('msqxc');
        $sqlH = "INSERT INTO game_msqxc (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(1105,date('Y-m-d 07:30:45'),$curDate,4,75);
        $valuesTomorrow = issueSeedValues(1105,date('Y-m-d 07:30:45',($time = strtotime('+1 day'))),date('ymd',$time),4,75 );
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '秒速七星彩明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['msqxc' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成秒速七星彩');
        } else {
            writeLog('ISSUE_SEED', 'error:秒速七星彩期数生成失败');
        }
    }
}
