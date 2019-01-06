<?php

namespace App\Http\Controllers\Obtain;

use App\Bets;
use App\Games;
use App\ReportBet;
use Illuminate\Support\Facades\Log;

class GameController extends BaseController
{
    //执行方法
    public function doAction($aParam){
        $aGame = Games::getGameAllData();
        Log::info($aGame);
        echo $this->returnAction([
            'code' => 0,
            'msg' => $this->code[0],
            'aData' => empty($aGame)?[]:$aGame,
        ]);
    }

}
