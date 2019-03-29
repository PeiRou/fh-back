<?php

/**
 *  第三方游戏列表
 */

namespace App;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GamesList extends Base
{
    protected $table = 'games_list';
    protected $primaryKey = 'id';

    public static function getArr($param = [])
    {
        $arr = self::select('id', 'pid', 'name')->get();
        return self::getTree($arr->toArray());
    }

    //获取的游戏
    public static function getList($param = [])
    {
        return self::select('games_api.type_id','games_list.name','game_id')
//        return self::select()
            ->leftJoin('games_api', 'games_api.g_id', 'games_list.g_id')
            ->where(function($sql) use($param){
                isset($param['type_id']) &&
                    $sql->where('games_api.type_id', $param['type_id']);
                isset($param['type']) &&
                    $sql->where('games_api.type', $param['type']);
            })
            ->groupBy('games_list.name')
            ->get();
    }

    public static $productType = [
        4 => 'AG',
        17 => 'Ameba(AE)',
        25 => 'Lotus',
        30 => 'IBC(沙巴)',
        47 => 'BTI',
        43 => 'MG',
        3 => 'PT',
    ];

    public static $gameCategory = [
        'RNG' => '电子',
        'LIVE' => '真人',
        'FISH' => '捕鱼',
        'SPORTS' => '体育',
    ];


}
