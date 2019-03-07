<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_MSJSK3 extends Command
{
    protected $signature = 'ISSUE_SEED_MSJSK3';
    protected $description = '秒速快3期数生成-1440-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('msjsk3');
        $sqlH = "INSERT INTO game_msjsk3 (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(1440,date('Y-m-d 23:59:00',strtotime('-1 day')),$curDate,4,60);
        $valuesTomorrow = issueSeedValues(1440,date('Y-m-d 23:59:00'),date('Ymd',($time=strtotime('+1 day'))),4,60);
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '秒速快3明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['msjsk3' => date('Ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成秒速快3');
        } else {
            writeLog('ISSUE_SEED', 'error:秒速快3期数生成失败');
        }
    }
}
