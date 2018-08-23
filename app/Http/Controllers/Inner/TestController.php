<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $open = ['鼠','鸡','羊','马','兔','虎','羊'];
        $countOpen = array_count_values($open);
        return $countOpen;
    }
}
