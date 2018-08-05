<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Levels extends Model
{
    protected $table = 'level';

    //获取层级选项
    public static function getLevelInfoList(){
        return self::select('name','id')->where('status','=',1)->get();
    }
}
