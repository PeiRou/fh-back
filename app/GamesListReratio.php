<?php

/**
 *  第三方游戏列表
 */

namespace App;

use Illuminate\Support\Facades\DB;

class GamesListReratio extends Base
{
    protected $table = 'games_list_reratio';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getGidArrayValue(){
        $aData = self::select('list_gid','betamount_threshold','rebate_limit','reratio')
            ->orderBy('list_gid','asc')->orderBy('betamount_threshold','asc')
            ->get();
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[$iData->list_gid][] = $iData;
        }
        return $aArray;
    }
}
