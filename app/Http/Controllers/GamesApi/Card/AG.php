<?php
/* AG */
namespace App\Http\Controllers\GamesApi\Card;

class AG extends Base{

    public function getBet($param = [])
    {
        $this->repo->param['time'] = $this->repo->param['time'] ?? $this->getTime($param);
    }

    private function getTime($param = [])
    {

    }
}
