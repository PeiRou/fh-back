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
        $timeUp = date('Y-m-d 09:10:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_gxk3 (issue,opentime) VALUES ";
        for($i=1;$i<=40;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(20);
            $i = str_repeat('0',3-strlen($i)).$i;
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }

        if($checkUpdate->gxk3 == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'广西快3期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'gxk3' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', '广西快3error');
                }
            } else {
                writeLog('ISSUE_SEED', '广西快3error');
            }
        }
    }
}
