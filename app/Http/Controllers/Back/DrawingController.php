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
        $draw_type = $request->get('draw_type');
        $dateName = 'updated_at';
        if($request->get('dateType') == 2)
            $dateName = 'created_at';
        //提款总额统计
        $sql = DB::table('drawing')
            ->leftJoin('users','drawing.user_id', '=', 'users.id')
            ->where(function ($q) use ($killTest){
                if(isset($killTest) && $killTest){
                    $q->where('users.testFlag',0);
                }
            })
            ->where(function ($q) use ($draw_type){
                if(isset($draw_type) && $draw_type!=''){
                    $q->where('drawing.draw_type',$draw_type);
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
            ->where(function($sql) use($request){
                if(isset($request->account_type, $request->account_param) && $request->account_param){
                    if($request->account_type == 'account')
                        $sql->where('drawing.username',$request->account_param);
                    if($request->account_type == 'orderNum')
                        $sql->where('drawing.order_id',$request->account_param);
                    if($request->account_type == 'operation_account')
                        $sql->where('drawing.operation_account',$request->account_param);
                    if($request->account_type == 'amount')
                        $sql->where('drawing.amount',$request->account_param);
                }
                if(isset($request->account_type) && $request->account_type == 'amount_fw'){
                    if(($min = (int) $request->get('amount_min')) && ($max = (int) $request->get('amount_max'))){
                        $sql->whereBetween('drawing.amount',[$min, $max]);
                    }
                }
            })
            ->whereBetween('drawing.'.$dateName,[$startDate.' 00:00:00', $endDate.' 23:59:59']);
        $drawingTotal = $sql->sum('drawing.amount');
        $adminDrawing = $sql->where('drawing.draw_type', 2)->sum('drawing.amount');
        preg_match('/[\d]*\.{0,1}[\d]{0,2}/',$drawingTotal * 1,$arr);
        preg_match('/[\d]*\.{0,1}[\d]{0,2}/',$adminDrawing * 1,$arr1);

        return response()->json([
            'total' => $arr[0] ?? $drawingTotal,
//            'total' => number_format($drawingTotal,2,'.','')
            'adminDrawing' => $arr1[0] ?? $adminDrawing
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
        if(env('PAY_TWO',false)){
            json_decode($this->getArraySignNew($iDrawing,$iPayOnlineNew,$iBank,$iUser),true);
        }else{
            json_decode($this->getArraySign($iDrawing,$iPayOnlineNew,$iBank,$iUser),true);
        }
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
    //支付2.0使用
    public function getArraySignNew($iDrawing,$iPayOnlineNew,$iBank = [],$iUser = []){
        $aArray = [
            'pay_uname' => $iPayOnlineNew->payName,
            'merchant_code' => $iPayOnlineNew->apiId,
            'merchant_secret' => $iPayOnlineNew->apiKey,
            'public_key' => $iPayOnlineNew->apiPublicKey,
            'private_key' => $iPayOnlineNew->apiPrivateKey,
            'order_no' => $iDrawing->order_id,
            'money' => $iDrawing->amount,
            'app_id' => $iPayOnlineNew->para1,
            'callback_url' => isset($iPayOnlineNew->res_url)?$iPayOnlineNew->res_url:env('CALLBACK_URL',env('WEBSITE_PROTOCOL','https').'://'.$_SERVER['HTTP_HOST'].'pay/order/callback/new'),
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
            'ciphertext' => $PaymentPlatform->setPublicKey(env('PUBLIC_KEY'))->publicKeyToEncrypt($aArray)->getEncryptData(),
        ]);
    }

    //刷新ip信息
    public function refreshIp(Request $request){
        if(!isset($request->key) || !isset($request->value) || !isset($request->table) || !isset($request->ip) || !isset($request->upKey)){
            return ['status' => false,'msg'=>'参数错误'];
        }
        $ipInfo = ip($request->ip);
        $res = DB::table($request->table)->where($request->key,$request->value)->update([$request->upKey => $ipInfo]);
        usleep(600000);
        return ['status' => true];
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
