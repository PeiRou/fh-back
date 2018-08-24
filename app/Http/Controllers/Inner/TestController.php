<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $CombinList = ['A','B','C','D'];
        $count = count($CombinList);
        echo "['A','B','C','D']</br>";
        for($i=0;$i<count($CombinList);$i++){
            $sit = $i+1;
            for($b=0;$b<$sit-1;$b++){
                echo $CombinList[$i].','.$CombinList[$b];
            }
        }
    }
}
