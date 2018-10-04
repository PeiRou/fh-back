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
        $filter = ['GAME50_GYDXDS_min','GAME50_GYZH_min','GAME50_DXDS_min','GAME50_1D10_min','GAME50_GYDXDS_max','GAME50_GYZH_max','GAME50_DXDS_max','GAME50_1D10_max','GAME50_GYDXDS_turnMax','GAME50_GYZH_turnMax','GAME50_DXDS_turnMax','GAME50_1D10_turnMax'];
        $fromDB = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->min_tag == $i){
                    $fromDB->put($item->min_tag,$item->minMoney);
                }
            }
            foreach ($filter as $s){
                if($item->max_tag == $s){
                    $fromDB->put($item->max_tag,$item->maxMoney);
                }
            }
            foreach ($filter as $x){
                if($item->turnMax_tag == $x){
                    $fromDB->put($item->turnMax_tag,$item->maxTurnMoney);
                }
            }
        }
        //return $fromDB->all();
        return view('back.gameTradeTables.50')->with('mm',$fromDB->all());
    }

    //重庆时时彩
    public function gameTradeTable1()
    {
        $data = Play::where('gameId',1)->get();
        $filter = ['GAME1_DXDSLHH_min','GAME1_DXDSLHH_max','GAME1_DXDSLHH_turnMax','GAME1_1D5_min','GAME1_1D5_max','GAME1_1D5_turnMax','GAME1_BAOZI_min','GAME1_BAOZI_max','GAME1_BAOZI_turnMax','GAME1_SHUNZI_min','GAME1_SHUNZI_max','GAME1_SHUNZI_turnMax','GAME1_DBZ_min','GAME1_DBZ_max','GAME1_DBZ_turnMax'];
        $fromDB = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->min_tag == $i){
                    $fromDB->put($item->min_tag,$item->minMoney);
                }
            }
            foreach ($filter as $s){
                if($item->max_tag == $s){
                    $fromDB->put($item->max_tag,$item->maxMoney);
                }
            }
            foreach ($filter as $x){
                if($item->turnMax_tag == $x){
                    $fromDB->put($item->turnMax_tag,$item->maxTurnMoney);
                }
            }
        }
        return view('back.gameTradeTables.1')->with('mm',$fromDB->all());
    }
    
    //新疆时时彩
    public function gameTradeTable4()
    {
        $data = Play::where('gameId',4)->get();
        $filter = ['GAME4_DXDSLHH_min','GAME4_DXDSLHH_max','GAME4_DXDSLHH_turnMax','GAME4_1D5_min','GAME4_1D5_max','GAME4_1D5_turnMax','GAME4_BAOZI_min','GAME4_BAOZI_max','GAME4_BAOZI_turnMax','GAME4_SHUNZI_min','GAME4_SHUNZI_max','GAME4_SHUNZI_turnMax','GAME4_DBZ_min','GAME4_DBZ_max','GAME4_DBZ_turnMax'];
        $fromDB = collect([]);
        foreach ($data as $item){
            foreach ($filter as $i){
                if($item->min_tag == $i){
                    $fromDB->put($item->min_tag,$item->minMoney);
                }
            }
            foreach ($filter as $s){
                if($item->max_tag == $s){
                    $fromDB->put($item->max_tag,$item->maxMoney);
                }
            }
            foreach ($filter as $x){
                if($item->turnMax_tag == $x){
                    $fromDB->put($item->turnMax_tag,$item->maxTurnMoney);
                }
            }
        }
        return view('back.gameTradeTables.4')->with('mm',$fromDB->all());
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
