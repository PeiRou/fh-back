<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedbackMessage extends Model
{
    protected $table = 'feedback_message';
    protected $primaryKey = 'id';

    public static $role = [
        'feedback_id' => 'required|integer',
        'content' => 'required|string',
    ];

    //获取反馈内容
    public static function getFeedbackMessageList($id){
        return self::where('feedback_id','=',$id)->orderBy('created_at','ASC')->get();
    }
    //获取所有信息
    public static function getAll($aParam){
        return self::where(function($aSql) use($aParam){
            if(isset($aParam['dateTime'])){
                $aSql->whereBetween('created_at',[$aParam['dateTime'].' 00:00:00', $aParam['dateTime'].' 23:59:59']);
            }
        })->get();
    }
}
