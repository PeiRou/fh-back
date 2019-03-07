<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GSK3 extends Command
{
    protected $signature = 'ISSUE_SEED_GSK3';
    protected $description = '甘肃快3期数生成-36';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('10:00:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_gsk3 (issue,opentime) VALUES ";
        for($i=1;$i<=36;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(20);
            $i = str_repeat('0',3-strlen($i)).$i;
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }

        if($checkUpdate->gsk3 == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'甘肃快3期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'gsk3' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', '甘肃快3error');
                }
            } else {
                writeLog('ISSUE_SEED', '甘肃快3error');
            }
        }
    }
}
