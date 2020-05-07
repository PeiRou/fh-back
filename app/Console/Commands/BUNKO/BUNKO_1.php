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
        //阻止彩种進行中
        if($excel->stopBunko($code, 2,'BunkoCP'))
            return 'ing';
        $get = $excel->getNeedBunkoIssue($lotterys['table'],$code,$havElse,$havElseLottery);
        if($get){
            //阻止奖期進行中
            if($excel->stopBunko($lotterys['gameId'], 10,'Bunko:'.$get->issue))
                return 'ing';
//            //将SQL状态改成结算中
            $update = DB::table($lotterys['table'])->where('id', $get->id)->update([
                'bunko' => 2
            ]);
            $opennum = $lotterys['type']=='lhc'?$get->open_num:$get->opennum;
            //SQL状态有成功改成结算中，就开始执行结算
            if($update)
                $excel->all($opennum,$get->issue,$get->id,false,$code,$lotterys);
        }else{
            //如果现在没有需要开奖的，把下一期时间放到缓存里，减少读取次数
            $excel->setNextBunkoIssue($lotterys['table'],$code);
        }
    }
}
