<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $open = ['鼠','羊','羊','马','兔','虎'];
        $countOpen = array_count_values($open);
        echo "鼠：".@$countOpen['鼠'];
        echo "牛：".@$countOpen['牛'];
        echo "虎：".@$countOpen['虎'];
        echo "兔：".@$countOpen['兔'];
        echo "龙：".@$countOpen['龙'];
        echo "蛇：".@$countOpen['蛇'];
        echo "马：".@$countOpen['马'];
        echo "羊：".@$countOpen['羊'];
        echo "猴：".@$countOpen['猴'];
        echo "鸡：".@$countOpen['鸡'];
        echo "狗：".@$countOpen['狗'];
        echo "猪：".@$countOpen['猪'];
    }
}
