<?php

namespace App\Http\Controllers\Back;

use App\Recharges;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class RechargeController extends Controller
{
    public function passRecharge(Request $request)
    {
        $id = $request->get('id');
        $getInfo = Recharges::where('id',$id)->first();
        $userId = $getInfo->userId;
        $amout = $getInfo->amount;

        $getUserInfo = User::where('id',$userId)->first();
        $userMoney = $getUserInfo->money;
        $userPayTimes = $getUserInfo->PayTimes;
        $userSaveMoneyCount = $getUserInfo->saveMoneyCount;

        $nowMoney = $userMoney+$amout;
        $nowUserPayTimes = $userPayTimes+1;
        $nowUserSaveMoneyCount = $userSaveMoneyCount + $amout;

        if($getInfo->addMoney == 1){
            return response()->json([
                'status' => false,
                'msg' => '用户充值已完成，请勿再试！'
            ]);
        } else {
            //更新用户余额
            $updateMoney = User::where('id',$userId)
                ->update([
                    'money' => $nowMoney,
                    'PayTimes' => $nowUserPayTimes,
                    'saveMoneyCount' => $nowUserSaveMoneyCount
                ]);
            if($updateMoney == 1){
                $updateRechargeStatus = Recharges::where('id',$id)
                    ->update([
                        'operation_id' => Session::get('account_id'),
                        'operation_account' => Session::get('account'),
                        'status' => 2,
                        'addMoney' => 1
                    ]);
                if($updateRechargeStatus == 1){
                    return response()->json([
                        'status' => true
                    ]);
                } else {
                    return response()->json([
                        'status' => false,
                        'msg' => '更新用户充值状态失败，请重试！'
                    ]);
                }
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '更新用户余额失败，请重试！'
                ]);
            }
        }
    }

    //驳回
    public function addRechargeError(Request $request)
    {
        $id  = $request->input('id');
        $msg = $request->input('msg');
        $getInfo = Recharges::where('id',$id)->first();

        if($getInfo->addMoney == 1){
            return response()->json([
                'status' => false,
                'msg' => '用户充值已完成，请勿再试！'
            ]);
        } else {
            $update = Recharges::where('id',$id)
                ->update([
                    'operation_id' => Session::get('account_id'),
                    'operation_account' => Session::get('account'),
                    'status' => 3,
                    'addMoney' => 1,
                    'msg' => $msg
                ]);
            if($update == 1){
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '更新用户充值状态失败，请重试！'
                ]);
            }
        }
    }

}
