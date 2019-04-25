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
        $txt = '';
        switch ($tm){
            case 49:
            case 37:
            case 25:
            case 13:
            case 1:
                $txt = '猪';
                break;
            case 48:
            case 36:
            case 24:
            case 12:
                $txt = '鼠';
                break;
            case 47:
            case 35:
            case 23:
            case 11:
                $txt = '牛';
                break;
            case 46:
            case 34:
            case 22:
            case 10:
                $txt = '虎';
                break;
            case 45:
            case 33:
            case 21:
            case 9:
                $txt = '兔';
                break;
            case 44:
            case 32:
            case 20:
            case 8:
                $txt = '龙';
                break;
            case 43:
            case 31:
            case 19:
            case 7:
                $txt = '蛇';
                break;
            case 42:
            case 30:
            case 18:
            case 6:
                $txt = '马';
                break;
            case 41:
            case 29:
            case 17:
            case 5:
                $txt = '羊';
                break;
            case 40:
            case 28:
            case 16:
            case 4:
                $txt = '猴';
                break;
            case 39:
            case 27:
            case 15:
            case 3:
                $txt = '鸡';
                break;
            case 38:
            case 26:
            case 14:
            case 2:
                $txt = '狗';
                break;

        }
        return $txt;
//        if($tm == 7 || $tm == 19 || $tm == 31 || $tm == 43){
//            return '蛇';
//        }
//        if($tm == 6 || $tm == 18 || $tm == 30 || $tm == 42){
//            return '马';
//        }
//        if($tm == 5 || $tm == 17 || $tm == 29 || $tm == 41){
//            return '羊';
//        }
//        if($tm == 4 || $tm == 16 || $tm == 28 || $tm == 40){
//            return '猴';
//        }
//        if($tm == 3 || $tm == 15 || $tm == 27 || $tm == 39){
//            return '鸡';
//        }
//        if($tm == 2 || $tm == 14 || $tm == 26 || $tm == 38){
//            return '狗';
//        }
//        if($tm == 1 || $tm == 13 || $tm == 25 || $tm == 37 || $tm == 49){
//            return '猪';
//        }
//        if($tm == 12 || $tm == 24 || $tm == 36 || $tm == 48){
//            return '鼠';
//        }
//        if($tm == 11 || $tm == 23 || $tm == 35 || $tm == 47){
//            return '牛';
//        }
//        if($tm == 10 || $tm == 22 || $tm == 34 || $tm == 46){
//            return '虎';
//        }
//        if($tm == 9 || $tm == 21 || $tm == 33 || $tm == 45){
//            return '兔';
//        }
//        if($tm == 8 || $tm == 20 || $tm == 32 || $tm == 44){
//            return '龙';
//        }
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