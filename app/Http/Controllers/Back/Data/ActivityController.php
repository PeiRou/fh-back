<?php

namespace App\Http\Controllers\Back\Data;

use App\Activity;
use App\ActivityCondition;
use App\ActivityPrize;
use App\ActivitySend;
use App\ActivityStatistics;
use App\StatisticsData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class ActivityController extends Controller
{
    //活动列表-表格数据
    public function lists(){
        $datas = Activity::all();
        $activityType = Activity::$activityType;
        $activityStatus = Activity::$activityStatus;
        return DataTables::of($datas)
            ->editColumn('type',function ($datas) use ($activityType) {
                return  $activityType[$datas->type];
            })
            ->editColumn('status',function ($datas) use ($activityStatus) {
                return  $activityStatus[$datas->status];
            })
            ->editColumn('start_time',function ($datas){
                return  str_replace('-','/',substr($datas->start_time,0,10)) . ' - ' . str_replace('-','/',substr($datas->end_time,0,10));
            })
            ->editColumn('control',function ($datas) {
                $html = '';
                if($datas->status == 1){
                    $html .= '<span class="edit-link" onclick="editStatus('.$datas->id.')"> 关闭 </span>';
                }else{
                    $html .= '<span class="edit-link" onclick="editStatus('.$datas->id.')"> 开启 </span>';
                }
                $html .= ' | <span class="edit-link" onclick="edit('.$datas->id.')"> 修改 </span>';
                return  $html;
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //活动条件-表格数据
    public function condition(Request $request){
        $params = $request->all();
        $datas = ActivityCondition::select('activity_condition.activity_id','activity_condition.id','activity_condition.day','activity_condition.money','activity_condition.bet','activity_condition.total_money','activity.name')
            ->where(function ($sql) use ($params){
                if(isset($params['activity_id']) && array_key_exists('activity_id',$params)){
                    return $sql->where('activity_id','=',$params['activity_id']);
                }
            })
            ->join('activity','activity.id','=','activity_condition.activity_id')
            ->orderBy('activity_condition.activity_id','asc')->orderBy('activity_condition.day','asc')->get();
        return DataTables::of($datas)
            ->editColumn('day',function ($datas){
                return '第'.$datas->day.'天';
            })
            ->editColumn('control',function ($datas) {
                $html = '<span class="edit-link" onclick="edit('.$datas->id.')"> 修改 </span>';
                $html .= ' | <span class="edit-link red" onclick="del('.$datas->id.',\''.$datas->name.'的第'.$datas->day.'天\')"> 删除 </span>';
                return  $html;
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //奖品配置-表格数据
    public function prize(Request $request){
        $datas = ActivityPrize::all();
        $prizeType = ActivityPrize::$prizeType;
        return DataTables::of($datas)
            ->editColumn('type',function ($datas) use ($prizeType) {
                return  $prizeType[$datas->type];
            })
            ->editColumn('control',function ($datas) {
                $html = '<span class="edit-link" onclick="edit('.$datas->id.')"> 修改 </span>';
                $html .= ' | <span class="edit-link red" onclick="del('.$datas->id.',\''.$datas->name.'\')"> 删除 </span>';
                return  $html;
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //派奖审核-表格数据
    public function review(Request $request){
        $params = $request->all();
        $datasSql = ActivitySend::where(function ($sql) use ($params){
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('activity_send.status','=',$params['status']);
            }
            if(isset($params['user_account']) && array_key_exists('user_account',$params)){
                $sql->where('activity_send.user_account','=',$params['user_account']);
            }
            if(isset($params['time']) && array_key_exists('time',$params)){
                $sql->wherebetween('activity_send.created_at',[$params['time'] . ' 00:00:00',$params['time'] . ' 23:59:59']);
            }else{
                $sql->wherebetween('activity_send.created_at',[date('Y-m-d 00:00:00'),date('Y-m-d 23:59:59')]);
            }
        })
            ->join('users','users.id','=','activity_send.user_id')
            ->join('level','level.value','=','users.rechLevel')
            ->join('activity_prize','activity_prize.id','=','activity_send.prize_id');
        $datasCount = $datasSql->count();
        $datas = $datasSql->select('activity_send.*','users.fullname','users.rechLevel as lv','level.name as levelname','activity_prize.type as pType','activity_prize.quantity as pQuantity')
            ->orderBy('activity_send.created_at','desc')->skip($params['start'])->take($params['length'])->get();
        $filterMoney = $datasSql->whereIn('activity_send.status',[4,5])->sum('activity_prize.quantity');
        $sendStatus = ActivitySend::$activityStatus;
        return DataTables::of($datas)
            ->editColumn('user_account',function ($datas) {
                if($datas->rechlevel=='111')        //黑名单
                    $levedsp = '-<font color="red"><b>'.$datas->levelname.'</b></font>)';
                else
                    $levedsp = '-<font color="green"><b>'.$datas->levelname.'</b></font>)';
                return  $datas->user_account.'('.$datas->fullname.$levedsp;
            })
            ->editColumn('created_at',function ($datas) {
                return  str_replace('-','/',substr($datas->created_at,0,16));
            })
            ->editColumn('status',function ($datas) use ($sendStatus){
                if($datas->pQuantity == 0 && $datas->pType == 2)
                    return $sendStatus[4];
                return  $sendStatus[$datas->status];
            })
            ->editColumn('admin_account',function ($datas){
                if(empty($datas->admin_account)){
                    return '-';
                }
                return  $datas->admin_account.'('.$datas->admin_name.')';
            })
            ->editColumn('updated_at',function ($datas){
                if(empty($datas->updated_at)){
                    return '-';
                }
                return  str_replace('-','/',substr($datas->updated_at,0,16));
            })
            ->editColumn('control',function ($datas) {
                $html = '<span class="edit-link" onclick="jumpHref(\''.$datas->user_id.'\')"> 注单明细 </span>';
                if(($datas->status == 2) && (($datas->pQuantity != 0) || ($datas->pType != 2))) {
                    $html .= ' | <span class="edit-link" onclick="editStatus(' . $datas->id . ',1,\'驳回\')"> 驳回 </span> | <span class="edit-link" onclick="editStatus(' . $datas->id . ',2,\'通过\')"> 通过 </span>';
                }
                return  $html;
            })
            ->rawColumns(['control','user_account'])
            ->setTotalRecords($datasCount)
            ->skipPaging()
            ->with('filterMoney',$filterMoney)
            ->make(true);
    }

    //每日数据统计-表格数据
    public function daily(Request $request){
        $aParam = $request->all();
        $aDataSql = StatisticsData::where(function ($aSql) use($aParam){
            if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam))
                $aSql->where('user_account',$aParam['user_account']);
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                $aSql->where('date','>=',$aParam['startTime']);
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                $aSql->where('date','<=',$aParam['endTime']);
        });
        $aDataCount = $aDataSql->count();
        $aData = $aDataSql->orderBy('date','desc')->skip($aParam['start'])->take($aParam['length'])->get();
        return DataTables::of($aData)
            ->editColumn('user_account',function ($aData) {
                return  $aData->user_account.'('.$aData->user_name.')';
            })
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //每日活动统计-表格数据
    public function data(Request $request){
        $aParam = $request->all();
        $aDataSql = ActivityStatistics::where(function ($aSql) use ($aParam) {
            if(isset($aParam['user_account']) && array_key_exists('user_account',$aParam))
                $aSql->where('user_account',$aParam['user_account']);
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                $aSql->where('day','>=',$aParam['startTime']);
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                $aSql->where('day','<=',$aParam['endTime']);
            if(isset($aParam['activity_type']) && array_key_exists('activity_type',$aParam))
                $aSql->where('activity_type',$aParam['activity_type']);
        });
        $aDataCount = $aDataSql->count();
        $aData = $aDataSql->orderBy('day','desc')->orderby('created_at','desc')->skip($aParam['start'])->take($aParam['length'])->get();
        return DataTables::of($aData)
            ->editColumn('user_account',function ($aData) {
                return  $aData->user_account.'('.$aData->user_name.')';
            })
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }
}
