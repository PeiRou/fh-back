<?php
/**
 * 快乐八玩法结算
 * User: Zoe
 * Date: 2019/4/24
 * Time: 下午19:09
 */

namespace App;

class ExcelLotteryKL8
{
    public $arrPlayCate;
    public $arrPlayId;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
    }

    public function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = $this->arrPlayCate['ZM'];
        for($i=0;$i<count($arrOpenCode);$i++){
            $winCode = $gameId.$playCate.$this->ZM_NUMS($arrOpenCode[$i]);
            $win->push($winCode);
        }
    }

    public function ZH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $sum = 0;
        $playCate = $this->arrPlayCate['ZH'];
        for($i=0;$i<count($arrOpenCode);$i++){
            $sum += (int)$arrOpenCode[$i];
        }
        if($sum > 810){ //总和大
            $playId = $this->arrPlayId['ZONGHEDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和小
            $playId = $this->arrPlayId['ZONGHEXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        if($sum%2 == 0) {
            $playId = $this->arrPlayId['ZONGHESHUANG']; //总和双
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['ZONGHEDAN']; //总和单
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        if($sum == 810){
            $playId = $this->arrPlayId['ZONGHE810']; //和值
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        if($sum%2 == 0 && $sum > 810){ //大双
            $playId = $this->arrPlayId['ZONGDASHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 == 0 && $sum < 810){ //小双
            $playId = $this->arrPlayId['ZONGXIAOSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 !== 0 && $sum > 810){ //大单
            $playId = $this->arrPlayId['ZONGDADAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 !== 0 && $sum < 810){ //小单
            $playId = $this->arrPlayId['ZONGXIAODAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function QHH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $qian = 0;
        $hou = 0;
        $playCate = $this->arrPlayCate['QHH'];
        for($i=0;$i<count($arrOpenCode);$i++){
            $num = (int)$arrOpenCode[$i];
            if($num >= 1 && $num <= 40){
                $qian += 1;
            }
            if($num >= 41 && $num <= 80){
                $hou += 1;
            }
        }
        if($qian > $hou){
            $playId = $this->arrPlayId['QIAN_DUO']; //前多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['HOU_DUO']; //后多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($qian == $hou){
            $playId = $this->arrPlayId['QIANHOUHE']; //前后和
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function DSH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $dan = 0;
        $shuang = 0;
        $playCate = $this->arrPlayCate['DSH'];
        for($i=0;$i<count($arrOpenCode);$i++){
            $num = (int)$arrOpenCode[$i];
            if($num%2 == 0){
                $shuang += 1;
            } else {
                $dan += 1;
            }
        }
        if($dan > 10){
            $playId = $this->arrPlayId['DAN_DUO']; //单多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if ($shuang > 10) {
            $playId = $this->arrPlayId['SHUANG_DUO']; //双多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($dan == $shuang){
            $playId = $this->arrPlayId['DANSHUANG_HE']; //单双和
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function WX($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $sum = 0;
        $playCate = $this->arrPlayCate['WX'];
        for($i=0;$i<count($arrOpenCode);$i++){
            $sum += (int)$arrOpenCode[$i];
        }
        if($sum >= 210 && $sum <= 695){ //金
            $playId = $this->arrPlayId['JIN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 696 && $sum <= 763){ //木
            $playId = $this->arrPlayId['MU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 764 && $sum <= 855){ //水
            $playId = $this->arrPlayId['SHUI'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 856 && $sum <= 923){ //火
            $playId = $this->arrPlayId['HUO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 924 && $sum <= 1410){ //土
            $playId = $this->arrPlayId['TU'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZM_NUMS($num)
    {
        $num = (int)$num;
        $play_id = 0;
        if($num>=1 && $num<=80){
            $play_id = $this->arrPlayId['ZHENGMA'.$num];
        }
        return $play_id;
    }
}
