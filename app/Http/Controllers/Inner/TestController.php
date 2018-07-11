<?php

namespace App\Http\Controllers\Inner;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function lhc()
    {
        $arrOpenCode = explode(',','16,6,5,30,18,32,27'); // 分割开奖号码
        $qsb_playCate = 69; //特码分类ID
        $zm1 = $arrOpenCode[0];
        $zm2 = $arrOpenCode[1];
        $zm3 = $arrOpenCode[2];
        $zm4 = $arrOpenCode[3];
        $zm5 = $arrOpenCode[4];
        $zm6 = $arrOpenCode[5];
        $tm = $arrOpenCode[6]; //特码号码
        //七个号码色波
        $s = [
            $this->SB_Color($zm1),
            $this->SB_Color($zm2),
            $this->SB_Color($zm3),
            $this->SB_Color($zm4),
            $this->SB_Color($zm5),
            $this->SB_Color($zm6),
            $this->SB_Color($tm),
        ];
        $tmsb = $this->SB_Color($tm);
        echo '特码色波：'.$tmsb;
        $ac = array_count_values($s);
        $redBall = 0;
        $blueBall = 0;
        $greenBall = 0;
        foreach($ac as $k => $v){
            if($tmsb == $k && $k == 'G'){
                $greenBall = $greenBall+0.5;
            }
            if($tmsb == $k && $k == 'R'){
                $redBall = $redBall+0.5;
            }
            if($tmsb == $k && $k == 'B'){
                $blueBall = $blueBall+0.5;
            }
        }
        if(isset($ac['R'])){
            $redBall = $redBall + $ac['R'];
        }
        if(isset($ac['B'])){
            $blueBall = $blueBall + $ac['B'];
        }
        if(isset($ac['G'])){
            $greenBall = $blueBall + $ac['G'];
        }
        return '红：'.$redBall.'=====蓝：'.$blueBall.'====绿：'.$greenBall;
    }

    function SB_Color($num){
        //红色
        if($num == 1 || $num == 2 || $num == 7 || $num == 8 || $num == 12 || $num == 13 || $num == 18 || $num == 19 || $num == 23 || $num == 24 || $num == 29 || $num == 30 || $num == 34 || $num == 35 || $num == 40 || $num == 45 || $num == 46){
            return 'R';
        }
        //蓝色
        if($num == 3 || $num == 4 || $num == 9 || $num == 10 || $num == 14 || $num == 15 || $num == 20 || $num == 25 || $num == 26 || $num == 31 || $num == 36 || $num == 37 || $num == 41 || $num == 42 || $num == 47 || $num == 48) { //蓝波
            return 'B';
        }
        //绿色
        if($num == 5 || $num == 6 || $num == 11 || $num == 16 || $num == 17 || $num == 21 || $num == 22 || $num == 27 || $num == 28 || $num == 32 || $num == 33 || $num == 38 || $num == 39 || $num == 43 || $num == 44 || $num == 49) { //绿波
            return 'G';
        }
    }
}
