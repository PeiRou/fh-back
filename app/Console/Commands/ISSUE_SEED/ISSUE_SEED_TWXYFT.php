<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_TWXYFT extends Command
{
    protected $signature = 'ISSUE_SEED_TWXYFT';
    protected $description = '台湾幸运飞艇期数生成-288-24小时';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = ' 23:55:00';
        $checkUpdate = DB::table('issue_seed')->select('twxyft')->where('id',1)->first();
        $issueDate = '';
        if(isset($checkUpdate->twxyft)) {
            if($curDate == $checkUpdate->twxyft) {
                $issueDate = date('Y-m-d', strtotime('+ 1 day', time()));
                $curDate = date('ymd', strtotime('+ 1 day', time()));
            }else if($curDate < $checkUpdate->twxyft)
                writeLog('ISSUE_SEED', $curDate.'台湾幸运飞艇期数已存在');
            else
                $issueDate = date('Y-m-d',time());
        }else{
            $issueDate = date('Y-m-d',time());
        }
        echo $issueDate;
        if(empty($issueDate))
            return '';
        $timeUp = $issueDate . $timeUp;
        $timeUp = Carbon::parse($timeUp)->addDay(-1)->toDateTimeString();
        $sql = "INSERT INTO game_twxyft (issue,opentime) VALUES ";
        for($i=1;$i<=288;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(5);
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
        }
        if($checkUpdate->twxyft == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'twxyft' => $curDate
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
