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
        $playCate = $this->arrPlayCate['QIANSAN'];
        $zaliu = 0;
        if($this->num_1 == $this->num_2 && $this->num_2 == $this->num_3){ //豹子
            $zaliu = 1;
            $playId = $this->arrPlayId['QIANSANBAOZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$this->num_1,$this->num_2,$this->num_3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = $this->arrPlayId['QIANSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = $this->arrPlayId['QIANSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = $this->arrPlayId['QIANSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = $this->arrPlayId['QIANSANBANSHUN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANDUIZI'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = $this->arrPlayId['QIANSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = $this->arrPlayId['QIANSANZALIU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //中三
    public function ZHONGSAN($gameId,$win){
        $playCate = $this->arrPlayCate['ZHONGSAN'];
        $zaliu = 0;
        if($this->num_2 == $this->num_3 && $this->num_3 == $this->num_4){ //豹子
            $zaliu = 1;
            $playId = $this->arrPlayId['ZHONGSANBAOZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$this->num_2,$this->num_3,$this->num_4];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = $this->arrPlayId['ZHONGSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = $this->arrPlayId['ZHONGSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = $this->arrPlayId['ZHONGSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANDUIZI'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = $this->arrPlayId['ZHONGSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = $this->arrPlayId['ZHONGSANZALIU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //后三
    public function HOUSAN($gameId,$win){
        $playCate = $this->arrPlayCate['HOUSAN'];
        $zaliu = 0;
        if($this->num_3 == $this->num_4 && $this->num_4 == $this->num_5){ //豹子
            $zaliu = 1;
            $playId = $this->arrPlayId['HOUSANBAOZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$this->num_3,$this->num_4,$this->num_5];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = $this->arrPlayId['HOUSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = $this->arrPlayId['HOUSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = $this->arrPlayId['HOUSANSHUNZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = $this->arrPlayId['HOUSANBANSHUN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANDUIZI'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = $this->arrPlayId['HOUSANBANSHUN'];
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = $this->arrPlayId['HOUSANZALIU'];
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
