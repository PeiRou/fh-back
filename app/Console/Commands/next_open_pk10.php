<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Bet\Clong;

class next_open_pk10 extends Command
{
    protected  $code = 'pk10';
    protected  $gameId = 50;
    protected  $clong;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_open_pk10';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '北京赛车-定時開號';

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
        $table = 'game_bjpk10';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('pk10:issue');
        $redis_needopen = $redis->exists($this->code.':needopen')?$redis->get($this->code.':needopen'):'';
        $redis_next_issue = $redis->get('pk10:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('pk10:gapnum');
        //在現在實際的差距
        $gapnum = $redis_next_issue-$redis_issue;

        //如果實際差距與redis上不一樣代表已經開新的一盤了，就有需要開號
        if($gapnum == $redis_gapnum && $redis_needopen == 'on')
            return 'no need';
        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        //如果數據庫已經查不到需要追朔的獎期，則停止追朔
        if(empty($res)){
            $redis->set($this->code.':needopen','on');
            $redis->set('pk10:gapnum',$gapnum);
            return 'Fail';
        }else{
            //阻止進行中
            $excel->stopIng($this->code,$res->issue,$redis);
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = $res->opentime;

        try {
            //官方彩种获取开号
            $html = $excel->checkOpenGuan($table,$needOpenIssue,'bjpk10',$gapnum,$redis_gapnum,$redis);
            $needOpenIssue = isset($html['needOpenIssue'])?$html['needOpenIssue']:$needOpenIssue;
            //清除昨天长龙，在录第一期的时候清掉
            if (substr($openTime,-8) == '09:07:30') {
                DB::table('clong_kaijian1')->where('lotteryid', $this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid', $this->gameId)->delete();
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
                        $key = 'pk10:issue';
                        $redis->set($key, $html['issue']);
                        $redis->set('pk10:gapnum',$gapnum);
                        $this->clong->setKaijian('pk10', 1, $html['nums']);
                        $this->clong->setKaijian('pk10', 2, $html['nums']);
                    }
                } catch (\Exception $exception) {
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
            $key = $this->code.'ing:'.$res->issue;
            $redis->setex($key,2,'ing');
        } catch (\Exception $exception) {
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
