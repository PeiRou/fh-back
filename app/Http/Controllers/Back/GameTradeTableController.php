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
        return view('back.gameTradeTables.50');
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
}
