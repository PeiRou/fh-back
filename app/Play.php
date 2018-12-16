<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Play extends Model
{
    protected $table = 'play';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function getOddsGroupByOddsTag($gameId){
        $aSql = "SELECT `play`.odds,`play`.odds_tag,`play_cate`.name FROM `play`
                  JOIN `play_cate` ON `play_cate`.id = `play`.playCateId 
                  WHERE `play`.`gameId` = :gameId GROUP BY `odds_tag`";
        $aArray = [
            'gameId' => $gameId,
        ];
        return DB::select($aSql,$aArray);
    }
}
