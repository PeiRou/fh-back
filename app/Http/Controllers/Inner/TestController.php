<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
//        $CombinList = ['A','B','C','D'];
//        $count = count($CombinList);
//        //echo "['A','B','C','D']</br>";
//        $arr = [];
//        $arr3 = [];
//        $temp = [];
//        for($i=0;$i<count($CombinList);$i++){
//            $sit = $i+1;
//            for($b=0;$b<=$sit-1;$b++){
//                if($CombinList[$i] !== $CombinList[$b]){
//                    $arr[] = [$CombinList[$i],$CombinList[$b]];
//                }
//                for($z=0;$z<=$sit-3;$z++){
//                    if($CombinList[$i] !== $CombinList[$b] && $CombinList[$b] !== $CombinList[$z]){
//                        $temp[] = $CombinList[$i].','.$CombinList[$b].','.$CombinList[$z];
//                    }
//                }
//            }
//        }
//        $temp = array_unique($temp);
//        foreach ($temp as $k => $v){
//            $temp[$k] = explode(",",$v);   //再将拆开的数组重新组装
//        }
//        //print_r($arr);
//        return $temp;

        $a = [1,2,3,4,5];
        foreach($a as $key => $value) {
            for($i = $key + 1; $i < count($a); $i++) {
                $key_00[] = [$value,$a[$i]];
                for($b = $key + 2; $b < count($a); $b++)
                {
                    if($value !== $a[$i] && $a[$i] !== $a[$b]){
                        if($value < $a[$i] && $a[$i] < $a[$b]){
                            $key_01[] = [$value, $a[$i], $a[$b]];
                        }
                    }
                    for($c = $key + 3; $c < count($a); $c++)
                    {
                        if($value !== $a[$i] && $a[$i] !== $a[$b] && $a[$b] !== $a[$c]){
                            if($value < $a[$i] && $a[$i] < $a[$b] && $a[$b] < $a[$c]){
                                $key_02[] = [$value, $a[$i], $a[$b], $a[$c]];
                            }
                        }
                        for($d = $key + 4; $d < count($a); $d++)
                        {
                            if($value !== $a[$i] && $a[$i] !== $a[$b] && $a[$b] !== $a[$c] && $a[$c] !== $a[$d]){
                                if($value < $a[$i] && $a[$i] < $a[$b] && $a[$b] < $a[$c] && $a[$c] < $a[$d]){
                                    $key_03[] = [$value, $a[$i], $a[$b], $a[$c], $a[$d]];
                                }
                            }
                        }
                    }
                }
            }
        }

        return $key_03;
        //print_r($key_01);
    }
}
