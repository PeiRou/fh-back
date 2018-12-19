<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_AHK3 extends Command
{
    protected $signature = 'ISSUE_SEED_AHK3';
    protected $description = '安徽快3期数生成-80';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $timeUp = ' 08:40:00';
        $checkUpdate = DB::table('issue_seed')->select('ahk3')->where('id',1)->first();
        $issueDate = '';
        if(isset($checkUpdate->ahk3)) {
            if($curDate == $checkUpdate->ahk3) {
                $issueDate = date('Y-m-d', strtotime('+ 1 day', time()));
                $curDate = date('Ymd', strtotime('+ 1 day', time()));
            }else if($curDate < $checkUpdate->ahk3)
                \Log::info($curDate.'安徽快3期数已存在');
            else
                $issueDate = date('Y-m-d',time());
        }else{
            $issueDate = date('Y-m-d',time());
        }
        echo $issueDate;
        if(empty($issueDate))
            return '';
        $timeUp = $issueDate . $timeUp;
        $sql = "INSERT INTO game_ahk3 (issue,opentime) VALUES ";
        for($i=1;$i<=80;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }

        if($checkUpdate->ahk3 == $curDate){
            \Log::info(date('Y-m-d').'安徽快3期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'ahk3' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('安徽快3error');
                }
            } else {
                \Log::info('安徽快3error');
            }
        }
    }
}
