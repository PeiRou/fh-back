<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdvertiseValue extends Model
{
    protected $table = 'advertise_value';

    public $advertiseStatus = [
        '1' => '开启',
        '2' => '关闭',
    ];

    //多行修改拼接
    public static function updateBatchStitching($data,$fields,$primary = 'id',$table = 'advertise_value'){
        $aSql = 'UPDATE '. $table . ' SET ';
        foreach ($fields as $field){
            $str1 = $field . ' = CASE ' . $primary . ' ';
            foreach ($data as $key => $value){
                $str1 .= 'WHEN \'' . $value[$primary] . '\' THEN \'' . $value[$field] . '\' ';
            }
            $str1 .= 'END , ';
            $aSql .= $str1;
        }
        $aSql = substr($aSql,0,strlen($aSql)-2);
        $endStr = 'WHERE ' . $primary . ' IN (';
        foreach ($data as $key => $value){
            $endStr .= '\''.$value[$primary] . '\',';
        }
        $endStr = substr($endStr,0,strlen($endStr)-1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }

    //获得内容
    public static function getValueByInfoId($infoId){
        return self::where('info_id',$infoId)->value('js_value');
    }
}
