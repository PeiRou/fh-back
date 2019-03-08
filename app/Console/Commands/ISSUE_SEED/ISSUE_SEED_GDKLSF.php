<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GDKLSF extends Command
{
    protected $signature = 'ISSUE_SEED_GDKLSF';
    protected $description = '广东快乐十分-奖期';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('gdklsf') ?? 0;
        $sqlH = "INSERT INTO game_gdklsf (issue,opentime) VALUES ";
        $sql = $sqlH . issueSeedValues(42, date('Y-m-d 09:00:00'), $curDate, 3, 1200);
        $valuesTomorrow = issueSeedValues(42, date('Y-m-d 09:00:00', ($time = strtotime('+1 day'))), date('Ymd', $time), 3, 1200);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '广东快乐十分明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['gdklsf' => date('Ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成广东快乐十分');
        } else {
            writeLog('ISSUE_SEED', 'error:广东快乐十分期数生成失败');
        }
    }
}
