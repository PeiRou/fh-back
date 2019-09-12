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
    public $intervals = 60; //查询数据时间 分钟
    public  $res_m = 0;
    public $repo = null;
    public $game_code = 0;
    public function __construct($repo){
        $this->repo = $repo;
    }
    public function action($method, $param = []){
        if(!method_exists($this,$method))
            return '';
        return $this->$method($param);
    }
    //获取棋牌投注详情
    public function getBet($param = []){
        $this->repo->param['s'] = 6;

        $this->repo->param['endTime'] = $this->repo->param['endTime'] ?? $this->btime($param);
        $this->repo->param['startTime'] = $this->repo->param['startTime'] ?? ($this->repo->param['endTime'] - (1000 * $this->intervals * 40));
        $res = $this->repo->createReqData();
        if(isset($res['code']) && $res['code'] == 0 ){
            $data = $res['data']['list'];
            return $this->repo->createData($data);
        }
        return $this->show($res['code'] ?? 500, $res['msg'] ?? 'error');
    }

    public function btime($param)
    {
        $t = $this->repo->OffsetTime(['time' => ($this->repo->getMillisecond($param) / 1000)]);
        return (strtotime($t) * 1000);
        return $this->repo->getMillisecond($param);
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