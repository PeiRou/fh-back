<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SystemSetting extends Model
{
    protected $table = 'system_setting';
    public $timestamps = false;

    public function getValueByRemark($value){
        return $this->where('id',1)->value($value);
    }

    public static function getValueByRemark1($value){
        return self::where('id',1)->value($value);
    }
}
