<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_TWXYFT extends Command
{
    protected $signature = 'ISSUE_SEED_TWXYFT';
    protected $description = '台湾幸运飞艇-期数生成-288-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $seededDate = DB::table('issue_seed')->where('id', 1)->value('twxyft') ?? 0;
        $sqlH = "INSERT INTO game_twxyft (issue,opentime) VALUES ";
        $sql = $sqlH . issueSeedValues(288, date('Y-m-d 23:55:00', strtotime('-1 day')), $curDate, 4);
        $valuesTomorrow = issueSeedValues(288, date('Y-m-d 23:55:00'), date('ymd', ($time = strtotime('+1 day'))), 4);
        switch ($seededDate <=> $curDate) {
            case 0:
                $sql = $sqlH . $valuesTomorrow;
                $this->sqlExec($sql, $time);
                break;
            case 1:
                echo '台湾幸运飞艇明日期数已存在';
                break;
            case -1:
                $sql .= ',' . $valuesTomorrow;
                $this->sqlExec($sql, $time, 2);
        }
    }

    private function sqlExec($sql, $time, $days = 1)
    {
        if (DB::statement($sql) and DB::table('issue_seed')->where('id', 1)->update(['twxyft' => date('ymd', $time)])) {
            writeLog('ISSUE_SEED', ($days == 1 ? date('Y-m-d', $time) : date('Y-m-d') . ':' . date('Y-m-d', $time)) . '已生成台湾幸运飞艇');
        } else {
            writeLog('ISSUE_SEED', 'error:台湾幸运飞艇期数生成失败');
        }
    }
}
