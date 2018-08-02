<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $a = rand(1,2);//豹子概率
        $b = rand(5,10); //二同号概率
        $c = rand(4,6); //三连号概率
        $d = rand(50,90); //其他
        $prize_arr = [
            111 => ['id'=>1,'rate'=>$a],
            222 => ['id'=>2,'rate'=>$a],
            333 => ['id'=>3,'rate'=>$a],
            444 => ['id'=>4,'rate'=>$a],
            555 => ['id'=>5,'rate'=>$a],
            666 => ['id'=>6,'rate'=>$a],
            112 => ['id'=>7,'rate'=>$b],
            113 => ['id'=>8,'rate'=>$b],
            114 => ['id'=>9,'rate'=>$b],
            115 => ['id'=>10,'rate'=>$b],
            116 => ['id'=>11,'rate'=>$b],
            223 => ['id'=>12,'rate'=>$b],
            224 => ['id'=>13,'rate'=>$b],
            225 => ['id'=>14,'rate'=>$b],
            226 => ['id'=>15,'rate'=>$b],
            334 => ['id'=>16,'rate'=>$b],
            335 => ['id'=>17,'rate'=>$b],
            336 => ['id'=>18,'rate'=>$b],
            445 => ['id'=>19,'rate'=>$b],
            446 => ['id'=>20,'rate'=>$b],
            556 => ['id'=>21,'rate'=>$b],
            122 => ['id'=>22,'rate'=>$b],
            133 => ['id'=>23,'rate'=>$b],
            144 => ['id'=>24,'rate'=>$b],
            155 => ['id'=>25,'rate'=>$b],
            166 => ['id'=>26,'rate'=>$b],
            233 => ['id'=>27,'rate'=>$b],
            244 => ['id'=>28,'rate'=>$b],
            255 => ['id'=>29,'rate'=>$b],
            266 => ['id'=>30,'rate'=>$b],
            344 => ['id'=>31,'rate'=>$b],
            355 => ['id'=>32,'rate'=>$b],
            366 => ['id'=>33,'rate'=>$b],
            455 => ['id'=>34,'rate'=>$b],
            466 => ['id'=>35,'rate'=>$b],
            566 => ['id'=>36,'rate'=>$b],
            123 => ['id'=>37,'rate'=>$c],
            234 => ['id'=>38,'rate'=>$c],
            345 => ['id'=>39,'rate'=>$c],
            456 => ['id'=>40,'rate'=>$c],
            124 => ['id'=>41,'rate'=>$d],
            125 => ['id'=>42,'rate'=>$d],
            126 => ['id'=>43,'rate'=>$d],
            134 => ['id'=>44,'rate'=>$d],
            135 => ['id'=>45,'rate'=>$d],
            136 => ['id'=>46,'rate'=>$d],
            145 => ['id'=>47,'rate'=>$d],
            146 => ['id'=>48,'rate'=>$d],
            156 => ['id'=>49,'rate'=>$d],
            235 => ['id'=>50,'rate'=>$d],
            236 => ['id'=>51,'rate'=>$d],
            245 => ['id'=>52,'rate'=>$d],
            246 => ['id'=>53,'rate'=>$d],
            256 => ['id'=>54,'rate'=>$d],
            346 => ['id'=>55,'rate'=>$d],
            356 => ['id'=>56,'rate'=>$d]
        ];
        $arr = [];
        foreach ($prize_arr as $key => $val) {
            $arr[$key] = $val['rate'];
        }
        $rid = $this->get_rand($arr);
        $x = str_split($rid) ;
        return $x;
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
