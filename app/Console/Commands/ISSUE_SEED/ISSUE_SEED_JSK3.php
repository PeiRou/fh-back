<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_JSK3 extends Command
{
    protected $signature = 'ISSUE_SEED_JSK3';
    protected $description = '江苏骰宝（快3）期数生成-41';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('jsk3') ?? 0;
        $sqlH = "INSERT INTO game_jsk3 (issue,opentime) VALUES ";
        $sql = $sqlH . issueSeedValues(41, date('Y-m-d 08:30:00'), $curDate, 3, 1200);
        $valuesTomorrow = issueSeedValues(41, date('Y-m-d 08:30:00', ($time = strtotime('+1 day'))), date('ymd', $time), 3, 1200);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '江苏骰宝（快3）明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['jsk3' => date('ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成江苏骰宝（快3）');
        } else {
            writeLog('ISSUE_SEED', 'error:江苏骰宝（快3）期数生成失败');
        }
    }
}
