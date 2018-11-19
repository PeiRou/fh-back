<?php

namespace App\Http\Controllers\Back\Data;

use App\PromotionConfig;
use App\PromotionReport;
use App\PromotionReview;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PromotionController extends Controller
{

    //推广设置-表格数据
    public function config(Request $request){
        $data = PromotionConfig::all();
        return DataTables::of($data)
            ->editColumn('admin_account',function ($data) {
                return empty($data->admin_account) ? '-' : $data->admin_account;
            })
            ->editColumn('control',function ($data) {
                return '<span class="edit-link" onclick="edit('.$data->id.')"> 修改 </span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //推广结算报表-表格数据
    public function report(Request $request){
        $params = $request->all();
        $data = PromotionReport::where(function ($sql) use ($params){
            if(isset($params['promotion_account']) && array_key_exists('promotion_account',$params)){
                $sql->where('promotion_account','=',$params['promotion_account']);
            }
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params['status']);
            }
            if(isset($params['agent_account']) && array_key_exists('agent_account',$params)){
                $sql->where('agent_account','=',$params['agent_account']);
            }
            if(isset($params['level']) && array_key_exists('level',$params)){
                $sql->where('level','=',$params['level']);
            }
            if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                $sql->where('date','>=',$params['startTime']);
            }
            if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                $sql->where('date','<=',$params['endTime']);
            }
        })->orderBy('created_at','desc')->get();
        $status = PromotionReport::$reportStatus;
        return DataTables::of($data)
            ->editColumn('promotion_account',function ($data) {
                return '<a href="javascript:;" onclick="userHref(\''.$data->promotion_account.'\')">'.$data->promotion_account.'('.$data->promotion_name.')</a>';
            })
            ->editColumn('sa_account',function ($data) {
                return empty($data->sa_account) ? '-' : $data->sa_account;
            })
            ->editColumn('agent_account',function ($data) {
                return empty($data->agent_account) ? '-' : $data->agent_account;
            })
            ->editColumn('level',function ($data) {
                return $data->level . '级';
            })
            ->editColumn('status',function ($data) use ($status){
                return $status[$data->status];
            })
            ->editColumn('control',function ($data) {
                if($data->status == 0){
                    return '<span class="edit-link" onclick="edit('.$data->id.')"> 修改 </span> | <span class="edit-link" onclick="editReview('.$data->id.')"> 提交审核 </span>';
                }
                return '';
            })
            ->rawColumns(['control','promotion_account'])
            ->make(true);
    }

    //推广结算报表-表格数据
    public function review(Request $request){
        $params = $request->all();
        $data = PromotionReview::where(function ($sql) use ($params){
            if(isset($params['promotion_account']) && array_key_exists('promotion_account',$params)){
                $sql->where('promotion_account','=',$params['promotion_account']);
            }
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params['status']);
            }
            if(isset($params['agent_account']) && array_key_exists('agent_account',$params)){
                $sql->where('agent_account','=',$params['agent_account']);
            }
            if(isset($params['level']) && array_key_exists('level',$params)){
                $sql->where('level','=',$params['level']);
            }
            if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                $sql->where('date','>=',$params['startTime']);
            }
            if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                $sql->where('date','<=',$params['endTime']);
            }
        })->orderBy('created_at','desc')->get();
        $status = PromotionReview::$reportStatus;
        return DataTables::of($data)
            ->editColumn('promotion_account',function ($data) {
                return '<a href="javascript:;" onclick="userHref(\''.$data->promotion_account.'\')">'.$data->promotion_account.'('.$data->promotion_name.')</a>';
            })
            ->editColumn('sa_account',function ($data) {
                return empty($data->sa_account) ? '-' : $data->sa_account;
            })
            ->editColumn('agent_account',function ($data) {
                return empty($data->agent_account) ? '-' : $data->agent_account;
            })
            ->editColumn('level',function ($data) {
                return $data->level . '级';
            })
            ->editColumn('status',function ($data) use ($status){
                return $status[$data->status];
            })
            ->editColumn('control',function ($data) {
                if($data->status == 2){
                    return '<span class="edit-link" onclick="commit('.$data->id.',1)"> 通过 </span> | <span class="edit-link" onclick="commit('.$data->id.',3)"> 驳回 </span>';
                }
                return '';
            })
            ->rawColumns(['control','promotion_account'])
            ->make(true);
    }
}
