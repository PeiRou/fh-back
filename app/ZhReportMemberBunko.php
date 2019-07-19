<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZhReportMemberBunko extends Model
{
    protected $table = 'zh_report_member_bunko';
    
    protected $primaryKey = 'id';

    public static function getDataMemberBunko($aTime,$aGameId = []){
        $aSql = "SELECT `user_id`,`agent_id`,SUM(`bet_bunko`) AS `sumBunko`,SUM(`bet_money`) AS `sumBetMoney`,SUM(`bet_count`) AS `betCount`
                    FROM `zh_report_member_bunko` WHERE `date` BETWEEN :startTime AND :endTime ";
        $aArray = [
            'startTime' => $aTime['start'],
            'endTime' => $aTime['end']
        ];
        if(!empty($aGameId) && is_array($aGameId)){
            $aSql .= ' AND `game_id` IN(';
            foreach ($aGameId as $kGameId => $iGameId){
                if($kGameId > 0)
                    $aSql .= ',';
                $aSql .= ':gameId'.$kGameId;
                $aArray['gameId'.$kGameId] = $iGameId;
            }
            $aSql .= ")";
        }
        $aSql .= ' GROUP BY `user_id`,`agent_id`';
        return DB::select($aSql,$aArray);
    }
}
