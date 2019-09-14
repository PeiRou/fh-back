<?php

namespace App\Console\Commands\Jq;

use App\GamesApi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class ListenJqIssue extends Command
{
    protected $signature = 'JqGetBetTime:ListenJqIssue';

    protected $description = 'Command description';

    public function handle()
    {
        $startIssue = date('YmdHis', time() - 60 * 60 * 24 * 7); # 只检查一周之内的
        $endIssue = date('YmdHis', time() - 60 * 60); # 1小时之前的

        $sql = "SELECT issue, g_id FROM `jq_game_issue` 
                                WHERE `status` = 0 
                                AND `issue` < {$endIssue} 
                                AND  `issue` > {$startIssue} 
                                AND `g_id` NOT IN(SELECT `g_id` from `games_api` WHERE `open` <> 1) 
                                GROUP BY `g_id` 
                                ORDER BY `issue` DESC ";
        $res = DB::select($sql);
        foreach ($res as $v){
            try{
                $date = date('Y-m-d H:i:s', strtotime($v->issue));
                ob_start();
                Artisan::call('GameApiGetBet', ['g_id' => $v->g_id, 'endTime' => $v->issue]);
                $res = ob_get_clean();
                writeLog('ListenJqIssue', $v->g_id.'---'.$date.$res);
            }catch (\Throwable $e){
                writeLog('error', $e->getMessage().$e->getFile().'('.$e->getLine().')'.$e->getTraceAsString());
            }
        }
    }

}
