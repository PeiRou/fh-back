<?php
/**
 * 快三玩法结算
 * User: Zoe
 * Date: 2019/4/23
 * Time: 下午20:18
 */

namespace App;

class ExcelLotteryK3
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
    //和值
    public function HZ($gameId,$win)
    {
        $playCate = $this->arrPlayCate['HZ'];
        $HZ = (int)$this->num_1 + (int)$this->num_2 + (int)$this->num_3;
        $TS = 0;

        if((int)$this->num_1 == (int)$this->num_2 && (int)$this->num_1 == (int)$this->num_3){ //通杀
            $TS = 1;
        }
        if($HZ >= 11 && $HZ <= 18 && $TS == 0){ //大
            $playId = $this->arrPlayId['HEZHIDA'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ >= 3 && $HZ <= 10 && $TS == 0){ //小
            $playId = $this->arrPlayId['HEZHIXIAO'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ%2 == 0){ //双
            $playId = $this->arrPlayId['HEZHISHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = $this->arrPlayId['HEZHIDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        $HZDS_arr = [3=>$this->arrPlayId['HEZHI3'],4=>$this->arrPlayId['HEZHI4'],5=>$this->arrPlayId['HEZHI5'],6=>$this->arrPlayId['HEZHI6'],7=>$this->arrPlayId['HEZHI7'],8=>$this->arrPlayId['HEZHI8'],9=>$this->arrPlayId['HEZHI9'],10=>$this->arrPlayId['HEZHI10'],11=>$this->arrPlayId['HEZHI11'],12=>$this->arrPlayId['HEZHI12'],13=>$this->arrPlayId['HEZHI13'],14=>$this->arrPlayId['HEZHI14'],15=>$this->arrPlayId['HEZHI15'],16=>$this->arrPlayId['HEZHI16'],17=>$this->arrPlayId['HEZHI17'],18=>$this->arrPlayId['HEZHI18']];
        foreach ($HZDS_arr as $k => $v){
            if($HZ == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //三连号
    public function SLH($gameId,$win)
    {
        $playCate = $this->arrPlayCate['SLH'];
        $SLH_TX = 0;
        $SLH_string = $this->num_1.$this->num_2.$this->num_3;
        $SLH_arr = [
            '123' => $this->arrPlayId['SANLIANHAO123'],
            '234' => $this->arrPlayId['SANLIANHAO234'],
            '345' => $this->arrPlayId['SANLIANHAO345'],
            '456' => $this->arrPlayId['SANLIANHAO456'],
        ];
        foreach ($SLH_arr as $k => $v){
            if($k == $SLH_string){
                $SLH_TX += 1;
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($SLH_TX !== 0){
            $playId = $this->arrPlayId['SANLIANTONGXUAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //三同号
    public function STH($gameId,$win)
    {
        $playCate = $this->arrPlayCate['STH'];
        $STH_TX = 0;
        $STH_string = $this->num_1.$this->num_2.$this->num_3;
        $STH_arr = [
            '111' => $this->arrPlayId['SANTONGHAO111'],
            '222' => $this->arrPlayId['SANTONGHAO222'],
            '333' => $this->arrPlayId['SANTONGHAO333'],
            '444' => $this->arrPlayId['SANTONGHAO444'],
            '555' => $this->arrPlayId['SANTONGHAO555'],
            '666' => $this->arrPlayId['SANTONGHAO666'],
        ];
        foreach ($STH_arr as $k => $v){
            if($k == $STH_string){
                $STH_TX += 1;
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($STH_TX !== 0){
            $playId = $this->arrPlayId['SANTONGTONGXUAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }
    //二同号
    public function ETH($gameId,$win)
    {
        $playCate = $this->arrPlayCate['ETH'];
        $isBaoZi = 0;
        $ETH_arr = [
            1 => $this->arrPlayId['ERTONGHAO11'],
            2 => $this->arrPlayId['ERTONGHAO22'],
            3 => $this->arrPlayId['ERTONGHAO33'],
            4 => $this->arrPlayId['ERTONGHAO44'],
            5 => $this->arrPlayId['ERTONGHAO55'],
            6 => $this->arrPlayId['ERTONGHAO66'],
        ];
        if((int)$this->num_1 == (int)$this->num_2 && (int)$this->num_1 == (int)$this->num_3){
            $isBaoZi = 1;
        }
        if((int)$this->num_1 == (int)$this->num_2 && $isBaoZi == 0){
            foreach ($ETH_arr as $k => $v){
                if((int)$this->num_1 == $k){
                    $playId = $v;
                    $winCode = $gameId.$playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if((int)$this->num_2 == (int)$this->num_3 && $isBaoZi == 0){
            foreach ($ETH_arr as $k => $v){
                if((int)$this->num_2 == $k){
                    $playId = $v;
                    $winCode = $gameId.$playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
    }
    //跨度
    public function KD($gameId,$win)
    {
        $playCate = $this->arrPlayCate['KD'];

        $KD_NUM = (int)$this->num_3 - (int)$this->num_1;
        $KD_DX_arr = [0 => $this->arrPlayId['KUADUXIAO'], 1 => $this->arrPlayId['KUADUXIAO'], 2 => $this->arrPlayId['KUADUXIAO'], 3 => $this->arrPlayId['KUADUDA'], 4 => $this->arrPlayId['KUADUDA'], 5 => $this->arrPlayId['KUADUDA']];
        $KD_DS_arr = [0 => $this->arrPlayId['KUADUSHUANG'], 1 => $this->arrPlayId['KUADUDAN'], 2 => $this->arrPlayId['KUADUSHUANG'], 3 => $this->arrPlayId['KUADUDAN'], 4 => $this->arrPlayId['KUADUSHUANG'], 5 => $this->arrPlayId['KUADUDAN']];
        $KD_KDZ_arr = [0 => $this->arrPlayId['KUADU0'], 1 => $this->arrPlayId['KUADU1'], 2 => $this->arrPlayId['KUADU2'], 3 => $this->arrPlayId['KUADU3'], 4 => $this->arrPlayId['KUADU4'], 5 => $this->arrPlayId['KUADU5']];
        foreach ($KD_DX_arr as $k => $v){
            if($KD_NUM == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($KD_DS_arr as $k => $v){
            if($KD_NUM == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        foreach ($KD_KDZ_arr as $k => $v){
            if($KD_NUM == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //牌点
    public function PD($gameId,$win)
    {
        $playCate = $this->arrPlayCate['PD'];
        $PD_NUM = (int)$this->num_1 + (int)$this->num_2 + (int)$this->num_3;
        $PD_GEWEI = $PD_NUM % 10;
        $PD_DX_arr = [0 => $this->arrPlayId['PAIDIANDA'], 6 => $this->arrPlayId['PAIDIANDA'], 7 => $this->arrPlayId['PAIDIANDA'], 8 => $this->arrPlayId['PAIDIANDA'], 9 => $this->arrPlayId['PAIDIANDA'], 1 => $this->arrPlayId['PAIDIANXIAO'], 2 => $this->arrPlayId['PAIDIANXIAO'], 3 => $this->arrPlayId['PAIDIANXIAO'], 4 => $this->arrPlayId['PAIDIANXIAO'], 5 => $this->arrPlayId['PAIDIANXIAO']];
        $PD_PDZ_arr = [1 => $this->arrPlayId['PAIDIAN1'], 2 => $this->arrPlayId['PAIDIAN2'], 3 => $this->arrPlayId['PAIDIAN3'], 4 => $this->arrPlayId['PAIDIAN4'], 5 => $this->arrPlayId['PAIDIAN5'], 6 => $this->arrPlayId['PAIDIAN6'], 7 => $this->arrPlayId['PAIDIAN7'], 8 => $this->arrPlayId['PAIDIAN8'], 9 => $this->arrPlayId['PAIDIAN9'], 0 => $this->arrPlayId['PAIDIAN10']];
        foreach ($PD_DX_arr as $k => $v){
            if($PD_GEWEI == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($PD_GEWEI%2 == 0){
            $playId = $this->arrPlayId['PAIDIANSHUANG'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = $this->arrPlayId['PAIDIANDAN'];
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        foreach ($PD_PDZ_arr as $k => $v){
            if($PD_GEWEI == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //不出号码
    public function BUCHU($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = $this->arrPlayCate['BUCHM'];
        $BUCHU_arr = [
            1 => $this->arrPlayId['BUCHUHAOMA1'],
            2 => $this->arrPlayId['BUCHUHAOMA2'],
            3 => $this->arrPlayId['BUCHUHAOMA3'],
            4 => $this->arrPlayId['BUCHUHAOMA4'],
            5 => $this->arrPlayId['BUCHUHAOMA5'],
            6 => $this->arrPlayId['BUCHUHAOMA6']
        ];
        foreach ($BUCHU_arr as $k => $v){
            if(!in_array($k,$arrOpenCode)){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }
    //必出号码
    public function BICHU($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = $this->arrPlayCate['BICHM'];
        $BICHU_arr = [
            1 => $this->arrPlayId['BICHUHAOMA1'],
            2 => $this->arrPlayId['BICHUHAOMA2'],
            3 => $this->arrPlayId['BICHUHAOMA3'],
            4 => $this->arrPlayId['BICHUHAOMA4'],
            5 => $this->arrPlayId['BICHUHAOMA5'],
            6 => $this->arrPlayId['BICHUHAOMA6']
        ];
        foreach ($BICHU_arr as $k => $v){
            if(in_array($k,$arrOpenCode)){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }
}
