<?php

namespace App\Http\Controllers\Back\Data;

use App\Permissions;
use App\PermissionsAuth;
use App\Roles;
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
            $pid = 0;
        }
        $aPermissionsAuths = PermissionsAuth::getPermissionList($pid);
        return DataTables::of($aPermissionsAuths)
            ->editColumn('open',function ($aPermissionsAuths){
                if($aPermissionsAuths->open == 0){
                    return '没有';
                }else{
                    return '有';
                }
            })
            ->editColumn('control',function ($aPermissionsAuths) {
                return '<span class="edit-link" onclick="jumpHref('.$aPermissionsAuths->id.')"> 查看下级 </span> | '
                    .'<span class="edit-link" onclick="edit('.$aPermissionsAuths->id.')"><i class="iconfont">&#xe602;</i> 修改</span>';
            })
            ->rawColumns(['control'])
            ->make(true);
    }
}
