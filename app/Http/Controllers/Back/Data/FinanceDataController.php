<?php

namespace App\Http\Controllers\Back\Data;

use App\AgentRecon;
use App\BetHis;
use App\Bets;
use App\Capital;
use App\Drawing;
use App\Levels;
use App\PayOnlineNew;
use App\Recharges;
use App\User;
use App\UserFreezeMoney;
use App\UserRecon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Artisan;

class FinanceDataController extends Controller
{
    //12-20 备用
//    public function rechargeRecord(Request $request)
//    {
//        $findUserId = '';
//        $killTestUser = $request->get('killTestUser');
//        $payType = $request->get('recharge_type'); //自动收款
//        $recharges_id = $request->get('recharges_id');
//        $startTime = $request->get('startTime');
//        $endTime = $request->get('endTime');
//        $account_type = $request->get('account_type');
//        $account_param = $request->get('account_param');
//        $status = $request->get('status');
//        $pay_online_id = $request->get('pay_online_id');
//        $amount = (int)$request->get('amount');
//        $fullName = $request->get('fullName');
//        $start = $request->get('start');
//        $length = $request->get('length');
//        $rechargeType = $request->get('rechargeType'); //收款方式
//        $dateType = $request->get('dateType');//时间类型
//        if($fullName && isset($fullName)){
//            $findUserId = DB::table('users')->where('fullName',$fullName)->first();
//        }
//
//        $sql = ' from recharges WHERE 1 ';
//        $where = '';
//        if(isset($killTestUser) && $killTestUser){
//            $where .= ' and testFlag = 0 ';
//        }else{
//            $where .= ' and testFlag in (0,2) ';
//        }
//        if(isset($pay_online_id) && $pay_online_id){
//            $where .= ' and recharges.pay_online_id = '.$pay_online_id;
//        }
//        if(isset($amount) && $amount){
//            $where .= ' and recharges.amount = '.$amount;
//        }
//        if(isset($findUserId) && $findUserId){
//            $where .= ' and recharges.userId = '.$findUserId->id;
//        }
//        if(isset($rechargeType))
//            $where .= ' and recharges.rechargeType = '.$rechargeType;
//        if(isset($account_param) && $account_param){
//            if($account_type == 'account'){
//                $where .= " and recharges.username = '".$account_param."'";
//            }else if($account_type == 'orderNum'){
//                $where .= " and recharges.orderNum = '".$account_param."'";
//            }else if($account_type == 'operation_account'){
//                $where .= " and recharges.operation_account = '".$account_param."'";
//            }else if($account_type == 'sysOrderNum'){
//                $where .= " and recharges.sysPayOrder = '".$account_param."'";
//            }
//        }
//        $dateTypeName = 'updated_at';
//        if(isset($dateType) && $dateType == 1){//报表时间
//            $dateTypeName = 'updated_at';
//        }else if(isset($dateType) && $dateType == 2){
//            $dateTypeName = 'created_at';
//        }
//        if(isset($startTime) && $startTime){
//            $where .= " and recharges.{$dateTypeName} >= '".$startTime." 00:00:00'";
//        }
//        if(isset($endTime) && $endTime){
//            $where .= " and recharges.{$dateTypeName} <= '".$endTime." 23:59:59'";
//        }
//        if(empty($startTime) && empty($endTime))
//            $where .= " and recharges.updated_at = now() ";
////        $whereStaus = '';
//
//        if(empty($findUserId) && empty($account_param)){
//            if(isset($status) && $status){
//                $whereStaus = ' and recharges.status = '.$status;
//                Session::put('recharge_report_status',$status);
//            }else{
//                $whereStaus = ' and recharges.status in (1,2,3)';
//                Session::put('recharge_report_status',2);
//            }
//            if(isset($payType) && $payType){
//                $where .= " and recharges.payType = '".$payType."'";
//            }else{
//                $where .= " and recharges.payType in ('bankTransfer' , 'alipay', 'weixin', 'cft')";
//            }
//            if(isset($recharges_id) && $recharges_id > 0 ){
//                $where .= " and recharges.admin_add_money = ".$recharges_id."";
//            }
//        }else{
//            if(isset($status) && $status){
//                $whereStaus = ' and recharges.status = '.$status;
//                Session::put('recharge_report_status',$status);
//            }else{
//                $whereStaus = ' and recharges.status in (1,2,3,4)';
//                Session::put('recharge_report_status',2);
//            }
//        }
//        $sql1 = 'SELECT userId as uid,recharges.id as rid,recharges.created_at as re_created_at,recharges.levels as re_levels,recharges.process_date as re_process_date,recharges.username as re_username,recharges.userId as userId,fullName as user_fullName,balance as user_money,recharges.payType as re_payType,recharges.amount as re_amount,rebate_or_fee,recharges.operation_account as re_operation_account,recharges.shou_info as re_shou_info,recharges.ru_info as re_ru_info,recharges.status as re_status,recharges.msg as re_msg,recharges.orderNum as re_orderNum,recharges.sysPayOrder as re_sysPayOrder,recharges.balance as re_balance,levels as user_rechLevel,level_name as level_name '.$sql.$where .$whereStaus. ' order by recharges.created_at desc ';
//        $aSqlCount = 'select count(recharges.id) AS count '.$sql.$where .$whereStaus;
//        Session::put('recharge_report',$where);
//        $recharge = DB::select($sql1 ." LIMIT ".$start.','.$length);
//        $rechargeCount = DB::select($aSqlCount);
//
//        return DataTables::of($recharge)
//            ->editColumn('created_at',function ($recharge){
//                return date('m/d H:i',strtotime($recharge->re_created_at));
//            })
//            ->editColumn('process_date',function ($recharge){
//                if($recharge->re_process_date !== null){
//                    return date('m/d H:i',strtotime($recharge->re_process_date));
//                } else {
//                    return "--";
//                }
//            })
//            ->editColumn('orderNum',function ($recharge){
//                return $recharge->re_orderNum;
//            })
//            ->editColumn('user',function ($recharge){
//                return '<span onclick="copyText(this)">'.$recharge->re_username.'</span><span> (<b>'.$recharge->level_name.'</b> <i style="cursor:pointer;" onclick="editLevels(\''.$recharge->uid.'\',\''.$recharge->re_levels.'\',\''.$recharge->rid.'\')" class="iconfont">&#xe602;</i>)</span>';
//            })
//            ->editColumn('trueName',function ($recharge){
//                return $recharge->user_fullName;
//            })
//            ->editColumn('balance',function ($recharge){
//                return $recharge->re_balance;
//            })
//            ->editColumn('payType',function ($recharge){
//                if($recharge->re_payType == 'onlinePayment'){
//                    return "在线支付";
//                }
//                if($recharge->re_payType == 'bankTransfer'){
//                    return "银行汇款";
//                }
//                if($recharge->re_payType == 'weixin'){
//                    return "微信转账";
//                }
//                if($recharge->re_payType == 'alipay'){
//                    return "支付宝转账";
//                }
//                if($recharge->re_payType == 'cft'){
//                    return "财付通转账";
//                }
//                if($recharge->re_payType == 'adminAddMoney'){
//                    return "后台加钱";
//                }
//            })
//            ->editColumn('amount',function ($recharge){
//                return "<b class='red-text'>$recharge->re_amount</b>";
//            })
//            ->editColumn('operation_account',function ($recharge){
//                if($recharge->re_operation_account == ""){
//                    return "--";
//                } else {
//                    return $recharge->re_operation_account;
//                }
//            })
//            ->editColumn('shou_info',function ($recharge){
//                return $recharge->re_shou_info;
//            })
//            ->editColumn('ru_info',function ($recharge){
//                return $recharge->re_ru_info;
//            })
//            ->editColumn('status',function ($recharge){
//                switch ($recharge->re_status){
//                    case 1:
//                        return "<b class='gary-text'>未受理</b>";
//                        break;
//                    case 2:
//                        return "<b class='green-text'>充值成功</b>";
//                        break;
//                    case 3:
//                        return '<b class="red-text">充值失败</b> <span class="tips-icon"><i data-tooltip="'.$recharge->re_msg.'" data-position="left center" data-inverted class="iconfont">&#xe61e;</i></span>';
//                        break;
//                    case 4:
//                        return "<b class='blue-text'>充值中</b>";
//                        break;
//                }
//            })
//            ->editColumn('control',function ($recharge){
//                if($recharge->re_payType == 'adminAddMoney') {
//                    return "<span class='light-gary-text'>通过 | 驳回</span>";
//                } else {
//                    if($recharge->re_status == 2 || $recharge->re_status == 3){
//                        return "<span class='light-gary-text'>通过 | 驳回</span>";
//                    } else if($recharge->re_status == 4) {
//                        return '<span class="hover-black" onclick="errorOnlinePay(\''.$recharge->rid.'\')">驳回</span>';
//                    } else {
//                        return '<span class="hover-black" onclick="pass(\''.$recharge->rid.'\')">通过</span> | <span class="hover-black" onclick="error(\''.$recharge->rid.'\')">驳回</span>';
//                    }
//                }
//            })
//            ->rawColumns(['amount','shou_info','ru_info','status','control','trueName','user'])
//            ->setTotalRecords($rechargeCount[0]->count)
//            ->skipPaging()
//            ->make(true);
//    }
    //充值记录
    public function rechargeRecord(Request $request)
    {
        $findUserId = '';
        $killTestUser = $request->get('killTestUser');
        $payType = $request->get('recharge_type'); //自动收款
        $recharges_id = $request->get('recharges_id');
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $account_type = $request->get('account_type');
        $account_param = $request->get('account_param');
        $status = $request->get('status');
        $pay_online_id = $request->get('pay_online_id');
        $amount = (int)$request->get('amount');
        $fullName = $request->get('fullName');
        $start = $request->get('start');
        $length = $request->get('length');
        $rechargeType = $request->get('rechargeType'); //收款方式
        $dateType = $request->get('dateType');//时间类型
        if($fullName && isset($fullName)){
            $findUserId = DB::table('users')->where('fullName',$fullName)->first();
        }

        $sql = ' from recharges
              JOIN users on recharges.userId = users.id LEFT JOIN level on level.value = recharges.levels WHERE 1 ';
        $where = '';
        if(isset($killTestUser) && $killTestUser){
            $where .= ' and users.testFlag = 0 ';
        }else{
            $where .= ' and users.testFlag in (0,2) ';
        }
        if(isset($pay_online_id) && $pay_online_id){
            $where .= ' and recharges.pay_online_id = '.$pay_online_id;
        }
        if(isset($amount) && $amount){
            $where .= ' and recharges.amount = '.$amount;
        }
        if(isset($findUserId) && $findUserId){
            $where .= ' and recharges.userId = '.$findUserId->id;
        }
        if(isset($rechargeType))
            $where .= ' and recharges.rechargeType = '.$rechargeType;
        if(isset($account_param) && $account_param){
            if($account_type == 'account'){
                $where .= " and recharges.username = '".$account_param."'";
            }else if($account_type == 'orderNum'){
                $where .= " and recharges.orderNum = '".$account_param."'";
            }else if($account_type == 'operation_account'){
                $where .= " and recharges.operation_account = '".$account_param."'";
            }else if($account_type == 'sysOrderNum'){
                $where .= " and recharges.sysPayOrder = '".$account_param."'";
            }
        }
        $dateTypeName = 'updated_at';
        if(isset($dateType) && $dateType == 1){//报表时间
            $dateTypeName = 'updated_at';
        }else if(isset($dateType) && $dateType == 2){
            $dateTypeName = 'created_at';
        }
        if(isset($startTime) && $startTime){
            $where .= " and recharges.{$dateTypeName} >= '".$startTime." 00:00:00'";
        }
        if(isset($endTime) && $endTime){
            $where .= " and recharges.{$dateTypeName} <= '".$endTime." 23:59:59'";
        }
        if(empty($startTime) && empty($endTime))
            $where .= " and recharges.updated_at = now() ";
//        $whereStaus = '';

        if(empty($findUserId) && empty($account_param)){
            if(isset($status) && $status){
                $whereStaus = ' and recharges.status = '.$status;
                Session::put('recharge_report_status',$status);
            }else{
                $whereStaus = ' and recharges.status in (1,2,3)';
                Session::put('recharge_report_status',2);
            }
            if(isset($payType) && $payType){
                $where .= " and recharges.payType = '".$payType."'";
            }else{
                $where .= " and recharges.payType in ('bankTransfer' , 'alipay', 'weixin', 'cft')";
            }
            if(isset($recharges_id) && $recharges_id > 0 ){
                $where .= " and recharges.admin_add_money = ".$recharges_id."";
            }
        }else{
            if(isset($status) && $status){
                $whereStaus = ' and recharges.status = '.$status;
                Session::put('recharge_report_status',$status);
            }else{
                $whereStaus = ' and recharges.status in (1,2,3,4)';
                Session::put('recharge_report_status',2);
            }
        }
        $sql1 = 'SELECT users.id as uid,recharges.id as rid,recharges.created_at as re_created_at,recharges.levels as re_levels,recharges.process_date as re_process_date,recharges.username as re_username,recharges.userId as userId,users.fullName as user_fullName,users.money as user_money,recharges.payType as re_payType,recharges.amount as re_amount,rebate_or_fee,recharges.operation_account as re_operation_account,recharges.shou_info as re_shou_info,recharges.ru_info as re_ru_info,recharges.status as re_status,recharges.msg as re_msg,recharges.orderNum as re_orderNum,recharges.sysPayOrder as re_sysPayOrder,recharges.balance as re_balance,users.rechLevel as user_rechLevel,level.name as level_name '.$sql.$where .$whereStaus. ' order by recharges.created_at desc ';
        $aSqlCount = 'select count(recharges.id) AS count '.$sql.$where .$whereStaus;
        Session::put('recharge_report',$where);
        $recharge = DB::select($sql1 ." LIMIT ".$start.','.$length);
        $rechargeCount = DB::select($aSqlCount);

        return DataTables::of($recharge)
            ->editColumn('created_at',function ($recharge){
                return date('m/d H:i',strtotime($recharge->re_created_at));
            })
            ->editColumn('process_date',function ($recharge){
                if($recharge->re_process_date !== null){
                    return date('m/d H:i',strtotime($recharge->re_process_date));
                } else {
                    return "--";
                }
            })
            ->editColumn('orderNum',function ($recharge){
                return $recharge->re_orderNum;
            })
            ->editColumn('user',function ($recharge){
                return '<span onclick="copyText(this)">'.$recharge->re_username.'</span><span> (<b>'.$recharge->level_name.'</b> <i style="cursor:pointer;" onclick="editLevels(\''.$recharge->uid.'\',\''.$recharge->re_levels.'\',\''.$recharge->rid.'\')" class="iconfont">&#xe602;</i>)</span>';
            })
            ->editColumn('trueName',function ($recharge){
                return $recharge->user_fullName;
            })
            ->editColumn('balance',function ($recharge){
                return $recharge->re_balance;
            })
            ->editColumn('payType',function ($recharge){
                if($recharge->re_payType == 'onlinePayment'){
                    return "在线支付";
                }
                if($recharge->re_payType == 'bankTransfer'){
                    return "银行汇款";
                }
                if($recharge->re_payType == 'weixin'){
                    return "微信转账";
                }
                if($recharge->re_payType == 'alipay'){
                    return "支付宝转账";
                }
                if($recharge->re_payType == 'cft'){
                    return "财付通转账";
                }
                if($recharge->re_payType == 'adminAddMoney'){
                    return "后台加钱";
                }
            })
            ->editColumn('amount',function ($recharge){
                return "<b class='red-text' onclick='copyText(this)'>$recharge->re_amount</b>";
            })
            ->editColumn('operation_account',function ($recharge){
                if($recharge->re_operation_account == ""){
                    return "--";
                } else {
                    return $recharge->re_operation_account;
                }
            })
            ->editColumn('shou_info',function ($recharge){
                return $recharge->re_shou_info;
            })
            ->editColumn('ru_info',function ($recharge){
                return $recharge->re_ru_info;
            })
            ->editColumn('status',function ($recharge){
                switch ($recharge->re_status){
                    case 1:
                        return "<b class='gary-text'>未受理</b>";
                        break;
                    case 2:
                        return "<b class='green-text'>充值成功</b>";
                        break;
                    case 3:
                        return '<b class="red-text">充值失败</b> <span class="tips-icon"><i data-tooltip="'.$recharge->re_msg.'" data-position="left center" data-inverted class="iconfont">&#xe61e;</i></span>';
                        break;
                    case 4:
                        return "<b class='blue-text'>充值中</b>";
                        break;
                }
            })
            ->editColumn('control',function ($recharge){
                if($recharge->re_payType == 'adminAddMoney') {
                    return "<span class='light-gary-text'>通过 | 驳回</span>";
                } else {
                    if($recharge->re_status == 2 || $recharge->re_status == 3){
                        return "<span class='light-gary-text'>通过 | 驳回</span>";
                    } else if($recharge->re_status == 4) {
                        if(in_array('ac.ad.passOnlineRecharge',$this->permissionArray))
                            return '<span class="hover-black" onclick="errorOnlinePay(\''.$recharge->rid.'\')">驳回</span>';
                        return '';
                    } else {
                        $str = '';
                        if(in_array('ac.ad.passRecharge',$this->permissionArray))
                            $str .= '<span class="hover-black" onclick="pass(\''.$recharge->rid.'\')">通过</span>';
                        if(in_array('ac.ad.addRechargeError',$this->permissionArray))
                            $str .= '| <span class="hover-black" onclick="error(\''.$recharge->rid.'\')">驳回</span>';
                        return $str;
//                        return '<span class="hover-black" onclick="pass(\''.$recharge->rid.'\')">通过</span>
//                                | <span class="hover-black" onclick="error(\''.$recharge->rid.'\')">驳回</span>';
                    }
                }
            })
            ->rawColumns(['amount','shou_info','ru_info','status','control','trueName','user'])
            ->setTotalRecords($rechargeCount[0]->count)
            ->skipPaging()
            ->make(true);
    }
    
    //提款记录
    public function drawingRecord(Request $request)
    {
        $killTestUser = $request->get('killTestUser');
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $status = $request->get('status');
        $account_type = $request->get('account_type');
        $account_param = $request->get('account_param');
        $draw_type = $request->get('draw_type');
        $rechLevel = $request->get('rechLevel');
        $dateType = $request->get('dateType');//时间类型
        $start = $request->get('start');
        $length = $request->get('length');

        $drawingSQL = DB::table('drawing')
            ->leftJoin('users','drawing.user_id', '=', 'users.id')
            ->leftJoin('level','drawing.levels', '=', 'level.value')
            ->select('drawing.created_at as dr_created_at','drawing.bank_name as dr_bank_name','drawing.fullName as dr_fullName','drawing.bank_num as dr_bank_num','drawing.bank_addr as dr_bank_addr','drawing.process_date as dr_process_date','users.rechLevel as user_rechLevel','drawing.user_id as dr_uid','drawing.amount as dr_amount','users.fullName as user_fullName','users.bank_name as user_bank_name','users.bank_num as user_bank_num','users.bank_addr as user_bank_addr','drawing.fullName as draw_fullName','drawing.levels as levels','drawing.bank_name as draw_bank_name','drawing.bank_num as draw_bank_num','drawing.bank_addr as draw_bank_addr','drawing.ip_info as dr_ip_info','drawing.ip as dr_ip','drawing.draw_type as dr_draw_type','drawing.status as dr_status','drawing.msg as dr_msg','drawing.platform as dr_platform','drawing.id as dr_id','users.username as user_username','drawing.balance as dr_balance','drawing.order_id as dr_order_id','drawing.operation_account as dr_operation_account','level.name as level_name','users.DrawTimes as user_DrawTimes','drawing.total_bet as dr_total_bet')
            ->where(function ($q) use ($killTestUser){
                if(isset($killTestUser) && $killTestUser){
                    $q->where('users.agent','!=',2);
                }
            })
            ->where(function ($q) use ($status){
                if(isset($status) && $status){
                    if($status == 'no'){
                        $q->where('drawing.status',0);
                    } else {
                        $q->where('drawing.status',$status);
                    }
                }
            })
            ->where(function ($q) use ($draw_type){
                if(isset($draw_type) && $draw_type!=''){
                    $q->where('drawing.draw_type',$draw_type);
                }
            })
            ->where(function ($q) use ($rechLevel,$account_param,$account_type){
                if(isset($rechLevel) && $rechLevel!=''){
                    $q->where('users.rechLevel',$rechLevel);
                    if(!(isset($account_param) && $account_type == 'account')){
                        //如果没有指定用户搜索的话只顯示用戶當前層級的提款
//                        $usersLevel = Drawing::getUsersLevel();
//                        $str = "";
//                        foreach ($usersLevel as $k=>$v){
//                            if($v->id)
//                                $str .= "WHEN `drawing`.`user_id` = {$v->id} THEN `levels` = ".($v->rechLevel ?? 0).' ';
//                        }
//                        $q->whereRaw("CASE {$str} END");
                        $q->where('drawing.levels', $rechLevel);
                    }
                }
            })
            ->where(function ($q) use ($account_type, $account_param, $request){
                if(isset($account_param) && $account_param){
                    if($account_type == 'account'){
                        $q->where('drawing.username',$account_param);
                    }
                    if($account_type == 'orderNum'){
                        $q->where('drawing.order_id',$account_param);
                    }
                    if($account_type == 'operation_account'){
                        $q->where('drawing.operation_account',$account_param);
                    }
                    if($account_type == 'amount'){
                        $q->where('drawing.amount',$account_param);
                    }
                }
                if(isset($account_type) && $account_type == 'amount_fw'){
                    if(($min = (int) $request->get('amount_min')) && ($max = $request->get('amount_max'))){
                        $q->whereBetween('drawing.amount',[$min, $max]);
                    }
                }
            })
            ->where(function ($q) use ($startTime,$endTime,$dateType) {
                $dateTypeName = 'created_at';
                if(isset($dateType) && $dateType == 1){//报表时间
                    $dateTypeName = 'updated_at';
                }else if(isset($dateType) && $dateType == 2){//添加时间
                    $dateTypeName = 'created_at';
                }
                if(isset($startTime) && $startTime || isset($endTime) && $endTime){
                    $q->whereBetween('drawing.'.$dateTypeName,[$startTime.' 00:00:00', $endTime.' 23:59:59']);
                } else {
                    $q->whereDate('drawing.'.$dateTypeName,date('Y-m-d'));
                }
            })
            ->orderBy('drawing.created_at','desc')->orderBy('drawing.id','desc');
        $drawingCount = $drawingSQL->count();
        $drawing = $drawingSQL->skip($start)->take($length)->get();
        $aPayOnlineNew = PayOnlineNew::select('levels','rechName','id')->where('payCode','DF')->where('status',1)->get()->toArray();
        return DataTables::of($drawing)
            ->editColumn('created_at',function ($drawing){
                return date('m/d H:i',strtotime($drawing->dr_created_at));
            })
            ->editColumn('username',function ($drawing){
                return '<span onclick="copyText(this)">'.$drawing->user_username.'</span></br><span class="blue-text" style="font-weight: normal;cursor: pointer;" onclick="showUserInfo(\''.$drawing->dr_uid.'\','.$drawing->dr_id.')">资金详情</span>';
            })
            ->editColumn('balance',function ($drawing){
                return $drawing->dr_balance;
            })
            ->editColumn('total_bet',function ($drawing){
                return "<a href='/back/control/userManage/userBetList/$drawing->dr_uid' target='_blank'>".$drawing->dr_total_bet."</a>";
            })
            ->editColumn('total_draw',function ($drawing){
                return $drawing->user_DrawTimes;
            })
            ->editColumn('order_id',function ($drawing){
                return $drawing->dr_order_id;
            })
            ->editColumn('operation_account',function ($drawing){
                return $drawing->dr_operation_account;
            })
            ->editColumn('process_date',function ($drawing){
                if($drawing->dr_process_date){
                    return date('m/d H:i',strtotime($drawing->dr_process_date));
                } else {
                    return '--';
                }
            })
            ->editColumn('rechLevel',function ($drawing){
                return '<b>'.$drawing->level_name.'</b> <i style="cursor:pointer;" onclick="editLevels(\''.$drawing->dr_uid.'\',\''.$drawing->user_rechLevel.'\',\''.$drawing->dr_id.'\')" class="iconfont">&#xe602;</i></span>';
            })
            ->editColumn('amount',function ($drawing){
                return '<span class="red-text" onclick="copyText(this)" style="font-size: 12pt;">'.$drawing->dr_amount.'</span>';
            })
            ->editColumn('bank_info',function ($drawing){
                return '<div style="text-align: center">姓名：<span onclick="copyText(this)">'.(empty($drawing->dr_fullName)?$drawing->user_fullName:$drawing->dr_fullName).'</span></br>银行：<span onclick="copyText(this)">'.(empty($drawing->dr_bank_name)?$drawing->user_bank_name:$drawing->dr_bank_name).'</span><br>账号：<span onclick="copyText(this)">'.(empty($drawing->dr_bank_num)?$drawing->user_bank_num:$drawing->dr_bank_num).'</span><br>地址：<span onclick="copyText(this)">'.(empty($drawing->dr_bank_addr)?$drawing->user_bank_addr:$drawing->dr_bank_addr).'</span></div>';
            })
            ->editColumn('liushui',function ($drawing){
                return '-';
            })
            ->editColumn('ip_info',function ($drawing){
                if($drawing->dr_draw_type == 2){
                    return '-';
                } else {
                    return "<span><i class='iconfont'>&#xe627;</i> $drawing->dr_ip</span></br><span>$drawing->dr_ip_info<span  class=\"refreshIp\"  onclick='refreshIp({$drawing->dr_id},\"{$drawing->dr_ip}\", this)' >刷新</span></span>";
                }
            })
            ->editColumn('draw_type',function ($drawing){
                if($drawing->dr_draw_type == 1){
                    return '手动出款';
                } else if($drawing->dr_draw_type == 2) {
                    return '后台扣钱';
                } else {
                    return '自动出款';
                }
            })
            ->editColumn('status',function ($drawing){
                $txt = '';
                if($drawing->dr_status == 0){
                    $txt .= '<span class="orange-text">未受理</span>';
                } else if($drawing->dr_status == 1) {
                    $txt .= '<span class="blue-text">处理中</span>';
                } else if($drawing->dr_status == 2) {
                    $txt .= '<span class="green-text"><b>通过</b></span>';
                } else if($drawing->dr_status == 3) {
                    $txt .= '<span class="red-text"><b>不通过</b></span> ';
                } else if($drawing->dr_status == 3) {
                    $txt .= '锁定';
                }
                if($drawing->dr_msg != '') {
                $txt .= '<span class="tips-icon"><i data-position="left center" data-tooltip="'.$drawing->dr_msg.'" data-inverted class="iconfont">&#xe61e;</i></span>';
                }
                return $txt;
            })
            ->editColumn('platform',function ($drawing){
                if($drawing->dr_platform == 1){
                    return '电脑端';
                }
                if($drawing->dr_platform == 2){
                    return '手机端';
                }
                if($drawing->dr_platform == 3){
                    return 'IOS';
                }
                if($drawing->dr_platform == 4){
                    return 'Android';
                }
                if($drawing->dr_platform == 5){
                    return '其它';
                }
            })
            ->editColumn('control',function ($drawing) use ($aPayOnlineNew){
                if($drawing->dr_status == 2 || $drawing->dr_status == 3){
                    return "<span class='light-gary-text'>通过 | 驳回</span>";
                }elseif($drawing->dr_status == 1){
                    return '<span class="hover-black" onclick="passAuto(\''.$drawing->dr_id.'\')">通过</span> | <span class="hover-black" onclick="errorAuto(\''.$drawing->dr_id.'\')">驳回</span><br/>';
                } else {
                    $iHtml = '';
                    foreach ($aPayOnlineNew as $iPayOnlineNew)
                        if(in_array($drawing->levels,explode(',',$iPayOnlineNew['levels'])))
                            $iHtml .= ' <span class="hover-black" onclick="dispensing(\''.$drawing->dr_id.'\',\''.$iPayOnlineNew['id'].'\',\''.$iPayOnlineNew['rechName'].'\')">'.$iPayOnlineNew['rechName'].'</span> |';
                    $str = '';
                    if(in_array('ac.ad.passDrawing',$this->permissionArray))
                        $str .= '<span class="hover-black" onclick="pass(\''.$drawing->dr_id.'\')">通过</span>';
                    if(in_array('ac.ad.addDrawingError',$this->permissionArray))
                        $str .= '| <span class="hover-black" onclick="error(\''.$drawing->dr_id.'\')">驳回</span><br/>';
                    return rtrim($str, '|').rtrim($iHtml,'|');
//                    return '<span class="hover-black" onclick="pass(\''.$drawing->dr_id.'\')">通过</span>
//                            | <span class="hover-black" onclick="error(\''.$drawing->dr_id.'\')">驳回</span><br/>'.rtrim($iHtml,'|');
                }
            })
            ->rawColumns(['rechLevel','amount','username','bank_info','status','control','ip_info','total_bet'])
            ->setTotalRecords($drawingCount)
            ->skipPaging()
            ->make(true);
    }
    
    //资金明细
    public function capitalDetails(Request $request)
    {
        $param = $request->all();
        $start = $request->get('start');
        $length = $request->get('length');
//        if(empty($param['account']))            //预设没有填用户的时候没有任何值
//            return array('draw'=>1,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>[]);
        /* 修改 */
        if(empty($param['account']) && !$param['type'])            //预设没有填用户的时候没有任何值
            return array('draw'=>1,'recordsTotal'=>0,'recordsFiltered'=>0,'data'=>[]);
        /* 修改end */
        if(isset($param['type']) && array_key_exists('type', $param)){
            if(in_array($param['type'],Capital::$includePlayTypeOption)){
                $aBetHis = '';
                $aBets = '';
                $aBetHisCount = 0;
                $aBetsCount = 0;
                if(strtotime($param['endTime']) >= strtotime(date('Y-m-d',strtotime('-1 day')))){
                    $aBetHis = BetHis::AssemblyFundDetails($param);
                    $aBetHisCount = $aBetHis->count();
                }
                if(strtotime($param['startTime']) < strtotime(date('Y-m-d',strtotime('-2 day')))) {
                    $aBets = Bets::AssemblyFundDetails($param);
                    $aBetsCount = $aBets->count();
                }
                if(empty($aBetHis) && !empty($aBets)){
                    $capital = $aBets->skip($start)->take($length)->get();
                }elseif(empty($aBets) && !empty($aBetHis)){
                    $capital = $aBetHis->skip($start)->take($length)->get();
                }else{
                    $capital = $aBets->union($aBetHis)->orderBy('created_at','desc')->skip($start)->take($length)->get();
                }
                $capitalCount = $aBetHisCount + $aBetsCount;
//                $capital = Bets::AssemblyFundDetails($param);
//                $capitalCount = $capital->count();
//                $capital = $capital->skip($start)->take($length)->get();
            }else if($param['type']=='t01'){        //充值
                $capital = Capital::AssemblyFundDetails_Rech($param);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
            }else if($param['type']=='t04'){        //返利/手续费
                $capital = Capital::AssemblyFundDetails($param);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
            }else if($param['type'] === 't15' || $param['type'] === 't17'){        //提现和提现失败
                $capital = Drawing::AssemblyFundDetails($param,$param['type']);
                $capitalCount = $capital->count();
                $capital = $capital->skip($start)->take($length)->get();
            }else{
                $capitalSql = Capital::AssemblyFundDetails($param);
                $capital = $capitalSql->orderBy('bet_id','desc')->skip($start)->take($length)->get();
                $capitalCount = $capitalSql->count();
            }
        }else {
            $capitalSql = Capital::AssemblyFundDetails($param);
            $betsSql = Bets::AssemblyFundDetails($param);
            $betHisSql = BetHis::AssemblyFundDetails($param);
            $RechSql = Capital::AssemblyFundDetails_Rech($param);
            $drawingSql = Drawing::AssemblyFundDetails($param);
            $capitalCount = $capitalSql->count() + $betsSql->count() + $betHisSql->count() + $RechSql->count() + $drawingSql->count();
            $capital = $capitalSql->union($RechSql)->union($betsSql)->union($betHisSql)->union($drawingSql)->orderBy('created_at','desc')->orderBy('bet_id','desc')->skip($start)->take($length);
        }
        $playTypeOptions = Capital::$playTypeOption;
        return DataTables::of($capital)
            ->editColumn('type',function ($capital) use ($playTypeOptions){
                if(strpos($capital->type,'t') === false) {
                    return $playTypeOptions['t05'];
                }
                return $playTypeOptions[$capital->type];
            })
            ->editColumn('game_name',function ($capital){
                if(empty($capital->game_name)){
                    return '-';
                }else{
                    return $capital->game_name;
                }
            })
            ->editColumn('money', function($capital){
                if($capital->type=='t05'){
                    if($capital->game_id>0){
                        if($capital->game_id ==90 || $capital->game_id ==91){
                            if($capital->nn_view_money < 0)
                                return '<span class="green-text">下注:'.$capital->nn_view_money.'</span>'.'<span class="gary-text">(冻结:'.$capital->freeze_money.')</span>'.'<span class="gary-text">(解冻:'.$capital->freeze_money.')</span>';
                            else
                                return '<span class="red-text">下注:'.$capital->nn_view_money.'</span>'.'<span class="gary-text">(冻结:'.$capital->freeze_money.')</span>'.'<span class="gary-text">(解冻:'.$capital->freeze_money.')</span>';
                        }else{
                            return '<span class="green-text">-'.$capital->money.'</span>';
                        }
                    }else{
                        if($capital->money < 0)
                        {
                            return '<span class="green-text">'.$capital->money.'</span>';
                        } else {
                            return '<span class="red-text">'.$capital->money.'</span>';
                        }
                    }
                }else{
                    return '<span class="red-text">'.$capital->money.'</span>';
                }
            })
            ->editColumn('balance',function ($capital){
                if(empty($capital->balance)){
                    return '-';
                }else{
                    return $capital->balance;
                }
            })
            ->editColumn('issue',function ($capital){
                if(empty($capital->issue)){
                    return '-';
                }else{
                    return $capital->issue;
                }
            })
            ->editColumn('account',function ($capital){
                if(empty($capital->account)){
                    return '-';
                }else{
                    return $capital->account;
                }
            })
            ->editColumn('content',function ($capital){
                if(empty($capital->content)){
                    return '-';
                }else{
                    if(empty($capital->content2))
                        return $capital->content;
                    else
                        return $capital->content2.'<br>'.$capital->content;
                }
            })
            ->editColumn('play_type',function ($capital){
                if(empty($capital->playcate_name)){
                    return '-';
                }else{
                    return $capital->playcate_name;
                }
            })
            ->rawColumns(['money','balance','content','issue'])
            ->setTotalRecords($capitalCount)
            ->skipPaging()
            ->make(true);
    }
    
    //会员对账执行
    public function memberReconciliation(Request $request)
    {
        $data = $request->all();
        $commandstr = 'Member:DailyReconTotal';
        $commandata = [
            'dayTime'=>$data['dayTime'],
            'user'=>$data['user']
        ];
        Artisan::call($commandstr,$commandata);

        return response()->json([
            'status'=>true,
            'msg'=>'执行成功'
        ]);
    }
    
    //代理对账
    public function agentReconciliation()
    {
//        $agentRecon = AgentRecon::all();
//        return DataTables::of($agentRecon)
//            ->make(true);
    }

    //用户冻结记录
    public function freezeRecord(Request $request){
        $aData = UserFreezeMoney::freezeRecord($request->all());
        return DataTables::of($aData['aData'])
            ->editColumn('user',function ($aData){
                return $aData->username.(empty($aData->fullName)?'':'('.$aData->fullName.')');
            })
            ->editColumn('status',function ($aData){
                return $aData->userFreezeMoneyStatus[$aData->status];
            })
            ->editColumn('control',function ($aData){
                return '<span class="edit-link" onclick="status(\''.$aData->id.'\')"> 解冻</span>';
            })
            ->rawColumns(['control'])
            ->setTotalRecords($aData['iCount'])
            ->skipPaging()
            ->make(true);
    }
}
