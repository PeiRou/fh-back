<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_CQSSC extends Command
{
    protected $signature = 'ISSUE_SEED_CQSSC';
    protected $description = '重庆时时彩期数生成-59';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('cqssc') ?? 0;
        $sqlH = "INSERT INTO game_cqssc (issue,opentime) VALUES ";
        $sql = $sqlH . $this->issueSeedValues(9, date('Y-m-d 00:10:00'), $curDate, 1, 3, 1200)
            . ',' . $this->issueSeedValues(59, date('Y-m-d 07:10:00'), $curDate, 10, 3, 1200);
        $valuesTomorrow = $this->issueSeedValues(9, date('Y-m-d 00:10:00', ($time = strtotime('+1 day'))), date('Ymd', $time), 1, 3, 1200)
            . ',' . $this->issueSeedValues(59, date('Y-m-d 07:10:00', $time), date('Ymd', $time), 10, 3, 1200);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '重庆时时彩明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['cqssc' => date('Ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成重庆时时彩');
        } else {
            writeLog('ISSUE_SEED', 'error:重庆时时彩期数生成失败');
        }
    }

    private function issueSeedValues($num, $timeUp, $curDate, $start = 1, $len = 3, $interval = 1200)
    {
        for ($sql = '', $i = $start; $i <= $num; $i++) {
            $timeUp = Carbon::parse($timeUp)->addSeconds($interval);
            $i = str_repeat('0', $len - strlen($i)) . $i;
            $sql .= "('{$curDate}{$i}','$timeUp'),";
        }
        return rtrim($sql, ',');
    }
}
