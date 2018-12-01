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
        '1' => '代理模式',
        '2' => '会员推广模式',
    ];

    //获取所有代理商
    public static function getAgentAllBunko(){
        return self::select(DB::raw("a_id,account,name,created_at,0 as bunko"))->where('created_at','<',date('Y-m-01'))->get();
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
            $aArray['user_odds'] = null;
            $aArray['agent_odds'] = null;
            $aArray['user_odds_level'] = null;
        }else{
            $iAgent = Agent::select('agent_odds_setting.level','agent_odds_setting.odds','agent.superior_agent')->where('agent.a_id',$agentId)
                ->join('agent_odds_setting','agent_odds_setting.level','=','agent.odds_level')->first();
            if(empty($iAgent->superior_agent)){
                $aArray['agent_odds'] = null;
            }else{
                $aArray['agent_odds'] = self::getAgentOddsById($iAgent->superior_agent);
            }
            $aArray['user_odds'] = empty($iAgent->odds)?null:$iAgent->odds;
            $aArray['user_odds_level'] = empty($iAgent->level)?null:$iAgent->level;
        }
        return $aArray;
    }

    //根据代理id获取代理赔率
    public static function getAgentOddsById($superior_agent){
        $agent_odds = explode(',',$superior_agent);
        $aAgentOdds = self::select('agent_odds_setting.level','agent_odds_setting.odds','agent.a_id')->whereIn('agent.a_id',$agent_odds)
            ->leftJoin('agent_odds_setting','agent.odds_level','=','agent_odds_setting.level')->get();
        $aArray = [];
//        $aBasisOdds = SystemSetting::getValueByRemark1('agent_odds_basis');
        foreach ($aAgentOdds as $kAgentOdds => $iAgentOdds){
            if(empty($iAgentOdds->level))
                $aArray[$iAgentOdds->a_id] = 0;
            else
                $aArray[$iAgentOdds->a_id] = $iAgentOdds->level;
        }
        return serialize($aArray);
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

    //获得下级代理
    public static function getSubordinateAgent($agentId){
        $aSql = "SELECT * FROM `agent` WHERE FIND_IN_SET(:agentId,`superior_agent`)";
        $aArray = ['agentId' => $agentId];
        return DB::select($aSql,$aArray);
    }
}
