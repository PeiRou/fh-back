<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $CombinList = ['A','B','C','D'];
        $count = count($CombinList);
        echo "['A','B','C','D']</br>";
        $arr = [];
        $arr3 = [];
        for($i=0;$i<count($CombinList);$i++){
            $sit = $i+1;
            for($b=0;$b<=$sit-1;$b++){
                if($CombinList[$i] !== $CombinList[$b]){
                    $arr[] = $CombinList[$i].','.$CombinList[$b];
                }
                for($z=0;$z<=$sit-2;$z++){
                    if($CombinList[$i] !== $CombinList[$b] && $CombinList[$b] !== $CombinList[$z]){
                        $arr3[] = $CombinList[$i].','.$CombinList[$b].','.$CombinList[$z];
                    }
                }
            }
        }
        print_r($arr);
        print_r($arr3);
    }
}
