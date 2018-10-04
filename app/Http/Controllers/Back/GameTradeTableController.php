<?php

namespace App\Http\Controllers\Back;

use App\Play;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameTradeTableController extends Controller
{
    //北京赛车
    public function gameTradeTable50()
    {
        $data = Play::where('gameId',50)->get();
        $filter = ['GAME50_GYDXDS','GAME50_GYZH','GAME50_DXDS','GAME50_1D10'];
        $fromDB = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->bet_tag == $i){
                    $fromDB->put($item->bet_tag.'_min',$item->minMoney);
                    $fromDB->put($item->bet_tag.'_max',$item->maxMoney);
                    $fromDB->put($item->bet_tag.'_turnMax',$item->maxTurnMoney);
                }
            }
        }
        return $fromDB->all();
        //return view('back.gameTradeTables.50')->with('money',$fromDB->all());
    }

    //重庆时时彩
    public function gameTradeTable1()
    {
        return view('back.gameTradeTables.1');
    }
    
    //新疆时时彩
    public function gameTradeTable4()
    {
        return view('back.gameTradeTables.4');
    }

    //天津时时彩
    public function gameTradeTable5()
    {
        return view('back.gameTradeTables.5');
    }

    //广东快乐十分
    public function gameTradeTable60()
    {
        return view('back.gameTradeTables.60');
    }

    //江苏快3
    public function gameTradeTable10()
    {
        return view('back.gameTradeTables.10');
    }

    //安徽快3
    public function gameTradeTable11()
    {
        return view('back.gameTradeTables.11');
    }

    //广西快3
    public function gameTradeTable12()
    {
        return view('back.gameTradeTables.12');
    }

    //湖北快3
    public function gameTradeTable13()
    {
        return view('back.gameTradeTables.13');
    }

    //重庆幸运农场
    public function gameTradeTable61()
    {
        return view('back.gameTradeTables.61');
    }

    //北京快乐8
    public function gameTradeTable65()
    {
        return view('back.gameTradeTables.65');
    }

    //广东11选5
    public function gameTradeTable21()
    {
        return view('back.gameTradeTables.21');
    }

    //PC蛋蛋
    public function gameTradeTable66()
    {
        return view('back.gameTradeTables.66');
    }

    //秒速赛车
    public function gameTradeTable80()
    {
        return view('back.gameTradeTables.80');
    }

    //秒速飞艇
    public function gameTradeTable82()
    {
        return view('back.gameTradeTables.82');
    }

    //秒速时时彩
    public function gameTradeTable81()
    {
        return view('back.gameTradeTables.81');
    }

    //跑马
    public function gameTradeTable99()
    {
        return view('back.gameTradeTables.99');
    }

    //秒速快3
    public function gameTradeTable86()
    {
        return view('back.gameTradeTables.86');
    }

    //幸运快乐8
    public function gameTradeTable83()
    {
        return view('back.gameTradeTables.83');
    }

    //幸运蛋蛋
    public function gameTradeTable84()
    {
        return view('back.gameTradeTables.84');
    }

    //幸运六合彩
    public function gameTradeTable85()
    {
        return view('back.gameTradeTables.85');
    }

    //福彩3D
    public function gameTradeTable30()
    {
        return view('back.gameTradeTables.30');
    }

    //六合彩
    public function gameTradeTable70()
    {
        return view('back.gameTradeTables.70');
    }
}
