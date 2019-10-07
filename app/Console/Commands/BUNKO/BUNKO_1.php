<?php

namespace App\Console\Commands\BUNKO;

use App\Excel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use SameClass\Config\LotteryGames\Games;

class BUNKO_1 extends Command
{
    protected $signature = 'BUNKO_1 {code?}';
    protected $description = '单一定时结算';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $code = $this->argument('code');
        if(in_array($code,['lhc','msnn','pknn']))
            return false;
        $Games = new Games();
        $lotterys = $Games->games[$code]??'';
        if(empty($lotterys) || in_array($code,['lhc','msnn','pknn']))
            return false;
        $havElse = $lotterys['conElseLottery'];
        $havElseLottery = [];

        if(!empty($havElse)){       //如果有连动彩种，例如秒速赛车＋秒速牛牛，幸运快乐8＋幸运28
            $havElseLottery = isset($Games->games[$havElse])?$Games->games[$havElse]:[];
        }
        $excel = new Excel();
        $excel = $excel->newObject($code);
        $get = $excel->getNeedBunkoIssue($lotterys['table'],$code,$havElse,$havElseLottery);
        if($get){
            $redis = Redis::connection();
            $redis->select(0);
            $redis->del($code.':needbunko--'.$get->issue);

            //阻止進行中
            $key = 'Bunko:'.$lotterys['gameId'].'ing:'.$get->issue;
            echo $key.PHP_EOL;
            if($redis->exists($key)){
                echo $key.'----ing'.PHP_EOL;
                return 'ing';
            }
            $redis->setex($key,10,'ing');

//            //将SQL状态改成结算中
            $update = DB::table($lotterys['table'])->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            $opennum = $lotterys['type']=='lhc'?$get->open_num:$get->opennum;
            //SQL状态有成功改成结算中，就开始执行结算
            if($update)
                $excel->all($opennum,$get->issue,$get->id,false,$code,$lotterys);
            $get = $excel->getNeedBunkoIssueAll($lotterys['table'],$code,$havElse,$havElseLottery);
            if($get){
                foreach ($get as $k => $one)
                    $redis->set($code . ':needbunko--' . $one->issue,strtotime($one->opentime));
            }
            $redis->setex($key,1,'ing');
        }elseif (count($havElseLottery)>0){
            $redis = Redis::connection();
            $redis->select(0);
            $get = $excel->getNeedBunkoIssueAll($lotterys['table'],$code,$havElse,$havElseLottery);
            if($get)
                foreach ($get as $k => $one)
                    $redis->set($code . ':needbunko--' . $one->issue,strtotime($one->opentime));
        }
    }
}
