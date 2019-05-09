<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PromotionConfig extends Model
{
    protected $table = 'promotion_config';
    protected $primaryKey = 'id';

    public static $role = [
        'level' => 'required|integer',
        'money' => 'required',
        'proportion' => 'required',
    ];

    //获取单个详情
    public static function getPromotionConfigInfoOne($id){
        return self::where('id','=',$id)->first();
    }

    //获取推广结算
    public static function getPromotionConfigList(){
        $data = self::select('level','money','proportion')->where('level',1)->get();
        $array = [];
        foreach ($data as $value){
            $array[$value->level] = [
                'money' => $value->money,
                'proportion' => $value->proportion,
            ];
        }
        return $array;
    }

    //获取推广层级
    public static function getPromotionList(){
        $aData = self::select('level','proportion')->get();
        $aArray =[];
        foreach ($aData as $iData)
            $aArray[$iData->level]= $iData->proportion;
        return $aArray;
    }

}
