<?php
/* AG */
namespace App\Http\Controllers\GamesApi\Card;

class AG extends Base{

    public function getBet($param = [])
    {
       $this->repo->param = $param;
        if($jq_error_bet_id = @app('obj')->jq_error_bet_id > 0){
            $this->repo->param['clear'] = true;
        }
        $this->repo->param['time'] = $this->repo->param['time'] ?? $this->getTime($param);
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
