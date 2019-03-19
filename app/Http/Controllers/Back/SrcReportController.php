<?php

namespace App\Http\Controllers\Back;

use App\ReportStatisticsDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Session;

class SrcReportController extends Controller
{
    public function addStatistics(Request $request){
        $startDay = empty($request->post('startDay'))?date('Y-m-d'):$request->post('startDay');
        if(ReportStatisticsDate::where('date',$startDay)->count() > 0){
            return response()->json([
                'status' => false,
                'msg' => "已操作过了"
            ]);
        }
        ReportStatisticsDate::insert([
            'date' => $startDay,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'admin_id' => Session::get('account_id'),
            'admin_account' => Session::get('account'),
            'admin_name' => Session::get('account_name'),
        ]);

        $aParam = [
            'startTime' => $startDay,
            'endTime' => $startDay,
        ];
        Artisan::call('AgentReport:BetTotalSettlement',$aParam);
        Artisan::call('AgentReport:TotalSettlement',$aParam);
        Artisan::call('GeneralReport:BetTotalSettlement',$aParam);
        Artisan::call('GeneralReport:TotalSettlement',$aParam);
        Artisan::call('MemberReport:BetTotalSettlement',$aParam);
        Artisan::call('MemberReport:TotalSettlement',$aParam);

        return response()->json([
            'status' => true,
            'msg' => "添加成功！"
        ]);
    }

    //生成棋牌投注报表
    public function addReportCard(Request $request)
    {
        $aParam = [
            'startTime' => $request->startDay,
            'endTime' => $request->startDay
        ];
        Artisan::call('CardReport:get',$aParam);
        return response()->json([
            'status' => true,
            'msg' => "已生成！"
        ]);
    }
}
