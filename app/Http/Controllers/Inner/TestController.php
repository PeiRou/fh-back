<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $arrOpenCode = explode(',','4,23,12,5,17,33,48'); // 分割开奖号码
        $zm_playCate = 70; //特码分类ID
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $nums = [
            '1' => '1545',
            '2' => '1546',
            '3' => '1547',
            '4' => '1548',
            '5' => '1549',
            '23' => '1578',
            '12' => '6666',
            '13' => '7777',
        ];
        foreach ($nums as $k => $v){
            if($ZM1 == $k){
                echo "中了，ID:".$v;
            }
            if($ZM2 == $k){
                echo "中了，ID:".$v;
            }
            if($ZM3 == $k){
                echo "中了，ID:".$v;
            }
//            echo $k.'----'.$v.'</br>';
        }
    }
}
