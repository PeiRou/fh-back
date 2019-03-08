<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    protected $table = 'level';

    //获取层级选项
    public static function getLevelInfoList(){
        return self::select('name','id','value')->where('status','=',1)->get();
    }

    //获取层级数组
    public static function getLevelArrayValue(){
        $aData = self::select('name','id','value')->get();
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[$iData->value] = $iData;
        }
        return $aArray;
    }
}
