<?php

namespace App\Http\Controllers\GamesApi\Card;

class GG extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        if($param['issue'] == 1){
            $param['issue'] = null;
        }
        if(isset($param['clear']) && $param['clear'] == 45){
            $this->pvp($param);
        }elseif(isset($param['clear']) && $param['clear'] == 46){
            $this->rng($param);
        }else{
            $this->pvp($param);
            $this->rng($param);
        }
    }

    public function pvp($param = [])
    {
        $this->repo->gameListArr['game_id'] = 45;
        $index = $param['issue'] ?? $this->getindex(45);
        $res = $this->repo->hook('pvp',$index);
        if(count($res)){
            $this->repo->insertError($res['code'] ?? 500, $res['msg'] ?? 'ok');
        }
    }

    public function rng($param = [])
    {
        $this->repo->gameListArr['game_id'] = 46;
        $index = $param['issue'] ?? $this->getindex(46);
        $res = $this->repo->hook('rng',$index);
        if(count($res)){
            $this->repo->insertError($res['code'] ?? 500, $res['msg'] ?? 'ok');
        }
    }

    public function getindex($game_id)
    {
        $id = \Illuminate\Support\Facades\DB::table('jq_bet')->where('game_id', $game_id)->orderBy('id','desc')->value('GameID');
        empty($id) && $id = \Illuminate\Support\Facades\DB::table('jq_bet_his')->where('game_id', $game_id)->orderBy('id','desc')->value('GameID');
        return $id ?? 0;
    }
}
