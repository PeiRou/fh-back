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

    public static function betMemberReportData($startTime = '',$endTime = ''){
        return self::select('zh_report_member_bunko.*','level.third_rebate','users.money as userMoney')
            ->where(function ($aSql) use($startTime,$endTime){
                if(!empty($startTime)){
                    $aSql->where('zh_report_member_bunko.date','>=',$startTime);
                }
                if(!empty($endTime)){
                    $aSql->where('zh_report_member_bunko.date','<=',$startTime);
                }
                $aSql->where('zh_report_member_bunko.game_id','>',0);
            })
            ->join('users','users.id','=','zh_report_member_bunko.user_id')
            ->join('level','level.value','=','users.rechLevel')
            ->get();
    }

    public static function betMemberPromotionData($startTime = '',$endTime = ''){
        $aSql = "SELECT `re`.*,`users`.user_odds_level,`level`.users_promoter_shangji FROM
                    (SELECT `game_id`,`game_name`,`user_id`,`user_account`,`user_name`,SUM(`bet_money`) AS `bet_money`
                        FROM `zh_report_member_bunko` WHERE `date` >= :startTime AND `date` <= :endTime 
                        GROUP BY `user_id`,`game_id`
                    ) AS `re`
                    JOIN `users` ON `users`.id = `re`.user_id
                    JOIN `level` ON `level`.value = `users`.rechLevel";
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime,
        ];
        return DB::select($aSql,$aArray);
    }
}
