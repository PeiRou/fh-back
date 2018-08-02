<?php

namespace App\Http\Controllers\Back\Data;

use App\AgentRecon;
use App\Bets;
use App\Capital;
use App\Drawing;
use App\Levels;
use App\Recharges;
use App\User;
use App\UserRecon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
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

        $sql = 'select users.id as uid,recharges.id as rid,recharges.created_at as re_created_at,recharges.process_date as re_process_date,recharges.username as re_username,recharges.userId as userId,users.fullName as user_fullName,users.money as user_money,recharges.payType as re_payType,recharges.amount as re_amount,rebate_or_fee,recharges.operation_account as re_operation_account,recharges.shou_info as re_shou_info,recharges.ru_info as re_ru_info,recharges.status as re_status,recharges.msg as re_msg,recharges.orderNum as re_orderNum,recharges.balance as re_balance from recharges 
              JOIN users on recharges.userId = users.id WHERE 1 ';
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
        if(isset($account_param) && $account_param){
            if($account_type == 'account'){
                $where .= " and recharges.username = '".$account_param."'";
            }else if($account_type == 'orderNum'){
                $where .= " and recharges.orderNum = '".$account_param."'";
            }else if($account_type == 'operation_account'){
                $where .= " and recharges.operation_account = '".$account_param."'";
            }
        }
        if(isset($startTime) && $startTime){
            $where .= " and recharges.created_at >= '".$startTime." 00:00:00'";
        }
        if(isset($endTime) && $endTime){
            $where .= " and recharges.created_at <= '".$endTime." 23:59:59'";
        }
        if(empty($startTime) && empty($endTime))
            $where .= " and recharges.created_at = now() ";
        $whereStaus = '';
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
        }
        $sql .= $where .$whereStaus. ' order by recharges.created_at desc ';
        Session::put('recharge_report',$where);
        $recharge = DB::select($sql);

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
            ->select('drawing.created_at as dr_created_at','drawing.process_date as dr_process_date','users.rechLevel as user_rechLevel','drawing.user_id as dr_uid','drawing.amount as dr_amount','users.fullName as user_fullName','users.bank_name as user_bank_name','users.bank_num as user_bank_num','users.bank_addr as user_bank_addr','drawing.ip_info as dr_ip_info','drawing.ip as dr_ip','drawing.draw_type as dr_draw_type','drawing.status as dr_status','drawing.msg as dr_msg','drawing.platform as dr_platform','drawing.id as dr_id','users.username as user_username','drawing.balance as dr_balance','drawing.order_id as dr_order_id','drawing.operation_account as dr_operation_account','level.name as level_name','users.DrawTimes as user_DrawTimes','drawing.total_bet as dr_total_bet')
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
        if(isset($param['type']) && array_key_exists('type', $param)){
            if(in_array($param['type'],Capital::$includePlayTypeOption)){
                $capital = Bets::AssemblyFundDetails($param);
            }else if($param['type']=='t01'){        //充值
                $capital = Capital::AssemblyFundDetails_Rech($param);
            }else if($param['type']=='t04'){        //返利/手续费
                $capital = Capital::AssemblyFundDetails($param);
            }else{
                $capitalSql = Capital::AssemblyFundDetails($param);
                $capital = $capitalSql->get();
            }
        }else {
            $capitalSql = Capital::AssemblyFundDetails($param);
            $betsSql = Bets::AssemblyFundDetails($param);
            $RechSql = Capital::AssemblyFundDetails_Rech($param);
            $capital = $capitalSql->union($RechSql)->union($betsSql)->orderBy('created_at','desc');
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
                if($capital->game_id>0){
                    if($capital->game_id ==90 || $capital->game_id ==91){
                        if($capital->nn_view_money < 0)
                            return '<span class="green-text">下注:'.$capital->nn_view_money.'</span>'.'<span class="gary-text">(冻结:'.$capital->freeze_money.')</span>'.'<span class="gary-text">(解冻:'.$capital->freeze_money.')</span>';
                        else
                            return '<span class="red-text">下注:'.$capital->nn_view_money.'</span>'.'<span class="gary-text">(冻结:'.$capital->freeze_money.')</span>'.'<span class="gary-text">(解冻:'.$capital->freeze_money.')</span>';
                    }else{
                        if($capital->money < 0)
                        {
                            return '<span class="green-text">'.$capital->money.'</span>';
                        } else {
                            return '<span class="red-text">下注:'.$capital->money.'</span>';
                        }
                    }
                }else{
                    if($capital->money < 0)
                    {
                        return '<span class="green-text">'.$capital->money.'</span>';
                    } else {
                        return '<span class="red-text">'.$capital->money.'</span>';
                    }
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
                if(empty($capital->play_type)){
                    return '-';
                }else{
                    return $capital->play_type;
                }
            })
            ->rawColumns(['money','balance','content','issue'])
            ->make(true);
    }
    
    //会员对账
    public function memberReconciliation()
    {
//        $userRecon = UserRecon::all();
//        return DataTables::of($userRecon)
//            ->make(true);
    }
    
    //代理对账
    public function agentReconciliation()
    {
//        $agentRecon = AgentRecon::all();
//        return DataTables::of($agentRecon)
//            ->make(true);
    }
}
