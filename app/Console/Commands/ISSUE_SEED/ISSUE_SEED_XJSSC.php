<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_XJSSC extends Command
{
    protected $signature = 'ISSUE_SEED_XJSSC';
    protected $description = '新疆时时彩期数生成-48';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('xjssc') ?? 0;
        $sqlH = "INSERT INTO game_xjssc (issue,opentime) VALUES ";
        $sql = $sqlH . issueSeedValues(48, date('Y-m-d 10:00:00'), ($curDate = date('Ymd')), 2, 1200);
        $valuesTomorrow = issueSeedValues(48, date('Y-m-d 10:00:00', ($time = strtotime('+1 day'))), date('Ymd', $time), 2, 1200);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '新疆时时彩明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['xjssc' => date('Ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成新疆时时彩');
        } else {
            writeLog('ISSUE_SEED', 'error:新疆时时彩期数生成失败');
        }
    }
}
