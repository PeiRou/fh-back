<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_MSFT extends Command
{
    protected $signature = 'ISSUE_SEED_MSFT';
    protected $description = '秒速飞艇期数生成-985';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 07:29:45');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_msft (issue,opentime) VALUES ";
        for($i=1;$i<=1105;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(75);
            if(strlen($i) == 1){
                $i = '000'.$i;
            }
            if(strlen($i) == 2){
                $i = '00'.$i;
            }
            if(strlen($i) == 3){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }
        if($checkUpdate->msft == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'msft' => $curDate
                ]);
                if($update == 1){
                    writeLog('ISSUE_SEED', date('Y-m-d').'已更新');
                }
            } else {
                writeLog('ISSUE_SEED', 'error');
            }
        }
    }
}
