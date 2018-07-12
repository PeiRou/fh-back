<?php

namespace App\Http\Controllers\Back;

use App\Banks;
use App\Levels;
use App\PayOnline;
use App\RechargeWay;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SrcPayController extends Controller
{
    //添加银行
    public function addBank(Request $request)
    {
        $name = $request->input('name');
        $engName = $request->input('eng_name');
        $status = $request->input('status');

        $bank = new Banks();
        $bank->name = $name;
        $bank->eng_name = $engName;
        $bank->status = $status;
        $insert = $bank->save();
        if($insert == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'添加成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }
    
    //添加层级
    public function addLevel(Request $request)
    {
        $name = $request->input('name');
        $value = (int)$request->input('value');
        $oneRechMoney = $request->input('oneRechMoney');
        $allRechMoney = $request->input('allRechMoney');
        $oneDrawMoney = $request->input('oneDrawMoney');
        $allDrawMoney = $request->input('allDrawMoney');
        $status = $request->input('status');

        //检查层级名称是否存在
        $checkName = Levels::where('name',$name)->count();
        if($checkName == 1){
            return response()->json([
                'status'=>false,
                'msg'=>'层级名称已经存在，请更换'
            ]);
        }
        //检查分层值是否存在
        $checkLevelValue = Levels::where('value',$value)->count();
        if($checkLevelValue == 1){
            return response()->json([
                'status'=>false,
                'msg'=>'层级值已被使用，请更换'
            ]);
        }

        $level = new Levels();
        $level->name = $name;
        $level->value = $value;
        $level->oneRechMoney = $oneRechMoney;
        $level->allRechMoney = $allRechMoney;
        $level->oneDrawMoney = $oneDrawMoney;
        $level->allDrawMoney = $allDrawMoney;
        $level->status = $status;
        $save = $level->save();
        if($save == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'添加成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }
    
    //修改支付层级
    public function editLevel(Request $request)
    {
        $id = $request->input('id');
        $name = $request->input('name');
        $oneRechMoney = $request->input('oneRechMoney');
        $allRechMoney = $request->input('allRechMoney');
        $oneDrawMoney = $request->input('oneDrawMoney');
        $allDrawMoney = $request->input('allDrawMoney');
        $status = $request->input('status');

        $getinfo = Levels::where('id',$id)->first();
        //检查层级名称是否存在
        if($name !== $getinfo->name){
            $checkName = Levels::where('name',$name)->count();
            if($checkName == 1){
                return response()->json([
                    'status'=>false,
                    'msg'=>'层级名称已经存在，请更换'
                ]);
            }
        }

        $update = Levels::where('id',$id)->update([
            'name'=>$name,
            'oneRechMoney'=>$oneRechMoney,
            'allRechMoney'=>$allRechMoney,
            'oneDrawMoney'=>$oneDrawMoney,
            'allDrawMoney'=>$allDrawMoney,
            'status'=>$status
        ]);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>'修改成功'
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }

    //删除层级检查
    public function delLevelCheck(Request $request)
    {
        $id = $request->get('id');
        $info = Levels::where('id',$id)->first();

        //统计该层级下有多少会员
        $count = User::where('rechLevel',$info->value)->count();
        if($count == 0){
            $msg = "当前层级中没有用户，确定要删除吗？";
        } else {
            $msg = "当前层级有【 <span style='font-weight: bold;color:red;font-size: 18px;'>".$count."</span> 】个用户，删除后这些用户会转移到默认层级，确定要删除该层级吗？";
        }

        return response()->json([
            'msg'=>$msg
        ]);
    }
    
    //删除层级
    public function delLevel(Request $request)
    {
        $id = $request->get('id');
        $info = Levels::where('id',$id)->first();

        $update = User::where('rechLevel',$info->value)->update([
            'rechLevel'=>0
        ]);

        $del = Levels::where('id',$id)->delete();

        if($del == 1){
            return response()->json([
                'status'=>true,
                'msg'=>$update
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法删除，请稍后重试'
            ]);
        }
    }

    //层级全部转移
    public function allExchangeLevel(Request $request)
    {
        $id = $request->get('id');
        $ToLevel = $request->get('level');

        //待迁移的
        $info = Levels::where('id',$id)->first();
        $ComeLevel = $info->value;

        if($ComeLevel == $ToLevel){
            return response()->json([
                'status'=>false,
                'msg'=>"当前层级下无法转移，您选择的转移层级就是当前层级"
            ]);
        }

        //迁移操作
        $update = User::where('rechLevel',$ComeLevel)->update([
            'rechLevel'=> $ToLevel
        ]);

        if($update !== 0){
            return response()->json([
                'status'=>true,
                'msg'=>"更新成功"
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }

    //添加充值方式
    public function addRechargeWay(Request $request)
    {
        $type = $request->input('type');
        $value = $request->input('value');
        $content = $request->input('content');
        $status = $request->input('status');

        $data = new RechargeWay();
        $data->type = $type;
        $data->value = $value;
        $data->content = $content;
        $data->status = $status;
        $save = $data->save();
        if($save == 1){
            return response()->json([
                'status'=>true,
                'msg'=>"添加成功！"
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }

    //修改充值方式
    public function editRechargeWay(Request $request)
    {
        $id = $request->input('id');
        $type = $request->input('type');
        $value = $request->input('value');
        $content = $request->input('content');
        $status = $request->input('status');

        $update = RechargeWay::where('id',$id)->update([
            'type'=>$type,
            'value'=>$value,
            'content'=>$content,
            'status'=>$status
        ]);
        if($update == 1){
            return response()->json([
                'status'=>true,
                'msg'=>"更新成功！"
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法更新，请稍后重试'
            ]);
        }
    }

    //删除充值方式
    public function delRechargeWay(Request $request)
    {
        $id = $request->get('id');
        $del = RechargeWay::where('id',$id)->delete();
        if($del == 1){
            return response()->json([
                'status'=>true,
                'msg'=>"删除成功！"
            ]);
        } else {
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法删除，请稍后重试'
            ]);
        }
    }
    
    //添加在线支付配置
    public function addPayOnline(Request $request)
    {
        $payType = $request->input('payType');
        $getPayTypeCode = DB::table('pay_type')->where('id',$payType)->first();
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payeeName = $request->input('payeeName');
        $apiId = $request->input('apiId');
        $apiKey = $request->input('apiKey');
        $apiPublicKey= $request->input('apiPublicKey');
        $domain = $request->input('domain');
        $para1 = $request->input('para1');
        $req_url = $request->input('req_url');
        $res_url = $request->input('res_url');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = null;
        }

        $payOnline = new PayOnline();
        $payOnline->payType = $payType;
        $payOnline->code = $getPayTypeCode->code;
        $payOnline->rechType = 'onlinePayment';
        $payOnline->rechName = '在线支付';
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payeeName = $payeeName;
        $payOnline->apiId = $apiId;
        $payOnline->apiKey = $apiKey;
        $payOnline->apiPublicKey = $apiPublicKey;
        $payOnline->domain = $domain;
        $payOnline->para1 = $para1;
        $payOnline->res_url = $res_url;
        $payOnline->req_url = $req_url;
        $payOnline->min_money = $min_money;
        $payOnline->max_money = $max_money;
        $payOnline->rebate_or_fee = $rebate_or_fee;
        $payOnline->status = $status;
        $payOnline->remark = $remark;
        $payOnline->remark2 = $remark2;
        $payOnline->levels = $new_levels;
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
    
    //修改在线支付
    public function editPayOnline(Request $request)
    {
        $id = $request->input('id');
        $payType = $request->input('payType');
        $lockArea = $request->input('lockArea');
        if($lockArea !== null){
            $new_lockArea = implode(',',$lockArea);
        } else {
            $new_lockArea = null;
        }
        $payeeName = $request->input('payeeName');
        $apiId = $request->input('apiId');
        $apiKey = $request->input('apiKey');
        $apiPublicKey= $request->input('apiPublicKey');
        $domain = $request->input('domain');
        $para1 = $request->input('para1');
        $req_url = $request->input('req_url');
        $res_url = $request->input('res_url');
        $min_money = $request->input('min_money');
        $max_money = $request->input('max_money');
        $rebate_or_fee = $request->input('rebate_or_fee');
        $status = $request->input('status');
        $remark = $request->input('remark');
        $remark2 = $request->input('remark2');
        $levels = $request->input('levels');
        if($levels !== null){
            $new_levels = implode(',',$levels);
        } else {
            $new_levels = '0';
        }

        $update = PayOnline::where('id',$id)
            ->update([
                'payType' => $payType,
                'lockArea' => $new_lockArea,
                'payeeName' => $payeeName,
                'apiId' => $apiId,
                'apiKey' => $apiKey,
                'apiPublicKey' => $apiPublicKey,
                'domain' => $domain,
                'para1' => $para1,
                'res_url' => $res_url,
                'req_url' => $req_url,
                'min_money' => $min_money,
                'max_money' => $max_money,
                'rebate_or_fee' => $rebate_or_fee,
                'status' => $status,
                'remark' => $remark,
                'remark2' => $remark2,
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
    
    //变更在线支付状态
    public function changeOnlinePayStatus(Request $request)
    {
        $id = $request->get('id');
        $nowStatus = $request->get('status');
        if($nowStatus == 1){
            $changeStatus = 0;
        } else {
            $changeStatus = 1;
        }
        $update = PayOnline::where('id',$id)
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
    
    //删除在线支付配置
    public function delOnlinePay(Request $request)
    {
        $id = $request->get('id');
        if(isset($id) && $id){
            $del = PayOnline::where('id',$id)->delete();
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

        $payOnline = new PayOnline();
        $payOnline->rechName = '银行转账';
        $payOnline->code = 'bankTransfer';
        $payOnline->rechType = 'bankTransfer';
        $payOnline->lockArea = $new_lockArea;
        $payOnline->payee = $payee;
        $payOnline->payeeName = $payeeName;
        $payOnline->remark = $remark;
        $payOnline->remark2 = $remark2;
        $payOnline->pageDesc = $pageDesc;
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

        $update = PayOnline::where('id',$id)
            ->update([
                'lockArea' => $new_lockArea,
                'payee' => $payee,
                'payeeName' => $payeeName,
                'remark' => $remark,
                'remark2' => $remark2,
                'pageDesc' => $pageDesc,
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

        $payOnline = new PayOnline();
        $payOnline->rechName = '支付宝支付';
        $payOnline->rechType = 'alipay';
        $payOnline->code = 'alipay';
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

        $update = PayOnline::where('id',$id)
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

        $payOnline = new PayOnline();
        $payOnline->rechName = '微信支付';
        $payOnline->rechType = 'weixin';
        $payOnline->code = 'weixin';
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

        $update = PayOnline::where('id',$id)
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
    
    //添加财付通
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

        $payOnline = new PayOnline();
        $payOnline->rechName = '财付通支付';
        $payOnline->rechType = 'cft';
        $payOnline->code = 'cft';
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

        $update = PayOnline::where('id',$id)
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
}
