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
        $playCate = 215;
        $SLH_TX = 0;
        $SLH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $SLH_arr = [
            '123' => 4299,
            '234' => 4300,
            '345' => 4301,
            '456' => 4302,
        ];
        foreach ($SLH_arr as $k => $v){
            if($k == $SLH_string){
                echo $v;
                $SLH_TX += 1;
            }
        }
        echo $SLH_TX;
    }
}
