<?php

namespace App\Http\Controllers\Obtain;



class OfferController extends BaseController
{
    //执行方法
    public function doAction($aParam){


        die($this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
            'order_id' => $aParam['order_id'] ?? '没有订单',
            'data' => $aParam,
        ]));
    }

}
