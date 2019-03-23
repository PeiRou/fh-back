<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/5
 * Time: 上午9:19
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Xjssc extends Excel
{
    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->NUM1($openCode,$gameId,$win);
        $this->NUM2($openCode,$gameId,$win);
        $this->NUM3($openCode,$gameId,$win);
        $this->NUM4($openCode,$gameId,$win);
        $this->NUM5($openCode,$gameId,$win);
        $this->NUM1_DXDS($openCode,$gameId,$win);
        $this->NUM2_DXDS($openCode,$gameId,$win);
        $this->NUM3_DXDS($openCode,$gameId,$win);
        $this->NUM4_DXDS($openCode,$gameId,$win);
        $this->NUM5_DXDS($openCode,$gameId,$win);
        $this->ZHDXDS($openCode,$gameId,$win);
        $this->QIANSAN($openCode,$gameId,$win);
        $this->ZHONGSAN($openCode,$gameId,$win);
        $this->HOUSAN($openCode,$gameId,$win);
        $table = 'game_xjssc';
        $gameName = '新疆时时彩';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $excelModel->bunko($win,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $excelModel->updateUserMoney($gameId,$issue,$gameName);
                if($updateUserMoney == 1){
                    writeLog('New_Bet', $gameName . $issue . "结算出错");
                }
            }
        }
        $update = DB::table($table)->where('id',$id)->update([
            'bunko' => 1
        ]);
        if ($update !== 1) {
            writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
        }else{
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
        }
    }

    private function QIANSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 100;
        $zaliu = 0;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 325;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 326;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 326;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 326;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 328;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 327;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 328;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 328;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 328;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 328;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 328;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 328;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 329;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHONGSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 101;
        $zaliu = 0;
        $num1 = $arrOpenCode[1];
        $num2 = $arrOpenCode[2];
        $num3 = $arrOpenCode[3];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 330;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 331;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 331;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 331;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 333;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 332;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 333;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 333;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 333;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 333;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 333;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 333;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 334;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function HOUSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 102;
        $zaliu = 0;
        $num1 = $arrOpenCode[2];
        $num2 = $arrOpenCode[3];
        $num3 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 335;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 336;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 336;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 336;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 338;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 337;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 338;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 338;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 338;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 338;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 338;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 338;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 339;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHDXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 94;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        $num_total = $num1+$num2+$num3+$num4+$num5;
        if($num_total >= 23){ //总和大
            $playId = 248;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total <= 22){ //总和小
            $playId = 249;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total%2 == 0){ //总和双
            $playId = 251;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = 250;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num5){ //龙
            $playId = 252;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($num1 < $num5){ //虎
            $playId = 253;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($num1 == $num5) { //和
            $playId = 254;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 95;
        $num = $arrOpenCode[0];
        //大小
        if($num >= 5){
            $playId = 265;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 266;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 268;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 267;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM2_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 96;
        $num = $arrOpenCode[1];
        //大小
        if($num >= 5){
            $playId = 279;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 280;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 282;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 281;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM3_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 97;
        $num = $arrOpenCode[2];
        //大小
        if($num >= 5){
            $playId = 293;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 294;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 296;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 295;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM4_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 98;
        $num = $arrOpenCode[3];
        //大小
        if($num >= 5){
            $playId = 307;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 308;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 310;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 309;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM5_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 99;
        $num = $arrOpenCode[4];
        //大小
        if($num >= 5){
            $playId = 321;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 322;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 324;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 323;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 95;
        $num = $arrOpenCode[0];
        switch ($num){
            case 0:
                $play_id = 255;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 256;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 257;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 258;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 259;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 260;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 261;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 262;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 263;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 264;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM2($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 96;
        $num = $arrOpenCode[1];
        switch ($num){
            case 0:
                $play_id = 269;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 270;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 271;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 272;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 273;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 274;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 275;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 276;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 277;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 278;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM3($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 97;
        $num = $arrOpenCode[2];
        switch ($num){
            case 0:
                $play_id = 283;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 284;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 285;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 286;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 287;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 288;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 289;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 290;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 291;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 292;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM4($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 98;
        $num = $arrOpenCode[3];
        switch ($num){
            case 0:
                $play_id = 297;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 298;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 299;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 300;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 301;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 302;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 303;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 304;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 305;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 306;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM5($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 99;
        $num = $arrOpenCode[4];
        switch ($num){
            case 0:
                $play_id = 311;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 312;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 313;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 314;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 315;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 316;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 317;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 318;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 319;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 320;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }
}