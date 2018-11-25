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
        $this->repo->param['s'] = 6;
        $this->repo->param['startTime'] = $this->repo->getMillisecond() - (1000 * 10 * 60);
        $this->repo->param['endTime'] = $this->repo->getMillisecond();
        $res = $this->repo->createReqData();
        if(isset($res['code']) && $res['code'] == 0 ){
            $data = $res['data']['list'];
            return $this->repo->createData($data);
        }
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