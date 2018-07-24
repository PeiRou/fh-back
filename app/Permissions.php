<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    //
    protected $table = 'permissions';

    //获取具体权限
    public static function getPermissionOne($id){
        $data = self::where('id','=',$id)->first();
        $data->auth_array = explode(',',$data->auth);
        return $data;
    }

    //修改数据
    public static function savePermissionOne($id,$data){
        return self::where('id','=',$id)->update($data);
    }
}
