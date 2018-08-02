<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $prize_arr = [
            111 => ['id'=>1,'rate'=>1],
            222 => ['id'=>2,'rate'=>1],
            333 => ['id'=>3,'rate'=>1],
            444 => ['id'=>4,'rate'=>1],
            555 => ['id'=>5,'rate'=>1],
            666 => ['id'=>6,'rate'=>1],
            112 => ['id'=>7,'rate'=>6],
            113 => ['id'=>8,'rate'=>6],
            114 => ['id'=>9,'rate'=>6],
            115 => ['id'=>10,'rate'=>6],
            116 => ['id'=>11,'rate'=>6],
            223 => ['id'=>12,'rate'=>6],
            224 => ['id'=>13,'rate'=>6],
            225 => ['id'=>14,'rate'=>6],
            226 => ['id'=>15,'rate'=>6],
            334 => ['id'=>16,'rate'=>6],
            335 => ['id'=>17,'rate'=>6],
            336 => ['id'=>18,'rate'=>6],
            445 => ['id'=>19,'rate'=>6],
            446 => ['id'=>20,'rate'=>6],
            556 => ['id'=>21,'rate'=>6],
            122 => ['id'=>22,'rate'=>6],
            133 => ['id'=>23,'rate'=>6],
            144 => ['id'=>24,'rate'=>6],
            155 => ['id'=>25,'rate'=>6],
            166 => ['id'=>26,'rate'=>6],
            233 => ['id'=>27,'rate'=>6],
            244 => ['id'=>28,'rate'=>6],
            255 => ['id'=>29,'rate'=>6],
            266 => ['id'=>30,'rate'=>6],
            344 => ['id'=>31,'rate'=>6],
            355 => ['id'=>32,'rate'=>6],
            366 => ['id'=>33,'rate'=>6],
            455 => ['id'=>34,'rate'=>6],
            466 => ['id'=>35,'rate'=>6],
            566 => ['id'=>36,'rate'=>6],
        ];
        $arr = [];
        foreach ($prize_arr as $key => $val) {
            $arr[$val['id']] = $val['rate'];
        }
        $rid = $this->get_rand($arr);
        return $rid;
    }

    private function get_rand($proArr) {
        $result = '';
        //概率数组的总概率精度
        $proSum = array_sum($proArr);
        //概率数组循环
        foreach ($proArr as $key => $proCur) {
            $randNum = mt_rand(1, $proSum);
            if ($randNum <= $proCur) {
                $result = $key;
                break;
            } else {
                $proSum -= $proCur;
            }
        }
        unset ($proArr);
        return $result;
    }
}
