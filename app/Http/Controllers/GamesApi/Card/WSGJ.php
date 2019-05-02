<?php
/* 无双棋牌 */
/**
 * 账号注册
 * 用户名支持4-14位，密码支持6-12位
 * 访问接口不会自动创建用户
 * 不能指定游戏进入 只能先进入大厅
 */
namespace App\Http\Controllers\GamesApi\Card;

class WSGJ extends Base{
    public function __construct($repo){
        parent::__construct($repo);
    }

    //获取棋牌投注详情
    public function getBet($param = []){
        $this->repo->param['time'] = $this->repo->param['time'] ?? $this->getTime($param);
//        $this->repo->param['time'] = '201811251845,201811251860';
        $res = $this->repo->getBet();
        if(isset($res['code']) && $res['code'] == 0){
            $res = $res['data'];
            $page_info = $res['page_info'];
            $data = $res['details'];
            $this->repo->createData($data);//组合数据  插入数据库
            //当前页数小于总页数  继续请求
            if($page_info['currentPage'] < $page_info['totalPage']){
                $this->repo->param['page'] = $page_info['currentPage'] + 1;
                return $this->getBet();
            }
        }else{
            $code = $res['code'] ?? 500;
            $msg = '第'.($this->repo->param['page']??1).'页数据获取失败:'.($res['msg']??'error');
            $this->repo->insertError($code, $msg);
            return $this->show($code, $msg);
        }
    }
    private function getTime($param = []){

        $toMinute = date('i', $param['toTime'] ?? time());
        if ($toMinute >= 0 && $toMinute < 15){
            $toMinute = '15';
        }else if($toMinute >= 15 && $toMinute < 30){
            $toMinute = '30';
        }else if($toMinute >= 30 && $toMinute < 45){
            $toMinute = '45';
        }else{
            $toMinute = '60';
        }
        $Minute = ($toMinute - 15) == 0 ? '00' : $toMinute - 15;
        return date('YmdH', $param['toTime'] ?? time()).$Minute.','.date('YmdH', ($param['toTime'] ?? time())).($toMinute - 1).'59';
    }

}
