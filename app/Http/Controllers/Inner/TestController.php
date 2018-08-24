<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $zx_plays = ['鼠'=>3729,'牛'=>3730,'虎'=>3731,'兔'=>3732,'龙'=>3733,'蛇'=>3734,'马'=>3735,'羊'=>3736,'猴'=>3737,'鸡'=>3738,'狗'=>3739,'猪'=>3740];
        $openSX = ['鼠','虎','龙','蛇','羊','鸡'];
        $countOpen = array_count_values($openSX);
        return $countOpen;
    }
}
