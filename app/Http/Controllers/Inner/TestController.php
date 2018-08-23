<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $zxbz_ids = [];
        $zxbz_lose_ids = [];
        $open = explode(',', '龙');
        $user = explode(',', '羊,鸡,狗');
        $bi = array_intersect($open, $user);
        if ($bi) {
            $zxbz_ids[] = '中';
        } else {
            $zxbz_lose_ids[] = '不中';
        }
        return $zxbz_ids;
    }
}
