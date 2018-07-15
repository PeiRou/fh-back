<?php

namespace App\Http\Controllers\Back\Data;

use App\AgentRecon;
use App\Capital;
use App\Drawing;
use App\Levels;
use App\Recharges;
use App\User;
use App\UserRecon;
use function foo\func;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FinanceDataController extends Controller
{
    //充值记录
    public function rechargeRecord(Request $request)
    {
        $findUserId = '';
        $killTestUser = $request->get('killTestUser');
        $payType = $request->get('recharge_type');
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $account_type = $request->get('account_type');
        $account_param = $request->get('account_param');
        $status = $request->get('status');
        $pay_online_id = $request->get('pay_online_id');
        $amount = $request->get('amount');
        $fullName = $request->get('fullName');
        if($fullName && isset($fullName)){
            $findUserId = DB::table('users')->where('fullName',$fullName)->first();
        }

        $recharge = DB::table('recharges')
            ->leftJoin('users','recharges.userId', '=', 'users.id')
            ->select('users.id as uid','recharges.id as rid','recharges.created_at as re_created_at','recharges.process_date as re_process_date','recharges.username as re_username','recharges.userId as userId','users.fullName as user_fullName','users.money as user_money','recharges.payType as re_payType','recharges.amount as re_amount','recharges.operation_account as re_operation_account','recharges.shou_info as re_shou_info','recharges.ru_info as re_ru_info','recharges.status as re_status','recharges.msg as re_msg','recharges.orderNum as re_orderNum')
            ->where(function ($q) use ($killTestUser){
                if(isset($killTestUser) && $killTestUser){
                    $q->where('users.agent','!=',2);
                }
            })
            ->where(function ($q) use ($pay_online_id){
                if(isset($pay_online_id) && $pay_online_id){
                    $q->where('recharges.pay_online_id',$pay_online_id);
                }
            })
            ->where(function ($q) use ($amount){
                if(isset($amount) && $amount){
                    $q->where('recharges.amount',$amount);
                }
            })
            ->where(function ($q) use ($findUserId){
                if(isset($findUserId) && $findUserId){
                    $q->where('recharges.userId',$findUserId->id);
                }
            })
            ->where(function ($q) use ($status,$account_param){
                if(isset($status) && $status){
                    $q->where('recharges.status',$status);
                } else {
                    if($account_param == ""){
                        $q->where('recharges.status','!=',4);
                    }
                }
            })
            ->where(function ($q) use ($account_type, $account_param){
                if(isset($account_param) && $account_param){
                    if($account_type == 'account'){
                        $q->where('recharges.username',$account_param);
                    }
                    if($account_type == 'orderNum'){
                        $q->where('recharges.orderNum',$account_param);
                    }
                    if($account_type == 'operation_account'){
                        $q->where('recharges.operation_account',$account_param);
                    }
                }
            })
            ->where(function ($q) use ($payType,$account_type,$account_param) {
                if(isset($payType) && $payType){
                    $q->where('recharges.payType',$payType);
                } else {
                    if($account_param == ""){
                        $q->where('recharges.payType','!=','onlinePayment');
                    }
                }
            })
            ->where(function ($q) use ($startTime,$endTime) {
                if(isset($startTime) && $startTime || isset($endTime) && $endTime){
                    $q->whereBetween('recharges.created_at',[$startTime.' 00:00:00', $endTime.' 23:59:59']);
                } else {
                    $q->whereDate('recharges.created_at',date('Y-m-d'));
                }
            })
            ->orderBy('recharges.created_at','desc')->get();

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
                return $recharge->re_username;
            })
            ->editColumn('trueName',function ($recharge){
                return $recharge->user_fullName;
            })
            ->editColumn('balance',function ($recharge){
                return $recharge->user_money;
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
                return "<b class='red-text'>$recharge->re_amount</b>";
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
                        return '<span class="hover-black" onclick="errorOnlinePay(\''.$recharge->rid.'\')">驳回</span>';
                    } else {
                        return '<span class="hover-black" onclick="pass(\''.$recharge->rid.'\')">通过</span> | <span class="hover-black" onclick="error(\''.$recharge->rid.'\')">驳回</span>';
                    }
                }
            })
            ->rawColumns(['amount','shou_info','ru_info','status','control','trueName'])
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
        $rechLevel = $request->get('rechLevel');

        $drawing = DB::table('drawing')
            ->leftJoin('users','drawing.user_id', '=', 'users.id')
            ->leftJoin('level','users.rechLevel','=','level.value')
            ->select('drawing.created_at as dr_created_at','drawing.process_date as dr_process_date','users.rechLevel as user_rechLevel','drawing.user_id as dr_uid','drawing.amount as dr_amount','users.fullName as user_fullName','users.bank_name as user_bank_name','users.bank_num as user_bank_num','users.bank_addr as user_bank_addr','drawing.ip_info as dr_ip_info','drawing.ip as dr_ip','drawing.draw_type as dr_draw_type','drawing.status as dr_status','drawing.msg as dr_msg','drawing.platform as dr_platform','drawing.id as dr_id','users.username as user_username','drawing.balance as dr_balance','drawing.order_id as dr_order_id','drawing.operation_account as dr_operation_account','level.name as level_name','users.DrawTimes as user_DrawTimes')
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
            ->where(function ($q) use ($rechLevel){
                if(isset($rechLevel) && $rechLevel){
                    $q->where('users.rechLevel',$rechLevel);
                }
            })
            ->where(function ($q) use ($account_type, $account_param){
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
            })
            ->where(function ($q) use ($startTime,$endTime) {
                if(isset($startTime) && $startTime || isset($endTime) && $endTime){
                    $q->whereBetween('drawing.created_at',[$startTime.' 00:00:00', $endTime.' 23:59:59']);
                } else {
                    $q->whereDate('drawing.created_at',date('Y-m-d'));
                }
            })
            ->orderBy('drawing.created_at','desc')->get();

        return DataTables::of($drawing)
            ->editColumn('created_at',function ($drawing){
                return date('m/d H:i',strtotime($drawing->dr_created_at));
            })
            ->editColumn('username',function ($drawing){
                return $drawing->user_username.'</br><span class="blue-text" style="font-weight: normal;cursor: pointer;" onclick="showUserInfo(\''.$drawing->dr_uid.'\')">资金详情</span>';
            })
            ->editColumn('balance',function ($drawing){
                return $drawing->dr_balance;
            })
            ->editColumn('total_bet',function ($drawing){
                $bet = DB::table('bet')->where('user_id',$drawing->dr_uid)->whereDate('created_at',date('Y-m-d'))->sum('bet_money');
                return "<a href='/back/control/userManage/userBetList/$drawing->dr_uid' target='_blank'>".$bet."</a>";
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
                  if($drawing->level_name){
                      return  $drawing->level_name;
                  } else {
                      return '用户已被删除';
                  }

            })
            ->editColumn('amount',function ($drawing){
                return '<span class="red-text" style="font-size: 12pt;">'.$drawing->dr_amount.'</span>';
            })
            ->editColumn('bank_info',function ($drawing){
                return '<div style="text-align: center">姓名：'.$drawing->user_fullName.'</br>银行：'.$drawing->user_bank_name.'<br>账号：'.$drawing->user_bank_num.'<br>地址：'.$drawing->user_bank_addr.'</div>';
            })
            ->editColumn('liushui',function ($drawing){
                return '-';
            })
            ->editColumn('ip_info',function ($drawing){
                if($drawing->dr_draw_type == 2){
                    return '-';
                } else {
                    return "<span><i class='iconfont'>&#xe627;</i> $drawing->dr_ip</span></br><span>$drawing->dr_ip_info</span>";
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
                if($drawing->dr_status == 0){
                    return '<span class="orange-text">未受理</span>';
                } else if($drawing->dr_status == 1) {
                    return '<span class="blue-text">处理中</span>';
                } else if($drawing->dr_status == 2) {
                    return '<span class="green-text"><b>通过</b></span>';
                } else if($drawing->dr_status == 3) {
                    return '<span class="red-text"><b>不通过</b></span> <span class="tips-icon"><i data-position="left center" data-tooltip="'.$drawing->dr_msg.'" data-inverted class="iconfont">&#xe61e;</i></span>';
                } else if($drawing->dr_status == 3) {
                    return '锁定';
                }
            })
            ->editColumn('platform',function ($drawing){
                if($drawing->dr_platform == 1){
                    return '电脑端';
                }
                if($drawing->dr_platform == 2){
                    return '手机端';
                }
            })
            ->editColumn('control',function ($drawing){
                if($drawing->dr_status == 2 || $drawing->dr_status == 3){
                    return "<span class='light-gary-text'>通过 | 驳回</span>";
                } else {
                    return '<span class="hover-black" onclick="pass(\''.$drawing->dr_id.'\')">通过</span> | <span class="hover-black" onclick="error(\''.$drawing->dr_id.'\')">驳回</span>';
                }
            })
            ->rawColumns(['rechLevel','amount','username','bank_info','status','control','ip_info','total_bet'])
            ->make(true);
    }
    
    //资金明细
    public function capitalDetails(Request $request)
    {
        $param = $request->all();
        $capital = Capital::select('users.username','capital.to_user','capital.order_id','capital.created_at','capital.type','capital.money','capital.balance','capital.issue','capital.game_id','game.game_name','capital.play_type','capital.operation_id','sub_account.account','capital.content')
            ->where(function ($sql) use($param){
            if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                $sql->whereBetween('capital.created_at',[$param['startTime'] .' 00:00:00',$param['endTime'] .' 23:59:59']);
            }else{
                if(isset($param['time_point']) && array_key_exists('time_point',$param)) {
                    if($param['time_point'] == 'today'){
                        $time = date('Y-m-d');
                        $sql->whereBetween('capital.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                    }elseif($param['time_point'] == 'yesterday'){
                        $time = date('Y-m-d',strtotime('- 1 day',time()));
                        $sql->whereBetween('capital.created_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                    }else{
                        $time = date('Y-m-d',strtotime('- 2 day',time()));
                        $sql->where('capital.created_at','<=',$time . '23:59:59');
                    }
                }
            }
            if(isset($param['account']) && array_key_exists('account',$param)){
                $sql->where('users.name','=',$param['account']);
            }
            if(isset($param['game_id']) && array_key_exists('game_id',$param)){
                $sql->where('capital.game_id','=',$param['game_id']);
            }
            if(isset($param['order_id']) && array_key_exists('order_id',$param)){
                $sql->where('capital.order_id','=',$param['order_id']);
            }
            if(isset($param['issue']) && array_key_exists('issue',$param)){
                $sql->where('capital.issue','=',$param['issue']);
            }
            if(isset($param['type']) && array_key_exists('type',$param)){
                $sql->where('capital.type','=',$param['type']);
            }
            if(isset($param['amount_min']) && array_key_exists('amount_min',$param)){
                $sql->where('capital.money','>=',$param['amount_min']);
            }
            if(isset($param['amount_max']) && array_key_exists('amount_max',$param)){
                $sql->where('capital.money','<=',$param['amount_max']);
            }
        })->leftJoin('game','game.game_id','=','capital.game_id')->leftJoin('users','users.id','=','capital.to_user')->leftJoin('sub_account','sub_account.sa_id','=','capital.operation_id')
            ->orderBy('capital.created_at','desc')->get();
        $playTypeOptions = Capital::$playTypeOption;
        return DataTables::of($capital)
            ->editColumn('type',function ($capital) use ($playTypeOptions){
                return $playTypeOptions[$capital->type];
            })
            ->editColumn('game_name',function ($capital){
                if(empty($capital->game_name)){
                    return '-';
                }else{
                    return $capital->game_name;
                }
            })
            ->editColumn('issue',function ($capital){
                if(empty($capital->issue)){
                    return '-';
                }else{
                    return $capital->issue;
                }
            })
            ->editColumn('play_type',function ($capital){
                if(empty($capital->play_type)){
                    return '-';
                }else{
                    return $capital->play_type;
                }
            })
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
