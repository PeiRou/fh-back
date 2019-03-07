<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GSK3 extends Command
{
    protected $signature = 'ISSUE_SEED_GSK3';
    protected $description = '甘肃快3期数生成-36';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('gsk3');
        $sqlH = "INSERT INTO game_gsk3 (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(36,date('Y-m-d 10:00:00'),$curDate,3,1200);
        $valuesTomorrow = issueSeedValues(36,date('Y-m-d 10:00:00',($time=strtotime('+1 day'))),date('ymd',$time),3,1200);
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '甘肃快3明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['gsk3' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成甘肃快3');
        } else {
            writeLog('ISSUE_SEED', 'error:甘肃快3期数生成失败');
        }
    }
}
