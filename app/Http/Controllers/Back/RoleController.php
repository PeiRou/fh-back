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

    //修改角色
    public function editNewRole(Request $request){
        $params = $request->all();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        $data = [];
        if(isset($params['permission_id']) && array_key_exists('permission_id',$params)){
            $data['permission_id'] = implode(',',$params['permission_id']);
        }
        if(isset($params['role_name']) && array_key_exists('role_name',$params)){
            $data['name'] = $params['role_name'];
        }
        if(Roles::saveRoleData($params['id'],$data)){
            return response()->json([
                'status'=>true
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法修改，请稍后重试'
            ]);
        }
    }
}
