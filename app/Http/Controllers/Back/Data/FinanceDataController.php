<?php

namespace App\Http\Controllers\Back\Data;

use App\AgentRecon;
use App\Capital;
use App\Drawing;
use App\Levels;
use App\Recharges;
use App\User;
use App\UserRecon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FinanceDataController extends Controller
{
    //充值记录
    public function rechargeRecord(Request $request)
    {
//        $isSearch = $request->get('isSearch');
//        $status = $request->get('status');
//        $pay_online_id = $request->get('pay_online_id');
//        $payType = $request->get('recharge_type');
//        $rechargeType = $request->get('rechargeType'); //自动还是手动收款 参数
//        $account_type = $request->get('account_type');
//        $account_param = $request->get('account_param');
//        $amount = $request->get('amount');
//        $fullName = $request->get('fullName');
//        $startTime = $request->get('startTime');
//        $endTime = $request->get('endTime');
//
//        $recharge = Recharges::select()
//            ->where(function ($query) use ($status,$isSearch){
//                if($isSearch == 'yes'){
//                    if(isset($status) && $status){
//                        $query->where('status',$status);
//                    }
//                } else {
//                    $query->where('status',1);
//                }
//            })
//            ->where(function ($query) use ($fullName){
//                if(isset($fullName) && $fullName){
//                    $find = User::where('fullName',$fullName)->first();
//                    if($find){
//                        $query->where('userId',$find->id);
//                    }
//                }
//            })
//            ->where(function ($query) use ($amount){
//                if(isset($amount) && $amount){
//                    $query->where('amount',$amount);
//                }
//            })
//            ->where(function ($query) use ($pay_online_id){
//                if(isset($pay_online_id) && $pay_online_id){
//                    $query->where('pay_online_id',$pay_online_id);
//                }
//            })
//            ->where(function ($query) use ($rechargeType){
//                if(isset($rechargeType) && $rechargeType){
//                    $query->where('rechargeType',$rechargeType);
//                }
//            })
//            ->where(function ($query) use ($payType,$isSearch){
//                if($isSearch == 'yes'){
//                    if(isset($payType) && $payType){
//                        $query->where('payType',$payType);
//                    }
//                } else {
//                    $query->where('payType','!=','onlinePayment')->where('payType','!=','adminAddMoney');
//                }
//            })
//            ->where(function ($query) use ($account_type,$account_param){
//                if(isset($account_type) && $account_type && isset($account_param) && $account_param){
//                    if($account_type == 'account'){
//                        $query->where('username',$account_param);
//                    }
//                    if($account_type == 'orderNum'){
//                        $query->where('orderNum',$account_param);
//                    }
//                    if($account_type == 'operation_account'){
//                        $query->where('operation_account',$account_param);
//                    }
//                }
//            })
//            ->where(function ($query) use ($startTime,$endTime) {
//                if(isset($startTime) && $startTime || isset($endTime) && $endTime){
//                    $query->whereBetween('created_at',[$startTime, $endTime]);
//                }
//            })
//        ->orderBy('created_at','desc')->get();
        $payType = $request->get('recharge_type');

        $recharge = Recharges::select()
            ->where(function ($q) use ($payType) {
                if(isset($payType) && $payType){
                    $q->where('payType',$payType);
                } else {
                    $q->where('payType','!=','onlinePayment');
                }
            })
            ->orderBy('created_at','desc')->get();

        return DataTables::of($recharge)
            ->editColumn('created_at',function ($recharge){
                return date('m/d H:i',strtotime($recharge->created_at));
            })
            ->editColumn('process_date',function ($recharge){
                if($recharge->process_date !== null){
                    return date('m/d H:i',strtotime($recharge->process_date));
                } else {
                    return "--";
                }
            })
            ->editColumn('user',function ($recharge){
                return $recharge->username;
            })
            ->editColumn('trueName',function ($recharge){
                $userInfo = User::where('id',$recharge->userId)->first();
                if($userInfo){
                    return $userInfo->fullName;
                } else {
                    return "<span class='red-text'>用户已不存在</span>";
                }
            })
            ->editColumn('balance',function ($recharge){
                $userInfo = User::where('id',$recharge->userId)->first();
                if($userInfo){
                    return $userInfo->money;
                } else {
                    return "--";
                }
            })
            ->editColumn('payType',function ($recharge){
                if($recharge->payType == 'onlinePayment'){
                    return "在线支付";
                }
                if($recharge->payType == 'bankTransfer'){
                    return "银行汇款";
                }
                if($recharge->payType == 'weixin'){
                    return "微信转账";
                }
                if($recharge->payType == 'alipay'){
                    return "支付宝转账";
                }
                if($recharge->payType == 'cft'){
                    return "财付通转账";
                }
                if($recharge->payType == 'adminAddMoney'){
                    return "后台加钱";
                }
            })
            ->editColumn('amount',function ($recharge){
                return "<b class='red-text'>$recharge->amount</b>";
            })
            ->editColumn('operation_account',function ($recharge){
                if($recharge->operation_account == ""){
                    return "--";
                } else {
                    return $recharge->operation_account;
                }
            })
            ->editColumn('shou_info',function ($recharge){
                return $recharge->shou_info;
            })
            ->editColumn('ru_info',function ($recharge){
                return $recharge->ru_info;
            })
            ->editColumn('status',function ($recharge){
                switch ($recharge->status){
                    case 1:
                        return "<b class='gary-text'>未受理</b>";
                        break;
                    case 2:
                        return "<b class='green-text'>充值成功</b>";
                        break;
                    case 3:
                        return '<b class="red-text">充值失败</b> <span class="tips-icon"><i data-tooltip="'.$recharge->msg.'" data-position="left center" data-inverted class="iconfont">&#xe61e;</i></span>';
                        break;
                    case 4:
                        return "<b class='blue-text'>充值中</b>";
                        break;
                }
            })
            ->editColumn('control',function ($recharge){
                if($recharge->payType == 'onlinePayment' || $recharge->payType == 'adminAddMoney'){
                    return "<span class='light-gary-text'>通过 | 驳回</span>";
                } else {
                    if($recharge->status == 2 || $recharge->status == 3){
                        return "<span class='light-gary-text'>通过 | 驳回</span>";
                    } else {
                        return '<span class="hover-black" onclick="pass(\''.$recharge->id.'\')">通过</span> | <span class="hover-black" onclick="error(\''.$recharge->id.'\')">驳回</span>';
                    }
                }
            })
            ->rawColumns(['amount','shou_info','ru_info','status','control','trueName'])
            ->make(true);
    }
    
    //提款记录
    public function drawingRecord()
    {
        $drawing = Drawing::select()->orderBy('created_at','desc')->get();
        return DataTables::of($drawing)
            ->editColumn('created_at',function ($drawing){
                return date('m/d H:i',strtotime($drawing->created_at));
            })
            ->editColumn('process_date',function ($drawing){
                if($drawing->process_date){
                    return date('m/d H:i',strtotime($drawing->process_date));
                } else {
                    return '--';
                }
            })
            ->editColumn('rechLevel',function ($drawing){
               $getUserInfo = DB::table('users')->where('id',$drawing->user_id)->first();
               if($getUserInfo){
                   $levels = Levels::where('value',$getUserInfo->rechLevel)->first();
                    return  "<a href='javascript:void(0)' onclick='editLevels(\"$drawing->user_id\",\"$getUserInfo->rechLevel\")' class='allow-edit'>$levels->name <i class='iconfont'>&#xe715;</i></a>";
               } else {
                   return '用户已被删除';
               }
            })
            ->editColumn('amount',function ($drawing){
                return '<span class="red-text">'.$drawing->amount.'</span>';
            })
            ->editColumn('bank_info',function ($drawing){
                $userInfo = DB::table('users')->where('id',$drawing->user_id)->first();
                if($userInfo){
                    return '<div style="text-align: center">姓名：'.$userInfo->fullName.'</br>银行：'.$userInfo->bank_name.'<br>账号：'.$userInfo->bank_num.'<br>地址：'.$userInfo->bank_addr.'</div>';
                } else {
                    return '';
                }
            })
            ->editColumn('liushui',function ($drawing){
                return '--';
            })
            ->editColumn('ip_info',function ($drawing){
                return "<span data-tooltip='$drawing->ip_info' data-inverted><i class='iconfont'>&#xe627;</i> $drawing->ip</span>";
            })
            ->editColumn('draw_type',function ($drawing){
                if($drawing->draw_type == 1){
                    return '手动出款';
                } else {
                    return '自动出款';
                }
            })
            ->editColumn('status',function ($drawing){
                if($drawing->status == 0){
                    return '<span class="orange-text">未受理</span>';
                } else if($drawing->status == 1) {
                    return '<span class="blue-text">处理中</span>';
                } else if($drawing->status == 2) {
                    return '<span class="green-text"><b>通过</b></span>';
                } else if($drawing->status == 3) {
                    return '<span class="red-text"><b>不通过</b></span> <span class="tips-icon"><i data-position="left center" data-tooltip="'.$drawing->msg.'" data-inverted class="iconfont">&#xe61e;</i></span>';
                } else if($drawing->status == 3) {
                    return '锁定';
                }
            })
            ->editColumn('platform',function ($drawing){
                if($drawing->platform == 1){
                    return '电脑端';
                }
                if($drawing->platform == 2){
                    return '手机端';
                }
            })
            ->editColumn('control',function ($drawing){
                if($drawing->status == 2 || $drawing->status == 3){
                    return "<span class='light-gary-text'>通过 | 驳回</span>";
                } else {
                    return '<span class="hover-black" onclick="pass(\''.$drawing->id.'\')">通过</span> | <span class="hover-black" onclick="error(\''.$drawing->id.'\')">驳回</span>';
                }
            })
            ->rawColumns(['rechLevel','amount','bank_info','status','control','ip_info'])
            ->make(true);
    }
    
    //资金明细
    public function capitalDetails()
    {
        $capital = Capital::all();
        return DataTables::of($capital)
            ->make(true);
    }
    
    //会员对账
    public function memberReconciliation()
    {
        $userRecon = UserRecon::all();
        return DataTables::of($userRecon)
            ->make(true);
    }
    
    //代理对账
    public function agentReconciliation()
    {
        $agentRecon = AgentRecon::all();
        return DataTables::of($agentRecon)
            ->make(true);
    }
}
