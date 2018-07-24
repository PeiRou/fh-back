<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionsType extends Model
{
    //
    protected $table = 'permissions_type';

    //获得权限类型
    public static function getPermissionType(){
        return self::select('id','type_name','type_pefix')->orderBy('sort','asc')->get();
    }
}
