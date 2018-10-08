<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_GD11X5 extends Command
{
    protected $signature = 'ISSUE_SEED_GD11X5';
    protected $description = '广东11选5-奖期';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 09:00:00');
        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $sql = "INSERT INTO game_gd11x5 (issue,opentime) VALUES ";
        for($i=1;$i<=84;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(10);
            if(strlen($i) == 1){
                $i = '0'.$i;
            }
            $issue = $curDate.$i;
            $sql .= "('$issue','$timeUp'),";
        }
        if($checkUpdate->gd11x5 == $curDate){
            \Log::info(date('Y-m-d').'广东11选5已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'gd11x5' => $curDate
                ]);
                if($update !== 1){
                    \Log::info('广东11选5error');
                }
            } else {
                \Log::info('广东11选5error');
            }
        }
    }
}
