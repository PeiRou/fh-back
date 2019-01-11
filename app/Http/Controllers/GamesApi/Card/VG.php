<?php
/* VG */
namespace App\Http\Controllers\GamesApi\Card;


class VG extends Base{

    //获取棋牌投注详情
    public function getBet()
    {
        $tableName = 'jq_'.strtolower($this->repo->gameInfo->alias).'_bet';
        $id = \Illuminate\Support\Facades\DB::table($tableName)->orderBy('id','desc')->value('GameID');
        $res = $this->repo->gamerecordid();
        p($res, 1);
    }

}
