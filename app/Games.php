<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    protected $table = 'game';
    protected $primaryKey = 'g_id';

    //获取游戏选项
    public static function getGameOption(){
        return self::select('game_id','game_name')->where('status','=',1)->get();
    }
}
