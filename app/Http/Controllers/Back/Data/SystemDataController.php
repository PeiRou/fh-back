<?php

namespace App\Http\Controllers\Back\Data;

use App\Advertise;
use App\AdvertiseInfo;
use App\Feedback;
use App\Permissions;
use App\PermissionsAuth;
use App\Roles;
use App\Whitelist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpParser\Node\Expr\Array_;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class SystemDataController extends Controller
{
    //权限-表格数据
    public function permissions()
    {
        $permissions = Permissions::all();
        return DataTables::of($permissions)
            ->editColumn('control',function ($permissions) {
                return  '<span class="edit-link" onclick="edit('.$permissions->id.')"><i class="iconfont">&#xe602;</i> 修改</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }
    
    //角色-表格数据
    public function roles()
    {
        $roles = Roles::all();
        return DataTables::of($roles)
            ->editColumn('control',function ($roles) {
                return  '<span class="edit-link" onclick="edit('.$roles->id.')"><i class="iconfont">&#xe602;</i> 修改</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //权限控制-表格数据
    public function permissionsAuth(Request $request){
        $params = $request->all();
        if(isset($params['pid']) && array_key_exists('pid',$params)){
            $pid = $params['pid'];
        }else{
            $pid = '';
        }
        if(isset($params['route_name']) && array_key_exists('route_name',$params)){
            $route_name = $params['route_name'];
        }else{
            $route_name = '';
        }
        $aPermissionsAuths = PermissionsAuth::getPermissionList($pid,$route_name);
        return DataTables::of($aPermissionsAuths)
            ->editColumn('open',function ($aPermissionsAuths){
                if($aPermissionsAuths->open == 0){
                    return '没有';
                }else{
                    return '有';
                }
            })
            ->editColumn('control',function ($aPermissionsAuths) {
                return '<span class="edit-link" onclick="jumpHref('.$aPermissionsAuths->id.')"> 查看下级 </a></span> | '
                    .'<span class="edit-link" onclick="edit('.$aPermissionsAuths->id.')"><i class="iconfont">&#xe602;</i> 修改</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //ip白名单设置-表格数据
    public function whitelist(Request $request){
        $roles = Whitelist::where('admin_account','!=','admin')->get();
        return DataTables::of($roles)
            ->editColumn('control',function ($roles) {
                return '<span class="edit-link" onclick="edit('.$roles->id.')"><i class="iconfont">&#xe602;</i> 修改 </a></span> | '
                    .'<span class="edit-link" onclick="del('.$roles->id.')"> 删除</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //建议反馈-表格数据
    public function feedback(Request $request){
        $params = $request->all();
        $data = Feedback::where(function ($sql) use ($params){
            if(isset($params['type']) && array_key_exists('type',$params)){
                $sql->where('type','=',$params['type']);
            }
            if(isset($params['status']) && array_key_exists('status',$params)){
                $sql->where('status','=',$params['status']);
            }
            if(isset($params['user_account']) && array_key_exists('user_account',$params)){
                $sql->where('user_account','=',$params['user_account']);
            }
            if(isset($params['startTime']) && array_key_exists('startTime',$params)){
                $sql->where('created_at','>=',$params['startTime'] . ' 00:00:00');
            }
            if(isset($params['endTime']) && array_key_exists('endTime',$params)){
                $sql->where('created_at','<=',$params['endTime'] .' 23:59:59');
            }
        })->orderBy('created_at','desc')->get();
        $type = Feedback::$feedbackType;
        $status = Feedback::$feedbackStatus;
        return DataTables::of($data)
            ->editColumn('user_account',function ($data){
                return  $data->user_account.'('.$data->user_name.')';
            })
            ->editColumn('type',function ($data) use ($type){
                return  $type[$data->type];
            })
            ->editColumn('status',function ($data) use ($status){
                return  $status[$data->status];
            })
            ->editColumn('control',function ($data) {
                return '<span class="edit-link" style="color:#4183c4" onclick="view('.$data->id.')">查看</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //广告位-表格数据
    public function advertise(Request $request){
        $aData = Advertise::get();
        return DataTables::of($aData)
            ->editColumn('type',function ($aData){
                return  $aData->advertiseType[$aData->type];
            })
            ->editColumn('status',function ($aData){
                return  $aData->advertiseStatus[$aData->status];
            })
            ->editColumn('control',function ($data) {
                return '<span class="edit-link" style="color:#4183c4" onclick="del('.$data->id.')">删除</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }

    //广告位-表格数据
    public function advertiseInfo(Request $request){
        $aParam = $request->post();
        $aData = AdvertiseInfo::select('advertise_info.status','advertise_info.created_at','advertise_info.sort','advertise_info.js_key','advertise.title','advertise_info.id','advertise.type')
            ->where(function ($aSql) use($aParam){
                if(isset($aParam['ad_id']) && array_key_exists('ad_id',$aParam))
                    $aSql->where('advertise_info.ad_id',$aParam['ad_id']);
            })->join('advertise','advertise.id','=','advertise_info.ad_id')
            ->orderBy('advertise_info.ad_id','asc')->orderBy('advertise_info.sort','asc')->get();
        $aType = (new Advertise())->advertiseType;
        return DataTables::of($aData)
            ->editColumn('type',function ($aData) use ($aType){
                return  $aType[$aData->type];
            })
            ->editColumn('status',function ($aData){
                return  $aData->advertiseStatus[$aData->status];
            })
            ->editColumn('sort', function ($aData){
                return "<input type='text' value='".$aData->sort."' name='sort[]' style='border: 1px solid #aaa;height: 20px;width: 30px;'><input type='hidden' value='".$aData->id."' name='sortId[]'>";
            })
            ->editColumn('js_key',function ($aData){
                return  empty($aData->js_key)?'-':$aData->js_key;
            })
            ->editColumn('control',function ($data) {
                return '<span class="edit-link" style="color:#4183c4" onclick="edit('.$data->id.')">修改</span> | 
                        <span class="edit-link" style="color:#4183c4" onclick="del('.$data->id.')">删除</span>';
            })
            ->rawColumns(['control','sort'])
            ->make(true);
    }
}
