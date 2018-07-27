<?php

namespace App\Http\Controllers\Back\Data;

use App\AgentDrawDetails;
use App\AgentReport;
use App\AgentReportReview;
use App\Http\Proxy\GetDate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class AgentSettleController extends Controller
{
    //代理结算报表-表格数据
    public function report(Request $request)
    {
        $params = $request->all();
        $permissions = AgentReport::where(function ($sql) use($params){
            if(isset($params['account']) && array_key_exists('account',$params)){
                $sql->where('account','=',$params['account']);
            }
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params['status']);
            }
            if(isset($params['monthTime']) && array_key_exists('monthTime',$params)){
                $date = new GetDate();
                $dateTime = $date->GetTheSpecifiedDate($params['monthTime']);
                $sql->whereBetween('created_at',[$dateTime['start'],$dateTime['end']]);
            }else{
                if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                    $sql->where('created_at','>=',$params['startTime']);
                }
                if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                    $sql->where('created_at','<=',$params['endTime']);
                }
            }
        })->orderBy('created_at','desc')->get();
        $reportStatus = AgentReport::$reportStatus;
        return DataTables::of($permissions)
            ->editColumn('status',function ($permissions) use ($reportStatus) {
                return  $reportStatus[$permissions->status];
            })
            ->editColumn('control',function ($permissions) {
                $html = '';
                if($permissions->status == 0){
                    $html = '<span class="edit-link" onclick="edit('.$permissions->agent_report_idx.')"><i class="iconfont">&#xe602;</i> 修改</span>';
                    $html .= ' | <span class="edit-link" onclick="editReview('.$permissions->agent_report_idx.')"> 提交审核 </span>';
                }
                return  $html;
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //代理结算审核-表格数据
    public function review(Request $request){
        $params = $request->all();
        $permissions = AgentReportReview::where(function ($sql) use($params){
            if(isset($params['account']) && array_key_exists('account',$params)){
                $sql->where('account','=',$params['account']);
            }
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params['status']);
            }
            if(isset($params['monthTime']) && array_key_exists('monthTime',$params)){
                $date = new GetDate();
                $dateTime = $date->GetTheSpecifiedDate($params['monthTime']);
                $sql->whereBetween('created_at',[$dateTime['start'],$dateTime['end']]);
            }else{
                if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                    $sql->where('created_at','>=',$params['startTime']);
                }
                if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                    $sql->where('created_at','<=',$params['endTime']);
                }
            }
        })->orderBy('created_at','desc')->get();
        $reportStatus = AgentReportReview::$reportStatus;
        return DataTables::of($permissions)
            ->editColumn('status',function ($permissions) use ($reportStatus) {
                return  $reportStatus[$permissions->status];
            })
            ->editColumn('control',function ($permissions) {
                $html = '<span class="edit-link" onclick="edit('.$permissions->agent_report_idx.')"><i class="iconfont">&#xe602;</i> 修改</span>';
                if($permissions->status == 2){
                    $html .= ' | <span class="edit-link" onclick="editSettle('.$permissions->agent_report_idx.')"> 结算</span>';
                    $html .= ' | <span class="edit-link" onclick="editTurnDown('.$permissions->agent_report_idx.')"> 驳回</span>';
                }
                return $html;
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //代理提现-表格数据
    public function withdraw(Request $request){
        $params = $request->all();
        $permissions = AgentDrawDetails::where(function ($sql) use ($params) {
            if(isset($params['account']) && array_key_exists('account',$params)){
                $sql->where('account','=',$params['account']);
            }
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params['status']);
            }
            if(isset($params['order_id']) && array_key_exists('order_id',$params)){
                $sql->where('order_id','=',$params['order_id']);
            }
            if(isset($params['monthTime']) && array_key_exists('monthTime',$params)){
                $date = new GetDate();
                $dateTime = $date->GetTheSpecifiedDate($params['monthTime']);
                $sql->whereBetween('created_at',[$dateTime['start'],$dateTime['end']]);
            }else{
                if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                    $sql->where('created_at','>=',$params['startTime']);
                }
                if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                    $sql->where('created_at','<=',$params['endTime']);
                }
            }
        })->orderby('created_at','desc')->get();
        return DataTables::of($permissions)
            ->editColumn('control',function ($permissions) {
                return '<span class="edit-link" onclick="edit('.$permissions->agent_report_idx.')"><i class="iconfont">&#xe602;</i> 修改</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }
}
