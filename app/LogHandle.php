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
            $routeLists = RouteConfig::$routeList;
            $dataLists = [];
            foreach ($routeLists as $key => $routeList){
                $dataLists[] = [
                    'type_id' => $key,
                    'type_name' => $routeList['name']
                ];
            }
            return $dataLists;
        }

}
