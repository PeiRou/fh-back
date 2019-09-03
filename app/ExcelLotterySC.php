<?php
/**
 * 赛车玩法结算
 * User: Zoe
 * Date: 2019/4/20
 * Time: 下午18:01
 */

namespace App;

class ExcelLotterySC
{
    public $arrPlayCate;
    public $arrPlayId;
    public $guan;
    public $ya;
    public $guanyahe;
    public $num_3;
    public $num_4;
    public $num_5;
    public $num_6;
    public $num_7;
    public $num_8;
    public $num_9;
    public $num_10;

    public function setArrPlay($openCode,$arrPlayCate=array(),$arrPlayId=array()){
        $this->arrPlayCate = $arrPlayCate;
        $this->arrPlayId = $arrPlayId;
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $this->guan = $arrOpenCode[0];
        $this->ya = $arrOpenCode[1];
        $this->num_3 = $arrOpenCode[2];
        $this->num_4 = $arrOpenCode[3];
        $this->num_5 = $arrOpenCode[4];
        $this->num_6 = $arrOpenCode[5];
        $this->num_7 = $arrOpenCode[6];
        $this->num_8 = $arrOpenCode[7];
        $this->num_9 = $arrOpenCode[8];
        $this->num_10 = $arrOpenCode[9];
        $this->guanyahe = $this->guan+$this->ya;
    }
    //冠、亚军和
    public function GYH($gameId,$win){
        $gyh_playCate = $this->arrPlayCate['GUANYAJUNHE'];
        if($this->guanyahe%2 == 0){
            //echo "双";
            $gyh_ds_playId = $this->arrPlayId['GUANYASHUANG'];
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        } else {
            //echo "单";
            $gyh_ds_playId = $this->arrPlayId['GUANYADAN'];
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        }
        if($this->guanyahe <= 11){
            //echo "小";
            $gyh_dx_playId = $this->arrPlayId['GUANYAXIAO'];
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        } else {
            //echo "大";
            $gyh_dx_playId = $this->arrPlayId['GUANYADA'];
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        }
        return $win;
    }
    //冠、亚军和定位
    public function GYH_ZD_NUM($gameId,$win){
        $gyh_playCate = $this->arrPlayCate['GUANYAJUNHE'];
        switch ($this->guanyahe){
            case 3:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE3'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 4:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE4'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 5:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE5'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 6:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE6'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 7:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE7'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 8:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE8'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 9:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE9'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 10:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE10'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 11:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE11'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 12:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE12'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 13:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE13'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 14:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE14'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 15:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE15'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 16:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE16'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 17:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE17'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 18:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE18'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 19:
                $gyh_zd_num_playId = $this->arrPlayId['GUANYAJUNHE19'];
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //冠军，大小单双，龙虎
    public function GJ($gameId,$win){
        $gj_playCate = $this->arrPlayCate['GUANJUN'];
        //冠军单双
        if($this->guan%2 == 0){
            //echo "双";
            $gj_ds_playId = $this->arrPlayId['LIANGMIANGUANJUNSHUANG'];
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        } else {
            //echo "单";
            $gj_ds_playId = $this->arrPlayId['LIANGMIANGUANJUNDAN'];
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        }
        //冠军大小
        if($this->guan >= 6){
            $gj_da_playId = $this->arrPlayId['LIANGMIANGUANJUNDA'];
            $gj_da_winCode = $gameId.$gj_playCate.$gj_da_playId;
            $win->push($gj_da_winCode);
        }
        if($this->guan <= 5){
            $gj_xiao_playId = $this->arrPlayId['LIANGMIANGUANJUNXIAO'];
            $gj_xiao_winCode = $gameId.$gj_playCate.$gj_xiao_playId;
            $win->push($gj_xiao_winCode);
        }
        //冠军龙虎
        if($this->guan > $this->num_10){
            //龙
            $gj_long_playId = $this->arrPlayId['LIANGMIANGUANJUNLONG'];
            $gj_long_winCode = $gameId.$gj_playCate.$gj_long_playId;
            $win->push($gj_long_winCode);
        } else {
            $gj_hu_playId = $this->arrPlayId['LIANGMIANGUANJUNHU'];
            $gj_hu_winCode = $gameId.$gj_playCate.$gj_hu_playId;
            $win->push($gj_hu_winCode);
        }
        return $win;
    }
    //亚军，大小单双，龙虎
    public function YJ($gameId,$win){
        $yj_playCate = $this->arrPlayCate['YAJUN'];
        $num = $this->ya;
        $num_hu = $this->num_9;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANYAJUNSHUANG'];
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANYAJUNDAN'];
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANYAJUNDA'];
            $da_winCode = $gameId.$yj_playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANYAJUNXIAO'];
            $xiao_winCode = $gameId.$yj_playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_hu){
            //龙
            $long_playId = $this->arrPlayId['LIANGMIANYAJUNLONG'];
            $long_winCode = $gameId.$yj_playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = $this->arrPlayId['LIANGMIANYAJUNHU'];
            $hu_winCode = $gameId.$yj_playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }
    //第三名，大小单双，龙虎
    public function SAN($gameId,$win){
        $playCate = $this->arrPlayCate['DISANMING'];
        $num = $this->num_3;
        $num_hu = $this->num_8;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDISANMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDISANMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDISANMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDISANMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_hu){
            //龙
            $long_playId = $this->arrPlayId['LIANGMIANDISANMINGLONG'];
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = $this->arrPlayId['LIANGMIANDISANMINGHU'];
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }
    //第四名，大小单双，龙虎
    public function SI($gameId,$win){
        $playCate = $this->arrPlayCate['DISIMING'];
        $num = $this->num_4;
        $num_hu = $this->num_7;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDISIMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDISIMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDISIMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDISIMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_hu){
            //龙
            $long_playId = $this->arrPlayId['LIANGMIANDISIMINGLONG'];
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = $this->arrPlayId['LIANGMIANDISIMINGHU'];
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }
    //第五名，大小单双，龙虎
    public function WU($gameId,$win){
        $playCate = $this->arrPlayCate['DIWUMING'];
        $num = $this->num_5;
        $num_hu = $this->num_6;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDIWUMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDIWUMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDIWUMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDIWUMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_hu){
            //龙
            $long_playId = $this->arrPlayId['LIANGMIANDIWUMINGLONG'];
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = $this->arrPlayId['LIANGMIANDIWUMINGHU'];
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }
    //第六名，大小单双
    public function LIU($gameId,$win){
        $playCate = $this->arrPlayCate['DILIUMING'];
        $num = $this->num_6;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDILIUMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDILIUMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDILIUMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDILIUMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }
    //第七名，大小单双
    public function QI($gameId,$win){
        $playCate = $this->arrPlayCate['DIQIMING'];
        $num = $this->num_7;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDIQIMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDIQIMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDIQIMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDIQIMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }
    //第八名，大小单双
    public function BA($gameId,$win){
        $playCate = $this->arrPlayCate['DIBAMING'];
        $num = $this->num_8;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDIBAMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDIBAMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDIBAMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDIBAMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }
    //第九名，大小单双
    public function JIU($gameId,$win){
        $playCate = $this->arrPlayCate['DIJIUMING'];
        $num = $this->num_9;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDIJIUMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDIJIUMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDIJIUMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDIJIUMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }
    //第十名，大小单双
    public function SHI($gameId,$win){
        $playCate = $this->arrPlayCate['DISHIMING'];
        $num = $this->num_10;
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = $this->arrPlayId['LIANGMIANDISHIMINGSHUANG'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = $this->arrPlayId['LIANGMIANDISHIMINGDAN'];
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = $this->arrPlayId['LIANGMIANDISHIMINGDA'];
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = $this->arrPlayId['LIANGMIANDISHIMINGXIAO'];
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }
    //冠军，定位
    public function NUM1($gameId,$win){
        $playCate = $this->arrPlayCate['GUANJUN'];
        $num = $this->guan;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAOGUANJUN1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAOGUANJUN2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAOGUANJUN3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAOGUANJUN4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAOGUANJUN5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAOGUANJUN6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAOGUANJUN7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAOGUANJUN8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAOGUANJUN9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAOGUANJUN10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //亚军，定位
    public function NUM2($gameId,$win){
        $playCate = $this->arrPlayCate['YAJUN'];
        $num = $this->ya;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAOYAJUN1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAOYAJUN2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAOYAJUN3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAOYAJUN4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAOYAJUN5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAOYAJUN6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAOYAJUN7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAOYAJUN8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAOYAJUN9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAOYAJUN10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第三名，定位
    public function NUM3($gameId,$win){
        $playCate = $this->arrPlayCate['DISANMING'];
        $num = $this->num_3;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODISANMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODISANMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODISANMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODISANMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODISANMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODISANMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODISANMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODISANMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODISANMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODISANMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第四名，定位
    public function NUM4($gameId,$win){
        $playCate = $this->arrPlayCate['DISIMING'];
        $num = $this->num_4;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODISIMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODISIMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODISIMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODISIMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODISIMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODISIMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODISIMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODISIMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODISIMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODISIMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第五名，定位
    public function NUM5($gameId,$win){
        $playCate = $this->arrPlayCate['DIWUMING'];
        $num = $this->num_5;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODIWUMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODIWUMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODIWUMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODIWUMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODIWUMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODIWUMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODIWUMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODIWUMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODIWUMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODIWUMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第六名，定位
    public function NUM6($gameId,$win){
        $playCate = $this->arrPlayCate['DILIUMING'];
        $num = $this->num_6;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODILIUMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODILIUMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODILIUMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODILIUMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODILIUMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODILIUMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODILIUMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODILIUMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODILIUMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODILIUMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第七名，定位
    public function NUM7($gameId,$win){
        $playCate = $this->arrPlayCate['DIQIMING'];
        $num = $this->num_7;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODIQIMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODIQIMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODIQIMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODIQIMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODIQIMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODIQIMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODIQIMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODIQIMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODIQIMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODIQIMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第八名，定位
    public function NUM8($gameId,$win){
        $playCate = $this->arrPlayCate['DIBAMING'];
        $num = $this->num_8;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODIBAMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODIBAMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODIBAMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODIBAMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODIBAMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODIBAMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODIBAMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODIBAMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODIBAMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODIBAMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第九名，定位
    public function NUM9($gameId,$win){
        $playCate = $this->arrPlayCate['DIJIUMING'];
        $num = $this->num_9;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODIJIUMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODIJIUMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODIJIUMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODIJIUMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODIJIUMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODIJIUMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODIJIUMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODIJIUMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODIJIUMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODIJIUMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
    //第十名，定位
    public function NUM10($gameId,$win){
        $playCate = $this->arrPlayCate['DISHIMING'];
        $num = $this->num_10;
        switch ($num){
            case 1:
                $play_id = $this->arrPlayId['DANHAODISHIMING1'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = $this->arrPlayId['DANHAODISHIMING2'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = $this->arrPlayId['DANHAODISHIMING3'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = $this->arrPlayId['DANHAODISHIMING4'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = $this->arrPlayId['DANHAODISHIMING5'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = $this->arrPlayId['DANHAODISHIMING6'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = $this->arrPlayId['DANHAODISHIMING7'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = $this->arrPlayId['DANHAODISHIMING8'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = $this->arrPlayId['DANHAODISHIMING9'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = $this->arrPlayId['DANHAODISHIMING10'];
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
}
