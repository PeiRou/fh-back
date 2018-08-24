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

        $a = [1,2,3,4];

        foreach($a as $key => $value)
        {
            for($i = $key + 1; $i < count($a); $i++)
            {
                //echo $value.",".$a[$i]."\n";

                for($b = $key + 2; $b < count($a); $b++)
                {
                    if($value !== $a[$i] && $a[$i] !== $a[$b]){
                        $key_01 = [$value, $a[$i], $a[$b]];
                        $length =count($key_01);
                        for($n=0;$n<$length-1;$n++){
                            //内层循环n-i-1
                            for($i=0;$i<$length-$n-1;$i++){
                                //判断数组元素大小，交换位置，实现从小往大排序
                                if($key_01[$i]>$key_01[$i+1]){
                                    $temp=$key_01[$i+1];
                                    $key_01[$i+1]=$key_01[$i];
                                    $key_01[$i]=$temp;
                                }
                            }
                        }
                    }
                }
            }
        }

        print_r($key_01);
    }
}
