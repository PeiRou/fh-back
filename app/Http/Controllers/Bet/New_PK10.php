<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 上午10:21
 */

namespace App\Http\Controllers\Bet;


use App\Bets;
use Illuminate\Support\Facades\DB;

class New_PK10
{
    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->GYH($openCode,$gameId,$win);
        $this->GYH_ZD_NUM($openCode,$gameId,$win);
        $this->GJ($openCode,$gameId,$win);
        $this->YJ($openCode,$gameId,$win);
        $this->SAN($openCode,$gameId,$win);
        $this->SI($openCode,$gameId,$win);
        $this->WU($openCode,$gameId,$win);
        $this->LIU($openCode,$gameId,$win);
        $this->QI($openCode,$gameId,$win);
        $this->BA($openCode,$gameId,$win);
        $this->JIU($openCode,$gameId,$win);
        $this->SHI($openCode,$gameId,$win);
        $this->NUM1($openCode,$gameId,$win);
        $this->NUM2($openCode,$gameId,$win);
        $this->NUM3($openCode,$gameId,$win);
        $this->NUM4($openCode,$gameId,$win);
        $this->NUM5($openCode,$gameId,$win);
        $this->NUM6($openCode,$gameId,$win);
        $this->NUM7($openCode,$gameId,$win);
        $this->NUM8($openCode,$gameId,$win);
        $this->NUM9($openCode,$gameId,$win);
        $this->NUM10($openCode,$gameId,$win);
        $table = 'game_bjpk10';
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    \Log::info("北京PK10" . $issue . "结算出错");
                }
            }
        }
        $update = DB::table($table)->where('id',$id)->update([
            'bunko' => 1
        ]);
        if ($update !== 1) {
            \Log::info("北京PK10" . $issue . "结算not Finshed");
        }
    }

    private function GYH($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gyh_playCate = 10;
        $guan = $arrOpenCode[0];
        $ya = $arrOpenCode[1];
        $guanyahe = $guan+$ya;
        if($guanyahe%2 == 0){
            //echo "双";
            $gyh_ds_playId = 343;
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        } else {
            //echo "单";
            $gyh_ds_playId = 342;
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        }
        if($guanyahe <= 11){
            //echo "小";
            $gyh_dx_playId = 341;
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        } else {
            //echo "大";
            $gyh_dx_playId = 340;
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        }
        return $win;
    }

    private function GYH_ZD_NUM($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gyh_playCate = 10;
        $guan = $arrOpenCode[0];
        $ya = $arrOpenCode[1];
        $guanyahe = $guan+$ya;
        switch ($guanyahe){
            case 3:
                $gyh_zd_num_playId = 344;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 4:
                $gyh_zd_num_playId = 345;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 5:
                $gyh_zd_num_playId = 346;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 6:
                $gyh_zd_num_playId = 347;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 7:
                $gyh_zd_num_playId = 348;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 8:
                $gyh_zd_num_playId = 349;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 9:
                $gyh_zd_num_playId = 350;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 10:
                $gyh_zd_num_playId = 351;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 11:
                $gyh_zd_num_playId = 352;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 12:
                $gyh_zd_num_playId = 353;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 13:
                $gyh_zd_num_playId = 354;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 14:
                $gyh_zd_num_playId = 355;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 15:
                $gyh_zd_num_playId = 356;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 16:
                $gyh_zd_num_playId = 357;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 17:
                $gyh_zd_num_playId = 358;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 18:
                $gyh_zd_num_playId = 359;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 19:
                $gyh_zd_num_playId = 360;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function GJ($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gj_playCate = 11;
        $guanjun = $arrOpenCode[0];
        $num_10 = $arrOpenCode[9];
        //冠军单双
        if($guanjun%2 == 0){
            //echo "双";
            $gj_ds_playId = 364;
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        } else {
            //echo "单";
            $gj_ds_playId = 363;
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        }
        //冠军大小
        if($guanjun >= 6){
            $gj_da_playId = 361;
            $gj_da_winCode = $gameId.$gj_playCate.$gj_da_playId;
            $win->push($gj_da_winCode);
        }
        if($guanjun <= 5){
            $gj_xiao_playId = 362;
            $gj_xiao_winCode = $gameId.$gj_playCate.$gj_xiao_playId;
            $win->push($gj_xiao_winCode);
        }
        //冠军龙虎
        if($guanjun > $num_10){
            //龙
            $gj_long_playId = 365;
            $gj_long_winCode = $gameId.$gj_playCate.$gj_long_playId;
            $win->push($gj_long_winCode);
        } else {
            $gj_hu_playId = 366;
            $gj_hu_winCode = $gameId.$gj_playCate.$gj_hu_playId;
            $win->push($gj_hu_winCode);
        }
        return $win;
    }

    private function YJ($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $yj_playCate = 12;
        $yajun = $arrOpenCode[1];
        $num_10 = $arrOpenCode[8];
        //单双
        if($yajun%2 == 0){
            //echo "双";
            $ds_playId = 380;
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 379;
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($yajun >= 6){
            $da_playId = 377;
            $da_winCode = $gameId.$yj_playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($yajun <= 5){
            $xiao_playId = 378;
            $xiao_winCode = $gameId.$yj_playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($yajun > $num_10){
            //龙
            $long_playId = 381;
            $long_winCode = $gameId.$yj_playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 382;
            $hu_winCode = $gameId.$yj_playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function SAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 13;
        $num = $arrOpenCode[2];
        $num_10 = $arrOpenCode[7];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 396;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 395;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 393;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 394;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 397;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 398;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function SI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 14;
        $num = $arrOpenCode[3];
        $num_10 = $arrOpenCode[6];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 412;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 411;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 409;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 410;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 413;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 414;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function WU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 15;
        $num = $arrOpenCode[4];
        $num_10 = $arrOpenCode[5];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 428;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 427;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 425;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 426;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 429;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 430;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function LIU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 16;
        $num = $arrOpenCode[5];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 444;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 443;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 441;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 442;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function QI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 17;
        $num = $arrOpenCode[6];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 458;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 457;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 455;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 456;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function BA($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 18;
        $num = $arrOpenCode[7];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 472;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 471;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 469;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 470;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function JIU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 19;
        $num = $arrOpenCode[8];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 486;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 485;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 483;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 484;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function SHI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 20;
        $num = $arrOpenCode[9];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 500;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 499;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 497;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 498;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function NUM1($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 11;
        $num = $arrOpenCode[0];
        switch ($num){
            case 1:
                $play_id = 367;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 368;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 369;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 370;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 371;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 372;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 373;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 374;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 375;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 376;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM2($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 12;
        $num = $arrOpenCode[1];
        switch ($num){
            case 1:
                $play_id = 383;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 384;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 385;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 386;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 387;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 388;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 389;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 390;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 391;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 392;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM3($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 13;
        $num = $arrOpenCode[2];
        switch ($num){
            case 1:
                $play_id = 399;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 400;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 401;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 402;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 403;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 404;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 405;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 406;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 407;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 408;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM4($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 14;
        $num = $arrOpenCode[3];
        switch ($num){
            case 1:
                $play_id = 415;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 416;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 417;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 418;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 419;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 420;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 421;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 422;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 423;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 424;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM5($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 15;
        $num = $arrOpenCode[4];
        switch ($num){
            case 1:
                $play_id = 431;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 432;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 433;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 434;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 435;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 436;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 437;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 438;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 439;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 440;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM6($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 16;
        $num = $arrOpenCode[5];
        switch ($num){
            case 1:
                $play_id = 445;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 446;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 447;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 448;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 449;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 450;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 451;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 452;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 453;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 454;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM7($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 17;
        $num = $arrOpenCode[6];
        switch ($num){
            case 1:
                $play_id = 459;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 460;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 461;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 462;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 463;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 464;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 465;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 466;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 467;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 468;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM8($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 18;
        $num = $arrOpenCode[7];
        switch ($num){
            case 1:
                $play_id = 473;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 474;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 475;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 476;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 477;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 478;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 479;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 480;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 481;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 482;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM9($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 19;
        $num = $arrOpenCode[8];
        switch ($num){
            case 1:
                $play_id = 487;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 488;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 489;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 490;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 491;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 492;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 493;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 494;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 495;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 496;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM10($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 20;
        $num = $arrOpenCode[9];
        switch ($num){
            case 1:
                $play_id = 501;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 502;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 503;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 504;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 505;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 506;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 507;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 508;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 509;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 510;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function bunko($win,$gameId,$issue){
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
            $sql = "UPDATE bet SET bunko = CASE ";
            $sql_lose = "UPDATE bet SET bunko = CASE ";
            $ids = implode(',', $id);
            foreach ($getUserBets as $item){
                $bunko = $item->bet_money * $item->play_odds;
                $bunko_lose = 0-$item->bet_money;
                $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
            }
            $sql .= "END WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
            $sql_lose .= "END WHERE `play_id` NOT IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
            $run = DB::statement($sql);
            if($run == 1){
                $run2 = DB::statement($sql_lose);
                if($run2 == 1){
                    return 1;
                }
            }
        }
    }

    private function updateUserMoney($gameId,$issue){
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        if($get){
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->s ";
            }

            //\Log::info($users);
            $ids = implode(',',$users);
            //\Log::info($ids);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                //\Log::info($sql);
                $up = DB::connection('mysql::write')->statement($sql);
                if($up != 1){
                    return 1;
                }
            }
        } else {
            \Log::info('北京赛车已结算过，已阻止！');
        }
        return 0;
    }
}