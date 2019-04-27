<?php

namespace App\Console\Commands\next_open;

use App\Excel;
use App\Helpers\LHC_SX;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class next_open_sflhc extends Command
{
    protected  $code = 'sflhc';
    protected  $gameId = 904;
    protected $LHC;
    protected $signature = 'next_open_sflhc';
    protected $description = '三分六合彩-定時開號';

    public function __construct(LHC_SX $LHC)
    {
        $this->LHC = $LHC;
        parent::__construct();
    }
    
    public function handle()
    {
        $table = 'game_sflhc';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('sflhc:issue');
        $redis_needopen = $redis->exists($this->code.':needopen')?$redis->get($this->code.':needopen'):'';
        $redis_next_issue = $redis->get('sflhc:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('sflhc:gapnum');
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
            $redis->set('sflhc:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            if($excel->stopIng($this->code,$res->issue,$redis))
                return 'ing';
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = $res->opentime;

        //---kill start
        $opencode = $excel->kill_count($table,$needOpenIssue,$this->gameId,@$res->opencode);
        //---kill end
        if(empty($opencode))
            return 'Fail';

        try {
            //清除昨天长龙，在录第一期的时候清掉
            if(substr($needOpenIssue,-3)=='001'){
                DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
            }
            if ($redis_issue !== $needOpenIssue) {
                try {
                    $openNum = explode(',',$opencode);
                    $n1 = $openNum[0];
                    $n2 = $openNum[1];
                    $n3 = $openNum[2];
                    $n4 = $openNum[3];
                    $n5 = $openNum[4];
                    $n6 = $openNum[5];
                    $n7 = $openNum[6];
                    $totalNum = (int)$n1+(int)$n2+(int)$n3+(int)$n4+(int)$n5+(int)$n6+(int)$n7;

                    $up = DB::table('game_sflhc')->where('issue',$needOpenIssue)->update([
                        'is_open' => 1,
                        'year' => date('Y',strtotime($openTime)),
                        'month' => date('m',strtotime($openTime)),
                        'day' => date('d',strtotime($openTime)),
                        'open_num'=> $opencode,
                        'n1' => $n1,
                        'n2' => $n2,
                        'n3' => $n3,
                        'n4' => $n4,
                        'n5' => $n5,
                        'n6' => $n6,
                        'n7' => $n7,
                        'n1_sb' => $this->LHC->sebo($n1),
                        'n2_sb' => $this->LHC->sebo($n2),
                        'n3_sb' => $this->LHC->sebo($n3),
                        'n4_sb' => $this->LHC->sebo($n4),
                        'n5_sb' => $this->LHC->sebo($n5),
                        'n6_sb' => $this->LHC->sebo($n6),
                        'n7_sb' => $this->LHC->sebo($n7),
                        'n1_sx' => $this->LHC->shengxiao($n1),
                        'n2_sx' => $this->LHC->shengxiao($n2),
                        'n3_sx' => $this->LHC->shengxiao($n3),
                        'n4_sx' => $this->LHC->shengxiao($n4),
                        'n5_sx' => $this->LHC->shengxiao($n5),
                        'n6_sx' => $this->LHC->shengxiao($n6),
                        'n7_sx' => $this->LHC->shengxiao($n7),
                        'total_num' => $totalNum,
                    ]);
                    if ($up == 1 && $needOpenIssue == ($redis_next_issue-1)) {
                        $key = 'sflhc:issue';
                        $redis->set($key, $needOpenIssue);
                        $redis->set('sflhc:gapnum',$gapnum);
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
