<?php

/**
 *  第三方游戏列表
 */

namespace App;

class GamesList extends Base
{
    protected $table = 'games_list';
    protected $primaryKey = 'id';

    public static function getArr($param = [])
    {
        $arr = self::select('id', 'pid', 'name')->get();
        return self::getTree($arr->toArray());
    }


}
