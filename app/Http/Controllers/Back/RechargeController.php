<?php

namespace App\Http\Controllers\Back;

use App\Recharges;
use App\User;
use App\Capital;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class RechargeController extends Controller
{
    public function passRecharge(Request $request)
    {
        $id = $request->get('id');
        $getInfo = Recharges::where('id',$id)->first();
        $userId = $getInfo->userId;
        $amout = $getInfo->amount;
        $rebate_or_fee = $getInfo->rebate_or_fee;           //返利或手续费

        $getUserInfo = User::where('id',$userId)->first();
        $userMoney = $getUserInfo->money;
        $userPayTimes = $getUserInfo->PayTimes;
        $userSaveMoneyCount = $getUserInfo->saveMoneyCount;

        $nowMoney = $userMoney+$amout+$rebate_or_fee;
        $nowUserPayTimes = $userPayTimes+1;
        $nowUserSaveMoneyCount = $userSaveMoneyCount + $amout + $rebate_or_fee;

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
                        'addMoney' => 1,
                        'process_date' => date('Y-m-d H:i:s')
                    ]);
                if($updateRechargeStatus == 1){
                    if(!empty($rebate_or_fee)){
                        $capital = new Capital();
                        $capital->to_user = $userId;
                        $capital->user_type = 'user';
                        $capital->order_id = $capital->randOrder('C');
                        $capital->type = 't04';
                        $capital->money = $rebate_or_fee;
                        $capital->balance = $nowMoney;
                        $capital->operation_id = 0;
                        if($rebate_or_fee>0)
                            $capital->content = '充值返利';
                        else
                            $capital->content = '充值手续费';
                        $insert = $capital->save();
                    }
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

    public function passOnlineRecharge(Request $request)
    {
        $id = $request->get('id');
        $updateRechargeStatus = Recharges::where('id',$id)
            ->update([
                'operation_id' => Session::get('account_id'),
                'operation_account' => Session::get('account'),
                'status' => 3,
                'addMoney' => 1,
                'process_date' => date('Y-m-d H:i:s'),
                'msg' => '第三方回调失败，已手动入款'
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
                    'process_date' => date('Y-m-d H:i:s'),
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

    public function totalRecharge(Request $request)
    {
        $rechType = $request->get('rechType');
        $payOnlineId = $request->get('payOnlineId');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $killTest = $request->get('killTest');
        $account = $request->get('account');

        //今日线上总数
        $onlinePayToday = DB::table('recharges')
            ->leftJoin('users','recharges.userId', '=', 'users.id')
            ->where(function ($q) use ($killTest){
                if(isset($killTest) && $killTest){
                    $q->where('users.agent','!=',2);
                }
            })
            ->where('recharges.payType','onlinePayment')->where('recharges.status',2)->whereDate('recharges.created_at',date('Y-m-d'))->sum('recharges.amount');
        //今日线下总数
        $offlinePayToday = DB::table('recharges')
            ->leftJoin('users','recharges.userId', '=', 'users.id')
            ->where(function ($q) use ($killTest){
                if(isset($killTest) && $killTest){
                    $q->where('users.agent','!=',2);
                }
            })
            ->where('recharges.payType','!=','onlinePayment')->where('recharges.status',2)->whereDate('recharges.created_at',date('Y-m-d'))->sum('recharges.amount');

        $where = Session::get('recharge_report');
        $total = DB::select('select sum(amount) as total  from recharges LEFT JOIN users on recharges.userId = users.id WHERE 1 '.$where);
        foreach ($total as&$val)
            $total = $val;
        return response()->json([
            'total' => number_format($total->total,2),
            'onlinePayToday' => number_format($onlinePayToday,2),
            'offlinePayToday' => number_format($offlinePayToday,2)
        ]);
    }
}
