<?php

namespace App\Console\Commands\next_open;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;

class next_open_qqffc extends Command
{
    protected  $code = 'qqffc';
    protected  $gameId = 113;
    protected  $clong;
    protected $signature = 'next_open_qqffc';
    protected $description = 'QQ分分彩-定時開號';

    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }

    public function handle()
    {
        $table = 'game_qqffc';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('qqffc:issue');
        $redis_needopen = $redis->exists($this->code.':needopen')?$redis->get($this->code.':needopen'):'';
        $redis_next_issue = $redis->get('qqffc:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('qqffc:gapnum');
        //在現在實際的差距
        $gapnum = $redis_next_issue-$redis_issue;

        //如果實際差距與redis上不一樣代表已經開新的一盤了，就有需要開號
        if($gapnum == $redis_gapnum && $redis_needopen=='on')
            return 'no need';

        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        //如果數據庫已經查不到需要追朔的獎期，則停止追朔
        if(empty($res)){
            $redis->set($this->code.':needopen','on');
            $redis->set('qqffc:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            if($excel->stopIng($this->code,$res->issue,$redis))
                return 'ing';
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = $res->opentime;
        $issuenum = substr($needOpenIssue,-4);
        $res->opencode = $excel->opennum($table);

        //---kill start
        $opennum = $excel->kill_count($table,$needOpenIssue,$this->gameId,$res->opencode);
        //---kill end
        $opencode = empty($opennum)?$res->opencode:$opennum;
        if(empty($opencode))
            return 'Fail';

        //清除昨天长龙，在录第一期的时候清掉
        if($issuenum=='0001'){
            DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
            DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
        }
        try {
            if ($redis_issue !== $needOpenIssue) {
                try {
                    $up = DB::table($table)->where('issue', $needOpenIssue)
                        ->update([
                            'is_open' => 1,
                            'year' => date('Y',strtotime($openTime)),
                            'month' => date('m',strtotime($openTime)),
                            'day' => date('d',strtotime($openTime)),
                            'opennum'=> $opencode
                        ]);
                    if ($up == 1 && $needOpenIssue == ($redis_next_issue-1)) {
                        $key = 'qqffc:issue';
                        $redis->set($key, $needOpenIssue);
                        $redis->set('qqffc:gapnum',$gapnum);
                        $this->clong->setKaijian('qqffc',1,$opencode);
                        $this->clong->setKaijian('qqffc',2,$opencode);
                    }
                } catch (\Exception $exception) {
                    writeLog('next_open', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception) {
            writeLog('next_open', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
