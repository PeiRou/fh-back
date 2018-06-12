<?php

namespace App\Http\Controllers\Back;

use App\Permissions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //添加权限
    public function addPermission(Request $request)
    {
        $name = $request->input('permission_name');
        $permissions = $request->input('permission_selected');
        $permission_group = $request->input('permission_group');

        $permission = new Permissions();
        $permission->name = $name;
        $permission->auth = $permissions;
        $permission->group_name = $permission_group;
        $permission->save();
    }
}
