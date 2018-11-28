<?php
/* 体彩指数 */
namespace App\Http\Controllers\GamesApi\Sports;

class TCController extends BaseController
{
    public function __construct($repo){
        parent::__construct();
        $this->repository = $repo;
    }

    public function action($method){
        if(!method_exists($this,$method))
            die('没有方法');
        return $this->$method();
    }

    //获取体彩指数数据
    public function getTCZS(){
//        $res = $this->repository->getTCZS();
        $res = $this->getOtherApiRepository('TCZS')->getTCZS();
        if(!isset($res['code']) || $res['code'] != 0){
           return $res;
        }
        //清空表
        $this->getOtherApiRepository('TCZS')->deleteTCZS();
        $this->getOtherApiRepository('TCZS')->createDataTCZS($res['data']);
    }

}
