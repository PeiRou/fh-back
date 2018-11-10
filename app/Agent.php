<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Agent extends Model
{
    protected $table = 'agent';
    protected $primaryKey = 'a_id';

    //状态
    public static $agentStatus = [
        '1' => '正常',
        '2' => '冻结',
        '3' => '停用',
    ];

    //获取所有代理商
    public static function getAgentAllBunko(){
        return self::select(DB::raw("a_id,account,name,created_at,0 as bunko"))->where('created_at','<',date('Y-m'))->get();
    }

    public static function betAgentReportData(){
        $aSql = "SELECT `agent`.`account` AS `agentAccount`,`agent`.`name` AS `agentName`,`agent`.`a_id` AS `agentId`,
                  `general_agent`.`account` AS `generalAccount`,`general_agent`.`ga_id` AS `generalId`,`general_agent`.`name` AS `generalName`
                  FROM `agent`
                  JOIN `general_agent` ON `general_agent`.`ga_id` = `agent`.`gagent_id`";
        return DB::select($aSql);
    }

    public static function agentReportRegister_aSql($where = '', $having = ''){
        $aSql = "SELECT COUNT(u.id) as countMember, SUM(bet_bunko) AS bet_bunko, SUM(Damount) AS Damount, SUM(Ramount) AS Ramount, SUM(money) AS money, ag.name, ag.a_id as agent, COUNT(FirstTime) AS FirstTimeNum
                FROM `agent` AS ag
                LEFT JOIN (
                    SELECT u.id, b.bet_bunko, d.Damount, r.Ramount, u.money, d.user_id, u.agent, FirstTime
                    FROM `users` as u 
                    LEFT JOIN ( SELECT sum( CASE  WHEN b.game_id IN ( 90, 91 ) THEN
                                        nn_view_money ELSE ( CASE WHEN bunko > 0 THEN bunko - bet_money ELSE bunko END ) 
                                    END  ) AS bet_bunko,user_id FROM `bet` AS b GROUP BY user_id ) AS b ON b.user_id = u.id
                    LEFT JOIN ( SELECT SUM(d.amount) AS Damount, d.user_id FROM `drawing` AS d WHERE STATUS = 2  GROUP BY user_id ) AS d ON d.user_id = u.id
                    LEFT JOIN ( SELECT SUM(re.amount) AS Ramount, re.userId FROM `recharges` AS re WHERE STATUS = 2 AND payType != 'adminAddMoney' GROUP BY userId ) AS r ON r.userId = u.id
                    LEFT JOIN ( SELECT userId, created_at AS FirstTime FROM `recharges` WHERE STATUS = 2 AND payType != 'adminAddMoney' GROUP BY userId  HAVING 1  {$having} ) AS sc ON sc.userId = u.id
                    WHERE testFlag IN ( 0, 2 )
                    {$where}
                ) AS u ON u.agent = ag.a_id
                GROUP BY a_id
                ORDER BY countMember DESC";
        return $aSql;
    }
}
