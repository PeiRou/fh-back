<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;

class next_open_cqxync extends Command
{
    protected  $code = 'cqxync';
    protected  $gameId = 61;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_open_cqxync';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重庆幸运农场-定時開號';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Clong $clong)
    {
        $this->clong = $clong;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = 'game_cqxync';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('cqxync:issue');
        $redis_needopen = $redis->exists('cqxync:needopen')?$redis->get('cqxync:needopen'):'';
        $redis_next_issue = $redis->get('cqxync:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('cqxync:gapnum');
        //在現在實際的差距
        $gapnum = $redis_next_issue-$redis_issue;

        //如果實際差距與redis上不一樣代表已經開新的一盤了，就有需要開號
        if($gapnum == $redis_gapnum && $redis_needopen=='on')
            return 'no need';

        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        //如果數據庫已經查不到需要追朔的獎期，則停止追朔
        if(empty($res)){
            $redis->set('cqxync:needopen','on');
            $redis->set('cqxync:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            $key = $this->code.'ing:'.$res->issue;
            if($redis->exists($key)){
                return 'ing';
            }
            $redis->setex($key,60,'ing');
            $redis->set('cqxync:needopen','');
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = (string)$res->opentime;

        try {
            $html = $excel->getGuanIssueNum($needOpenIssue,$redis_issue,$this->code);
            //如果官方數據庫已經查不到需要追朔的獎期，則停止追朔
            if(!isset($html['issue'])){
                if(($gapnum == $redis_gapnum) && !empty($redis_gapnum)){
                    $redis->set($this->code.':needopen','on');
                    return 'no have';
                }else{
                    $res = $excel->getNeedMinIssue($table);
                    $needOpenIssue = $res->issue;
                    $openTime = (string)$res->opentime;
                    $html = $excel->getGuanIssueNum($needOpenIssue,$redis_issue,$this->code);
                    if(!isset($html))
                        return 'no have';
                }
            }
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
                        $key = 'cqxync:issue';
                        $redis->set($key, $html['issue']);
                        $redis->set('cqxync:gapnum',$gapnum);
                        $this->clong->setKaijian('cqxync',1,$html['nums']);
                        $this->clong->setKaijian('cqxync',2,$html['nums']);
                    }
                } catch (\Exception $exception) {
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }else{
                $key = $this->code.'ing:'.$res->issue;
                $redis->setex($key,2,'ing');
            }
        } catch (\Exception $exception) {
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}