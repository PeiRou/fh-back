<?php

namespace App\Http\Controllers\Back\Data;

use App\Permissions;
use App\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Contracts\DataTable;
use Yajra\DataTables\DataTables;

class SystemDataController extends Controller
{
    //权限-表格数据
    public function permissions()
    {
        $permissions = Permissions::all();
        return DataTables::of($permissions)
            ->make(true);
    }
    
    //角色-表格数据
    public function roles()
    {
        $roles = Roles::all();
        return DataTables::of($roles)
            ->make(true);
    }
}
