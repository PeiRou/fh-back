<?php

namespace App\Http\Controllers\Back\Data;

use App\Http\Proxy\GetDate;
use App\PlatformDeposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PlatformController extends Controller
{
    //平台费用结算-表格数据
    public function settlement(Request $request)
    {
        $model = \App\Offer::class;
        $res = $model::where(function ($sql) use ($request) {
            if(isset($request->status))
                $sql->where('status', $request->status);
            if(isset($request->startTime, $request->endTime))
                $sql->whereBetween('created_at', [$request->startTime . '-00 00:00:00', $request->endTime . '-00 00:00:00']);
        });
        $count = $res->count();
        $res = $res->skip($request->start)->take($request->length)->orderBy('created_at', 'desc')->get();
        return DataTables::of($res)
            ->editColumn('status',function ($val) use ($model) {
                return  $model::$status[$val->status];
            })
            ->editColumn('paystatus',function ($val) use ($model) {
                return  $model::$paystatus[$val->paystatus];
            })
            ->editColumn('overstayed',function ($val) {
                if($val['status'] !== 2){
                    $outTime = strtotime($val['overstayed']) - time();
                    $date = $outTime > 0 ? \App\Repository\OfferRepository::time_tran($outTime) : '到期';
                    $date = "({$date})";
                    $outTime <= (60 * 60 * 24 * 7) && $date = "<span class='red-text'>{$date}</span>";
                    return empty($val['overstayed']) ? '-' : $val['overstayed']."{$date}";
                }
                return $val['overstayed'];
            })

            ->editColumn('control',function ($val) {
                $str = '<ul class="control-menu">';

                if($val['status'] !== 2)
                    $str .= '<li onclick="edit(100439)">支付</li>';
                $str .= '</ul>';
                return $str;
            })
            ->rawColumns(['control', 'paystatus', 'overstayed'])
            ->setTotalRecords($count)
            ->skipPaging()
            ->make(true);
    }
    //平台费用结算-表格数据
//    public function settlement(Request $request){
//        $params = $request->post();
//        $data = PlatformSettlement::where(function ($sql) use ($params) {
//            if(isset($params['status']) && array_key_exists('status',$params)){
//                $sql->where('status','=',$params);
//            }
//            if(isset($params['monthTime']) && array_key_exists('monthTime',$params)){
//                $date = new GetDate();
//                $monthTime = $date->GetTheSpecifiedDate($params['monthTime']);
//                $sql->whereBetween('date',[$monthTime['start'],$monthTime['end']]);
//            }else{
//                if(isset($params['startTime']) && array_key_exists('startTime',$params)){
//                    $sql->where('date','>=',$params['startTime'] . '-01');
//                }
//                if(isset($params['endTime']) && array_key_exists('endTime',$params)){
//                    $sql->where('date','<=',$params['endTime'] . '-01');
//                }
//            }
//        })->orderBy('created_at','desc')->get();
//        $aPlatformStatus = PlatformSettlement::$PlatformStatus;
//        return DataTables::of($data)
//            ->editColumn('date',function ($data) {
//                return substr($data->date,0,7);
//            })
//            ->editColumn('status',function ($data) use ($aPlatformStatus) {
//                return  $aPlatformStatus[$data->status];
//            })
//            ->editColumn('control',function ($data) {
//                $html = '';
//                if($data->status == 1){
//                    $html .= '<span class="edit-link red" onclick="pay('.$data->id.')"> 付款 </span>';
//                }
//                return  $html;
//            })
//            ->rawColumns(['control'])
//            ->make(true);
//    }

    //付款记录-表格数据
    public function record(Request $request){
        $params = $request->post();
        $data = PlatformDeposit::where(function ($sql) use ($params) {
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params);
            }
            if(isset($params['monthTime']) && array_key_exists('monthTime',$params)){
                $date = new GetDate();
                $monthTime = $date->GetTheSpecifiedDate($params['monthTime']);
                $sql->whereBetween('created_at',[$monthTime['start'],$monthTime['end']]);
            }else{
                if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                    $sql->where('created_at','>=',$params['startTime'] . ' 00:00:00');
                }
                if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                    $sql->where('created_at','<=',$params['endTime'] . ' 23:59:59');
                }
            }
        })->orderBy('created_at','desc')->get();
        $aPlatformStatus = PlatformDeposit::$PlatformStatus;
        $aPlatformType = PlatformDeposit::$PlatformType;
        return DataTables::of($data)
            ->editColumn('status',function ($data) use ($aPlatformStatus) {
                return  $aPlatformStatus[$data->status];
            })
            ->editColumn('status',function ($data) use ($aPlatformType) {
                return  $aPlatformType[$data->type];
            })
            ->make(true);
    }

}
