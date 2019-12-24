<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/12/20
 * Time: 13:44
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BalanceIncomeDay extends Model
{
    protected $table = 'balance_income_day';

    public static function betMemberReportData($aDateTime)
    {
        return self::select('user_id', 'money')->where('date', $aDateTime)->pluck('money', 'user_id');
    }

    public static function betAgentReportData($aDateTime)
    {
        $sql = "SELECT
                    sum( b.money ) AS money,
                    COUNT(DISTINCT(`u`.`id`)) AS `userIdCount`,
                    u.agent ,
                    `date`
                FROM
                    balance_income_day AS b
                    LEFT JOIN users AS u ON u.id = b.user_id 
                WHERE
                    1 
                    AND date = '{$aDateTime}' 
                    AND `b`.`test_flag` = 0 
                GROUP BY
                    u.agent,`date`";
        return DB::select($sql);
    }

    public static function betGAgentReportData($aDateTime)
    {
        $sql = " SELECT
                    sum( b.money ) AS money,
                    COUNT(DISTINCT(`u`.`id`)) AS `userIdCount`,
                    COUNT(DISTINCT(`agent`.`a_id`)) AS `agentIdCount`,
                    `date`,
                    `agent`.`gagent_id` AS `generalId` 
                FROM
                    balance_income_day AS b
                    LEFT JOIN users AS u ON u.id = b.user_id
                    JOIN `agent` ON `agent`.`a_id` = `u`.`agent` 
                WHERE
                    1 
                    AND date = '{$aDateTime}'
                    AND `b`.`test_flag` = 0 
                GROUP BY
                    `generalId`,`date` ";
        return DB::select($sql);
    }

}
