<?php

namespace App\Http\Controllers\Back;

use App\Roles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    //添加角色
    public function addNewRole(Request $request)
    {
        $permission_id = $request->input('permission_id');
        $role_name = $request->input('role_name');
        $new_permission_id = implode(',',$permission_id);

        $role = new Roles();
        $role->name = $role_name;
        $role->permission_id = $new_permission_id;
        $role->type = 'system';
        $role->save();
    }
}
