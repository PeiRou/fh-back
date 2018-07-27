<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agent extends Model
{
    protected $table = 'agent';
    protected $primaryKey = 'a_id';

    //获取所有代理商
    public static function getAgentAllBunko(){
        return self::select(DB::raw("a_id,account,name,created_at,0 as bunko"))->where('created_at','<',date('Y-m'))->get();
    }
}
