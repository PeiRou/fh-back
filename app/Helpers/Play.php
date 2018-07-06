<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/6
 * Time: 下午4:20
 */

namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class Play
{
    public function handle($gameId,$playCate,$play,$odds)
    {
        $cate_txt = DB::table('play_cate')->where('gameId',$gameId)->where('id',$playCate)->first();
        $play_txt = DB::table('play')->where('gameId',$gameId)->where('id',$play)->first();
        return "<span class='blue-text'>$cate_txt->name - </span><span class='blue-text'>$play_txt->name</span> @ <span class='red-text'>$odds</span>";
    }
}