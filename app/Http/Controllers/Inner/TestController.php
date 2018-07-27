<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $openCode ='1,1,1';
        $arrOpenCode = explode(',',$openCode);
        $playCate = 217;
        $isBaoZi = 0;
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && (int)$arrOpenCode[0] == (int)$arrOpenCode[2]){
            $isBaoZi = 1;
            echo '是豹子，不算，妈卖批！';
        }
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && $isBaoZi == 0){
            echo '前二'.$arrOpenCode[0];
        }
        if((int)$arrOpenCode[1] == (int)$arrOpenCode[2] && $isBaoZi == 0){
            echo '后二'.$arrOpenCode[0];
        }
    }
}
