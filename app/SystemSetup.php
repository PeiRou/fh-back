<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SystemSetup extends Model
{
    protected $table = 'system_setup';
    public $timestamps = false;

    public static function getValueByCode($code){
        return self::where('code',$code)->value('value');
    }
}
