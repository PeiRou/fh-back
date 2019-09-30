<?php
/* VG */
namespace App\Http\Controllers\GamesApi\Card;


class VG extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        $this->repo->param['id'] = $this->repo->param['id'] ?? \Illuminate\Support\Facades\DB::table('jq_bet')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('GameID');
        empty($this->repo->param['id']) && $this->repo->param['id'] = \Illuminate\Support\Facades\DB::table('jq_bet_his')->where('g_id', $this->repo->gameInfo->g_id)->orderBy('id','desc')->value('GameID');
        if(empty($res = $this->repo->gamerecordid()))
            return $this->show(500, '超时！');
        if ($res['state'] === 0) {
            return $this->repo->createData($res['value']);
        }
        return $this->show($res['state'] ?? 14, $this->repo->code[$res['state']] ?? $res['message'] ?? 'error');
    }

}
