<?php
/* VG */
namespace App\Http\Controllers\GamesApi\Card;


class VGNEW extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        \Illuminate\Support\Facades\Redis::select(11);
        $this->repo->param['id'] = \Illuminate\Support\Facades\Redis::get('vg_id');
        empty($this->repo->param['id']) && $this->repo->param['id'] = $this->repo->param['id'] ?? \Illuminate\Support\Facades\DB::table('jq_bet')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('GameID');
        empty($this->repo->param['id']) && $this->repo->param['id'] = \Illuminate\Support\Facades\DB::table('jq_bet_his')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('GameID');
        $res = $this->repo->hook('getBet');
        return $this->show($res['code'] ?? 0, $res['msg'] ?? '');
    }

}