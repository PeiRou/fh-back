<?php

namespace App\Http\Controllers\Back;

use App\Permissions;
use App\PermissionsAuth;
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
        if($permission->save()){
            return response()->json([
                'status'=>true
            ]);
        }else{
            return response()->json([
                'status'=>false,
                'msg'=>'暂时无法添加，请稍后重试'
            ]);
        }
    }

    //修改权限
    public function editPermission(Request $request){
        $params = $request->all();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        $data = [];
        if(isset($params['permission_name']) && array_key_exists('permission_name',$params)){
            $data['name'] = $params['permission_name'];
        }
        if(isset($params['permission_selected']) && array_key_exists('permission_selected',$params)){
            $data['auth'] = $params['permission_selected'];
        }
        if(isset($params['permission_group']) && array_key_exists('permission_group',$params)){
            $data['group_name'] = $params['permission_group'];
        }
        if(Permissions::savePermissionOne($params['id'],$data)){
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

    //添加权限控制
    public function addPermissionAuth(Request $request){
        $params = $request->all();
        $mPermissionAuth = new PermissionsAuth();
        $mPermissionAuth->pid = $params['p_id'];
        $mPermissionAuth->auth_name = $params['auth_name'];
        $mPermissionAuth->route_name = $params['route_name'];
        $mPermissionAuth->type_id = $params['type_id'];
        $mPermissionAuth->open = $params['open'];
        $mPermissionAuth->sort = $params['sort'];
        if($mPermissionAuth->save()){
            return response()->json([
                'status'=>true
            ]);
        }
        return response()->json([
            'status'=>false,
            'msg'=>'暂时无法添加，请稍后重试'
        ]);
    }

    //修改权限控制
    public function editPermissionAuth(Request $request){
        $params = $request->all();
        if(!isset($params['id']) && !array_key_exists('id',$params)){
            return response()->json(['status'=>false,'msg'=>'修改id为空']);
        }
        $data = [];
        if(isset($params['p_id']) && array_key_exists('p_id',$params)){
            $data['pid'] = $params['p_id'];
        }
        if(isset($params['auth_name']) && array_key_exists('auth_name',$params)){
            $data['auth_name'] = $params['auth_name'];
        }
        if(isset($params['route_name']) && array_key_exists('route_name',$params)){
            $data['route_name'] = $params['route_name'];
        }
        if(isset($params['type_id']) && array_key_exists('type_id',$params)){
            $data['type_id'] = $params['type_id'];
        }
        if(isset($params['open']) && array_key_exists('open',$params)){
            $data['open'] = $params['open'];
        }
        if(isset($params['sort']) && array_key_exists('sort',$params)){
            $data['sort'] = $params['sort'];
        }
        if(PermissionsAuth::where('id','=',$params['id'])->update($data)){
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
