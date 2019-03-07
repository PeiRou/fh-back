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
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 08:00:00');
        $seededDate = @DB::table('issue_seed')->where('id',1)->value('xylhc');
        $sql = "INSERT INTO game_xylhc (issue,opentime) VALUES ";
        $sql .= issueSeedValues(240,$timeUp,$curDate);
        if ($seededDate){
            if($seededDate == $curDate){
                echo '幸运六合彩期数已存在';
            } else {
                if(DB::statement($sql) and DB::table('issue_seed')->where('id',1)->update(['xylhc' => $curDate])
                    and DB::table('clong_kaijian1')->where('lotteryid',85)->delete()
                    and DB::table('clong_kaijian2')->where('lotteryid',85)->delete() ){
                    writeLog('ISSUE_SEED', date('Y-m-d').'已更新');
                } else {
                    writeLog('ISSUE_SEED', 'error,期数生成失败');
                }
            }
        } else {

        }
    }
}