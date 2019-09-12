<?php
/* 开心棋牌 */
namespace App\Http\Controllers\GamesApi\Card;

class KX extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
//        $this->repo->param['endTime'] = $this->repo->param['endTime'] ?? $param['toTime'] ?? (time() - 4 * 60);
        $this->repo->param['endTime'] = $this->repo->param['endTime'] ?? (strtotime($this->repo->OffsetTime(['time' => $param['toTime'] ?? (time() - 4 * 60)])));
        $this->repo->param['startTime'] = $this->repo->param['endTime'] - 15 * 60;
        $res = $this->repo->betList();
//        $res = json_decode('{"code":1,"msg":"","data":{"count":12,"list":{"id":["5182","5183","5184","5185","5186","5187","5188","5189","5190","5191","5192","5193"],"gtype":["1","1","6","6","6","6","6","1","1","1","1","1"],"rtype":["1","1","0","0","0","0","0","1","1","1","1","1"],"account":["cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001","cook001"],"bet":[4,8,1,1,1,1,1,1,1,1,1,1],"settlement":[0,0,0,0,0,1.5,1.5,1.9,1.9,1.9,0,0],"balance":[496,488,487,486,485,485.5,486,486.9,487.8,488.7,487.7,486.7],"ctime":[1545631449,1545631475,1545631480,1545631487,1545631494,1545631501,1545631510,1545632398,1545633454,1545633475,1545633506,1545633538]}}}', 1);
        if(isset($res['code']) && $res['code'] == 1){
            $this->repo->createData($res['data']['list']);//组合数据  插入数据库
        }else{
            return $this->repo->show($res['code'] ?? 500, $this->repo->code[$res['code']] ?? 'error');
        }
    }

}
