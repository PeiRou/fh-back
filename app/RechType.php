<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RechType extends Model
{
    protected $table = 'rech_type';
    public $timestamps = false;

    //支付类型
    public static $aPatType = [
        'WY' => '网银',
        'ZFB' => '支付宝',
        'WX' => '微信',
        'QQ' => 'QQ',
        'YL' => '银联扫码',
        'JD' => '京东钱包',
        'BD' => '百度钱包',
        'YLONLINE' => '银联快捷'
    ];

    //修改排序
    public static function editBatchPayOnlineData($data){
        return DB::update(self::updateBatchStitching('rech_type',$data,['sort'],'id'));
    }

    //多行修改拼接
    public static function updateBatchStitching($table,$data,$fields,$primary){
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
}
