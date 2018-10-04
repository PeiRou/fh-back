<?php

namespace App\Http\Controllers\Back;

use App\Play;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameTradeTableController extends Controller
{
    public function gameTradeTable50()
    {
        $data = Play::where('gameId',50)->get();
        return view('back.gameTradeTables.50');
    }
}
