<?php

namespace App;

use App\Helpers\RouteConfig;
use Illuminate\Database\Eloquent\Model;

class LogHandle extends Model
{
    protected $table = 'log_handle';
    protected $primaryKey = 'id';

    //获取操作类型
    public static function getTypeOption(){
        $routeLists = PermissionsType::getPermissionType();
        $dataLists = [];
        foreach ($routeLists as $routeList){
            $dataLists[] = [
                'type_id' => $routeList->type_pefix,
                'type_name' => $routeList->type_name
            ];
        }
        return $dataLists;
    }

    //获取类型
    public static function getTypeAction($routeName){
        $routeLists = PermissionsAuth::getPermissionList();
        $data = [];
        foreach ($routeLists as $routeList){
            if($routeList->route_name == $routeName){
                $data = [
                    'type_id' => $routeList->type_pefix,
                    'type_name' => $routeList->type_name,
                    'route' => $routeName,
                    'action' => $routeList->auth_name
                ];
            }
        }
        if(empty($data)){
            $data = [
                'type_id' => 'error',
                'type_name' => '未知类型',
                'route' => $routeName,
                'action' => '未知方法'
            ];
        }
        return $data;
    }

}
