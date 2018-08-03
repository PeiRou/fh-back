<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayType extends Model
{
    protected $table = 'pay_type';

    //获取类型
    public static function getPayTypeAllList(){
        $data = self::select('id','rechName')->get();
        $list = [];
        foreach ($data as $value){
            $list[$value->id] = $value->rechName;
        }
        return $list;
    }
}
