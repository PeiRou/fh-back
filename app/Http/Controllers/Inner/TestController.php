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
        $playCate = 220;
        $BUCHU_arr = [
            1 => 4341,
            2 => 4342,
            3 => 4343,
            4 => 4344,
            5 => 4345,
            6 => 4346
        ];
        foreach ($BUCHU_arr as $k => $v){
            if(!in_array($k,$arrOpenCode)){
                echo $v.'不在开奖号码中';
            }
        }
    }
}
