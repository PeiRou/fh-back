<?php

namespace App\Http\Controllers\Obtain;

use App\Bets;
use App\ReportAgent;
use Illuminate\Support\Facades\Log;

class ReportController extends BaseController
{
    //执行方法
    public function doAction($aParam){
        if(strtotime($aParam['dateTime']) == strtotime(date('Y-m-d')))
            $aData = Bets::AgentTodaySum([
                'timeStart' => $aParam['dateTime'],
                'timeEnd' => $aParam['dateTime'],
            ]);
        else
            $aData = ReportAgent::reportQuerySum([
                'timeStart' => $aParam['dateTime'],
                'timeEnd' => $aParam['dateTime'],
                'general_id' => NULL
            ]);
        echo $this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
            'recharge_money' => empty($aData->recharges_money)?'0.00':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'0.00':$aData->drawing_money,
            'bet_count' => $aData->bet_count,
            'bet_money' => $aData->bet_money,
            'bet_amount' => $aData->bet_amount,
            'activity_money' => empty($aData->activity_money)?'0.00':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'0.00':$aData->handling_fee,
            'odds_amount' => empty($aData->odds_amount)?'0.00':$aData->odds_amount,
            'return_amount' => $aData->return_amount,
            'bet_bunko' => $aData->bet_bunko,
            'fact_return_amount' => $aData->fact_return_amount,
            'fact_bet_bunko' => $aData->fact_bet_bunko,
        ]);
    }

}
