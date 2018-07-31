<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionsAuth extends Model
{
    //
    protected $table = 'permissions_auth';

    //获取权限列表
    public static function getPermissionLowerLevelList(){
        $aPermissions = self::select('id','pid','auth_name','open','route_name')->orderBy('sort','asc')->get();
        return self::privilegeArrayCategorization($aPermissions);

    }

    //权限数组归类
    public static function privilegeArrayCategorization($params,$id = 0,$retrunData = []){
        foreach ($params as $key => $param){
            if($param->pid == $id){
                $retrunData[$key] = $param;
                $retrunData[$key]->child = self::privilegeArrayCategorization($params,$param->id);
            }
        }
        return $retrunData;
    }

    //获取权限
    public static function getPermissionList($pid = '',$route_name = ''){
        $aSql = self::select('permissions_type.type_name','permissions_type.type_pefix','permissions_auth.open','permissions_auth.auth_name','permissions_auth.route_name','permissions_auth.created_at','permissions_auth.id','permissions_auth.pid','permissions_auth.type_id');
        if($pid !== ''){
            $aSql->where('pid','=',$pid);
        }
        if($route_name !== ''){
            $aSql->where('route_name','=',$route_name);
        }
        return $aSql->join('permissions_type','permissions_type.id','=','permissions_auth.type_id')->get();
    }

    //获取具体权限
    public static function getPermissionOne($id){
        return self::where('id','=',$id)->first();
    }
}
