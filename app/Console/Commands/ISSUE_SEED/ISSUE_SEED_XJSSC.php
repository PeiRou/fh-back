<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_XJSSC extends Command
{
    protected $signature = 'ISSUE_SEED_XJSSC';
    protected $description = '新疆时时彩期数生成-96';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $timeUp = date('Y-m-d 10:00:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_xjssc (issue,opentime) VALUES ";
        for($i=1;$i<=96;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            if(strlen($i) == 1){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }

        if($checkUpdate->xjssc == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'新疆时时彩期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'xjssc' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', '新疆时时彩error');
                }
            } else {
                writeLog('ISSUE_SEED', '新疆时时彩error');
            }
        }
    }
}
