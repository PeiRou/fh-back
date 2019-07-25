<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/23 0023
 * Time: 16:08
 */

namespace App\Http\Controllers\GamesApi\Card;


class FYDJ extends Base
{
//    public function action($doingCode = 0, $param = []){
//        if($doingCode == 0){ //登录
//            $res = $this->repo->login($param);
//        }else if($doingCode == 1){//查余额
//            if($this->repo->user['testFlag'] !== 0){
//                return $this->show(2, '测试或试玩账号无法使用此功能');
//            }
//            $res = $this->getMoney();
//        }
//        return $res;
//    }

    public function getBet($param = [])
    {
        $res = $this->repo->betList();
        if(isset($res['error']) && $res['error'] == true){
            return $this->repo->show($res['success'] ?? 500, $res['msg'] ?? 'error');
        }else{
            $this->repo->createData($res);//组合数据  插入数据库
            return $this->repo->show(0, 'ok');
        }
    }

    public function up($money = 0){
        $this->repo->param['money'] = $money;
        $this->repo->param['type'] = 'in';
        return $this->repo->change();
    }

    public function down($money = 0)
    {
        $this->repo->param['money'] = $money;
        $this->repo->param['type'] = 'out';
        return $this->repo->change();
    }

    public function getMoney(){
        return $this->repo->getMoney();
    }

    public function getOrder($param){
        return $this->repo->getOrder($param);
    }
}