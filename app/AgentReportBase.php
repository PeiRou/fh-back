<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AgentReportBase extends Model
{
    protected $table = 'agent_report_base';
    protected $primaryKey = 'agent_report_base_idx';

    //获取平台信息
    public static function getAgentBaseInfo(){
        $data = self::where('agent_report_base_idx','=',1)->first();
        $data->fenhong_rate = json_decode($data->fenhong_rate,true);
        return $data;
    }

    //修改平台信息
    public static function editAgentBaseInfo($data){
        return self::where('agent_report_base_idx','=',1)->update($data);
    }
}
