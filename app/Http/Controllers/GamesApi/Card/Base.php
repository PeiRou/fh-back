<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 13:44
 */

namespace App\Http\Controllers\GamesApi\Card;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class Base
{
    public $intervals = 10; //查询数据时间 分钟
    public  $res_m = 0;
    public $repo = null;
    public $game_code = 0;
    public function __construct($repo){
        $this->repo = $repo;
    }
    public function action($method){
        if(!method_exists($this,$method))
            return '';
        return $this->$method();
    }
    //获取棋牌投注详情
    public function getBet(){
        $this->repo->param['s'] = 6;
        $this->repo->param['startTime'] = $this->repo->getMillisecond() - (1000 * $this->intervals * 60);
        $this->repo->param['endTime'] = $this->repo->getMillisecond();
        $res = $this->repo->createReqData();
        if(isset($res['code']) && $res['code'] == 0 ){
            $data = $res['data']['list'];
            return $this->repo->createData($data);
        }
        return $this->show($res['code'] ?? 500, $res['msg'] ?? 'error');
    }
    //开元的拉取历史投注报表，可供拉自定义的时间数据
    public function getHistoryBet()
    {
        $redis = Redis::connection();
        $redis->select(13);
        $key = 'laqu1_';
        if(!$redis->exists($key))
            $redis->setex($key, 60 * 60, strtotime('2018-12-19 00:00:00') * 1000);
        $this->addTime = $redis->get($key);

        if($this->addTime >= strtotime('2018-12-22 05:00:00') * 1000){
            return true;
        }
        $this->repo->param['s'] = 6;
        $this->repo->param['startTime'] = $this->addTime;
        $this->repo->param['endTime'] = $this->addTime + (1000 * 60 * 60);
        $res = $this->repo->createReqData();
        if(isset($res['code']) && $res['code'] == 0 ){
            $data = $res['data']['list'];
            $this->repo->createData($data);
            $this->addTime = $this->addTime + (1000 * 60 * 60);
            $redis->setex($key, 60 * 60, $this->addTime);
        }
        if(isset($res['code']) && $res['code'] == 16){
            $this->addTime = $this->addTime + (1000 * 60 * 60);
            $redis->setex($key, 60 * 60, $this->addTime);
        }

        writeLog('huifu', $this->addTime);
        writeLog('huifu', $res['msg'] ?? 'error');

        return $this->show($res['code'] ?? 500, $res['msg'] ?? 'error');
    }

    protected function show($code = '', $msg = '', $data = []){
        $data = [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
        return $data;
    }
}