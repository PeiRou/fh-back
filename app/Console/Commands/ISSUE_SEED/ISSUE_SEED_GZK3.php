<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GZK3 extends Command
{
    protected $signature = 'ISSUE_SEED_GZK3';
    protected $description = '贵州快3期数生成-39';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('gzk3');
        $sqlH = "INSERT INTO game_gzk3 (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(39,date('Y-m-d 09:10:00'),$curDate,3,1200);
        $valuesTomorrow = issueSeedValues(39,date('Y-m-d 09:10:00',($time=strtotime('+1 day'))),date('ymd',$time),3,1200);
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '贵州快3明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['gzk3' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成贵州快3');
        } else {
            writeLog('ISSUE_SEED', 'error:贵州快3期数生成失败');
        }
    }
}
