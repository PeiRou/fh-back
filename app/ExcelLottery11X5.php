<?php
/**
 * 11选5玩法结算
 * User: Zoe
 * Date: 2019/4/24
 * Time: 下午22:02
 */

namespace App;

use Illuminate\Support\Facades\DB;

class ExcelLottery11X5
{
    public $arrPlayCate;
    public $arrPlayId;
    public $lm_open;
    public $num_1;
    public $num_2;
    public $num_3;
    public $num_4;
    public $num_5;
    public $OPEN_QIAN_2;
    public $OPEN_QIAN_3;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $this->lm_open = $arrOpenCode;
        $this->num_1 = $arrOpenCode[0];
        $this->num_2 = $arrOpenCode[1];
        $this->num_3 = $arrOpenCode[2];
        $this->num_4 = $arrOpenCode[3];
        $this->num_5 = $arrOpenCode[4];
        $this->OPEN_QIAN_2 = [$this->num_1,$this->num_2];
        $this->OPEN_QIAN_3 = [$this->num_1,$this->num_2,$this->num_3];
    }
    //两面部分结算
    public function LM($gameId,$win,$ids_he)
    {
        $playCate = $this->arrPlayCate['ZH'];
        $num1 = $this->num_1;
        $num2 = $this->num_2;
        $num3 = $this->num_3;
        $num4 = $this->num_4;
        $num5 = $this->num_5;
        $numsTotal = $num1 + $num2 + $num3 + $num4 + $num5;

        //总和大小-Start
        if($numsTotal == 30){   //总和等于30视为和局 //和局退本金
            $playId = $this->arrPlayId['ZONGHEDA'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['ZONGHEXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $ids_he->push($winCode);
        }else {
            if($numsTotal > 30){ //总和大
                $playId = $this->arrPlayId['ZONGHEDA'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }else if($numsTotal < 30){ //总和小
                $playId = $this->arrPlayId['ZONGHEXIAO'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        //总和大小-End

        //总和单双-Start
        if($numsTotal%2 == 0){ //总和双
            $playId = $this->arrPlayId['ZONGHESHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = $this->arrPlayId['ZONGHEDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和单双-End

        //总和尾大、尾小-Start
        $totalStrSplit = str_split($numsTotal);
        $totalWei = (int)$totalStrSplit[1];
        if($totalWei >= 5){ //总和尾大
            $playId = $this->arrPlayId['ZONGHEWEIDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($totalWei <= 4){ //总和尾小
            $playId = $this->arrPlayId['ZONGHEWEIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //总和尾大、尾小-End

        //龙虎-Start
        if($num1 > $num5){ //龙
            $playId = $this->arrPlayId['LONG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //虎
            $playId = $this->arrPlayId['HU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //龙虎-End

        //单号1两面-Start
        $Q1PlayCate = $this->arrPlayCate['QIU1'];
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
        }
        if($num1 == 11){ //单号1两面开11视为和局 //和局退本金
            $playId = $this->arrPlayId['DIYIQIUDA'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIYIQIUXIAO'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIYIQIUSHUANG'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIYIQIUDAN'];
            $winCode = $gameId.$Q1PlayCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($num1 >= 6 && $num1 !== 11){ //大
                $playId = $this->arrPlayId['DIYIQIUDA'];
                $winCode = $gameId.$Q1PlayCate.$playId;
                $win->push($winCode);
            }else if($num1 <= 5){ //小
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
        }
        //单号1两面-End

        //单号2两面-Start
        $Q2PlayCate = $this->arrPlayCate['QIU2'];
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
        }
        if($num2 == 11){ //单号2两面开11视为和局 //和局退本金
            $playId = $this->arrPlayId['DIERQIUDA'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIERQIUXIAO'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIERQIUSHUANG'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIERQIUDAN'];
            $winCode = $gameId.$Q2PlayCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($num2 >= 6){ //大
                $playId = $this->arrPlayId['DIERQIUDA'];
                $winCode = $gameId.$Q2PlayCate.$playId;
                $win->push($winCode);
            }else if($num2 <= 5){ //小
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
        }
        //单号2两面-End

        //单号3两面-Start
        $Q3PlayCate = $this->arrPlayCate['QIU3'];
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
        }
        if($num3 == 11){ //单号3两面开11视为和局 //和局退本金
            $playId = $this->arrPlayId['DISANQIUDA'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DISANQIUXIAO'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DISANQIUSHUANG'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DISANQIUDAN'];
            $winCode = $gameId.$Q3PlayCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($num3 >= 6){ //大
                $playId = $this->arrPlayId['DISANQIUDA'];
                $winCode = $gameId.$Q3PlayCate.$playId;
                $win->push($winCode);
            }else if($num3 <= 5){ //小
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
        }
        //单号3两面-End

        //单号4两面-Start
        $Q4PlayCate = $this->arrPlayCate['QIU4'];
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
        }
        if($num4 == 11){ //单号4两面开11视为和局 //和局退本金
            $playId = $this->arrPlayId['DISIQIUDA'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DISIQIUXIAO'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DISIQIUSHUANG'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DISIQIUDAN'];
            $winCode = $gameId.$Q4PlayCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($num4 >= 6){ //大
                $playId = $this->arrPlayId['DISIQIUDA'];
                $winCode = $gameId.$Q4PlayCate.$playId;
                $win->push($winCode);
            }else if($num4 <= 5){ //小
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
        }
        //单号4两面-End

        //单号5两面-Start
        $Q5PlayCate = $this->arrPlayCate['QIU5'];
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
        }
        if($num5 == 11){ //单号5两面开11视为和局 //和局退本金
            $playId = $this->arrPlayId['DIWUQIUDA'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIWUQIUXIAO'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIWUQIUSHUANG'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $ids_he->push($winCode);
            $playId = $this->arrPlayId['DIWUQIUDAN'];
            $winCode = $gameId.$Q5PlayCate.$playId;
            $ids_he->push($winCode);
        }else{
            if($num5 >= 6){ //大
                $playId = $this->arrPlayId['DIWUQIUDA'];
                $winCode = $gameId.$Q5PlayCate.$playId;
                $win->push($winCode);
            }else if($num5 <= 5){ //小
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
        }
        //单号5两面-End

        //一中一 - Start
        $YZYPlayCate = $this->arrPlayCate['YZY'];
        $YZYNums = ['1'=>$this->arrPlayId['YIZHONGYI1'],'2'=>$this->arrPlayId['YIZHONGYI2'],'3'=>$this->arrPlayId['YIZHONGYI3'],'4'=>$this->arrPlayId['YIZHONGYI4'],'5'=>$this->arrPlayId['YIZHONGYI5'],'6'=>$this->arrPlayId['YIZHONGYI6'],'7'=>$this->arrPlayId['YIZHONGYI7'],'8'=>$this->arrPlayId['YIZHONGYI8'],'9'=>$this->arrPlayId['YIZHONGYI9'],'10'=>$this->arrPlayId['YIZHONGYI10'],'11'=>$this->arrPlayId['YIZHONGYI11']];
        foreach ($YZYNums as $k => $v){
            if($num1 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num2 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num3 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num4 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
            if($num5 == $k){
                $playId = $v;
                $winCode = $gameId.$YZYPlayCate.$playId;
                $win->push($winCode);
            }
        }
        //一中一 - End
    }
    //直选
    public function a11X5_ZH($gameId,$table,$issue){
        $zhixuan_playCate = $this->arrPlayCate['ZHIXUAN']; //直选分类ID
        $zhixuan_ids = [];
        $zhixuan_lose_ids = [];
        $sql_zhixuan = '';
        $get = DB::table($table)->select('bet_id','bet_info','play_id')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$zhixuan_playCate)->where('bunko','=',0.00)->get();
        $open2 = $this->OPEN_QIAN_2;
        $open3 = $this->OPEN_QIAN_3;
        foreach ($get as $item) {
            $user = explode(',', $item->bet_info);
            $playId = $this->arrPlayId['QIANERZHIXUAN'];     //前二直选
            $numCode = $gameId.$zhixuan_playCate.$playId;
            if($item->play_id == $numCode){ //前二直选
                if($open2[0] == $user[0] && $open2[1] == $user[1]){
                    $zhixuan_ids[] = $item->bet_id;
                } else {
                    $zhixuan_lose_ids[] = $item->bet_id;
                }
            }
            $playId = $this->arrPlayId['QIANSANZHIXUAN'];     //前三直选
            $numCode = $gameId.$zhixuan_playCate.$playId;
            if($item->play_id == $numCode){ //前三直选
                if($open3[0] == $user[0] && $open3[1] == $user[1] && $open3[2] == $user[2]){
                    $zhixuan_ids[] = $item->bet_id;
                } else {
                    $zhixuan_lose_ids[] = $item->bet_id;
                }
            }
        }
        $ids_zhixuan = implode(',', $zhixuan_ids);
        if($ids_zhixuan){
            $sql_zhixuan = "UPDATE bet SET bunko = bet_money * play_odds, status = 3 , updated_at ='".date('Y-m-d H:i:s')."' WHERE `bet_id` IN ($ids_zhixuan)"; //中奖的SQL语句
        }
        return $sql_zhixuan;
    }
    //连码
    public function a11X5_LIANMA($gameId,$table,$issue){
        $lm_playCate = $this->arrPlayCate['LIANMA'];        //分类id
        $lm_ids = [];
        $lm_lose_ids = [];
        $sql_lm = '';
        $get_lm = DB::table($table)->select('bet_id','bet_info','play_id','play_name')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('playcate_id',$lm_playCate)->where('bunko','=',0.00)->get();
        $open2 = $this->OPEN_QIAN_2;
        $open3 = $this->OPEN_QIAN_3;
        foreach ($get_lm as $item) {
            $explodeBetInfo = explode(',',$item->bet_info);
            if(count($explodeBetInfo) == 2 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff2 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff2) == 2){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            } else if (count($explodeBetInfo) == 3 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff3 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff3) == 3){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            } else if (count($explodeBetInfo) == 4 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff4 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff4) == 4){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            } else if (count($explodeBetInfo) == 5 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff5 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff5) == 5){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            } else if (count($explodeBetInfo) == 6 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff6 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff6) == 5){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            } else if (count($explodeBetInfo) == 7 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff7 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff7) == 5){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            } else if (count($explodeBetInfo) == 8 && $item->play_name !== '前二组选' && $item->play_name !== '前三组选'){
                $diff8 = array_intersect($this->lm_open, $explodeBetInfo);
                if(count($diff8) == 5){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            $explodeBetInfo = explode(',',$item->bet_info);
            $playId = $this->arrPlayId['QIANERZUXUAN'];     //前二组选
            $numCode = $gameId.$lm_playCate.$playId;
            if($item->play_id == $numCode){ //前二组选
                if($explodeBetInfo[0] == $open2[0] && $explodeBetInfo[1] == $open2[1]){
                    $lm_ids[] = $item->bet_id;
                } else {
                    $lm_lose_ids[] = $item->bet_id;
                }
            }
            $playId = $this->arrPlayId['QIANSANZUXUAN'];    //前三组选
            $numCode = $gameId.$lm_playCate.$playId;
            if($item->play_id == $numCode){ //前三组选
                if($explodeBetInfo[0] == $open3[0] && $explodeBetInfo[1] == $open3[1] && $explodeBetInfo[2] == $open3[2]){
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
