<?php

namespace App\Http\Controllers\Home;

use App\Banks;
use App\Models\Chat\Users;
use App\PayOnline;
use App\Recharges;
use App\User;
use App\UserBank;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    //银行列表
    public function bankList()
    {
        $bank = Banks::select('bank_id','name','eng_name')->where('status',1)->get();
        return response()->json($bank);
    }

    //检查用户是否绑定银行卡
    public function checkUserBank(Request $request)
    {
        $uid = $request->get('user_id');
        $getBank = UserBank::where('user_id',$uid)->first();
        if($getBank){
            return response()->json([
                'status'=>true,
                'bank_id' => $getBank->id,
                'bankName' => $getBank->bank_name,
                'cardNo' => '尾号'.substr($getBank->cardNo,-4),
                'subAddress' => $getBank->subAddress,
                'userId' => $getBank->user_id
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'没有绑定银行卡'
            ]);
        }

    }
    
    //保存银行卡
    public function saveBankCard(Request $request)
    {
        $uid = $request->get('user_id');
        $trueName = $request->get('trueName');
        $bankId = $request->get('bank_id');
        $cardNo = $request->get('cardNo');
        $cardAddress = $request->get('cardAddress');

        $updateUserFullName = Users::where('id',$uid)
            ->update([
                'fullName' => $trueName
            ]);
        if($updateUserFullName == 1){
            $getBankName = Banks::where('bank_id',$bankId)->first();

            $insertBank = new UserBank();
            $insertBank->user_id = $uid;
            $insertBank->bank_name = $getBankName->name;
            $insertBank->cardNo = $cardNo;
            $insertBank->subAddress = $cardAddress;
            $save = $insertBank->save();
            if($save == 1){
                return response()->json([
                   'status'=>true
                ],200);
            } else {
                return response()->json([
                    'status'=>false,
                    'msg'=>'银行卡绑定失败！请重试'
                ],200);
            }
        }
    }
    
    //PC端用户提交转账 
    public function userCharge(Request $request)
    {
        $cfgId = $request->get('cfgId');
        $rechMoney = $request->get('rechMoney');
        $realName = $request->get('realName');
        $payeeInfo = $request->get('payeeInfo');
        $rechTime = date('Y-m-d H:i:s');
        $user_id = $request->get('user_id');

        $getRechType = PayOnline::where('id',$cfgId)->first();
        $rechBank = Banks::where('bank_id',$getRechType->paramId)->first();
        $getUserInfo = User::where('id',$user_id)->first();

        if($getRechType->rechType == 'bankTransfer'){
            $shou_info = "收款人：$getRechType->payeeName<br> 收款银行：$rechBank->name<br> 账号：$getRechType->payee";
            $ru_info = "入款人：$realName<br> 入款时间：$rechTime";
        }
        if($getRechType->rechType == 'weixin'){
            $shou_info = "微信名称：$getRechType->payeeName<br> 微信账号：$getRechType->payee";
            $ru_info = "微信号：$realName<br> 转账时间：$rechTime";
        }
        if($getRechType->rechType == 'alipay'){
            $shou_info = "名称：$getRechType->payeeName<br> 支付宝账号：$getRechType->payee";
            $ru_info = "支付宝昵称：$realName<br> 转账时间：$rechTime<br> 认证姓名：$payeeInfo";
        }
        if($getRechType->rechType == 'cft'){
            $shou_info = "财付通名称：$getRechType->payeeName<br> 财付通账号：$getRechType->payee";
            $ru_info = "财付通号：$realName<br> 转账时间：$rechTime";
        }
        $recharges = new Recharges();
        $recharges->userId = $user_id;
        $recharges->username = $getUserInfo->username;
        $recharges->pay_online_id = $cfgId;
        $recharges->orderNum = payOrderNumber();
        $recharges->payType = $getRechType->rechType;
        $recharges->amount = $rechMoney;
        $recharges->rechargeType = 0;
        $recharges->shou_info = $shou_info;
        $recharges->ru_info = $ru_info;
        $recharges->status = 1;
        $save = $recharges->save();
        if($save == 1){
            return response()->json([
                'status'=>true,
                'msg' => '存款申请提交成功，请等待客服审核'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'提交失败，请稍后再试！'
            ]);
        }
    }
}
