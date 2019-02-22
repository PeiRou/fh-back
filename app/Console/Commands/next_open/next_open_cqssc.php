<?php

namespace App\Console\Commands\next_open;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;

class next_open_cqssc extends Command
{
    protected  $code = 'cqssc';
    protected  $gameId = 1;
    protected  $clong;
    protected $signature = 'next_open_cqssc';
    protected $description = '重庆时时彩-定時開號';
    
    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_cqssc';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('cqssc:issue');
        $redis_needopen = $redis->exists($this->code.':needopen')?$redis->get($this->code.':needopen'):'';
        $redis_next_issue = $redis->get('cqssc:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('cqssc:gapnum');
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
            $redis->set('cqssc:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            if($excel->stopIng($this->code,$res->issue,$redis))
                return 'ing';
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = (string)$res->opentime;

        try {
            //官方彩种获取开号
            $html = $excel->checkOpenGuan($table,$needOpenIssue,$this->code,$gapnum,$redis_gapnum,$redis);
            $needOpenIssue = isset($html['needOpenIssue'])?$html['needOpenIssue']:$needOpenIssue;
            //清除昨天长龙，在录第一期的时候清掉
            if(substr($needOpenIssue,-3)=='001'){
                DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
            }
            if (isset($html['issue']) && $redis_issue !== $html['issue']) {
                try {
                    $up = DB::table($table)->where('issue', $html['issue'])
                        ->update([
                            'is_open' => 1,
                            'year' => date('Y',strtotime($openTime)),
                            'month' => date('m',strtotime($openTime)),
                            'day' => date('d',strtotime($openTime)),
                            'opennum' => $html['nums']
                        ]);
                    if ($up == 1 && $needOpenIssue == ($redis_next_issue-1)) {
                        $key = 'cqssc:issue';
                        $redis->set($key, $html['issue']);
                        $redis->set('cqssc:gapnum',$gapnum);
                        $this->clong->setKaijian('cqssc',1,$html['nums']);
                        $this->clong->setKaijian('cqssc', 2, $html['nums']);
                    }
                } catch (\Exception $exception) {
                    writeLog('next_open', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
            $key = $this->code.'ing:'.$res->issue;
            $redis->setex($key,2,'ing');
        } catch (\Exception $exception) {
            writeLog('next_open', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
