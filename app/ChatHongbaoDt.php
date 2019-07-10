<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChatHongbaoDt extends Model
{
    protected $table = 'chat_hongbao_dt';
    protected $primaryKey = 'chat_hongbao_dt_idx';

    public static function betMemberReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(`amount`) AS `amount`,LEFT(`getdatetime`,10) AS `date`,`users_id` FROM `chat_hongbao_dt` 
                    WHERE `hongbao_dt_status` = 2 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= ' `getdatetime` >= :startTime';
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= ' `getdatetime` >= :endTime';
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `users_id` ORDER BY `getdatetimes` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(`chat_hongbao_dt`.`amount`) AS `amount`,LEFT(`chat_hongbao_dt`.`getdatetime`,10) AS `date`,`users`.agent
                    FROM `chat_hongbao_dt` 
                    JOIN `users` ON `users`.id = `chat_hongbao_dt`.users_id
                    WHERE `hongbao_dt_status` = 2 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= ' `chat_hongbao_dt`.`getdatetime` >= :startTime';
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= ' `chat_hongbao_dt`.`getdatetime` >= :endTime';
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `users`.agent ORDER BY `chat_hongbao_dt`.`getdatetimes` ASC";
        return DB::select($aSql,$aArray);
    }

    public static function betGeneralReportData($startTime = '',$endTime = ''){
        $aSql = "SELECT SUM(`chat_hongbao_dt`.amount) AS `amount`,LEFT(`chat_hongbao_dt`.`getdatetime`,10) AS `date`,`agent`.gagent_id
                    FROM `chat_hongbao_dt`
                    JOIN `users` ON `users`.id = `chat_hongbao_dt`.users_id
                    JOIN `agent` ON `agent`.a_id = `users`.agent
                    WHERE `hongbao_dt_status` = 2 ";
        $aArray = [];
        if(!empty($startTime)){
            $aSql .= ' `chat_hongbao_dt`.`getdatetime` >= :startTime';
            $aArray['startTime'] = $startTime;
        }
        if(!empty($endTime)){
            $aSql .= ' `chat_hongbao_dt`.`getdatetime` >= :endTime';
            $aArray['endTime'] = $endTime;
        }
        $aSql .= " GROUP BY `agent`.gagent_id ORDER BY `chat_hongbao_dt`.`getdatetimes` ASC";
        return DB::select($aSql,$aArray);
    }
}
