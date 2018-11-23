<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GamesApi extends Model
{
    protected $table = 'games_api';
    protected $primaryKey = 'g_id';

    //获取游戏信息
    public static function getGamesApiInfo($g_id){
        return self::where('g_id', $g_id)->first();
    }
    //获取所有游戏
    public static function getList(){
        return self::get();
    }
    //检查游戏是否开启
    public static function getStatus($g_id){
        return self::where('g_id', $g_id)->value('status');
    }

}
