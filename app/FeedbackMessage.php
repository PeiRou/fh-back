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
}
