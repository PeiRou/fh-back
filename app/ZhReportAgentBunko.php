<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ZhReportAgentBunko extends Model
{
    protected $table = 'zh_report_agent_bunko';

    protected $primaryKey = 'id';

    //获取第三方数据
    public static function getThirdData($startTime,$endTime){
        $aSql = 'SELECT `zh_report_agent_bunko`.agent_id,`zh_report_agent_bunko`.agent_account,`zh_report_agent_bunko`.agent_name, 
                    `zh_report_agent_bunko`.game_id,`zh_report_agent_bunko`.bet_money,`zh_report_agent_bunko`.game_name,`agent`.superior_agent
                    FROM `zh_report_agent_bunko`
                    INNER JOIN `agent` ON `agent`.a_id = `zh_report_agent_bunko`.agent_id AND `agent`.modelStatus = 1
                    WHERE `game_id` > 0 AND `date` >= :startTime AND `date` <= :endTime';
        $aArray = [
            'startTime' => $startTime,
            'endTime' => $endTime
        ];
        return DB::select($aSql,$aArray);
    }
}
