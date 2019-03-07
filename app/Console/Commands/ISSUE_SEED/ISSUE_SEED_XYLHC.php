<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_XYLHC extends Command
{
    protected $signature = 'ISSUE_SEED_XYLHC';
    protected $description = '幸运六合彩期数生成-240';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('xylhc');
        $sqlH = "INSERT INTO game_xylhc (issue,opentime) VALUES ";
        $sql = $sqlH.issueSeedValues(240,date('Y-m-d 08:00:00'),($curDate = date('ymd')) );
        $valuesTomorrow = issueSeedValues(240,date('Y-m-d 08:00:00',($time = strtotime('+1 day'))),date('ymd',$time) );
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '幸运六合彩明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['xylhc' => date('ymd',$time)]) ){
            DB::table('clong_kaijian1')->where('lotteryid',85)->delete();
            DB::table('clong_kaijian2')->where('lotteryid',85)->delete();
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成幸运六合彩');
        } else {
            writeLog('ISSUE_SEED', 'error,幸运六合彩期数生成失败');
        }
    }
}