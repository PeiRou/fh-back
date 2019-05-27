<?php

namespace App\Http\Controllers\Obtain;

use App\Offer;

class NotificationController extends BaseController
{
    //执行方法
//    public function doAction($aParam){
//        $iOffer = Offer::where('order_id',$aParam['order_id'])->where('order_no',$aParam['order_no'])->first();
//        if(empty($iOffer)){
//            echo $this->returnAction([
//                'code' => 4,
//                'msg' => $this->code[4],
//            ]);
//        }
//        if($iOffer->paystatus == 2){
//            echo $this->returnAction([
//                'code' => 0,
//                'msg' => $this->code[0],
//            ]);
//        }
//        if(Offer::where('order_id',$aParam['order_id'])->where('order_no',$aParam['order_no'])->update([
//            'paystatus' => 2,
//            'status' => 2
//        ])){
//            echo $this->returnAction([
//                'code' => 0,
//                'msg' => $this->code[0],
//            ]);
//        }
//        echo $this->returnAction([
//            'code' => 5,
//            'msg' => $this->code[5],
//        ]);
//    }

    public function doAction($aParam){
        $iOfferModel = Offer::where('order_no',$aParam['order_no']);
        $iOffer = $iOfferModel->get();

        if(empty($iOffer)){
            echo $this->returnAction([
                'code' => 4,
                'msg' => $this->code[4],
            ]);
        }
        if($iOfferModel->update([
            'paystatus' => 2,
            'status' => 2
        ])){
            echo $this->returnAction([
                'code' => 0,
                'msg' => $this->code[0],
            ]);
        }
        echo $this->returnAction([
            'code' => 5,
            'msg' => $this->code[5],
        ]);
    }
}
