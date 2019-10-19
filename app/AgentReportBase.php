<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentReportBase extends Model
{
    protected $table = 'agent_report_base';
    protected $primaryKey = 'agent_report_base_idx';

    //获取平台信息
    public static function getAgentBaseInfo(){
        $aList = self::get();
        $aData = [];
        foreach ($aList as $iList){
            $aData[$iList->code] = $iList->value;
        }
        $aData = json_decode(json_encode($aData));
        $aData->fenhong_rate = json_decode($aData->fenhong_rate,true);
        $aData->statistics_game = json_decode($aData->statistics_game,true);
        $aData->noNeed_agent = json_decode($aData->noNeed_agent,true);
        return $aData;
    }

    //修改平台信息
    public static function editAgentBaseInfo($data){
        return self::where('agent_report_base_idx','=',1)->update($data);
    }
}
