<?php

namespace App\Http\Controllers\Inner;

use App\Play;
use App\PlayCates;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class innerActionController extends Controller
{
    public function playCate(Request $request)
    {
        $gameId = $request->input('gameId');
        $name = $request->input('name');
        $code = $request->input('code');
        $isShow = $request->input('isShow');
        $isBan = $request->input('isBan');

        $playCate = new PlayCates();
        $playCate->gameId = $gameId;
        $playCate->name = $name;
        $playCate->code = $code;
        $playCate->isShow = $isShow;
        $playCate->isBan = $isBan;
        $insert = $playCate->save();
        if($insert == 1){
            return response()->json([
                'status'=>true
            ]);
        } else {
            return response()->json([
                'status'=>true,
                'msg'=>'Fail'
            ]);
        }
    }

    public function play(Request $request)
    {
        $gameId = $request->input('gameId');
        $playCateId = $request->input('playCateId');
        $name = $request->input('name');
        $code = $request->input('code');
        $odds = $request->input('odds');
        $rebate = $request->input('rebate');
        $minMoney = $request->input('minMoney');
        $maxMoney = $request->input('maxMoney');
        $maxTurnMoney = $request->input('maxTurnMoney');
        $alias = $request->input('alias');

        $play = new Play();
        $play->name = $name;
        $play->code = $code;
        $play->alias = $alias;
        $play->playCateId = $playCateId;
        $play->gameId = $gameId;
        $play->odds = $odds;
        $play->rebate = $rebate;
        $play->minMoney = $minMoney;
        $play->maxMoney = $maxMoney;
        $play->maxTurnMoney = $maxTurnMoney;
        $insert = $play->save();
        if($insert == 1){
            return response()->json([
                'status'=>true
            ]);
        } else {
            return response()->json([
                'status'=>true,
                'msg'=>'Fail'
            ]);
        }
    }

    public function getPlayCateItem(Request $request)
    {
        $gameId = $request->get('gameId');
        if($gameId){
            $get = PlayCates::where('gameId',$gameId)->get();
            return response()->json([
                'status'=>true,
                'data'=>$get
            ]);
        }
    }
}
