<?php
/**
 * Created by PhpStorm.
 * User: ashen
 * Date: 18-10-3
 * Time: 下午1:04
 */

namespace App\Http\Controllers\Back;

use App\PayOnlineNew;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class SrcPayNewController extends Controller{

    //添加在线支付配置
    public function addPayOnline(Request $request){
        $aParam = $request->all();
        $iPayTypeNew = DB::table('pay_type_new')->where('id',$aParam['payType'])->first();
        if(!empty($aParam['lockArea'])){
            $new_lockArea = implode(',',$aParam['lockArea']);
        } else {
            $new_lockArea = null;
        }
        if(!empty($aParam['levels'])){
            $new_levels = implode(',',$aParam['levels']);
        } else {
            $new_levels = null;
        }
        $payOnline = new PayOnlineNew();
        $payOnline->payType = $iPayTypeNew->id;
        $payOnline->rechName = $iPayTypeNew->rechName;
        $payOnline->payCode = $iPayTypeNew->code;
        $payOnline->rechType = 'onlinePayment';
        $payOnline->payName = $iPayTypeNew->payName;
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payeeName = $aParam['payeeName'];
        $payOnline->apiId = $aParam['apiId'];
        $payOnline->apiKey = $aParam['apiKey'];
        $payOnline->apiPublicKey = $aParam['apiPublicKey'];
        $payOnline->apiPrivateKey = $aParam['apiPrivateKey'];
        $payOnline->domain = $aParam['domain'];
        $payOnline->para1 = $aParam['para1'];
        $payOnline->req_url = $aParam['req_url'];
        $payOnline->res_url = $aParam['res_url'];
        $payOnline->min_money = $aParam['min_money'];
        $payOnline->max_money = $aParam['max_money'];
        $payOnline->rebate_or_fee = $aParam['rebate_or_fee'];
        $payOnline->status = $aParam['status'];
        $payOnline->remark = $aParam['remark'];
        $payOnline->remark2 = $aParam['remark2'];
        $payOnline->levels = $new_levels;
        $payOnline->pcMobile = $iPayTypeNew->pcMobile;
        $payOnline->isBank = $iPayTypeNew->isBank;
        $payOnline->bankInfo = $iPayTypeNew->bankInfo;
        $payOnline->save();
        return response()->json([
            'status' => true
        ]);
    }

    //复制在线支付配置
    public function copyPayOnline(Request $request){
        $aParam = $request->all();
        $iPayTypeNew = DB::table('pay_type_new')->where('id',$aParam['payType'])->first();
        if(!empty($aParam['lockArea'])){
            $new_lockArea = implode(',',$aParam['lockArea']);
        } else {
            $new_lockArea = null;
        }
        if(!empty($aParam['levels'])){
            $new_levels = implode(',',$aParam['levels']);
        } else {
            $new_levels = null;
        }
        $payOnline = new PayOnlineNew();
        $payOnline->payType = $iPayTypeNew->id;
        $payOnline->rechName = $iPayTypeNew->rechName;
        $payOnline->payCode = $iPayTypeNew->code;
        $payOnline->rechType = 'onlinePayment';
        $payOnline->payName = $iPayTypeNew->payName;
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payeeName = $aParam['payeeName'];
        $payOnline->apiId = $aParam['apiId'];
        $payOnline->apiKey = $aParam['apiKey'];
        $payOnline->apiPublicKey = $aParam['apiPublicKey'];
        $payOnline->apiPrivateKey = $aParam['apiPrivateKey'];
        $payOnline->domain = $aParam['domain'];
        $payOnline->para1 = $aParam['para1'];
        $payOnline->req_url = $aParam['req_url'];
        $payOnline->res_url = $aParam['res_url'];
        $payOnline->min_money = $aParam['min_money'];
        $payOnline->max_money = $aParam['max_money'];
        $payOnline->rebate_or_fee = $aParam['rebate_or_fee'];
        $payOnline->status = $aParam['status'];
        $payOnline->remark = $aParam['remark'];
        $payOnline->remark2 = $aParam['remark2'];
        $payOnline->levels = $new_levels;
        $payOnline->pcMobile = $iPayTypeNew->pcMobile;
        $payOnline->isBank = $iPayTypeNew->isBank;
        $payOnline->bankInfo = $iPayTypeNew->bankInfo;
        $payOnline->save();
        return response()->json([
            'status' => true
        ]);
    }
    //修改在线支付配置新
    public function editPayOnline(Request $request){
        $aParam = $request->all();
        $iPayTypeNew = DB::table('pay_type_new')->where('payName',$aParam['payType'])->first();
        if(!empty($aParam['lockArea'])){
            $new_lockArea = implode(',',$aParam['lockArea']);
        } else {
            $new_lockArea = null;
        }
        if(!empty($aParam['levels'])){
            $new_levels = implode(',',$aParam['levels']);
        } else {
            $new_levels = null;
        }
        $payOnline = PayOnlineNew::find($aParam['id']);
        $payOnline->payType = $iPayTypeNew->id;
        $payOnline->rechName = $iPayTypeNew->rechName;
        $payOnline->payCode = $iPayTypeNew->code;
        $payOnline->rechType = 'onlinePayment';
        $payOnline->payName = $iPayTypeNew->payName;
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payeeName = $aParam['payeeName'];
        $payOnline->apiId = $aParam['apiId'];
        $payOnline->apiKey = $aParam['apiKey'];
        $payOnline->apiPublicKey = $aParam['apiPublicKey'];
        $payOnline->apiPrivateKey = $aParam['apiPrivateKey'];
        $payOnline->domain = $aParam['domain'];
        $payOnline->para1 = $aParam['para1'];
        $payOnline->req_url = $aParam['req_url'];
        $payOnline->res_url = $aParam['res_url'];
        $payOnline->min_money = $aParam['min_money'];
        $payOnline->max_money = $aParam['max_money'];
        $payOnline->rebate_or_fee = $aParam['rebate_or_fee'];
        $payOnline->status = $aParam['status'];
        $payOnline->remark = $aParam['remark'];
        $payOnline->remark2 = $aParam['remark2'];
        $payOnline->levels = $new_levels;
        $payOnline->pcMobile = $iPayTypeNew->pcMobile;
        $payOnline->isBank = $iPayTypeNew->isBank;
        $payOnline->bankInfo = $iPayTypeNew->bankInfo;
        $payOnline->save();
        return response()->json([
            'status' => true
        ]);
    }



    //变更在线支付状态新
    public function changeOnlinePayStatus(Request $request)
    {
        $id = $request->get('id');
        $nowStatus = $request->get('status');
        if($nowStatus == 1){
            $changeStatus = 0;
        } else {
            $changeStatus = 1;
        }
        $update = PayOnlineNew::where('id',$id)
            ->update([
                'status' => $changeStatus
            ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //删除在线支付配置新
    public function delOnlinePay(Request $request)
    {
        $id = $request->get('id');
        if(isset($id) && $id){
            $del = PayOnlineNew::where('id',$id)->delete();
            if($del == 1){
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '删除失败！'
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => '删除失败！'
            ]);
        }
    }

    //添加银行支付配置
    public function addPayBank(Request $request)
    {
        $paramId = $request->input('paramId');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payeeName = $request->input('payeeName');
        $payee = $request->input('payee');
        $remark = $request->input('remark');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = null;
        }

        $getbank = DB::table('bank')->select('name')->where('bank_id',$paramId)->first();

        $payOnline = new PayOnlineNew();
        $payOnline->rechName = $getbank->name;
        $payOnline->payCode = 'bankTransfer';
        $payOnline->rechType = 'bankTransfer';
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payee = $payee;
        $payOnline->payeeName = $payeeName;
        $payOnline->remark = $pageDesc;
        $payOnline->remark2 = $remark2;
        $payOnline->pageDesc = $remark;
        $payOnline->min_money = $min_money;
        $payOnline->max_money = $max_money;
        $payOnline->rebate_or_fee = $rebate_or_fee;
        $payOnline->status = $status;
        $payOnline->levels = $new_levels;
        $payOnline->paramId = $paramId;
        $save = $payOnline->save();
        if($save == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //修改银行支付配置
    public function editPayBank(Request $request)
    {
        $id = $request->input('id');
        $paramId = $request->input('paramId');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payeeName = $request->input('payeeName');
        $payee = $request->input('payee');
        $remark = $request->input('remark');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = '0';
        }

        $update = PayOnlineNew::where('id',$id)
            ->update([
                'lockArea' => $new_lockArea,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'remark' => $pageDesc,
                'remark2' => $remark2,
                'pageDesc' => $remark,
                'min_money' => $min_money,
                'max_money' => $max_money,
                'rebate_or_fee' => $rebate_or_fee,
                'status' => $status,
                'levels' => $new_levels,
                'paramId' => $paramId
            ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //添加支付宝配置
    public function addPayAlipay(Request $request)
    {
        $payeeName = $request->input('payeeName');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payee = $request->input('payee');
        $qrCode = $request->input('qrCode');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $checkType = $request->input('checkType');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = null;
        }

        $payOnline = new PayOnlineNew();
        $payOnline->rechName = '支付宝支付';
        $payOnline->rechType = 'alipay';
        $payOnline->payCode = 'alipay';
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payee = $payee;
        $payOnline->payeeName = $payeeName;
        $payOnline->qrCode = $qrCode;
        $payOnline->pageDesc = $pageDesc;
        $payOnline->min_money = $min_money;
        $payOnline->max_money = $max_money;
        $payOnline->rebate_or_fee = $rebate_or_fee;
        $payOnline->status = $status;
        $payOnline->levels = $new_levels;
        $payOnline->remark = $remark;
        $payOnline->remark2 = $remark2;
        $payOnline->checkType = $checkType;
        $save = $payOnline->save();
        if($save == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //修改支付宝配置
    public function editPayAlipay(Request $request)
    {
        $id = $request->input('id');
        $payeeName = $request->input('payeeName');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payee = $request->input('payee');
        $qrCode = $request->input('qrCode');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $checkType = $request->input('checkType');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = '0';
        }

        $update = PayOnlineNew::where('id',$id)
            ->update([
                'lockArea' => $new_lockArea,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'checkType' => $checkType,
                'qrCode' => $qrCode,
                'remark' => $remark,
                'remark2' => $remark2,
                'pageDesc' => $pageDesc,
                'min_money' => $min_money,
                'max_money' => $max_money,
                'rebate_or_fee' => $rebate_or_fee,
                'status' => $status,
                'levels' => $new_levels
            ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //添加微信配置
    public function addPayWechat(Request $request)
    {
        $payeeName = $request->input('payeeName');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payee = $request->input('payee');
        $qrCode = $request->input('qrCode');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $checkType = $request->input('checkType');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = null;
        }

        $payOnline = new PayOnlineNew();
        $payOnline->rechName = '微信支付';
        $payOnline->rechType = 'weixin';
        $payOnline->payCode = 'weixin';
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payee = $payee;
        $payOnline->payeeName = $payeeName;
        $payOnline->qrCode = $qrCode;
        $payOnline->pageDesc = $pageDesc;
        $payOnline->min_money = $min_money;
        $payOnline->max_money = $max_money;
        $payOnline->rebate_or_fee = $rebate_or_fee;
        $payOnline->status = $status;
        $payOnline->levels = $new_levels;
        $payOnline->remark = $remark;
        $payOnline->remark2 = $remark2;
        $payOnline->checkType = $checkType;
        $save = $payOnline->save();
        if($save == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //修改微信配置
    public function editPayWechat(Request $request)
    {
        $id = $request->input('id');
        $payeeName = $request->input('payeeName');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payee = $request->input('payee');
        $qrCode = $request->input('qrCode');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $checkType = $request->input('checkType');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = '0';
        }

        $update = PayOnlineNew::where('id',$id)
            ->update([
                'lockArea' => $new_lockArea,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'checkType' => $checkType,
                'qrCode' => $qrCode,
                'remark' => $remark,
                'remark2' => $remark2,
                'pageDesc' => $pageDesc,
                'min_money' => $min_money,
                'max_money' => $max_money,
                'rebate_or_fee' => $rebate_or_fee,
                'status' => $status,
                'levels' => $new_levels
            ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }//添加财付通
    public function addPayCft(Request $request)
    {
        $payeeName = $request->input('payeeName');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payee = $request->input('payee');
        $qrCode = $request->input('qrCode');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $checkType = $request->input('checkType');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = null;
        }

        $payOnline = new PayOnlineNew();
        $payOnline->rechName = '财付通支付';
        $payOnline->rechType = 'cft';
        $payOnline->payCode = 'cft';
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payee = $payee;
        $payOnline->payeeName = $payeeName;
        $payOnline->qrCode = $qrCode;
        $payOnline->pageDesc = $pageDesc;
        $payOnline->min_money = $min_money;
        $payOnline->max_money = $max_money;
        $payOnline->rebate_or_fee = $rebate_or_fee;
        $payOnline->status = $status;
        $payOnline->levels = $new_levels;
        $payOnline->remark = $remark;
        $payOnline->remark2 = $remark2;
        $payOnline->checkType = $checkType;
        $save = $payOnline->save();
        if($save == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //修改财付通配置
    public function editPayCft(Request $request)
    {
        $id = $request->input('id');
        $payeeName = $request->input('payeeName');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payee = $request->input('payee');
        $qrCode = $request->input('qrCode');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $checkType = $request->input('checkType');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $pageDesc = $request->input('pageDesc');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = '0';
        }

        $update = PayOnlineNew::where('id',$id)
            ->update([
                'lockArea' => $new_lockArea,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'checkType' => $checkType,
                'qrCode' => $qrCode,
                'remark' => $remark,
                'remark2' => $remark2,
                'pageDesc' => $pageDesc,
                'min_money' => $min_money,
                'max_money' => $max_money,
                'rebate_or_fee' => $rebate_or_fee,
                'status' => $status,
                'levels' => $new_levels
            ]);
        if($update == 1){
            return response()->json([
                'status' => true
            ]);
        } else {
            return response()->json([
                'status' => false,
                'msg' => ''
            ]);
        }
    }

    //设置排序新
    public function setSort(Request $request){
        $params = $request->all();
        $data = [];
        foreach ($params['sort'] as $key => $value){
            $data[$key]['sort'] = empty($value) ? 0 : $value;
            $data[$key]['id'] = $params['id'][$key];
        }
        if(PayOnlineNew::editBatchPayOnlineData($data)){
            return response()->json([
                'status' => true
            ]);
        }else{
            return response()->json([
                'status' => false,
                'msg' => '排序失败'
            ]);
        }
    }
}