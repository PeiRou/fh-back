<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/3/3
 * Time: 下午5:37
 */

namespace App\Http\Proxy;


use App\Bets;
use App\PlayCates;
use Illuminate\Support\Facades\Log;

class SettleMssc
{
    public function settle($openNum,$issue)
    {
        $findIssue = Bets::where('issue',$issue)->get();
        $num = explode(',',$openNum);
        //冠亚和
        $GYJH = $num[0]+$num[1];
        $GYJH_cate_id = $this->getCate('GYJH');

        //Log::info($GYJH_cate_id);
    }

    function getCate($cateCode){
        $cate = PlayCates::where('gameId',80)->where('code',$cateCode)->first();
        return $cate->id;
    }

    //冠亚和-冠亚大
    function GYH_GYD($GYJH){

    }
}