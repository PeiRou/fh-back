<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function exportExcelForRecharges(Request $request)
    {
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $rechargesType = $request->get('rechargesType');
        switch ($rechargesType){
            case 'onlinePayment':
                $fileTypeName = '在线充值';
                break;
            case 'bankTransfer':
                $fileTypeName = '银行汇款';
                break;
            case 'alipay':
                $fileTypeName = '支付宝转账';
                break;
            case 'weixin':
                $fileTypeName = '微信转账';
                break;
            case 'cft':
                $fileTypeName = '财付通转账';
                break;
            case 'adminAddMoney':
                $fileTypeName = '后台加钱';
                break;
        }

        $cellData = [
//            ['订单日期','处理日期','会员','余额','订单号','付款方式','交易金额','操作人','收款信息','入款信息','状态'],
            ['会员','交易金额','操作人','收款信息','状态'],
        ];
        $exportRecharges = DB::table('recharges')
            ->leftJoin('users','recharges.userId','=','users.id')
            ->select('users.username as username','recharges.amount as amount','recharges.operation_account as operation_account','recharges.shou_info as shou_info','recharges.status as re_status')
            ->where('recharges.payType',$rechargesType)
            ->where('users.testFlag',0)
            ->whereBetween('recharges.created_at',[$startTime.' 00:00:00',$endTime.' 23:59:59'])
            ->get();
        foreach ($exportRecharges as $item){
            if($item->re_status == 1){
                $re_status = '未受理';
            }
            if($item->re_status == 2){
                $re_status = '充值成功';
            }
            if($item->re_status == 3){
                $re_status = '充值失败';
            }
            if($item->re_status == 4){
                $re_status = '在线充值中';
            }
            $cellData[] = [
                $item->username,
                $item->amount,
                $item->operation_account,
                $item->shou_info,
                $re_status,
            ];
        }

        Excel::create('【'.$fileTypeName.'】充值数据-['.$startTime.'-'.$endTime.']',function ($excel) use ($cellData,$fileTypeName){
            $excel->sheet($fileTypeName, function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }
}
