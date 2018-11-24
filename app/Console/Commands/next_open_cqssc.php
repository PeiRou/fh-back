<?php

namespace App\Console\Commands;

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
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_open_cqssc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '重庆时时彩-定時開號';

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
        $table = 'game_cqssc';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('cqssc:issue');
        $redis_needopen = $redis->exists('cqssc:needopen')?$redis->get('cqssc:needopen'):'';
        $redis_next_issue = $redis->get('cqssc:nextIssue');
        if($redis_issue == ($redis_next_issue - 1) || $redis_needopen=='on')
            return 'no need';
        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        //如果數據庫已經查不到需要追朔的獎期，則停止追朔
        if(empty($res)){
            $redis->set('cqssc:needopen','on');
            return 'Fail';
        }else{
            $redis->set('cqssc:needopen','');
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = (string)$res->opentime;

        if($needOpenIssue == $redis_issue)
            $url = Config::get('website.guanIssueServerUrl').'cqssc';
        else
            $url = Config::get('website.guanIssueServerUrl').'cqssc?issue='.$needOpenIssue;
        try {
            $html = json_decode(file_get_contents($url), true);
            //如果官方數據庫已經查不到需要追朔的獎期，則停止追朔
            if(!isset($html['issue'])){
                $redis->set('cqssc:needopen','on');
                return 'no have';
            }
            //清除昨天长龙，在录第一期的时候清掉
            if(substr($needOpenIssue,3)=='001'){
                DB::table('clong_kaijian1')->where('lotteryid',$this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid',$this->gameId)->delete();
            }
            if ($redis_issue !== $html['issue']) {
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
                        Redis::set($key, $html['issue']);
                        $this->clong->setKaijian('cqssc',1,$html['nums']);
                        $this->clong->setKaijian('cqssc', 2, $html['nums']);
                    }
                } catch (\Exception $exception) {
                    \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                }
            }
        } catch (\Exception $exception) {
            \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
        }
    }
}
