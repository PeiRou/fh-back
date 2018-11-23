<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/12
 * Time: 13:44
 */

namespace App\Http\Controllers\GamesApi\Card;

use Illuminate\Support\Facades\DB;

class Base
{
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
//        p(date('YmdHi'),1);
        $this->repo->param['time'] = date('YmdHi');
//        return $this
    }
    private function res(){
        //生成url
        if(!$this->repo->createReqData())
            return $this->show(1, '配置参数错误！');
        //请求
        $this->repo->req();
        //处理数据
        $res = $this->repo->createRes();
        //失败  上下分查询订单状态
        if(!$res && ($this->repo->param['s'] == 2 || $this->repo->param['s'] == 3)){
            $data = $this->getOrderStatus();
            if(isset($data['code']) && $data['code'] == 0){
                return $data;
            }
        }
        if(isset($res) && $res['status']){
            return $this->show(0, '', $res['data']);
        }
        $error = isset($res['data']) && isset($res['data']['errorMsg']) ? $res['data']['errorMsg'] : '参数处理错误';
        return $this->show(2, $error);
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