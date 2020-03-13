<?php

namespace App\Http\Controllers\GamesApi\Card;

use Illuminate\Support\Facades\Redis;

class RGNEW extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        Redis::select(11);
        $this->repo->param['start_time'] = Redis::get('rgnew_start_time');
        empty($this->repo->param['start_time']) && $this->repo->param['start_time'] = $param['start_time'] ?? \Illuminate\Support\Facades\DB::table('jq_bet')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('updated_at');
        empty($this->repo->param['start_time']) && $this->repo->param['start_time'] = \Illuminate\Support\Facades\DB::table('jq_bet_his')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('updated_at');
        return $this->repo->getBet();
    }
}
