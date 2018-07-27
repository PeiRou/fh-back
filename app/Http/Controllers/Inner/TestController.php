<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $HZ = 10;
        $HZDS_arr = [3=>4279,4=>4280,5=>4281,6=>4282,7=>4283,8=>4284,9=>4285,10=>4286,11=>4287,12=>4288,13=>4289,14=>4290,15=>4291,16=>4292,17=>4293,18=>4294];
        foreach ($HZDS_arr as $k => $v){
            if($HZ == $k){
                echo $v;
            }
        }
    }
}
