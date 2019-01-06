<?php

namespace App\Http\Controllers\Obtain;

use App\Bets;
use App\ReportBet;
use Illuminate\Support\Facades\Log;

class BettingController extends BaseController
{
    //执行方法
    public function doAction($aParam){
        if(strtotime($aParam['startTime']) == strtotime(date('Y-m-d'))){
            $aBet = Bets::todayReportBet($aParam);
        }else{
            $aBet = ReportBet::reportQuery($aParam);
        }
        echo $this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
            'aData' => empty($aBet)?[]:$aBet,
        ]);
    }

}
