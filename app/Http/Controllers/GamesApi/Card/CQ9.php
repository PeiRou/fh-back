<?php

namespace App\Http\Controllers\GamesApi\Card;

use Illuminate\Support\Facades\DB;

class CQ9 extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        $this->repo->param['endtime'] = $this->repo->param['endtime'] ?? $this->repo->formatTime(strtotime($this->getTime($param)), true);
        $this->repo->param['starttime'] = $this->repo->formatTime(strtotime($this->repo->param['endtime']) - (60 * 15) - 1, false);
        $this->repo->param['page'] = $this->repo->param['page'] ?? 1;
        $this->repo->param['pagesize'] = $this->repo->param['pagesize'] ?? 1000;
        $res = $this->repo->hook('getBet');
        $this->repo->insertError($res['code'], $res['msg']);
        return $res;
    }

    public function getTime($param = [])
    {
//        isset($param['toTime']) && $param['toTime'] = ($param['toTime'] - 60 * 60 * 12);
        $time = $this->repo->OffsetTime(['time' => $param['toTime'] ?? time()]);
//        $t = $this->repo->formatTime(strtotime($time));
        return $time;
    }


}
