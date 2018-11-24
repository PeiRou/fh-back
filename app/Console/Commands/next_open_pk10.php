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
    protected  $code = 'bjpk10';
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
    protected $description = '北京赛车-當期開號';

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
        $excel = new Excel();
        $res = $excel->getNextIssue($table);
        $redis = Redis::connection();
        $redis->select(0);
        $redis_issue = Redis::get('pk10:issue');
        //當期獎期
        $nextIssue = $res->issue;
        $openTime = $res->opentime;
        if(empty($res) || ($nextIssue != $redis_issue))
            return 'Fail';

        $url = Config::get('website.guanServerUrl').'bjpk10';
        try {
            $html = json_decode(file_get_contents($url), true);
            //清除昨天长龙，在录第一期的时候清掉
            if (substr($openTime,-8) == '09:07:30') {
                DB::table('clong_kaijian1')->where('lotteryid', $this->gameId)->delete();
                DB::table('clong_kaijian2')->where('lotteryid', $this->gameId)->delete();
            }
            if ($redis_issue !== $html[0]['issue']) {
                try {
                    $up = DB::table('game_bjpk10')->where('issue', $html[0]['issue'])
                        ->update([
                            'is_open' => 1,
                            'year' => date('Y'),
                            'month' => date('m'),
                            'day' => date('d'),
                            'opennum' => $html[0]['nums']
                        ]);
                    if ($up == 1) {
                        $key = 'pk10:issue';
                        Redis::set($key, $html[0]['issue']);
                        $this->clong->setKaijian('pk10', 1, $html[0]['nums']);
                        $this->clong->setKaijian('pk10', 2, $html[0]['nums']);
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
