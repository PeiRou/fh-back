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
        for($i=0;$i<count($CombinList);$i++){
            $sit = $i+1;
            echo $CombinList[$i].'在数组中是第'.$sit.'位';
        }
    }
}
