<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PromotionRecode extends Model
{
    protected $table = 'promotion_record';

    protected $primaryKey = 'id';

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = 'SELECT `promotion_user_id`,`game_id`,`user_id`,SUM(`money`) AS `money` FROM `promotion_record` 
                    WHERE `date` >= :startTime AND `date` <= :endTime GROUP BY `game_id`,`user_id`,`promotion_user_id`';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }
}
