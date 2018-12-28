<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/9
 * Time: 下午6:35
 */

namespace App\Helpers;


class LHC_SX
{
    public function shengxiao($tm)
    {
        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){
            return '蛇';
        }
        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){
            return '马';
        }
        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){
            return '羊';
        }
        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){
            return '猴';
        }
        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){
            return '鸡';
        }
        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){
            return '狗';
        }
        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){
            return '猪';
        }
        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){
            return '鼠';
        }
        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){
            return '牛';
        }
        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){
            return '虎';
        }
        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){
            return '兔';
        }
        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){
            return '龙';
        }
    }

    public function wei($num){
        if($num == 10 || $num == 20 || $num == 30 || $num == 40){
            return '0尾';
        }
        if($num == 1 || $num == 11 || $num == 21 || $num == 31 || $num == 41){
            return '1尾';
        }
        if($num == 2 || $num == 12 || $num == 22 || $num == 32 || $num == 42){
            return '2尾';
        }
        if($num == 3 || $num == 13 || $num == 23 || $num == 33 || $num == 43){
            return '3尾';
        }
        if($num == 4 || $num == 14 || $num == 24 || $num == 34 || $num == 44){
            return '4尾';
        }
        if($num == 5 || $num == 15 || $num == 25 || $num == 35 || $num == 45){
            return '5尾';
        }
        if($num == 6 || $num == 16 || $num == 26 || $num == 36 || $num == 46){
            return '6尾';
        }
        if($num == 7 || $num == 17 || $num == 27 || $num == 37 || $num == 47){
            return '7尾';
        }
        if($num == 8 || $num == 18 || $num == 28 || $num == 38 || $num == 48){
            return '8尾';
        }
        if($num == 9 || $num == 19 || $num == 29 || $num == 39 || $num == 49){
            return '9尾';
        }
    }

    public function sebo($num){
        $red = [1,2,7,8,12,13,18,19,23,24,29,30,34,35,40,45,46];
        $blue = [3,4,9,10,14,15,20,25,26,31,36,37,41,42,47,48];
        $green = [5,6,11,16,17,21,22,27,28,32,33,38,39,43,44,49];
        if(in_array($num,$red)){
            return 'r';
        }
        if(in_array($num,$blue)){
            return 'b';
        }
        if(in_array($num,$green)){
            return 'g';
        }
    }
}