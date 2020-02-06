<?php

namespace App\Http\Controllers\GamesApi\Card;

use Illuminate\Support\Facades\Redis;

class NN extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        Redis::select(11);
        $this->repo->param['id'] = Redis::get('nn_id');
        empty($this->repo->param['id']) && $this->repo->param['id'] = $param['id'] ?? \Illuminate\Support\Facades\DB::table('jq_bet')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('GameID');
        empty($this->repo->param['id']) && $this->repo->param['id'] = \Illuminate\Support\Facades\DB::table('jq_bet_his')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('GameID');
        return $this->repo->getBet();
    }
}
