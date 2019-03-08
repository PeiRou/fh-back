<?php

namespace App\Console\Commands\ISSUE_SEED;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GXK3 extends Command
{
    protected $signature = 'ISSUE_SEED_GXK3';
    protected $description = '广西快3期数生成-40';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('gxk3') ?? 0;
        $sqlH = "INSERT INTO game_gxk3 (issue,opentime) VALUES ";
        $sql = $sqlH . issueSeedValues(40, date('Y-m-d 09:10:00'), $curDate, 3, 1200);
        $valuesTomorrow = issueSeedValues(40, date('Y-m-d 09:10:00', ($time = strtotime('+1 day'))), date('ymd', $time), 3, 1200);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '广西快3明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['gxk3' => date('ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成广西快3');
        } else {
            writeLog('ISSUE_SEED', 'error:广西快3期数生成失败');
        }
    }
}
