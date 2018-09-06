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

        $cellData = [
//            ['订单日期','处理日期','会员','余额','订单号','付款方式','交易金额','操作人','收款信息','入款信息','状态'],
            ['会员','交易金额','操作人','收款信息','状态'],
        ];
        $exportRecharges = DB::table('recharges')
            ->leftJoin('users','recharges.userId','=','users.id')
            ->select('users.username as username')
            ->where('recharges.payType',$rechargesType)
            ->whereBetween('recharges.created_at',[$startTime.' 00:00:00',$endTime.' 23:59:59'])
            ->get();
        foreach ($exportRecharges as $item){
            $cellData[] = [
                $item->username,
                $item->username,
                $item->username,
                $item->username,
                $item->username,
            ];
        }
        return $cellData;
//        Excel::create('111',function ($excel) use ($cellData){
//            $excel->sheet('123', function($sheet) use ($cellData){
//                $sheet->rows($cellData);
//            });
//        })->export('xls');
    }
}
