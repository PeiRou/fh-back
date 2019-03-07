<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_BJKL8 extends Command
{
    protected $signature = 'ISSUE_SEED_BJKL8';
    protected $description = '北京快乐8期数生成-179';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('bjkl8');
        $sqlH = "INSERT INTO game_bjkl8 (issue,opentime) VALUES ";
        $last = DB::table('game_bjkl8')->orderByDesc('id')->where('opentime',date('Y-m-d 23:55:00',strtotime('-1 day')))->first()->issue??0;
        $sql = $sqlH.$this->issueSeedValues(179,date('Y-m-d 09:00:00'),$last);
        //明日奖期基数时间
        $timeUp = date('Y-m-d 09:00:00',($time = strtotime('+1 day')));
        if ($seededDate){
            switch ($seededDate - date('ymd')) {
                case 0:
                    $sql = $sqlH.$this->issueSeedValues(179,$timeUp,$last);
                    $this->sqlExec($sql,$time);
                    break;
                case 1:
                    echo '北京快乐8明日期数已存在';
                    break;
                case -1:
                    $sql .= ','.$this->issueSeedValues(179,$timeUp,$last+179);
                    $this->sqlExec($sql,$time,2);
            }
        } else {
            $sql .= ','.$this->issueSeedValues(179,$timeUp,$last+179);
            $this->sqlExec($sql,$time,2);
        }
    }

    private function sqlExec($sql,$time,$days=1){
        if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['bjkl8' => date('ymd',$time)]) ){
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d',$time) : date('Y-m-d').':'.date('Y-m-d',$time)).'已生成北京快乐8');
        } else {
            writeLog('ISSUE_SEED', 'error:北京快乐8期数生成失败');
        }
    }

    private function issueSeedValues($num,$timeUp,$last,$interval=300)
    {
        for($sql='',$i=1;$i<=$num;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds($interval);
            $issue = (int)$last + $i;
            $sql .= "('$issue','$timeUp'),";
        }
        return rtrim($sql,',');
    }
}
