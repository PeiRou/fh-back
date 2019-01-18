<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityHongbaoProbability extends Model
{
    protected $table = 'activity_hongbao_probability';
    protected $primaryKey = 'id';

    //新增一个红包
    public function addHongbao ($data, $param)
    {

    }

    //将一个活动的红包默认都取消掉
    public static function clearDefault ($param)
    {
        return self::where(function($sql) use ($param){
            if(isset($param->activity_id))
                $sql->where('activity_id', (int)$param->activity_id);
        })->update(["is_default"=> 2]);
    }

}
