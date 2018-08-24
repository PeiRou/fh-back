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
        for($i=1;$i<count($CombinList);$i++){
            echo $i;
        }
    }
}
