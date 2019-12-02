<?php

namespace App\Http\Controllers\GamesApi\Card;

class TH extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        $starttime = strtotime($this->repo->OffsetTime(['time' => $param['toTime'] ?? time()])) - (60 * 3);
        $starttime = $this->bt($starttime);
        $this->repo->param['starttime'] = $this->repo->param['starttime'] ?? ($starttime * 1000);
        $this->repo->param['endtime'] = $this->repo->param['starttime'] + 299999;
        $this->repo->param['query_date'] = $this->repo->param['query_date'] ?? date('Y-m-d', $starttime);
        $res = $this->repo->hook('getBet');
        $this->repo->insertError($res['code'], $res['msg']);
        return $res;
    }

    public function bt($time)
    {
        $i = date('i', $time);
        $d = date('YmdH', $time).sprintf("%'02d", (((int)($i / 5)) * 5)).'00';
        return strtotime($d);
    }
}
