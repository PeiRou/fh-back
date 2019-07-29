<?php
/**
 * 时时彩玩法结算
 * User: Zoe
 * Date: 2019/4/22
 * Time: 下午22:18
 */

namespace App;

class ExcelLotterySSC
{
    public $arrPlayCate;
    public $arrPlayId;
    public $num_1;
    public $num_2;
    public $num_3;
    public $num_4;
    public $num_5;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $this->num_1 = $arrOpenCode[0];
        $this->num_2 = $arrOpenCode[1];
        $this->num_3 = $arrOpenCode[2];
        $this->num_4 = $arrOpenCode[3];
        $this->num_5 = $arrOpenCode[4];
    }
    //前三
    public function QIANSAN($gameId,$win){
        $txt = 'QIANSAN';
        $playCate = $this->arrPlayCate[$txt];
        $arr = [$this->num_1,$this->num_2,$this->num_3];
        sort($arr);
        //选三判断豹子。顺子。对子。半顺。杂六。
        $this->choSan($txt,$arr,$gameId,$playCate,$win);
    }
    //中三
    public function ZHONGSAN($gameId,$win){
        $txt = 'ZHONGSAN';
        $playCate = $this->arrPlayCate[$txt];
        $arr = [$this->num_2,$this->num_3,$this->num_4];
        sort($arr);
        //选三判断豹子。顺子。对子。半顺。杂六。
        $this->choSan($txt,$arr,$gameId,$playCate,$win);
    }
    //后三
    public function HOUSAN($gameId,$win){
        $txt = 'HOUSAN';
        $playCate = $this->arrPlayCate[$txt];
        $arr = [$this->num_3,$this->num_4,$this->num_5];
        sort($arr);
        //选三判断豹子。顺子。对子。半顺。杂六。
        $this->choSan($txt,$arr,$gameId,$playCate,$win);
    }
    //选三判断豹子。顺子。对子。半顺。杂六。
    private function choSan($txt,$arr,$gameId,$playCate,$win){
        //豹子
        if($arr[0] == $arr[1] && $arr[1] == $arr[2])
        {
            $playId = $this->arrPlayId[$txt.'BAOZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }//顺子
        elseif( ($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1)
            || implode("",$arr) == '019' || implode("",$arr) == '089')
        {
            $playId = $this->arrPlayId[$txt.'SHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }//对子
        elseif ($arr[0] == $arr[1] || $arr[1] == $arr[2])
        {
            $playId = $this->arrPlayId[$txt.'DUIZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }//半顺
        elseif($arr[1] - $arr[0] == 1 || $arr[2] - $arr[1] == 1
            || in_array(implode("",$arr),array('029','039','049','059','069','079')))
        {
            $playId = $this->arrPlayId[$txt.'BANSHUN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }//杂六
        else
        {
            $playId = $this->arrPlayId[$txt.'ZALIU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //总和-大小单双龙虎和
    public function ZHDXDS($gameId,$win){
        $playCate = $this->arrPlayCate['ZONGHELONGHUHE'];
        $num_total = $this->num_1+$this->num_2+$this->num_3+$this->num_4+$this->num_5;
        if($num_total >= 23){ //总和大
            $playId = $this->arrPlayId['ZONGHEDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total <= 22){ //总和小
            $playId = $this->arrPlayId['ZONGHEXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total%2 == 0){ //总和双
            $playId = $this->arrPlayId['ZONGHESHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = $this->arrPlayId['ZONGHEDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($this->num_1 > $this->num_5){ //龙
            $playId = $this->arrPlayId['LONG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($this->num_1 < $this->num_5){ //虎
            $playId = $this->arrPlayId['HU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($this->num_1 == $this->num_5) { //和
            $playId = $this->arrPlayId['HE'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //定位-第一球-大小单双
    public function NUM1_DXDS($gameId,$win){
        $playCate = $this->arrPlayCate['DIYIQIU'];
        $num = $this->num_1;
        //大小
        if($num >= 5){
            $playId = $this->arrPlayId['DIYIQIUDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = $this->arrPlayId['DIYIQIUXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = $this->arrPlayId['DIYIQIUSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['DIYIQIUDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //定位-第二球-大小单双
    public function NUM2_DXDS($gameId,$win){
        $playCate = $this->arrPlayCate['DIERQIU'];
        $num = $this->num_2;
        //大小
        if($num >= 5){
            $playId = $this->arrPlayId['DIERQIUDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = $this->arrPlayId['DIERQIUXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = $this->arrPlayId['DIERQIUSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['DIERQIUDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //定位-第三球-大小单双
    public function NUM3_DXDS($gameId,$win){
        $playCate = $this->arrPlayCate['DISANQIU'];
        $num = $this->num_3;
        //大小
        if($num >= 5){
            $playId = $this->arrPlayId['DISANQIUDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = $this->arrPlayId['DISANQIUXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = $this->arrPlayId['DISANQIUSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['DISANQIUDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //定位-第四球-大小单双
    public function NUM4_DXDS($gameId,$win){
        $playCate = $this->arrPlayCate['DISIQIU'];
        $num = $this->num_4;
        //大小
        if($num >= 5){
            $playId = $this->arrPlayId['DISIQIUDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = $this->arrPlayId['DISIQIUXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = $this->arrPlayId['DISIQIUSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['DISIQIUDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //定位-第五球-大小单双
    public function NUM5_DXDS($gameId,$win){
        $playCate = $this->arrPlayCate['DIWUQIU'];
        $num = $this->num_5;
        //大小
        if($num >= 5){
            $playId = $this->arrPlayId['DIWUQIUDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = $this->arrPlayId['DIWUQIUXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = $this->arrPlayId['DIWUQIUSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['DIWUQIUDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //定位-第一球
    public function NUM1($gameId,$win){
        $playCate = $this->arrPlayCate['DIYIQIU'];
        $num = (int)$this->num_1;
        if($num>=0 && $num<=9){
            $play_id = $this->arrPlayId['DIYIQIU'.$num];
            $winCode = $gameId.$playCate.$play_id;
            $win->push($winCode);
        }
    }
    //定位-第二球
    public function NUM2($gameId,$win){
        $playCate = $this->arrPlayCate['DIERQIU'];
        $num = (int)$this->num_2;
        if($num>=0 && $num<=9){
            $play_id = $this->arrPlayId['DIERQIU'.$num];
            $winCode = $gameId.$playCate.$play_id;
            $win->push($winCode);
        }
    }
    //定位-第三球
    public function NUM3($gameId,$win){
        $playCate = $this->arrPlayCate['DISANQIU'];
        $num = (int)$this->num_3;
        if($num>=0 && $num<=9){
            $play_id = $this->arrPlayId['DISANQIU'.$num];
            $winCode = $gameId.$playCate.$play_id;
            $win->push($winCode);
        }
    }
    //定位-第四球
    public function NUM4($gameId,$win){
        $playCate = $this->arrPlayCate['DISIQIU'];
        $num = (int)$this->num_4;
        if($num>=0 && $num<=9){
            $play_id = $this->arrPlayId['DISIQIU'.$num];
            $winCode = $gameId.$playCate.$play_id;
            $win->push($winCode);
        }
    }
    //定位-第五球
    public function NUM5($gameId,$win){
        $playCate = $this->arrPlayCate['DIWUQIU'];
        $num = (int)$this->num_5;
        if($num>=0 && $num<=9){
            $play_id = $this->arrPlayId['DIWUQIU'.$num];
            $winCode = $gameId.$playCate.$play_id;
            $win->push($winCode);
        }
    }
}
