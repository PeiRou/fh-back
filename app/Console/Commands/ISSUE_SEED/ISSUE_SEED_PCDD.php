<?php

namespace App\Console\Commands\ISSUE_SEED;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ISSUE_SEED_PCDD extends Command
{
    protected $signature = 'ISSUE_SEED_PCDD';
    protected $description = 'PC蛋蛋期数生成-179';
    const ZABBIX_BOT_URL = 'http://bot.tcwk10.com:5000';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $curDate = date('ymd');
        $timeUp = date('Y-m-d 09:00:00');

        $redis = \Illuminate\Support\Facades\Redis::connection();
        $redis->select(5);
        $key = 'issue_send:'.$this->signature.'_'.$curDate;
        if($redis->exists($key)){
            echo '重复执行！';
            return false;
        }
        $redis->setex($key, 60, 'on');

        $checkUpdate = DB::table('issue_seed')->where('id',1)->first();
        $checkLastIssue = DB::table('game_pcdd')->select(DB::raw('MAX(id) as maxid'),'issue')->where('opentime',date('Y-m-d 23:55:00',strtotime('-1 days')))->first();
        $lastIssue = @$checkLastIssue->issue;
        //$lastIssue = '907087';
        if(empty($lastIssue)){
            $str = date('Y-m-d H:i:s').' '.env('APP_NAME').'-'.$this->signature.'期数不可为0';
            writeLog('ISSUE_SEED', $str);
            echo $str;
            $url = self::ZABBIX_BOT_URL.'/telegram?q='.urlencode($str);
            try{
                $http = app(\GuzzleHttp\Client::class);
                $http->request('GET',$url,['connect_timeout' => 1]);
            }catch (\Exception $e){
            }
            return '';
        }
        $sql = "INSERT INTO game_pcdd (issue,opentime) VALUES ";
        for($i=1;$i<=179;$i++){
            $timeUp = Carbon::parse($timeUp)->addMinutes(5);
            $issue = (int)$lastIssue + (int)$i;
            $sql .= "('$issue','$timeUp'),";
            //\Log::info('期号:'.$curDate.$i.'====> 开奖时间：'.$timeUp);
        }
        if($checkUpdate->pcdd == $curDate){
            writeLog('ISSUE_SEED', date('Y-m-d').'期数已存在');
        } else {
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                $update = DB::table('issue_seed')->where('id',1)->update([
                    'pcdd' => $curDate
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
