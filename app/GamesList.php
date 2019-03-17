<?php

/**
 *  第三方游戏列表
 */

namespace App;

class GamesList extends Base
{
    protected $table = 'games_list';
    protected $primaryKey = 'id';

    public static function getArr()
    {
        $arr = self::select('id', 'pid', 'name')->get();
        $data = [];


    }

    private static function getPid($arr, $pid = 0)
    {
        $data = [];
        foreach ($arr as $k=>$v){
            if($v->pid == $pid){
                $data[] = $v;
                unset($arr[$k]);
            }
        }

    }

}
