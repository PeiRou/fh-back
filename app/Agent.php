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

    //模式
    public static $agentModelStatus = [
        '0' => '默认',
        '1' => 'o2o模式',
        '2' => '会员推广模式',
        '3' => '直属代理模式',
    ];

    //获取所有代理商
    public static function getAgentAllBunko($agentId){
        $aSql = 'SELECT `agent`.a_id,`agent`.account,`agent`.name,`agent`.created_at,0 AS `bunko`,`general_agent`.fenhong_rate AS `Gfenhong_rate`,
                `agent`.fenhong_rate,`general_agent`.ga_id AS `g_id`,`general_agent`.account AS `g_account`,`general_agent`.name AS `g_name`
                FROM `agent` 
                INNER JOIN `general_agent` ON `agent`.gagent_id = `general_agent`.ga_id
                WHERE `agent`.created_at < :iTime';
        $aArray = [
            'iTime' => date('Y-m-01')
        ];
        if(is_array($agentId) && count($agentId) > 0){
            $aSql .= ' AND `agent`.a_id NOT IN('.implode(',',$agentId).')';
        }
        return DB::select($aSql,$aArray);
    }

    public static function betAgentReportData(){
        $aSql = "SELECT `agent`.`account` AS `agentAccount`,`agent`.`name` AS `agentName`,`agent`.`a_id` AS `agentId`,
                  `general_agent`.`account` AS `generalAccount`,`general_agent`.`ga_id` AS `generalId`,`general_agent`.`name` AS `generalName`
                  FROM `agent`
                  JOIN `general_agent` ON `general_agent`.`ga_id` = `agent`.`gagent_id`";
        return DB::select($aSql);
    }

    public static function agentReportRegister_aSql($where = '', $having = ''){
        $aSql = "SELECT COUNT(u.id) as countMember, SUM(bet_bunko) AS bet_bunko, SUM(Damount) AS Damount, SUM(Ramount) AS Ramount, SUM(money) AS money, ag.name, ag.a_id as agent, COUNT(FirstTime) AS FirstTimeNum, account
                FROM `agent` AS ag
                LEFT JOIN (
                    SELECT u.id, b.bet_bunko, d.Damount, r.Ramount, u.money, d.user_id, u.agent, FirstTime
                    FROM `users` as u 
                    LEFT JOIN ( SELECT sum( CASE  WHEN b.game_id IN ( 90, 91 ) THEN
                                        nn_view_money ELSE ( CASE WHEN bunko > 0 THEN bunko - bet_money ELSE bunko END ) 
                                    END  ) AS bet_bunko,user_id FROM `bet` AS b WHERE 1 {$where} GROUP BY user_id ) AS b ON b.user_id = u.id
                    LEFT JOIN ( SELECT SUM(d.amount) AS Damount, d.user_id FROM `drawing` AS d WHERE STATUS = 2 {$where} GROUP BY user_id ) AS d ON d.user_id = u.id
                    LEFT JOIN ( SELECT SUM(re.amount) AS Ramount, re.userId FROM `recharges` AS re WHERE STATUS = 2 AND payType != 'adminAddMoney' {$where} GROUP BY userId ) AS r ON r.userId = u.id
                    LEFT JOIN ( SELECT userId, created_at AS FirstTime FROM `recharges` WHERE STATUS = 2 AND payType != 'adminAddMoney' GROUP BY userId  HAVING 1  {$having} ) AS sc ON sc.userId = u.id
                    WHERE testFlag IN ( 0, 2 )
                    {$where}
                ) AS u ON u.agent = ag.a_id 
                GROUP BY a_id
                ORDER BY countMember DESC , a_id DESC";
        return $aSql;
    }
    //用户返回赔率以及返水代理
    public static function returnUserOdds($agentId){
        $aArray = [];
        if(empty($agentId)){
            $aArray['agent_odds'] = null;
            $aArray['user_odds_level'] = null;
        }else{
            $iAgent = Agent::where('a_id',$agentId)->first();
            if(empty($iAgent->superior_agent)) {
                $aArray['agent_odds'] = null;
                $aArray['user_odds_level'] = null;
            }
            else {
                $aArray['agent_odds'] = serialize(AgentOdds::getOddsByAgentArray(explode(',', $iAgent->superior_agent),$agentId));
                $aArray['user_odds_level'] = serialize(AgentOdds::getOddsByAgent($agentId));
            }
        }
        return $aArray;
    }

    //根据代理id获取代理赔率
    public static function getAgentOddsById($superior_agent){
        return serialize(AgentOdds::getOddsByAgent(serialize(explode(',',$superior_agent))));
    }

    public static function updateBatchStitching($data,$fields,$primary,$symbol = '+',$table = 'agent'){
        $aSql = 'UPDATE '. $table . ' SET ';
        foreach ($fields as $field){
            $str1 = '`balance` = `balance` ' . $symbol . ' CASE ' . $primary . ' ';
            foreach ($data as $key => $value){
                $str1 .= 'WHEN \'' . $value[$primary] . '\' THEN \'' . $value[$field] . '\' ';
            }
            $str1 .= 'END , ';
            $aSql .= $str1;
        }
        $aSql = substr($aSql, 0, strlen($aSql) - 2);
        $endStr = 'WHERE ' . $primary . ' IN (';
        foreach ($data as $key => $value) {
            $endStr .= '\'' . $value[$primary] . '\',';
        }
        $endStr = substr($endStr, 0, strlen($endStr) - 1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }

    public static function updateFiledBatchStitching($data,$fields,$primary,$table = 'agent'){
        $aSql = 'UPDATE '. $table . ' SET ';
        foreach ($fields as $field){
            $str1 = '`' . $field . '` = CASE ' . $primary . ' ';
            foreach ($data as $key => $value){
                $str1 .= 'WHEN \'' . $value[$primary] . '\' THEN \'' . $value[$field] . '\' ';
            }
            $str1 .= 'END , ';
            $aSql .= $str1;
        }
        $aSql = substr($aSql, 0, strlen($aSql) - 2);
        $endStr = 'WHERE ' . $primary . ' IN (';
        foreach ($data as $key => $value) {
            $endStr .= '\'' . $value[$primary] . '\',';
        }
        $endStr = substr($endStr, 0, strlen($endStr) - 1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }

    public static function updateBalanceBatch($data,$fields,$table = 'agent'){
        $aSql = 'UPDATE '. $table . ' SET ';
        foreach ($fields as $field){
            $str1 = '`balance` = `balance` + CASE `a_id`  ';
            foreach ($data as $key => $value){
                $str1 .= 'WHEN \'' . $value['a_id'] . '\' THEN \'' . $value[$field] . '\' ';
            }
            $str1 .= 'END , ';
            $aSql .= $str1;
        }
        $aSql = substr($aSql, 0, strlen($aSql) - 2);
        $endStr = 'WHERE `a_id` IN (';
        foreach ($data as $key => $value) {
            $endStr .= '\'' . $value['a_id'] . '\',';
        }
        $endStr = substr($endStr, 0, strlen($endStr) - 1);
        $endStr .= ')';
        $aSql .= $endStr;
        return $aSql;
    }

    //获得下级代理
    public static function getSubordinateAgent($agentId){
        $aSql = "SELECT * FROM `agent` WHERE FIND_IN_SET(:agentId,`superior_agent`)";
        $aArray = ['agentId' => $agentId];
        return DB::select($aSql,$aArray);
    }

    //获取代理id数组
    public static function getAgentIdArrayByGId($gId){
        $aData = self::select('a_id')->where('gagent_id',$gId)->get();
        $aArray = [];
        foreach ($aData as $iData){
            $aArray[] = $iData->a_id;
        }
        return $aArray;
    }

    //获得注册代理数
    public static function getRegisteredCount($date){
        return self::where('created_at','>=',$date)->where('created_at','<=',$date.' 23:59:59')->count();
    }
}
