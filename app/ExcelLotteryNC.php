<?php
/**
 * 农场玩法结算
 * User: Zoe
 * Date: 2019/4/24
 * Time: 下午18:18
 */

namespace App;

use Illuminate\Support\Facades\DB;

class ExcelLotteryNC
{
    public $arrPlayCate;
    public $arrPlayId;
    public $num_1;
    public $num_2;
    public $num_3;
    public $num_4;
    public $num_5;
    public $num_6;
    public $num_7;
    public $num_8;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $this->num_1 = (int)$arrOpenCode[0];
        $this->num_2 = (int)$arrOpenCode[1];
        $this->num_3 = (int)$arrOpenCode[2];
        $this->num_4 = (int)$arrOpenCode[3];
        $this->num_5 = (int)$arrOpenCode[4];
        $this->num_6 = (int)$arrOpenCode[5];
        $this->num_7 = (int)$arrOpenCode[6];
        $this->num_8 = (int)$arrOpenCode[7];
    }
    //两面部分结算
    public function LM($gameId,$win,$ids_he){
        $playCate = $this->arrPlayCate['ZH'];
        $num1 = (int)$this->num_1;
        $num2 = (int)$this->num_2;
        $num3 = (int)$this->num_3;
        $num4 = (int)$this->num_4;
        $num5 = (int)$this->num_5;
        $num6 = (int)$this->num_6;
        $num7 = (int)$this->num_7;
        $num8 = (int)$this->num_8;
        $numsTotal = (int)$num1 + (int)$num2 + (int)$num3 + (int)$num4 + (int)$num5 + (int)$num6 + (int)$num7 + (int)$num8;
        $zhongArr = [1,2,3,4,5,6,7]; //中
        $faArr = [8,9,10,11,12,13,14]; //发
        $baiArr = [15,16,17,18,19,20]; //白
        $dongArr = [1,5,9,13,17]; //东
        $nanArr = [2,6,10,14,18]; //南
        $xiArr = [3,7,11,15,19]; //西
        $beiArr = [4,8,12,16,20]; //北

        //总和大小-Start
        if($numsTotal == 84){ //总和等于84视为和局  //和局退本金
            $playId = $this->arrPlayId['ZONGHEDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZONGHEXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }
        if($numsTotal >= 85 && $numsTotal <= 132){ //总和大
            $playId = $this->arrPlayId['ZONGHEDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }else if($numsTotal >= 36 && $numsTotal <= 83){ //总和小
            $playId = $this->arrPlayId['ZONGHEXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和大小-End

        //总和单双-Start
        if($numsTotal%2 == 0){
            $playId = $this->arrPlayId['ZONGHESHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['ZONGHEDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和单双-End

        //总和尾大、尾小-Start
        $totalStrSplit = str_split($numsTotal);
        if(count($totalStrSplit) == 3){
            $totalWei = (int)$totalStrSplit[2];
        }
        if(count($totalStrSplit) == 2){
            $totalWei = (int)$totalStrSplit[1];
        }

        if($totalWei >= 5){
            $playId = $this->arrPlayId['ZONGHEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($totalWei <= 4){
            $playId = $this->arrPlayId['ZONGHEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和尾大、尾小-End

        //第一球两面-Start
        $Q1PlayCate = $this->arrPlayCate['QIU1'];
        if($num1 >= 11){ //大
            $playId = $this->arrPlayId['DIYIQIUDA'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 <= 10){ //小
            $playId = $this->arrPlayId['DIYIQIUXIAO'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1%2 == 0){ //双
            $playId = $this->arrPlayId['DIYIQIUSHUANG'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DIYIQIUDAN'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        $num1_add_zero = str_pad($num1,2,"0",STR_PAD_LEFT); //十位补零
        $num1_over = str_split($num1_add_zero); //拆分个位 十位
        $num1_tou = (int)$num1_over[0];
        $num1_wei = (int)$num1_over[1];
        $num1Total = $num1_wei+$num1_tou;
        if($num1_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DIYIQIUWEIDA'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DIYIQIUWEIXIAO'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DIYIQIUHESHUSHUANG'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DIYIQIUHESHUDAN'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num8){ //龙
            $playId = $this->arrPlayId['DIYIQIULONG'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = $this->arrPlayId['DIYIQIUHU'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$zhongArr)){ //中
            $playId = $this->arrPlayId['DIYIQIUZHONG'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$faArr)){ //发
            $playId = $this->arrPlayId['DIYIQIUFA'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$baiArr)){ //白
            $playId = $this->arrPlayId['DIYIQIUBAI'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$dongArr)){ //东
            $playId = $this->arrPlayId['DIYIQIUDONG'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$nanArr)){ //南
            $playId = $this->arrPlayId['DIYIQIUNAN'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$xiArr)){ //西
            $playId = $this->arrPlayId['DIYIQIUXI'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num1,$beiArr)){ //北
            $playId = $this->arrPlayId['DIYIQIUBEI'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $win->push($winCode);
        }
        //第一球两面-End
        //第一球单号-Start
        switch ($num1){
            case 1:
                $playId = $this->arrPlayId['DIYIQIU1'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DIYIQIU2'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DIYIQIU3'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DIYIQIU4'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DIYIQIU5'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DIYIQIU6'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DIYIQIU7'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DIYIQIU8'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DIYIQIU9'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DIYIQIU10'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DIYIQIU11'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DIYIQIU12'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DIYIQIU13'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DIYIQIU14'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DIYIQIU15'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DIYIQIU16'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DIYIQIU17'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DIYIQIU18'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DIYIQIU19'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DIYIQIU20'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第一球单号-End

        //第二球两面-Start
        $Q2PlayCate = $this->arrPlayCate['QIU2'];
        if($num2 >= 11){ //大
            $playId = $this->arrPlayId['DIERQIUDA'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 <= 10){ //小
            $playId = $this->arrPlayId['DIERQIUXIAO'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2%2 == 0){ //双
            $playId = $this->arrPlayId['DIERQIUSHUANG'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DIERQIUDAN'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        $num2_add_zero = str_pad($num2,2,"0",STR_PAD_LEFT); //十位补零
        $num2_over = str_split($num2_add_zero); //拆分个位 十位
        $num2_tou = (int)$num2_over[0];
        $num2_wei = (int)$num2_over[1];
        $num2Total = $num2_wei+$num2_tou;
        if($num2_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DIERQIUWEIDA'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DIERQIUWEIXIAO'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DIERQIUHESHUSHUANG'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DIERQIUHESHUDAN'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if($num2 > $num7){ //龙
            $playId = $this->arrPlayId['DIERQIULONG'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = $this->arrPlayId['DIERQIUHU'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$zhongArr)){ //中
            $playId = $this->arrPlayId['DIERQIUZHONG'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$faArr)){ //发
            $playId = $this->arrPlayId['DIERQIUFA'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$baiArr)){ //白
            $playId = $this->arrPlayId['DIERQIUBAI'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$dongArr)){ //东
            $playId = $this->arrPlayId['DIERQIUDONG'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$nanArr)){ //南
            $playId = $this->arrPlayId['DIERQIUNAN'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$xiArr)){ //西
            $playId = $this->arrPlayId['DIERQIUXI'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num2,$beiArr)){ //北
            $playId = $this->arrPlayId['DIERQIUBEI'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $win->push($winCode);
        }
        //第二球两面-End
        //第二球单号-Start
        switch ($num2){
            case 1:
                $playId = $this->arrPlayId['DIERQIU1'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DIERQIU2'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DIERQIU3'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DIERQIU4'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DIERQIU5'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DIERQIU6'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DIERQIU7'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DIERQIU8'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DIERQIU9'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DIERQIU10'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DIERQIU11'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DIERQIU12'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DIERQIU13'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DIERQIU14'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DIERQIU15'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DIERQIU16'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DIERQIU17'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DIERQIU18'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DIERQIU19'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DIERQIU20'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第二球单号-End

        //第三球两面-Start
        $Q3PlayCate = $this->arrPlayCate['QIU3'];
        if($num3 >= 11){ //大
            $playId = $this->arrPlayId['DISANQIUDA'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 <= 10){ //小
            $playId = $this->arrPlayId['DISANQIUXIAO'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3%2 == 0){ //双
            $playId = $this->arrPlayId['DISANQIUSHUANG'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DISANQIUDAN'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        $num3_add_zero = str_pad($num3,2,"0",STR_PAD_LEFT); //十位补零
        $num3_over = str_split($num3_add_zero); //拆分个位 十位
        $num3_tou = (int)$num3_over[0];
        $num3_wei = (int)$num3_over[1];
        $num3Total = $num3_wei+$num3_tou;
        if($num3_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DISANQIUWEIDA'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DISANQIUWEIXIAO'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DISANQIUHESHUSHUANG'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DISANQIUHESHUDAN'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if($num3 > $num6){ //龙
            $playId = $this->arrPlayId['DISANQIULONG'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = $this->arrPlayId['DISANQIUHU'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$zhongArr)){ //中
            $playId = $this->arrPlayId['DISANQIUZHONG'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$faArr)){ //发
            $playId = $this->arrPlayId['DISANQIUFA'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$baiArr)){ //白
            $playId = $this->arrPlayId['DISANQIUBAI'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$dongArr)){ //东
            $playId = $this->arrPlayId['DISANQIUDONG'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$nanArr)){ //南
            $playId = $this->arrPlayId['DISANQIUNAN'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$xiArr)){ //西
            $playId = $this->arrPlayId['DISANQIUXI'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num3,$beiArr)){ //北
            $playId = $this->arrPlayId['DISANQIUBEI'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $win->push($winCode);
        }
        //第三球两面-End
        //第三球单号-Start
        switch ($num3){
            case 1:
                $playId = $this->arrPlayId['DISANQIU1'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DISANQIU2'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DISANQIU3'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DISANQIU4'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DISANQIU5'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DISANQIU6'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DISANQIU7'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DISANQIU8'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DISANQIU9'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DISANQIU10'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DISANQIU11'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DISANQIU12'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DISANQIU13'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DISANQIU14'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DISANQIU15'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DISANQIU16'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DISANQIU17'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DISANQIU18'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DISANQIU19'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DISANQIU20'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第三球单号-End

        //第四球两面-Start
        $Q4PlayCate = $this->arrPlayCate['QIU4'];
        if($num4 >= 11){ //大
            $playId = $this->arrPlayId['DISIQIUDA'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 <= 10){ //小
            $playId = $this->arrPlayId['DISIQIUXIAO'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4%2 == 0){ //双
            $playId = $this->arrPlayId['DISIQIUSHUANG'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DISIQIUDAN'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        $num4_add_zero = str_pad($num4,2,"0",STR_PAD_LEFT); //十位补零
        $num4_over = str_split($num4_add_zero); //拆分个位 十位
        $num4_tou = (int)$num4_over[0];
        $num4_wei = (int)$num4_over[1];
        $num4Total = $num4_wei+$num4_tou;
        if($num4_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DISIQIUWEIDA'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DISIQIUWEIXIAO'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DISIQIUHESHUSHUANG'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DISIQIUHESHUDAN'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if($num4 > $num5){ //龙
            $playId = $this->arrPlayId['DISIQIULONG'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = $this->arrPlayId['DISIQIUHU'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$zhongArr)){ //中
            $playId = $this->arrPlayId['DISIQIUZHONG'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$faArr)){ //发
            $playId = $this->arrPlayId['DISIQIUFA'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$baiArr)){ //白
            $playId = $this->arrPlayId['DISIQIUBAI'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$dongArr)){ //东
            $playId = $this->arrPlayId['DISIQIUDONG'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$nanArr)){ //南
            $playId = $this->arrPlayId['DISIQIUNAN'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$xiArr)){ //西
            $playId = $this->arrPlayId['DISIQIUXI'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num4,$beiArr)){ //北
            $playId = $this->arrPlayId['DISIQIUBEI'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $win->push($winCode);
        }
        //第四球两面-End
        //第四球单号-Start
        switch ($num4){
            case 1:
                $playId = $this->arrPlayId['DISIQIU1'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DISIQIU2'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DISIQIU3'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DISIQIU4'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DISIQIU5'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DISIQIU6'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DISIQIU7'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DISIQIU8'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DISIQIU9'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DISIQIU10'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DISIQIU11'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DISIQIU12'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DISIQIU13'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DISIQIU14'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DISIQIU15'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DISIQIU16'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DISIQIU17'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DISIQIU18'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DISIQIU19'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DISIQIU20'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第四球单号-End

        //第五球两面-Start
        $Q5PlayCate = $this->arrPlayCate['QIU5'];
        if($num5 >= 11){ //大
            $playId = $this->arrPlayId['DIWUQIUDA'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5 <= 10){ //小
            $playId = $this->arrPlayId['DIWUQIUXIAO'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5%2 == 0){ //双
            $playId = $this->arrPlayId['DIWUQIUSHUANG'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DIWUQIUDAN'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        $num5_add_zero = str_pad($num5,2,"0",STR_PAD_LEFT); //十位补零
        $num5_over = str_split($num5_add_zero); //拆分个位 十位
        $num5_tou = (int)$num5_over[0];
        $num5_wei = (int)$num5_over[1];
        $num5Total = $num5_wei+$num5_tou;
        if($num5_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DIWUQIUWEIDA'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DIWUQIUWEIXIAO'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if($num5Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DIWUQIUHESHUSHUANG'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DIWUQIUHESHUDAN'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$zhongArr)){ //中
            $playId = $this->arrPlayId['DIWUQIUZHONG'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$faArr)){ //发
            $playId = $this->arrPlayId['DIWUQIUFA'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$baiArr)){ //白
            $playId = $this->arrPlayId['DIWUQIUBAI'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$dongArr)){ //东
            $playId = $this->arrPlayId['DIWUQIUDONG'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$nanArr)){ //南
            $playId = $this->arrPlayId['DIWUQIUNAN'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$xiArr)){ //西
            $playId = $this->arrPlayId['DIWUQIUXI'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num5,$beiArr)){ //北
            $playId = $this->arrPlayId['DIWUQIUBEI'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $win->push($winCode);
        }
        //第五球两面-End
        //第五球单号-Start
        switch ($num5){
            case 1:
                $playId = $this->arrPlayId['DIWUQIU1'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DIWUQIU2'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DIWUQIU3'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DIWUQIU4'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DIWUQIU5'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DIWUQIU6'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DIWUQIU7'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DIWUQIU8'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DIWUQIU9'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DIWUQIU10'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DIWUQIU11'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DIWUQIU12'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DIWUQIU13'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DIWUQIU14'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DIWUQIU15'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DIWUQIU16'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DIWUQIU17'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DIWUQIU18'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DIWUQIU19'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DIWUQIU20'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第五球单号-End

        //第六球两面-Start
        $Q6PlayCate = $this->arrPlayCate['QIU6'];
        if($num6 >= 11){ //大
            $playId = $this->arrPlayId['DILIUQIUDA'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6 <= 10){ //小
            $playId = $this->arrPlayId['DILIUQIUXIAO'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6%2 == 0){ //双
            $playId = $this->arrPlayId['DILIUQIUSHUANG'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DILIUQIUDAN'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        $num6_add_zero = str_pad($num6,2,"0",STR_PAD_LEFT); //十位补零
        $num6_over = str_split($num6_add_zero); //拆分个位 十位
        $num6_tou = (int)$num6_over[0];
        $num6_wei = (int)$num6_over[1];
        $num6Total = $num6_wei+$num6_tou;
        if($num6_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DILIUQIUWEIDA'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DILIUQIUWEIXIAO'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if($num6Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DILIUQIUHESHUSHUANG'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DILIUQIUHESHUDAN'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$zhongArr)){ //中
            $playId = $this->arrPlayId['DILIUQIUZHONG'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$faArr)){ //发
            $playId = $this->arrPlayId['DILIUQIUFA'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$baiArr)){ //白
            $playId = $this->arrPlayId['DILIUQIUBAI'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$dongArr)){ //东
            $playId = $this->arrPlayId['DILIUQIUDONG'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$nanArr)){ //南
            $playId = $this->arrPlayId['DILIUQIUNAN'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$xiArr)){ //西
            $playId = $this->arrPlayId['DILIUQIUXI'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num6,$beiArr)){ //北
            $playId = $this->arrPlayId['DILIUQIUBEI'];
            $winCode = $gameId.$Q6PlayCate.$playId;
            $win->push($winCode);
        }
        //第六球两面-End
        //第六球单号-Start
        switch ($num6){
            case 1:
                $playId = $this->arrPlayId['DILIUQIU1'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DILIUQIU2'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DILIUQIU3'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DILIUQIU4'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DILIUQIU5'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DILIUQIU6'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DILIUQIU7'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DILIUQIU8'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DILIUQIU9'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DILIUQIU10'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DILIUQIU11'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DILIUQIU12'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DILIUQIU13'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DILIUQIU14'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DILIUQIU15'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DILIUQIU16'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DILIUQIU17'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DILIUQIU18'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DILIUQIU19'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DILIUQIU20'];
                $winCode = $gameId.$Q6PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第六球单号-End

        //第七球两面-Start
        $Q7PlayCate = $this->arrPlayCate['QIU7'];
        if($num7 >= 11){ //大
            $playId = $this->arrPlayId['DIQIQIUDA'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7 <= 10){ //小
            $playId = $this->arrPlayId['DIQIQIUXIAO'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7%2 == 0){ //双
            $playId = $this->arrPlayId['DIQIQIUSHUANG'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DIQIQIUDAN'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        $num7_add_zero = str_pad($num7,2,"0",STR_PAD_LEFT); //十位补零
        $num7_over = str_split($num7_add_zero); //拆分个位 十位
        $num7_tou = (int)$num7_over[0];
        $num7_wei = (int)$num7_over[1];
        $num7Total = $num7_wei+$num7_tou;
        if($num7_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DIQIQIUWEIDA'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DIQIQIUWEIXIAO'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if($num7Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DIQIQIUHESHUSHUANG'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DIQIQIUHESHUDAN'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$zhongArr)){ //中
            $playId = $this->arrPlayId['DIQIQIUZHONG'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$faArr)){ //发
            $playId = $this->arrPlayId['DIQIQIUFA'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$baiArr)){ //白
            $playId = $this->arrPlayId['DIQIQIUBAI'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$dongArr)){ //东
            $playId = $this->arrPlayId['DIQIQIUDONG'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$nanArr)){ //南
            $playId = $this->arrPlayId['DIQIQIUNAN'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$xiArr)){ //西
            $playId = $this->arrPlayId['DIQIQIUXI'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num7,$beiArr)){ //北
            $playId = $this->arrPlayId['DIQIQIUBEI'];
            $winCode = $gameId.$Q7PlayCate.$playId;
            $win->push($winCode);
        }
        //第七球两面-End
        //第七球单号-Start
        switch ($num7){
            case 1:
                $playId = $this->arrPlayId['DIQIQIU1'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DIQIQIU2'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DIQIQIU3'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DIQIQIU4'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DIQIQIU5'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DIQIQIU6'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DIQIQIU7'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DIQIQIU8'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DIQIQIU9'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DIQIQIU10'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DIQIQIU11'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DIQIQIU12'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DIQIQIU13'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DIQIQIU14'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DIQIQIU15'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DIQIQIU16'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DIQIQIU17'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DIQIQIU18'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DIQIQIU19'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DIQIQIU20'];
                $winCode = $gameId.$Q7PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第七球单号-End

        //第八球两面-Start
        $Q8PlayCate = $this->arrPlayCate['QIU8'];
        if($num8 >= 11){ //大
            $playId = $this->arrPlayId['DIBAQIUDA'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8 <= 10){ //小
            $playId = $this->arrPlayId['DIBAQIUXIAO'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8%2 == 0){ //双
            $playId = $this->arrPlayId['DIBAQIUSHUANG'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DIBAQIUDAN'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        $num8_add_zero = str_pad($num8,2,"0",STR_PAD_LEFT); //十位补零
        $num8_over = str_split($num8_add_zero); //拆分个位 十位
        $num8_tou = (int)$num8_over[0];
        $num8_wei = (int)$num8_over[1];
        $num8Total = $num8_wei+$num8_tou;
        if($num8_wei >= 5){ //尾大
            $playId = $this->arrPlayId['DIBAQIUWEIDA'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8_wei <= 4){ //尾小
            $playId = $this->arrPlayId['DIBAQIUWEIXIAO'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if($num8Total%2 == 0){ //合数双
            $playId = $this->arrPlayId['DIBAQIUHESHUSHUANG'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        } else { //合数单
            $playId = $this->arrPlayId['DIBAQIUHESHUDAN'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$zhongArr)){ //中
            $playId = $this->arrPlayId['DIBAQIUZHONG'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$faArr)){ //发
            $playId = $this->arrPlayId['DIBAQIUFA'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$baiArr)){ //白
            $playId = $this->arrPlayId['DIBAQIUBAI'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$dongArr)){ //东
            $playId = $this->arrPlayId['DIBAQIUDONG'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$nanArr)){ //南
            $playId = $this->arrPlayId['DIBAQIUNAN'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$xiArr)){ //西
            $playId = $this->arrPlayId['DIBAQIUXI'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        if(in_array($num8,$beiArr)){ //北
            $playId = $this->arrPlayId['DIBAQIUBEI'];
            $winCode = $gameId.$Q8PlayCate.$playId;
            $win->push($winCode);
        }
        //第八球两面-End
        //第八球单号-Start
        switch ($num8){
            case 1:
                $playId = $this->arrPlayId['DIBAQIU1'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = $this->arrPlayId['DIBAQIU2'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = $this->arrPlayId['DIBAQIU3'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = $this->arrPlayId['DIBAQIU4'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = $this->arrPlayId['DIBAQIU5'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = $this->arrPlayId['DIBAQIU6'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = $this->arrPlayId['DIBAQIU7'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = $this->arrPlayId['DIBAQIU8'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = $this->arrPlayId['DIBAQIU9'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = $this->arrPlayId['DIBAQIU10'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = $this->arrPlayId['DIBAQIU11'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = $this->arrPlayId['DIBAQIU12'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = $this->arrPlayId['DIBAQIU13'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = $this->arrPlayId['DIBAQIU14'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = $this->arrPlayId['DIBAQIU15'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = $this->arrPlayId['DIBAQIU16'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = $this->arrPlayId['DIBAQIU17'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = $this->arrPlayId['DIBAQIU18'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = $this->arrPlayId['DIBAQIU19'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = $this->arrPlayId['DIBAQIU20'];
                $winCode = $gameId.$Q8PlayCate.$playId;
                $win->push($winCode);
                break;
        }
        //第八球单号-End
    }
    //正码
    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $playCate = $this->arrPlayCate['ZM'];
        $ZM1 = $arrOpenCode[0];
        $ZM2 = $arrOpenCode[1];
        $ZM3 = $arrOpenCode[2];
        $ZM4 = $arrOpenCode[3];
        $ZM5 = $arrOpenCode[4];
        $ZM6 = $arrOpenCode[5];
        $ZM7 = $arrOpenCode[6];
        $ZM8 = $arrOpenCode[7];
        $nums = ['1'=>$this->arrPlayId['ZHENGMA1'],'2'=>$this->arrPlayId['ZHENGMA2'],'3'=>$this->arrPlayId['ZHENGMA3'],'4'=>$this->arrPlayId['ZHENGMA4'],'5'=>$this->arrPlayId['ZHENGMA5'],'6'=>$this->arrPlayId['ZHENGMA6'],'7'=>$this->arrPlayId['ZHENGMA7'],'8'=>$this->arrPlayId['ZHENGMA8'],'9'=>$this->arrPlayId['ZHENGMA9'],'10'=>$this->arrPlayId['ZHENGMA10'],'11'=>$this->arrPlayId['ZHENGMA11'],'12'=>$this->arrPlayId['ZHENGMA12'],'13'=>$this->arrPlayId['ZHENGMA13'],'14'=>$this->arrPlayId['ZHENGMA14'],'15'=>$this->arrPlayId['ZHENGMA15'],'16'=>$this->arrPlayId['ZHENGMA16'],'17'=>$this->arrPlayId['ZHENGMA17'],'18'=>$this->arrPlayId['ZHENGMA18'],'19'=>$this->arrPlayId['ZHENGMA19'],'20'=>$this->arrPlayId['ZHENGMA20']];
        foreach ($nums as $k => $v){
            if($ZM1 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM2 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM3 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM4 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM5 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM6 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM7 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
            if($ZM8 == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //连码
    public function NC_LIANMA($openCode,$gameId,$table,$issue){
        $lm_playCate = $this->arrPlayCate['LM']; //连码分类ID
        $lm_ids = [];
        $lm_lose_ids = [];
        $sql_lm = '';
        $get = DB::table($table)->select('bet_id','bet_info','play_name')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lm_playCate)->where('bunko','=',0.00)->get();
        $lm_open = explode(',', $openCode);
        foreach ($get as $item) {
            $explodeBetInfo = explode(',',$item->bet_info);
            if(count($explodeBetInfo) == 2 && $item->play_name == '任选二'){
                $diff2 = array_intersect($lm_open, $explodeBetInfo);
                if(count($diff2) == 2){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            if(count($explodeBetInfo) == 3 && $item->play_name == '任选三'){
                $diff3 = array_intersect($lm_open, $explodeBetInfo);
                if(count($diff3) == 3){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            if(count($explodeBetInfo) == 4 && $item->play_name == '任选四'){
                $diff4 = array_intersect($lm_open, $explodeBetInfo);
                if(count($diff4) == 4){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            if(count($explodeBetInfo) == 5 && $item->play_name == '任选五'){
                $diff5 = array_intersect($lm_open, $explodeBetInfo);
                if(count($diff5) == 5){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            if(count($explodeBetInfo) == 2 && $item->play_name == '选二连组'){
                $pattern = '/('.$item->bet_info.')/u';
                $matches = preg_match($pattern, $openCode);
                if($matches){
                    $lm_ids[] = $item->bet_id;
                }else{
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            if(count($explodeBetInfo) == 3 && $item->play_name == '选三前组'){
                if($explodeBetInfo[0] == $this->num_1 && $explodeBetInfo[1] == $this->num_2 && $explodeBetInfo[2] == $this->num_3){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
        }
        $ids_lm = implode(',', $lm_ids);
        if($ids_lm){
            $sql_lm = "UPDATE bet SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_lm)"; //中奖的SQL语句
        }
        return $sql_lm;
    }
}
