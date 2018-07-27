<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $openCode ='1,2,2';
        $arrOpenCode = explode(',',$openCode);
        $playCate = 218;

        $KD_NUM = (int)$arrOpenCode[2] - (int)$arrOpenCode[0];
        $KD_DX_arr = [
            0 => 4324,
            1 => 4324,
            2 => 4324,
            3 => 4323,
            4 => 4323,
            5 => 4323
        ];
        $KD_DS_arr = [
            0 => 4326,
            1 => 4325,
            2 => 4326,
            3 => 4325,
            4 => 4326,
            5 => 4325
        ];
        $KD_KDZ_arr = [
            0 => 4317,
            1 => 4318,
            2 => 4319,
            3 => 4320,
            4 => 4321,
            5 => 4322
        ];
        foreach ($KD_DX_arr as $k => $v){
            if($KD_NUM == $k){
                echo '大小'.$v;
            }
        }
        foreach ($KD_DS_arr as $k => $v){
            if($KD_NUM == $k){
                echo '单双'.$v;
            }
        }
        foreach ($KD_KDZ_arr as $k => $v){
            if($KD_NUM == $k){
                echo '跨度值'.$v;
            }
        }
    }
}
