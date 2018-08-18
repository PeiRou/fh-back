<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Notices extends Model
{
    protected $table = 'notice';

    //公告类型
    public static $noticesStatus = [
        '1' => '1.最新消息(投注区底部公告)',
        '2' => '2.最新消息(登录弹窗公告)',
        '3' => '3.推广页公告',
        '4' => '4.所有类型公告(包含：1、2、3)',
        '5' => '5.代理专属公告',
    ];

    //修改排序
    public static function editBatchNoticesData($data){
        return DB::update(self::updateBatchStitching('notice',$data,['sort'],'id'));
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

    //获取公告
    public static function getNoticesInfoOne($id){
        return self::where('id','=',$id)->first();
    }
}
