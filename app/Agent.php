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

    //用户返回赔率以及返水代理
    public static function returnUserOdds($agentId){
        $aArray = [];
        if(empty($agentId)){
            $aArray['user_odds'] = null;
            $aArray['agent_odds'] = null;
        }else{
            $iAgent = Agent::where('a_id',$agentId)->first();
            if(empty($iAgent->superior_agent)){
                $aArray['agent_odds'] = null;
            }else{
                $aArray['agent_odds'] = self::getAgentOddsById($iAgent->superior_agent);
            }
            $aArray['user_odds'] = $iAgent->odds_level;
        }
        return $aArray;
    }

    //根据代理id获取代理赔率
    public static function getAgentOddsById($superior_agent){
        $agent_odds = explode(',',$superior_agent);
        $aAgentOdds = self::select('agent_odds_setting.level','agent.a_id')->whereIn('agent.a_id',$agent_odds)
            ->leftJoin('agent_odds_setting','agent.odds_level','=','agent_odds_setting.level')->get();
        $aArray = [];
        foreach ($aAgentOdds as $kAgentOdds => $iAgentOdds){
            if(empty($iAgentOdds->level))
                $aArray[$iAgentOdds->a_id] = 0;
            else
                $aArray[$iAgentOdds->a_id] = $iAgentOdds->level;
        }
        return serialize($aArray);
    }
}
