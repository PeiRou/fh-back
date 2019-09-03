<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/7/16 0016
 * Time: 13:40
 */

namespace App\Http\Controllers\GamesApi\Card;


class MY extends Base
{

    public function getBet($param = [])
    {
        $res = $this->repo->betList();
//        $res = json_decode('{"code":1,"msg":"","data":{"count":12,"list":{"id":["5182","5183","5184","5185","5186","5187","5188","5189","5190","5191","5192","5193"],"gtype":["1","1","6","6","6","6","6","1","1","1","1","1"],"rtype":["1","1","0","0","0","0","0","1","1","1","1","1"],"account":["cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001"],"bet":[4,8,1,1,1,1,1,1,1,1,1,1],"settlement":[0,0,0,0,0,1.5,1.5,1.9,1.9,1.9,0,0],"balance":[496,488,487,486,485,485.5,486,486.9,487.8,488.7,487.7,486.7],"ctime":[1545631449,1545631475,1545631480,1545631487,1545631494,1545631501,1545631510,1545632398,1545633454,1545633475,1545633506,1545633538]}}}', 1);
        if(isset($res['ErrorCode']) && $res['ErrorCode'] == 0){
            $this->repo->createData($res['GameDetailList']);//组合数据  插入数据库
            return $this->repo->show(0, 'ok');
        }else{
            return $this->repo->show($res['status'] ?? 500, $res['err_msg'] ?? 'error');
        }
    }


//    public function action($doingCode = 0, $param = []){
//        if($doingCode == 0){ //登录
//            $res = $this->repo->login($param);
//        }else if($doingCode == 1){//查余额
////            if($this->repo->user['testFlag'] !== 0){
////                return $this->show(2, '测试或试玩账号无法使用此功能');
////            }
//            $res = $this->getMoney();
//        }
//        return $res;
//    }

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