<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 上午10:21
 */

namespace App\Http\Controllers\Bet;


use App\Bets;
use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_PK10 extends Excel
{
    protected $arrPlay_id = array(5010340,5010341,5010342,5010343,5010344,5010345,5010346,5010347,5010348,5010349,5010350,5010351,5010352,5010353,5010354,5010355,5010356,5010357,5010358,5010359,5010360,5011361,5011362,5011363,5011364,5011365,5011366,5011367,5011368,5011369,5011370,5011371,5011372,5011373,5011374,5011375,5011376,5012377,5012378,5012379,5012380,5012381,5012382,5012383,5012384,5012385,5012386,5012387,5012388,5012389,5012390,5012391,5012392,5013393,5013394,5013395,5013396,5013397,5013398,5013399,5013400,5013401,5013402,5013403,5013404,5013405,5013406,5013407,5013408,5014409,5014410,5014411,5014412,5014413,5014414,5014415,5014416,5014417,5014418,5014419,5014420,5014421,5014422,5014423,5014424,5015425,5015426,5015427,5015428,5015429,5015430,5015431,5015432,5015433,5015434,5015435,5015436,5015437,5015438,5015439,5015440,5016441,5016442,5016443,5016444,5016445,5016446,5016447,5016448,5016449,5016450,5016451,5016452,5016453,5016454,5017455,5017456,5017457,5017458,5017459,5017460,5017461,5017462,5017463,5017464,5017465,5017466,5017467,5017468,5018469,5018470,5018471,5018472,5018473,5018474,5018475,5018476,5018477,5018478,5018479,5018480,5018481,5018482,5019483,5019484,5019485,5019486,5019487,5019488,5019489,5019490,5019491,5019492,5019493,5019494,5019495,5019496,5020497,5020498,5020499,5020500,5020501,5020502,5020503,5020504,5020505,5020506,5020507,5020508,5020509,5020510);
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
        $gameName = '北京PK10';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$gameId,$issue,false,$this->arrPlay_id);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName);
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
            $this->stopBunko($gameId,1);
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
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
}