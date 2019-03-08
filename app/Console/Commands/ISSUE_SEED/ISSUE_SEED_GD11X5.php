<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GD11X5 extends Command
{
    protected $signature = 'ISSUE_SEED_GD11X5';
    protected $description = '广东11选5-奖期-42';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('gd11x5') ?? 0;
        $sqlH = "INSERT INTO game_gd11x5 (issue,opentime) VALUES ";
        $sql = $sqlH . issueSeedValues(42, date('Y-m-d 09:10:00'), $curDate, 2, 1200);
        $valuesTomorrow = issueSeedValues(42, date('Y-m-d 09:10:00', ($time = strtotime('+1 day'))), date('ymd', $time), 2, 1200);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '广东11选5明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['gd11x5' => date('ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成广东11选5');
        } else {
            writeLog('ISSUE_SEED', 'error:广东11选5期数生成失败');
        }
    }
}
