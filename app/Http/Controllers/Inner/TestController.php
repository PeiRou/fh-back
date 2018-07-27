<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $openCode ='1,1,4';
        $arrOpenCode = explode(',',$openCode);
        $playCate = 217;
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1]){
            echo '前二'.$arrOpenCode[0];
        }
        if((int)$arrOpenCode[1] == (int)$arrOpenCode[2]){
            echo '后二'.$arrOpenCode[0];
        }
    }
}
