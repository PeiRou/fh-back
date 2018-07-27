<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $openCode ='1,3,4';
        $arrOpenCode = explode(',',$openCode);
        $playCate = 217;
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1]){
            echo $arrOpenCode[0];
        }
    }
}
