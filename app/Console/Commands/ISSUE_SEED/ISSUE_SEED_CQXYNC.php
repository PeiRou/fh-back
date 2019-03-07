<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_CQXYNC extends Command
{
    protected $signature = 'ISSUE_SEED_CQXYNC';
    protected $description = '重庆幸运农场-奖期';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('cqxync');
        $sqlH = "INSERT INTO game_cqxync (issue,opentime) VALUES ";
        $sql = $sqlH.$this->issueSeedValues(13,date('Y-m-d 23:52:20',strtotime('-1 day')),$curDate,1,3,600)
            .','.$this->issueSeedValues(80,date('Y-m-d 09:52:20'),$curDate,14,3,600);
        $valuesTomorrow = $this->issueSeedValues(13,date('Y-m-d 23:52:20'),date('ymd',($time=strtotime('+1 day'))),1,3,600)
            .','.$this->issueSeedValues(80,date('Y-m-d 09:52:20',$time),date('ymd',$time),14,3,600);
        if ($seededDate){
            switch ($seededDate - $curDate) {
                case 0:
                    $sql = $sqlH.$valuesTomorrow;
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '重庆幸运农场明日期数已存在';
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
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['cqxync' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成重庆幸运农场');
        } else {
            writeLog('ISSUE_SEED', 'error:重庆幸运农场期数生成失败');
        }
    }

    private function issueSeedValues($end,$timeUp,$curDate,$start=1,$len=3,$interval=600)
    {
        for($sql='',$i=$start;$i<=$end;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds($interval);
            $i = str_repeat('0',$len-strlen($i)).$i;
            $sql .= "('{$curDate}{$i}','$timeUp'),";
        }
        return rtrim($sql,',');
    }
}
