<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = 'roles';

    //获取角色
    public static function getRoleOne($id){
        $data = self::where('id','=',$id)->first();
        $data->permission_array = explode(',',$data->permission_id);
        return $data;
    }

    //修改角色
    public static function saveRoleData($id,$data){
        return self::where('id','=',$id)->update($data);
    }
}
