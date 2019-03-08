<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_QQFFC extends Command
{
    protected $signature = 'ISSUE_SEED_QQFFC';
    protected $description = 'QQ分分彩期数生成-1440-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $seededDate = DB::table('issue_seed')->where('id',1)->value('qqffc')??0;
        $sqlH = "INSERT INTO game_qqffc (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(1440,date('Y-m-d 23:59:00',strtotime('-1 day')),$curDate,4,60);
        $valuesTomorrow = issueSeedValues(1440,date('Y-m-d 23:59:00'),date('Ymd',($time = strtotime('+1 day'))),4,60);
        switch ($seededDate<=>$curDate) {
            case 0:
                $sql = $sqlH.$valuesTomorrow;
                $this->sqlExec($sql,$time);
                break;
            case 1:
                echo 'QQ分分彩明日期数已存在';
                break;
            case -1:
                $sql .= ','.$valuesTomorrow;
                $this->sqlExec($sql,$time,2);
        }
    }

    private function sqlExec($sql,$time,$days=1){
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['qqffc' => date('Ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成QQ分分彩');
        } else {
            writeLog('ISSUE_SEED', 'error:QQ分分彩期数生成失败');
        }
    }
}
