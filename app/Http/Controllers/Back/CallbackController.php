<?php

namespace App\Http\Controllers\Back;

use App\Drawing;
use App\Helpers\PaymentPlatform;
use App\SystemSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Services\CryptService;

class CallbackController extends Controller
{
    public function withdrawal(Request $request){
        $aParam = $request->post();
        $this->customWriteLog('withdrawal','-----------------------------------------------------------------------------------------');
        $this->customWriteLog('withdrawal',$aParam);

        $aSystemSettingModel = new SystemSetting();
        $key = $aSystemSettingModel->getValueByRemark('payment_platform_key');                    //商户号的key
        $aData = CryptService::getInstance()->decrypt($aParam['ciphertext'],$key);
        $this->customWriteLog('withdrawal',$aData);

        if($aData['code'] !== 'SUCCESS') {
            $this->customWriteLog('withdrawal', '回调结果错误');
            return '回调结果错误';
        }
        $aPaymentPlatformModel = new PaymentPlatform();
        $sign = $aData['sign'];
        unset($aData['sign']);

        if($sign !== $aPaymentPlatformModel->getSign($aData,$key)) {
            $this->customWriteLog('withdrawal', '签名错误');
            return '签名错误';
        }

        if(!isset($aData['order_no']) || !array_key_exists('order_no',$aData)) {
            $this->customWriteLog('withdrawal', '订单号缺失');
            return '订单号缺失';
        }

        $iDrawing = Drawing::where('order_id',$aData['order_no'])->first();
        if(empty($iDrawing)) {
            $this->customWriteLog('withdrawal', '订单不存在');
            return '订单不存在';
        }

        if($iDrawing->amount != $aData['money']) {
            $this->customWriteLog('withdrawal', '订单金额不对');
            return '订单金额不对';
        }

        if($iDrawing->status != 1) {
            $this->customWriteLog('withdrawal', '订单状态错误');
            return '订单状态错误';
        }
        $result = Drawing::where('order_id',$aData['order_no'])->update([
            'status' => 2
        ]);
        if($result){
            $this->customWriteLog('withdrawal', '成功');
            return '成功';
        }
        $this->customWriteLog('withdrawal', '失败');
        return '失败';

    }

    //写入日志
    function customWriteLog($directory,$msg){
        $path = storage_path().'/logs/'.$directory;
        if(!is_dir($path)){
            mkdir($path);
        }
        $path .= '/'.date('Y-m');
        if(!is_dir($path)){
            mkdir($path);
        }
        $path .= '/'.date('d').'.log';
        \Illuminate\Support\Facades\Log::useFiles($path);
        \Illuminate\Support\Facades\Log::info($msg);
    }
}
