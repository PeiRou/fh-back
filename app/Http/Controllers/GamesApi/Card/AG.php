<?php
/* AG */
namespace App\Http\Controllers\GamesApi\Card;

use App\Http\Controllers\Obtain\SendController;
use App\SystemSetting;

class AG extends Base{

    public function getBet($param = [])
    {
        return $this->repo->senterGetBet($param);
    }

    public function getBet1($param = [])
    {
       $this->repo->param = $param;
        if($jq_error_bet_id = @app('obj')->jq_error_bet_id > 0){
            $this->repo->param['clear'] = true;
        }
        $this->repo->param['time'] = $this->repo->param['time'] ?? $this->getTime($param);
        # 转东美时区
        $this->repo->param['time'] = date('YmdHi', strtotime($this->repo->param['time']) - 60 * 60 * 12);
        $this->repo->param['startTime'] = date('YmdHi', strtotime($this->repo->param['time']) - 60 * 60);
        $this->repo->getBet();
        if(!isset($param['lostAndfoundPath'])){
            $this->repo->param['lostAndfoundPath'] = 'lostAndfound/';
            $this->repo->getBet();
        }
    }

    private function getTime($param = [])
    {
        if(!isset($param['toTime'])){
            $param['toTime'] = time();
            $this->repo->all = false;
        }
        return date('YmdHi', $param['toTime'] ?? time());
    }
}
