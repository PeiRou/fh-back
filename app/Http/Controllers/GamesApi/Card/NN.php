<?php

namespace App\Http\Controllers\GamesApi\Card;

class NN extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        $this->repo->param['id'] = $param['id'] ?? \Illuminate\Support\Facades\DB::table('jq_bet')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('GameID','desc')->value('GameID');
        empty($this->repo->param['id']) && $this->repo->param['id'] = \Illuminate\Support\Facades\DB::table('jq_bet_his')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('GameID','desc')->value('GameID');
        return $this->repo->getBet();
    }
}
