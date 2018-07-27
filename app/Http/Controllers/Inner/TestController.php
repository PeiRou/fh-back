<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $openCode ='1,3,6';
        $arrOpenCode = explode(',',$openCode);
        $playCate = 221;
        $BICHU_arr = [
            1 => 4347,
            2 => 4348,
            3 => 4349,
            4 => 4350,
            5 => 4351,
            6 => 4352
        ];
        foreach ($BICHU_arr as $k => $v){
            if(!in_array($k,$arrOpenCode)){
                echo $k.'在开奖号码中</br>';
            }
        }
    }
}
