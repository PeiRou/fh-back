<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/9/25
 * Time: 21:51
 */

namespace App;


use SameClass\Service\Cache;

class GamesListPlay extends Base
{
    use Cache;

    protected $table = 'games_list_play';

    public static function getOneList($game_id)
    {
        return self::HandleCacheData(function()use($game_id){
            return GamesListPlay::where(function($sql)use($game_id){
                $sql->where('game_id', $game_id);
            })->get()->keyBy('tag');
        }, 60 * 24 * 7, true, false);
    }

}