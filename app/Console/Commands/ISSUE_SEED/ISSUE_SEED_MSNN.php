<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_MSNN extends Command
{
    protected $signature = 'ISSUE_SEED_MSNN';
    protected $description = '秒速牛牛期数生成-985';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = DB::table('issue_seed')->where('id',1)->value('msnn')??0;
        $sqlH = "INSERT INTO game_msnn (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(985,date('Y-m-d 07:29:15'),$curDate,3,75);
        $valuesTomorrow = issueSeedValues(985,date('Y-m-d 07:29:15',($time = strtotime('+1 day'))),date('ymd',$time),3,75 );
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '秒速牛牛明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql,$time,$days=1){
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['msnn' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成秒速牛牛');
        } else {
            writeLog('ISSUE_SEED', 'error:秒速牛牛期数生成失败');
        }
    }
}
