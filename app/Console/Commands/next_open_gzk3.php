<?php

namespace App\Console\Commands;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class next_open_gzk3 extends Command
{
    protected  $code = 'gzk3';
    protected  $gameId = 18;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'next_open_gzk3';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '贵州快3-定時開號';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $table = 'game_gzk3';

        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = $redis->get('gzk3:issue');
        $redis_needopen = $redis->exists('gzk3:needopen')?$redis->get('gzk3:needopen'):'';
        $redis_next_issue = $redis->get('gzk3:nextIssue');
        //在redis上的差距
        $redis_gapnum = $redis->get('gzk3:gapnum');
        //在現在實際的差距
        $gapnum = $redis_next_issue-$redis_issue;

        //如果實際差距與redis上不一樣代表已經開新的一盤了，就有需要開號
        if($gapnum == $redis_gapnum && $redis_needopen=='on')
            return 'no need';

        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        //如果數據庫已經查不到需要追朔的獎期，則停止追朔
        if(empty($res)){
            $redis->set('gzk3:needopen','on');
            $redis->set('gzk3:gapnum',$gapnum);
            return 'Fail';
        }else{
            $redis->set('gzk3:needopen','');
        }
        //當期獎期
        $needOpenIssue = $res->issue;
        $openTime = (string)$res->opentime;

        if($needOpenIssue == $redis_issue)
            $url = Config::get('website.guanIssueServerUrl').'gzk3';
        else
            $url = Config::get('website.guanIssueServerUrl').'gzk3?issue='.$needOpenIssue;
        try {
            $html = json_decode(file_get_contents($url), true);
            //如果官方數據庫已經查不到需要追朔的獎期，則停止追朔
            if(!isset($html['issue'])){
                $redis->set('gzk3:needopen','on');
                return 'no have';
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
                        $key = 'gzk3:issue';
                        $redis->set($key, $html['issue']);
                        $redis->set('gzk3:gapnum',$gapnum);
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