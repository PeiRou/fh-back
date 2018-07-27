<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $openCode ='1,6,6';
        $arrOpenCode = explode(',',$openCode);
        $playCate = 219;
        $PD_NUM = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $PD_GEWEI = $PD_NUM % 10;
        $PD_arr = [
            0 => 4323,
            6 => 4323,
            7 => 4323,
            8 => 4323,
            9 => 4323,
            1 => 4324,
            2 => 4324,
            3 => 4324,
            4 => 4324,
            5 => 4324,
        ];
        foreach ($PD_arr as $k => $v){
            if($PD_GEWEI == $k){
                echo $v;
            }
        }
    }
}
