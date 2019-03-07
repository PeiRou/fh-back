<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_KSSC extends Command
{
    protected $signature = 'ISSUE_SEED_KSSC';
    protected $description = '快速赛车期数生成-276';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('kssc');
        $sqlH = "INSERT INTO game_kssc (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(276,date('Y-m-d 07:25:15'),$curDate,3);
        $valuesTomorrow = issueSeedValues(276,date('Y-m-d 07:25:15',($time=strtotime('+1 day'))),date('ymd',$time),3);
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '快速赛车明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['kssc' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成快速赛车');
        } else {
            writeLog('ISSUE_SEED', 'error:快速赛车期数生成失败');
        }
    }
}
