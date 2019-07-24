<?php

namespace App\Console\Commands\next_open;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;

class next_open_xy28 extends Command
{
    protected  $code = 'xy28';
    protected  $gameId = 84;
    protected  $clong;
    protected $signature = 'next_open_xy28';
    protected $description = '幸运28-定時開號';
    
    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_xy28';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('xy28:issue');
        $redis_needopen = $redis->exists($this->code.':needopen')?$redis->get($this->code.':needopen'):'';
        $redis_next_issue = $redis->get('xy28:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('xy28:gapnum');
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
            $redis->set('xy28:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            if($excel->stopIng($this->code,$res->issue,$redis))                return 'ing';
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = (string)$res->opentime;
        $issuenum = substr($needOpenIssue,-3);


        //「幸运28」按幸运快乐8的开奖结果为基础
        $kl8opennum = DB::table('game_xykl8')->select('opennum')->where('issue', $needOpenIssue)->first();
        if(empty($kl8opennum->opennum)){
            writeLog('next_open', '幸运快乐8 奖期:'.$needOpenIssue.' 没开奖');
            return 'Fail';
        }

        $opennum=explode(",",$kl8opennum->opennum);
        $opencode[0]=($opennum[0]+$opennum[1]+$opennum[2]+$opennum[3]+$opennum[4]+$opennum[5])%10;
        $opencode[1]=($opennum[6]+$opennum[7]+$opennum[8]+$opennum[9]+$opennum[10]+$opennum[11])%10;
        $opencode[2]=($opennum[12]+$opennum[13]+$opennum[14]+$opennum[15]+$opennum[16]+$opennum[17])%10;
        $opencode = implode(",",$opencode);


        //清除昨天长龙，在录第一期的时候清掉
        if($issuenum=='001'){
            DB::table('clong_kaijian2')->where('lotteryid', $this->gameId)->delete();
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
                            'opennum' => $opencode
                        ]);
                    if ($up == 1 && $needOpenIssue == ($redis_next_issue-1)) {
                        $key = 'xy28:issue';
                        $redis->set($key, $needOpenIssue);
                        $redis->set('xy28:gapnum',$gapnum);
                        $this->clong->setKaijian('xy28', 2, $opencode);
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
