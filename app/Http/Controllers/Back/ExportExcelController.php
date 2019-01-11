<?php

namespace App\Http\Controllers\Back;

use App\Drawing;
use App\Recharges;
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
//
        $cellData = [
//            ['订单日期','处理日期','会员','余额','订单号','付款方式','交易金额','操作人','收款信息','入款信息','状态'],
            ['订单时间','处理日期','会员','真实姓名','余额','订单号','付款方式','交易金额','返利/手续费','操作人','收款信息','入款信息','状态'],
        ];
//        $exportRecharges = DB::table('recharges')
//            ->leftJoin('users','recharges.userId','=','users.id')
//            ->select('users.username as username','recharges.amount as amount','recharges.operation_account as operation_account','recharges.shou_info as shou_info','recharges.status as re_status')
//            ->where('recharges.payType',$rechargesType)
//            ->where('users.testFlag',0)
//            ->whereBetween('recharges.created_at',[$startTime.' 00:00:00',$endTime.' 23:59:59'])
//            ->get();
        $exportRecharges = Recharges::exportExcelForRecharges($request);
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
                date('m/d H:i',strtotime($item->created_at)),
                empty($item->process_date)?'--':date('m/d H:i',strtotime($item->process_date)),
                $item->username,
                $item->fullName,
                $item->balance,
                $item->orderNum,
                \App\Recharges::$payType[$item->payType] ?? '--',
                $item->amount,
                $item->rebate_or_fee,
                $item->operation_account,
                $item->shou_info,
                str_replace('<br>',' ',$item->ru_info),
                $re_status,
            ];
        }


        Excel::create('【'.$fileTypeName.'】充值数据-['.$startTime.'-'.$endTime.']',function ($excel) use ($cellData,$fileTypeName){
            $excel->sheet($fileTypeName, function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');
    }

    public function exportExcelForDrawing(Request $request){
        $aParam = $request->post();
        $aData = Drawing::drawingRecord($aParam);
        $aStatus = Drawing::$statusDrawing;
        if(empty($aData->toArray()))
            return redirect('/back/control/financeManage/drawingRecord')->with('message', '该条件下没有提款记录');
        Excel::create('【'.$aParam['startTime'].'-'.$aParam['endTime'].'】回访用户',function ($excel) use ($aData,$aParam,$aStatus){
            $excel->sheet('【'.$aParam['startTime'].'-'.$aParam['endTime'].'】回访用户', function($sheet) use ($aData,$aParam,$aStatus){
                $sheet->appendRow(['订单时间','处理时间','会员','层级','余额','有效投注','提款总次数','订单号','流水','交易金额','银行信息','IP信息','终端','出款方式','状态','操作人']);
                $sheetHeight = [
                    1 => 20,
                ];
                foreach ($aData as $kData => $iData){
//                    if($iData->dr_draw_type)
//                        $ipInfo = '-';
//                    else
                        $ipInfo = $iData->dr_ip.$iData->ip_info;
                    if($iData->dr_platform == 1)
                        $platform = '电脑端';
                    elseif($iData->dr_platform == 2)
                        $platform = '手机端';
                    else
                        $platform = '';
                    if($iData->dr_draw_type == 1)
                        $draw_type = '手动出款';
                    elseif($iData->dr_draw_type == 2)
                        $draw_type = '后台扣钱';
                    else
                        $draw_type = '自动出款';
                    $sheet->appendRow([
                        date('m/d H:i',strtotime($iData->dr_created_at)),
                        empty($iData->dr_process_date)?'--':date('m/d H:i',strtotime($iData->dr_process_date)),
                        $iData->user_username,
                        $iData->level_name,
                        $iData->dr_balance,
                        $iData->dr_total_bet,
                        $iData->user_DrawTimes,
                        $iData->dr_order_id,
                        '-',
                        $iData->dr_amount,
                        '姓名：'.(empty($iData->dr_fullName)?$iData->user_fullName:$iData->dr_fullName)."\r\n".'银行：'.(empty($iData->dr_bank_name)?$iData->user_bank_name:$iData->dr_bank_name)."\r\n".'账号：'.(empty($iData->dr_bank_num)?$iData->user_bank_num:$iData->dr_bank_num)."\r\n".'地址：'.(empty($iData->dr_bank_addr)?$iData->user_bank_addr:$iData->dr_bank_addr),
                        $ipInfo,
                        $platform,
                        $draw_type,
                        $aStatus[$iData->dr_status],
                        $iData->dr_operation_account
                    ]);
                    $sheetHeight[$kData + 2] = 20;
                }
                $sheet->setHeight($sheetHeight);
                $sheet->setWidth(array(
                    'A'    =>  15,
                    'B'    =>  15,
                    'C'    =>  10,
                    'D'    =>  10,
                    'E'    =>  10,
                    'F'    =>  12,
                    'G'    =>  12,
                    'H'    =>  25,
                    'I'    =>  5,
                    'J'    =>  10,
                    'K'    =>  30,
                    'L'    =>  10,
                    'M'    =>  10,
                    'N'    =>  10,
                    'O'    =>  10,
                    'P'    =>  10,
                ));
            });
        })->export('xls');

    }
}
