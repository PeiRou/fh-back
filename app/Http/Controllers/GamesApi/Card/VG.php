<?php
/* VG */
namespace App\Http\Controllers\GamesApi\Card;


class VG extends Base{

    //获取棋牌投注详情
    public function getBet($param = [])
    {
        $tableName = 'jq_'.strtolower($this->repo->gameInfo->alias).'_bet';
        $this->repo->param['id'] = $this->repo->param['id'] ?? \Illuminate\Support\Facades\DB::table($tableName)->orderBy('id','desc')->value('GameID');
        if(empty($res = $this->repo->gamerecordid()))
            return $this->show(500, '超时！');
        if ($res['state'] === 0) {
            return $this->repo->createData($res['value']);
        }
        return $this->show($res['state'] ?? 14, 'error');
    }

}
