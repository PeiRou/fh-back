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
        //2019猪年排在1然后剩下往回推，2020鼠年排在1然后剩下往回推
        return ['牛','鼠','猪','狗','鸡','猴','羊','马','蛇','龙','兔','虎'][(int)$tm%12];
    }

    public function wei($num){
        return [0,1,2,3,4,5,6,7,8,9][(int)$num%10].'尾';
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