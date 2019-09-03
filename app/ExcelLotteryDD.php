<?php
/**
 * 蛋蛋玩法结算
 * User: Zoe
 * Date: 2019/4/24
 * Time: 下午23:28
 */

namespace App;

class ExcelLotteryDD
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
    }
    //混合
    public function HH($gameId,$win){
        $sum = (int)$this->num_1+(int)$this->num_2+(int)$this->num_3;
        $playCate = $this->arrPlayCate['HH'];
        if($sum >= 14){ //大
            $playId = $this->arrPlayId['DA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = $this->arrPlayId['XIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 == 0){ //双
            $playId = $this->arrPlayId['SHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['DAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 23){ //极大
            $playId = $this->arrPlayId['JIDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum <= 4){ //极小
            $playId = $this->arrPlayId['JIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if((int)$this->num_1 == (int)$this->num_2 && (int)$this->num_2 == (int)$this->num_3){ //豹子
            $playId = $this->arrPlayId['BAOZI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //波色
    public function BS($gameId,$win){
        $sum = (int)$this->num_1+(int)$this->num_2+(int)$this->num_3;
        $playCate = $this->arrPlayCate['BS'];
        //红
        if($sum == 3 || $sum == 6 || $sum == 9 || $sum == 12 || $sum == 15 || $sum == 18 || $sum == 21 || $sum == 24){
            $playId = $this->arrPlayId['HONGBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //绿
        else if($sum == 1 || $sum == 4 || $sum == 7 || $sum == 10 || $sum == 16 || $sum == 19 || $sum == 22 || $sum == 25){
            $playId = $this->arrPlayId['LUBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //蓝
        else if($sum == 2 || $sum == 5 || $sum == 8 || $sum == 11 || $sum == 17 || $sum == 20 || $sum == 23 || $sum == 26){
            $playId = $this->arrPlayId['LANBO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //特码
    public function TM($gameId,$win){
        $playCate = $this->arrPlayCate['TM'];
        $sum = (int)$this->num_1+(int)$this->num_2+(int)$this->num_3;
        if($sum>=0 && $sum<=27){
            $play_id = $this->arrPlayId['TEMA'.$sum];
            $winCode = $gameId.$playCate.$play_id;
            $win->push($winCode);
        }
    }
}
