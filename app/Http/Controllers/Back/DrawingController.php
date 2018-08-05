<?php

namespace App\Http\Controllers\Back;

use App\Drawing;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DrawingController extends Controller
{
    public function passDrawing(Request $request)
    {
        $id = $request->get('id');

        //避免重复尝试锁定
        Redis::select(5);
        $key = 'passDraw';
        if(Redis::exists($key.$id))
            return response()->json([
                'status' => false,
                'msg' => '30秒内无法重复操作，请勿再试！'
            ]);
        Redis::setex($key.$id,30,'on');

        if($id){
            //获取用户ID
            $getUserId = DB::table('drawing')->where('id',$id)->first();
            $userId = $getUserId->user_id;
            //获取用户的数据
            $getUserInfo = User::where('id',$userId)->first();
            $userDrawTimes = $getUserInfo->DrawTimes;
            $userDrawMoneyCount = $getUserInfo->drawMoneyCount;

            $nowUserDrawTimes = $userDrawTimes+1;
            $nowUserDrawMoneyCount = $userDrawMoneyCount + $getUserId->amount;

            $lock = $getUserId->locked;
            if($lock == 0){
                $update = DB::table('drawing')->where('id',$id)->update([
                    'status' => 2,
                    'operation_id' => Session::get('account_id'),
                    'operation_account' => Session::get('account_name'),
                    'process_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]);
                if($update == 1){
                    $updateUserInfo = User::where('id',$userId)
                        ->update([
                            'DrawTimes' => $nowUserDrawTimes,
                            'drawMoneyCount' => $nowUserDrawMoneyCount
                        ]);
                    if($updateUserInfo == 1){
                        return response()->json([
                            'status' => true
                        ]);
                    } else {
                        return response()->json([
                            'status' => false,
                            'msg' => '更新用户提款信息失败，请重试！'
                        ]);
                    }
                }
            } else {
                return response()->json([
                    'status' => false,
                    'msg' => '用户提款申请已被处理！'
                ]);
            }
        }
    }

    public function addDrawingError(Request $request)
    {
        $id  = $request->input('id');
        $msg = $request->input('msg');

        $getUserId = Drawing::where('id',$id)->first();
        $userId = $getUserId->user_id;
        $userAmount = $getUserId->amount;

        $update = Drawing::where('id',$id)
            ->update([
                'operation_id' => Session::get('account_id'),
                'operation_account' => Session::get('account_name'),
                'process_date' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
                'status' => 3,
                'msg' => $msg
            ]);
        if($update == 1){

            $getUser = DB::table('users')->where('id',$userId)->first();
            $userMoney = $getUser->money;
            $back_total_money = (int)$userMoney + (int)$userAmount;

            $updateUserMoney = DB::table('users')->where('id',$userId)->update([
                'money' => $back_total_money
            ]);

            if($updateUserMoney == 1){
                return response()->json([
                    'status' => true
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'msg' => '更新用户提款状态失败，请重试！'
            ]);
        }

    }

    public function totalDrawing(Request $request)
    {
        $status = $request->get('status');
        $startDate = $request->get('startDate');
        $endDate = $request->get('endDate');
        $account_param = $request->get('account_param');
        $killTest = $request->get('killTest');

        //提款总额统计
        $drawingTotal = DB::table('drawing')
            ->leftJoin('users','drawing.user_id', '=', 'users.id')
            ->where(function ($q) use ($account_param){
                if(isset($account_param) && $account_param){
                    $q->where('users.username',$account_param);
                }
            })
            ->where(function ($q) use ($killTest){
                if(isset($killTest) && $killTest){
                    $q->where('users.testFlag',0);
                }
            })
            ->where(function ($q) use ($status) {
                if($status && isset($status)){
                    if($status == 'no'){
                        $q->where('drawing.status',0);
                    } else {
                        $q->where('drawing.status',$status);
                    }
                } else {
                    $q->where('drawing.status',2);
                }
            })
            ->whereBetween('drawing.created_at',[$startDate.' 00:00:00', $endDate.' 23:59:59'])->sum('drawing.amount');
        return response()->json([
            'total' => number_format($drawingTotal,2)
        ]);
    }
}
