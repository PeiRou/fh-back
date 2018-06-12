<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/1/24
 * Time: 下午9:00
 */

namespace App\Http\Proxy;


use Illuminate\Support\Facades\Session;

class CheckPermission
{
    public function hasPermission($data)
    {
        $getAccountPermission = Session::get('account_permission');
        $permissionArray = explode(',',$getAccountPermission);
        if(in_array($data,$permissionArray)) {
            return "has";
        }
    }

    public function hasPermissionItem($data)
    {
        return $data;
    }
}