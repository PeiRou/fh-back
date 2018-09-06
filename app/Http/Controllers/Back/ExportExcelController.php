<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelController extends Controller
{
    public function exportExcelForRecharges(Request $request)
    {
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $rechargesType = $request->get('rechargesType');

        $cellData = [
            ['订单日期','处理日期','会员','余额','订单号','付款方式','交易金额','操作人','收款信息','入款信息','状态'],
            ['1','2','3','4','5','6','7','8','9','10','11'],
            ['1','2','3','4','5','6','7','8','9','10','11'],
            ['1','2','3','4','5','6','7','8','9','10','11'],
            ['1','2','3','4','5','6','7','8','9','10','11'],
            ['1','2','3','4','5','6','7','8','9','10','11'],
        ];
        Excel::create('充值记录',function ($excel) use ($cellData){
            $excel->sheet('123', function($sheet) use ($cellData){
                $sheet->rows($cellData);
            });
        })->export('xls');

        return response()->json([
            'status' => true
        ]);
    }
}
