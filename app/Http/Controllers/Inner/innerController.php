<?php

namespace App\Http\Controllers\Inner;

use App\Games;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class innerController extends Controller
{
    //录入玩法分类
    public function playCate()
    {
        $game = Games::all();
        return view('inner.playCate',compact('game'));
    }

    //录入玩法
    public function play()
    {
        $game = Games::all();
        return view('inner.play',compact('game'));
    }
}
