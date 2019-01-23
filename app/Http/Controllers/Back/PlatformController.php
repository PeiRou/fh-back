<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Obtain\SendController;
use App\Offer;
use App\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class PlatformController extends Controller
{
    //平台费用结算-手动结算
    public function addPlatformSettlement(Request $request){
        Artisan::call('PlatformSettle:Settlement');
        return response()->json([
            'status'=>true,
            'msg'=>'结算成功'
        ]);
    }

    public function pay(Request $request){
        $aParam = $request->input();
        $iOffer = Offer::where('id',$aParam['id'])->first();
        $iOffer->order_no = 'O'.time().rand(10000,99999);
        $iOffer->save();
        $aArray = [
            'platform_id' => SystemSetting::getValueByRemark1('payment_platform_id'),
            'timestamp' => time(),
            'order_id' => $iOffer->order_id,
            'order_no' => $iOffer->order_no,
            'amount' => $iOffer->money,
            'pay_remark' => $aParam['type']
        ];
        $baseController = new SendController($aArray);
        $iPay = $baseController->sendParameter('pay/pay/defray');
        if($iPay['code'] === 0){
            return response()->json([
                'status' => true,
                'data' => $iPay['data']
            ]);
        }elseif ($iPay['code'] === 110){
            return response()->json([
                'status' => false,
                'msg' => '该订单已经支付，请等待通知',
                'code' => $iPay['code']
            ]);
        }
        return response()->json([
            'status' => false,
            'msg' => '支付错误',
            'code' => $iPay['code']
        ]);
    }

}
