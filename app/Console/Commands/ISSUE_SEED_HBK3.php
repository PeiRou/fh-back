<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_HBK3 extends Command
{
    protected $signature = 'ISSUE_SEED_HBK3';
    protected $description = '湖北快3期数生成-78';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $timeUp = date('Y-m-d 09:00:40');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_hbk3 (issue,opentime) VALUES ";
        for($i=1;$i<=78;$i++){
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

        if($checkUpdate->hbk3 == $curDate){
            \Log::info(date('Y-m-d').'湖北快3期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'hbk3' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('湖北快3error');
                }
            } else {
                \Log::info('湖北快3error');
            }
        }
    }
}
