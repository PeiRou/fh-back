<?php
/* 开心棋牌 */
namespace App\Http\Controllers\GamesApi\Card;

class KX extends Base{

    public function getBet($param = [])
    {
        return $this->repo->senterGetBet($param);
    }
    //获取棋牌投注详情
    public function getBet1($param = [])
    {
        $this->repo->param['endTime'] = $this->repo->param['endTime'] ?? (strtotime($this->repo->OffsetTime(['time' => $param['toTime'] ?? (time() - 4 * 60)])));
        $this->repo->param['startTime'] = $this->repo->param['endTime'] - 15 * 60;
        $res = $this->repo->betList();
        $code = 0;
        $msg = '';
        if(isset($res['code']) && $res['code'] == 1){
            $this->repo->createData($res['data']['list']);//组合数据  插入数据库
        }else{
            $code = $res['code'];
            $msg = $this->repo->code[$res['code']] ?? 'error';
        }
        return $this->repo->show($code, $msg);
    }

}
