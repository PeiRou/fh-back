<?php

namespace App\Http\Controllers\Back;

use App\Banks;
use App\Drawing;
use App\Events\BackPusherEvent;
use App\Helpers\PaymentPlatform;
use App\PayOnlineNew;
use App\SystemSetting;
use App\User;
use App\UserFreezeMoney;
use App\Users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
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
            if($getUserId->locked)
                return response()->json([
                    'status' => false,
                    'msg' => '提现已处理过，该次操作无效！'
                ]);
            $userId = $getUserId->user_id;
            //获取用户的数据
            $getUserInfo = User::where('id',$userId)->first();
            $userDrawTimes = $getUserInfo->DrawTimes;
            $userDrawMoneyCount = $getUserInfo->drawMoneyCount;

            $nowUserDrawTimes = $userDrawTimes+1;
            $nowUserDrawMoneyCount = $userDrawMoneyCount + $getUserId->amount;

            $lock = $getUserId->locked;
            if($lock == 0){
                $data = [
                    'status' => 2,
                    'operation_id' => Session::get('account_id'),
                    'operation_account' => Session::get('account_name'),
                    'process_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'locked' => 1
                ];
                if(empty($getUserId->bank_id)){
                    $data['bank_id'] = $getUserInfo->bank_id;
                    $bank = DB::table('bank')->where('bank_id',$data['bank_id'])->first();
                    $data['fullName'] = $getUserInfo->fullName;
                    $data['bank_name'] = $bank->name;
                    $data['bank_num'] = $getUserInfo->bank_num;
                    $data['bank_addr'] = $getUserInfo->bank_addr;
                }
                $update = DB::table('drawing')->where('id',$id)->update($data);
                if($update == 1){
                    $updateUserInfo = User::where('id',$userId)
                        ->update([
                            'DrawTimes' => $nowUserDrawTimes,
                            'drawMoneyCount' => $nowUserDrawMoneyCount
                        ]);
                    if($updateUserInfo == 1){
                        event(new BackPusherEvent('success','提现成功提醒','您的提现申请已通过，提现金额：'.$getUserId->amount.'元，请注意查收，流水订单号：【'.$getUserId->order_id.'】',array('fnotice-'.$userId)));
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
    public function passDrawingAuto(Request $request)
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
            if($lock == 1){
                $data = [
                    'status' => 2,
                    'operation_id' => Session::get('account_id'),
                    'operation_account' => Session::get('account_name'),
                    'process_date' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'locked' => 1
                ];
                if(empty($getUserId->bank_id)){
                    $data['bank_id'] = $getUserInfo->bank_id;
                    $bank = DB::table('bank')->where('bank_id',$data['bank_id'])->first();
                    $data['fullName'] = $getUserInfo->fullName;
                    $data['bank_name'] = $bank->name;
                    $data['bank_num'] = $getUserInfo->bank_num;
                    $data['bank_addr'] = $getUserInfo->bank_addr;
                }
                $update = DB::table('drawing')->where('id',$id)->update($data);
                if($update == 1){
                    $updateUserInfo = User::where('id',$userId)
                        ->update([
                            'DrawTimes' => $nowUserDrawTimes,
                            'drawMoneyCount' => $nowUserDrawMoneyCount
                        ]);
                    if($updateUserInfo == 1){
                        event(new BackPusherEvent('success','提现成功提醒','您的提现申请已通过，提现金额：'.$getUserId->amount.'元，请注意查收，流水订单号：【'.$getUserId->order_id.'】',array('fnotice-'.$userId)));
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
        if($getUserId->locked)
            return response()->json([
                'status' => false,
                'msg' => '提现已处理过，该次操作无效！'
            ]);
        $userId = $getUserId->user_id;
        $userAmount = $getUserId->amount;
        //获取用户的数据
        $getUserInfo = User::where('id',$userId)->first();
        $data = [
            'operation_id' => Session::get('account_id'),
            'operation_account' => Session::get('account_name'),
            'process_date' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 3,
            'msg' => $msg,
            'locked' => 1
        ];
        if(empty($getUserId->bank_id)){
            $data['bank_id'] = $getUserInfo->bank_id;
            $bank = DB::table('bank')->where('bank_id',$data['bank_id'])->first();
            $data['fullName'] = $getUserInfo->fullName;
            $data['bank_name'] = $bank->name;
            $data['bank_num'] = $getUserInfo->bank_num;
            $data['bank_addr'] = $getUserInfo->bank_addr;
        }
        DB::beginTransaction();
        $update = Drawing::where('id',$id)
            ->update($data);
        $updateUserMoney = DB::table('users')->where('id',$userId)->update([
            'money' => DB::raw('money + '.$userAmount)
        ]);
        if($update == 1 && $updateUserMoney){
            DB::commit();
            event(new BackPusherEvent('error','提现失败提醒','您的提现申请被驳回，提现金额：'.$getUserId->amount.'元，流水订单号：【'.$getUserId->order_id.'】，如有疑问，请联系在线客服',array('fnotice-'.$userId)));
            return response()->json([
                'status' => true
            ]);
        } else {
            DB::rollBack();
            return response()->json([
                'status' => false,
                'msg' => '更新用户提款状态失败，请重试！'
            ]);
        }

    }

    public function addDrawingErrorAuto(Request $request){
        $id  = $request->input('id');
        $msg = $request->input('msg');

        $getUserId = Drawing::where('id',$id)->first();
        if($getUserId->locked != 1)
            return response()->json([
                'status' => false,
                'msg' => '该次订单没锁定,操作无效！'
            ]);
        $userId = $getUserId->user_id;
        $userAmount = $getUserId->amount;
        //获取用户的数据
        $getUserInfo = User::where('id',$userId)->first();
        $data = [
            'operation_id' => Session::get('account_id'),
            'operation_account' => Session::get('account_name'),
            'process_date' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'status' => 3,
            'msg' => $msg,
            'locked' => 1
        ];
        if(empty($getUserId->bank_id)){
            $data['bank_id'] = $getUserInfo->bank_id;
            $bank = DB::table('bank')->where('bank_id',$data['bank_id'])->first();
            $data['fullName'] = $getUserInfo->fullName;
            $data['bank_name'] = $bank->name;
            $data['bank_num'] = $getUserInfo->bank_num;
            $data['bank_addr'] = $getUserInfo->bank_addr;
        }
        DB::beginTransaction();
        $update = Drawing::where('id',$id)
            ->update($data);
        $updateUserMoney = DB::table('users')->where('id',$userId)->update([
            'money' => DB::raw('money + '.$userAmount)
        ]);
        if($update == 1 && $updateUserMoney){
            DB::commit();
            event(new BackPusherEvent('error','提现失败提醒','您的提现申请被驳回，提现金额：'.$getUserId->amount.'元，流水订单号：【'.$getUserId->order_id.'】，如有疑问，请联系在线客服',array('fnotice-'.$userId)));
            return response()->json([
                'status' => true
            ]);
        } else {
            DB::rollBack();
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

    public function dispensingDrawing(Request $request){
        $aParam = $request->all();
        DB::beginTransaction();
        $iDrawing = Drawing::where('id',$aParam['id'])->where('status',0)->where('locked',0)->first();
        if(empty($iDrawing)) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => '该订单已操作或不存在'
            ]);
        }
        $result = Drawing::where('id',$aParam['id'])->where('status',0)->where('locked',0)->update([
            'status' => 1,
            'locked' => 1,
            'draw_type' => 0,'operation_id' => Session::get('account_id'),
            'operation_account' => Session::get('account_name'),
            'process_date' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            ]);
        if(!$result) {
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => '该订单已操作'
            ]);
        }
        $iPayOnlineNew = PayOnlineNew::where('id',$aParam['payId'])->first();
        $iBank = Banks::where('bank_id',$iDrawing->bank_id)->first();
        $iUser = Users::where('id',$iDrawing->user_id)->first();
        if(empty($iUser->fullName)){
            DB::rollback();
            return response()->json([
                'status' => false,
                'msg' => '不存在真实姓名'
            ]);
        }
        DB::commit();
        json_decode($this->getArraySign($iDrawing,$iPayOnlineNew,$iBank,$iUser),true);
        return response()->json([
            'status' => true
        ]);
    }

    public function getArraySign($iDrawing,$iPayOnlineNew,$iBank = [],$iUser = []){
        $aArray = [
            'pay_uname' => $iPayOnlineNew->payName,
            'merchant_code' => $iPayOnlineNew->apiId,
            'merchant_secret' => $iPayOnlineNew->apiKey,
            'public_key' => $iPayOnlineNew->apiPublicKey,
            'private_key' => $iPayOnlineNew->apiPrivateKey,
            'order_no' => $iDrawing->order_id,
            'money' => $iDrawing->amount,
            'callback_url' => $iPayOnlineNew->res_url,
            'bank' => $iBank->eng_name,
            'gateway_address' => $iPayOnlineNew->req_url,
            'platform_id' => SystemSetting::where('id',1)->value('payment_platform_id'),
            'third_url' => $iPayOnlineNew->domain,
            'timestamp' => time(),
            'member_name' => $iUser->fullName,
            'member_card' => $iDrawing->bank_num,
        ];
        $PaymentPlatform = new PaymentPlatform();
        $aArray['sign'] = $PaymentPlatform->getSign($aArray,SystemSetting::where('id',1)->value('payment_platform_key'));
        return $PaymentPlatform->postCurl(SystemSetting::where('id',1)->value('payment_platform_dispensing'),[
            'ciphertext' => base64_encode(json_encode($aArray)),
        ]);
    }

    //提现解冻
    public function drawingThaw(Request $request){
        $id = $request->post('id');
        if(empty($id)){
            return ['status' => false,'msg'=>'参数错误'];
        }
        if(UserFreezeMoney::where('id',$id)->delete()){
            return ['status' => true];
        }else{
            return ['status' => false,'msg' => '解冻失败'];
        }
    }
}
