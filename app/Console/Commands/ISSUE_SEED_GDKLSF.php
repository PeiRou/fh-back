<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GDKLSF extends Command
{
    protected $signature = 'ISSUE_SEED_GDKLSF';
    protected $description = '广东快乐十分-奖期';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('Ymd');
        $timeUp = date('Y-m-d 09:00:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_gdklsf (issue,opentime) VALUES ";
        for($i=1;$i<=84;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            if(strlen($i) == 1){
                $i = '00'.$i;
            }
            if(strlen($i) == 2){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
        }
        if($checkUpdate->gdklsf == $curDate){
            \Log::info(date('Y-m-d').'广东快乐十分已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'gdklsf' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('广东快乐十分error');
                }
            } else {
                \Log::info('广东快乐十分error');
            }
        }
    }
}
