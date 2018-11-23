<?php
/* 无双棋牌 */
/**
 * 账号注册
 * 用户名支持4-14位，密码支持6-12位
 * 访问接口不会自动创建用户
 * 不能指定游戏进入 只能先进入大厅
 */
namespace App\Http\Controllers\GamesApi\Card;

class WS extends Base{
    public function __construct($repo){
        parent::__construct($repo);
    }
//    public function action($doingCode = 0){
//        $this->game_code = 'ws0000'; //不能指定游戏进入  只能先进入大厅
//        if($doingCode == 0){ //登录
//            $res = $this->login();
//        }
//        return $res;
//    }
    //获取棋牌投注详情
    public function getBet(){
        $this->repo->param['time'] = date('YmdHi');
        $this->repo->param['page'] = 1;
        $res = $this->repo->getBet();
        p($res,1);
    }

}
