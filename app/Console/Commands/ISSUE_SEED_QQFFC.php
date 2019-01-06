<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_QQFFC extends Command
{
    protected $signature = 'ISSUE_SEED_QQFFC';
    protected $description = 'QQ分分彩期数生成-1440-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $timeUp = Carbon::parse(date('Y-m-d 23:59:00'))->addDay(-1)->toDateTimeString();
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_qqffc (issue,opentime) VALUES ";
        for($i=1;$i<=1440;$i++){
            $timeUp = Carbon::parse($timeUp)->addSeconds(60);
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
        if($checkUpdate->qqffc == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'qqffc' => $curDate
                ]);
                if($update !== 1){
                    writeLog('ISSUE_SEED', 'error');
                }
            } else {
                writeLog('ISSUE_SEED', 'error');
            }
        }
    }
}
