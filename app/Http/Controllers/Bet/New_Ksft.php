<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/2/12
 * Time: 22:50
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Ksft extends Excel
{
    protected $arrPlay_id = array(8023155331,8023155332,8023155333,8023155334,8023155335,8023155336,8023155337,8023155338,8023155339,8023155340,8023155341,8023155342,8023155343,8023155344,8023155345,8023155346,8023155347,8023155348,8023155349,8023155350,8023155351,8023165352,8023165353,8023165354,8023165355,8023165356,8023165357,8023165358,8023165359,8023165360,8023165361,8023165362,8023165363,8023165364,8023165365,8023165366,8023165367,8023175368,8023175369,8023175370,8023175371,8023175372,8023175373,8023175374,8023175375,8023175376,8023175377,8023175378,8023175379,8023175380,8023175381,8023175382,8023175383,8023185384,8023185385,8023185386,8023185387,8023185388,8023185389,8023185390,8023185391,8023185392,8023185393,8023185394,8023185395,8023185396,8023185397,8023185398,8023185399,8023195400,8023195401,8023195402,8023195403,8023195404,8023195405,8023195406,8023195407,8023195408,8023195409,8023195410,8023195411,8023195412,8023195413,8023195414,8023195415,8023205416,8023205417,8023205418,8023205419,8023205420,8023205421,8023205422,8023205423,8023205424,8023205425,8023205426,8023205427,8023205428,8023205429,8023205430,8023205431,8023215432,8023215433,8023215434,8023215435,8023215436,8023215437,8023215438,8023215439,8023215440,8023215441,8023215442,8023215443,8023215444,8023215445,8023225446,8023225447,8023225448,8023225449,8023225450,8023225451,8023225452,8023225453,8023225454,8023225455,8023225456,8023225457,8023225458,8023225459,8023235460,8023235461,8023235462,8023235463,8023235464,8023235465,8023235466,8023235467,8023235468,8023235469,8023235470,8023235471,8023235472,8023235473,8023245474,8023245475,8023245476,8023245477,8023245478,8023245479,8023245480,8023245481,8023245482,8023245483,8023245484,8023245485,8023245486,8023245487,8023255488,8023255489,8023255490,8023255491,8023255492,8023255493,8023255494,8023255495,8023255496,8023255497,8023255498,8023255499,8023255500,8023255501);
    protected function exc_play($openCode,$gameId){
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
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_ksft';
        $gameName = '快速飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'ksft killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table);
                }
            }
            if(!$excel){
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel,$this->arrPlay_id);
                $this->bet_total($issue,$gameId);
                if($bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
            }else{
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }

    private function GYH($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gyh_playCate = 315;
        $guan = $arrOpenCode[0];
        $ya = $arrOpenCode[1];
        $guanyahe = $guan+$ya;
        if($guanyahe%2 == 0){
            //echo "双";
            $gyh_ds_playId = 5334;
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        } else {
            //echo "单";
            $gyh_ds_playId = 5333;
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        }
        if($guanyahe <= 11){
            //echo "小";
            $gyh_dx_playId = 5332;
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        } else {
            //echo "大";
            $gyh_dx_playId = 5331;
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        }
        return $win;
    }

    private function GYH_ZD_NUM($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gyh_playCate = 315;
        $guan = $arrOpenCode[0];
        $ya = $arrOpenCode[1];
        $guanyahe = $guan+$ya;
        switch ($guanyahe){
            case 3:
                $gyh_zd_num_playId = 5335;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 4:
                $gyh_zd_num_playId = 5336;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 5:
                $gyh_zd_num_playId = 5337;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 6:
                $gyh_zd_num_playId = 5338;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 7:
                $gyh_zd_num_playId = 5339;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 8:
                $gyh_zd_num_playId = 5340;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 9:
                $gyh_zd_num_playId = 5341;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 10:
                $gyh_zd_num_playId = 5342;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 11:
                $gyh_zd_num_playId = 5343;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 12:
                $gyh_zd_num_playId = 5344;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 13:
                $gyh_zd_num_playId = 5345;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 14:
                $gyh_zd_num_playId = 5346;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 15:
                $gyh_zd_num_playId = 5347;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 16:
                $gyh_zd_num_playId = 5348;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 17:
                $gyh_zd_num_playId = 5349;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 18:
                $gyh_zd_num_playId = 5350;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 19:
                $gyh_zd_num_playId = 5351;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function GJ($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gj_playCate = 316;
        $guanjun = $arrOpenCode[0];
        $num_10 = $arrOpenCode[9];
        //冠军单双
        if($guanjun%2 == 0){
            //echo "双";
            $gj_ds_playId = 5355;
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        } else {
            //echo "单";
            $gj_ds_playId = 5354;
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        }
        //冠军大小
        if($guanjun >= 6){
            $gj_da_playId = 5352;
            $gj_da_winCode = $gameId.$gj_playCate.$gj_da_playId;
            $win->push($gj_da_winCode);
        }
        if($guanjun <= 5){
            $gj_xiao_playId = 5353;
            $gj_xiao_winCode = $gameId.$gj_playCate.$gj_xiao_playId;
            $win->push($gj_xiao_winCode);
        }
        //冠军龙虎
        if($guanjun > $num_10){
            //龙
            $gj_long_playId = 5356;
            $gj_long_winCode = $gameId.$gj_playCate.$gj_long_playId;
            $win->push($gj_long_winCode);
        } else {
            $gj_hu_playId = 5357;
            $gj_hu_winCode = $gameId.$gj_playCate.$gj_hu_playId;
            $win->push($gj_hu_winCode);
        }
        return $win;
    }

    private function YJ($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $yj_playCate = 317;
        $yajun = $arrOpenCode[1];
        $num_10 = $arrOpenCode[8];
        //单双
        if($yajun%2 == 0){
            //echo "双";
            $ds_playId = 5371;
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5370;
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($yajun >= 6){
            $da_playId = 5368;
            $da_winCode = $gameId.$yj_playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($yajun <= 5){
            $xiao_playId = 5369;
            $xiao_winCode = $gameId.$yj_playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($yajun > $num_10){
            //龙
            $long_playId = 5372;
            $long_winCode = $gameId.$yj_playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5373;
            $hu_winCode = $gameId.$yj_playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function SAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 318;
        $num = $arrOpenCode[2];
        $num_10 = $arrOpenCode[7];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5387;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5386;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5384;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5385;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 5388;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5389;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function SI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 319;
        $num = $arrOpenCode[3];
        $num_10 = $arrOpenCode[6];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5403;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5402;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5400;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5401;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 5404;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5405;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function WU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 320;
        $num = $arrOpenCode[4];
        $num_10 = $arrOpenCode[5];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5419;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5418;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5416;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5417;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 5420;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5421;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function LIU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 321;
        $num = $arrOpenCode[5];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5435;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5434;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5432;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5433;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function QI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 322;
        $num = $arrOpenCode[6];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5449;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5448;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5446;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5447;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function BA($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 323;
        $num = $arrOpenCode[7];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5463;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5462;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5460;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5461;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function JIU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 324;
        $num = $arrOpenCode[8];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5477;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5476;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5474;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5475;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function SHI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 325;
        $num = $arrOpenCode[9];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5491;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5490;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5488;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5489;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function NUM1($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 316;
        $num = $arrOpenCode[0];
        switch ($num){
            case 1:
                $play_id = 5358;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5359;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5360;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5361;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5362;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5363;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5364;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5365;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5366;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5367;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM2($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 317;
        $num = $arrOpenCode[1];
        switch ($num){
            case 1:
                $play_id = 5374;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5375;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5376;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5377;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5378;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5379;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5380;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5381;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5382;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5383;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM3($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 318;
        $num = $arrOpenCode[2];
        switch ($num){
            case 1:
                $play_id = 5390;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5391;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5392;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5393;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5394;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5395;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5396;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5397;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5398;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5399;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM4($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 319;
        $num = $arrOpenCode[3];
        switch ($num){
            case 1:
                $play_id = 5406;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5407;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5408;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5409;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5410;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5411;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5412;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5413;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5414;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5415;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM5($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 320;
        $num = $arrOpenCode[4];
        switch ($num){
            case 1:
                $play_id = 5422;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5423;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5424;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5425;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5426;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5427;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5428;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5429;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5430;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5431;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM6($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 321;
        $num = $arrOpenCode[5];
        switch ($num){
            case 1:
                $play_id = 5436;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5437;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5438;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5439;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5440;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5441;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5442;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5443;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5444;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5445;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM7($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 322;
        $num = $arrOpenCode[6];
        switch ($num){
            case 1:
                $play_id = 5450;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5451;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5452;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5453;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5454;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5455;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5456;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5457;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5458;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5459;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM8($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 323;
        $num = $arrOpenCode[7];
        switch ($num){
            case 1:
                $play_id = 5464;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5465;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5466;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5467;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5468;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5469;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5470;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5471;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5472;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5473;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM9($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 324;
        $num = $arrOpenCode[8];
        switch ($num){
            case 1:
                $play_id = 5478;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5479;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5480;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5481;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5482;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5483;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5484;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5485;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5486;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5487;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM10($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 325;
        $num = $arrOpenCode[9];
        switch ($num){
            case 1:
                $play_id = 5492;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5493;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5494;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5495;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5496;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5497;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5498;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5499;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5500;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5501;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
}
