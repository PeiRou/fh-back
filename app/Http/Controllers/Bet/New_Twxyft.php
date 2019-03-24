<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/2/23
 * Time: 13:28
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Twxyft extends Excel
{
    protected $arrPlay_id = array(8043465594,8043465595,8043465596,8043465597,8043465598,8043465599,8043465600,8043465601,8043465602,8043465603,8043465604,8043465605,8043465606,8043465607,8043465608,8043465609,8043465610,8043465611,8043465612,8043465613,8043465614,8043475615,8043475616,8043475617,8043475618,8043475619,8043475620,8043475621,8043475622,8043475623,8043475624,8043475625,8043475626,8043475627,8043475628,8043475629,8043475630,8043485631,8043485632,8043485633,8043485634,8043485635,8043485636,8043485637,8043485638,8043485639,8043485640,8043485641,8043485642,8043485643,8043485644,8043485645,8043485646,8043495647,8043495648,8043495649,8043495650,8043495651,8043495652,8043495653,8043495654,8043495655,8043495656,8043495657,8043495658,8043495659,8043495660,8043495661,8043495662,8043505663,8043505664,8043505665,8043505666,8043505667,8043505668,8043505669,8043505670,8043505671,8043505672,8043505673,8043505674,8043505675,8043505676,8043505677,8043505678,8043515679,8043515680,8043515681,8043515682,8043515683,8043515684,8043515685,8043515686,8043515687,8043515688,8043515689,8043515690,8043515691,8043515692,8043515693,8043515694,8043525695,8043525696,8043525697,8043525698,8043525699,8043525700,8043525701,8043525702,8043525703,8043525704,8043525705,8043525706,8043525707,8043525708,8043535709,8043535710,8043535711,8043535712,8043535713,8043535714,8043535715,8043535716,8043535717,8043535718,8043535719,8043535720,8043535721,8043535722,8043545723,8043545724,8043545725,8043545726,8043545727,8043545728,8043545729,8043545730,8043545731,8043545732,8043545733,8043545734,8043545735,8043545736,8043555737,8043555738,8043555739,8043555740,8043555741,8043555742,8043555743,8043555744,8043555745,8043555746,8043555747,8043555748,8043555749,8043555750,8043565751,8043565752,8043565753,8043565754,8043565755,8043565756,8043565757,8043565758,8043565759,8043565760,8043565761,8043565762,8043565763,8043565764);
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
        $table = 'game_twxyft';
        $gameName = '台湾幸运飞艇';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'twxyft killing...');
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
            }else
                $this->stopBunko($gameId,1,'Kill');
        }else{
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
    }

    private function GYH($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gyh_playCate = 346;
        $guan = $arrOpenCode[0];
        $ya = $arrOpenCode[1];
        $guanyahe = $guan+$ya;
        if($guanyahe%2 == 0){
            //echo "双";
            $gyh_ds_playId = 5597;
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        } else {
            //echo "单";
            $gyh_ds_playId = 5596;
            $gyh_ds_winCode = $gameId.$gyh_playCate.$gyh_ds_playId;
            $win->push($gyh_ds_winCode);
        }
        if($guanyahe <= 11){
            //echo "小";
            $gyh_dx_playId = 5595;
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        } else {
            //echo "大";
            $gyh_dx_playId = 5594;
            $gyh_dx_winCode = $gameId.$gyh_playCate.$gyh_dx_playId;
            $win->push($gyh_dx_winCode);
        }
        return $win;
    }

    private function GYH_ZD_NUM($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gyh_playCate = 346;
        $guan = $arrOpenCode[0];
        $ya = $arrOpenCode[1];
        $guanyahe = $guan+$ya;
        switch ($guanyahe){
            case 3:
                $gyh_zd_num_playId = 5598;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 4:
                $gyh_zd_num_playId = 5599;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 5:
                $gyh_zd_num_playId = 5600;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 6:
                $gyh_zd_num_playId = 5601;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 7:
                $gyh_zd_num_playId = 5602;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 8:
                $gyh_zd_num_playId = 5603;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 9:
                $gyh_zd_num_playId = 5604;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 10:
                $gyh_zd_num_playId = 5605;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 11:
                $gyh_zd_num_playId = 5606;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 12:
                $gyh_zd_num_playId = 5607;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 13:
                $gyh_zd_num_playId = 5608;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 14:
                $gyh_zd_num_playId = 5609;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 15:
                $gyh_zd_num_playId = 5610;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 16:
                $gyh_zd_num_playId = 5611;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 17:
                $gyh_zd_num_playId = 5612;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 18:
                $gyh_zd_num_playId = 5613;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
            case 19:
                $gyh_zd_num_playId = 5614;
                $winCode = $gameId.$gyh_playCate.$gyh_zd_num_playId;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function GJ($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $gj_playCate = 347;
        $guanjun = $arrOpenCode[0];
        $num_10 = $arrOpenCode[9];
        //冠军单双
        if($guanjun%2 == 0){
            //echo "双";
            $gj_ds_playId = 5618;
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        } else {
            //echo "单";
            $gj_ds_playId = 5617;
            $gj_ds_winCode = $gameId.$gj_playCate.$gj_ds_playId;
            $win->push($gj_ds_winCode);
        }
        //冠军大小
        if($guanjun >= 6){
            $gj_da_playId = 5615;
            $gj_da_winCode = $gameId.$gj_playCate.$gj_da_playId;
            $win->push($gj_da_winCode);
        }
        if($guanjun <= 5){
            $gj_xiao_playId = 5616;
            $gj_xiao_winCode = $gameId.$gj_playCate.$gj_xiao_playId;
            $win->push($gj_xiao_winCode);
        }
        //冠军龙虎
        if($guanjun > $num_10){
            //龙
            $gj_long_playId = 5619;
            $gj_long_winCode = $gameId.$gj_playCate.$gj_long_playId;
            $win->push($gj_long_winCode);
        } else {
            $gj_hu_playId = 5620;
            $gj_hu_winCode = $gameId.$gj_playCate.$gj_hu_playId;
            $win->push($gj_hu_winCode);
        }
        return $win;
    }

    private function YJ($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $yj_playCate = 348;
        $yajun = $arrOpenCode[1];
        $num_10 = $arrOpenCode[8];
        //单双
        if($yajun%2 == 0){
            //echo "双";
            $ds_playId = 5634;
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5633;
            $ds_winCode = $gameId.$yj_playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($yajun >= 6){
            $da_playId = 5631;
            $da_winCode = $gameId.$yj_playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($yajun <= 5){
            $xiao_playId = 5632;
            $xiao_winCode = $gameId.$yj_playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($yajun > $num_10){
            //龙
            $long_playId = 5635;
            $long_winCode = $gameId.$yj_playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5636;
            $hu_winCode = $gameId.$yj_playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function SAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 349;
        $num = $arrOpenCode[2];
        $num_10 = $arrOpenCode[7];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5650;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5649;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5647;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5648;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 5651;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5652;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function SI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 350;
        $num = $arrOpenCode[3];
        $num_10 = $arrOpenCode[6];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5666;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5665;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5663;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5664;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 5667;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5668;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function WU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 351;
        $num = $arrOpenCode[4];
        $num_10 = $arrOpenCode[5];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5682;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5681;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5679;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5680;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        //龙虎
        if($num > $num_10){
            //龙
            $long_playId = 5683;
            $long_winCode = $gameId.$playCate.$long_playId;
            $win->push($long_winCode);
        } else {
            $hu_playId = 5684;
            $hu_winCode = $gameId.$playCate.$hu_playId;
            $win->push($hu_winCode);
        }
        return $win;
    }

    private function LIU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 352;
        $num = $arrOpenCode[5];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5698;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5697;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5695;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5696;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function QI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 353;
        $num = $arrOpenCode[6];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5712;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5711;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5709;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5710;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function BA($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 354;
        $num = $arrOpenCode[7];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5726;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5725;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5723;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5724;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function JIU($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 355;
        $num = $arrOpenCode[8];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5740;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5739;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5737;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5738;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function SHI($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 356;
        $num = $arrOpenCode[9];
        //单双
        if($num%2 == 0){
            //echo "双";
            $ds_playId = 5754;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        } else {
            //echo "单";
            $ds_playId = 5753;
            $ds_winCode = $gameId.$playCate.$ds_playId;
            $win->push($ds_winCode);
        }
        //大小
        if($num >= 6){
            $da_playId = 5751;
            $da_winCode = $gameId.$playCate.$da_playId;
            $win->push($da_winCode);
        }
        if($num <= 5){
            $xiao_playId = 5752;
            $xiao_winCode = $gameId.$playCate.$xiao_playId;
            $win->push($xiao_winCode);
        }
        return $win;
    }

    private function NUM1($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 347;
        $num = $arrOpenCode[0];
        switch ($num){
            case 1:
                $play_id = 5621;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5622;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5623;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5624;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5625;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5626;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5627;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5628;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5629;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5630;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM2($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 348;
        $num = $arrOpenCode[1];
        switch ($num){
            case 1:
                $play_id = 5637;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5638;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5639;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5640;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5641;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5642;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5643;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5644;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5645;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5646;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM3($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 349;
        $num = $arrOpenCode[2];
        switch ($num){
            case 1:
                $play_id = 5653;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5654;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5655;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5656;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5657;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5658;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5659;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5660;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5661;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5662;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM4($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 350;
        $num = $arrOpenCode[3];
        switch ($num){
            case 1:
                $play_id = 5669;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5670;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5671;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5672;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5673;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5674;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5675;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5676;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5677;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5678;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM5($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 351;
        $num = $arrOpenCode[4];
        switch ($num){
            case 1:
                $play_id = 5685;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5686;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5687;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5688;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5689;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5690;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5691;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5692;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5693;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5694;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM6($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 352;
        $num = $arrOpenCode[5];
        switch ($num){
            case 1:
                $play_id = 5699;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5700;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5701;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5702;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5703;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5704;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5705;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5706;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5707;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5708;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM7($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 353;
        $num = $arrOpenCode[6];
        switch ($num){
            case 1:
                $play_id = 5713;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5714;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5715;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5716;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5717;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5718;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5719;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5720;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5721;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5722;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM8($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 354;
        $num = $arrOpenCode[7];
        switch ($num){
            case 1:
                $play_id = 5727;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5728;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5729;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5730;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5731;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5732;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5733;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5734;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5735;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5736;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM9($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 355;
        $num = $arrOpenCode[8];
        switch ($num){
            case 1:
                $play_id = 5741;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5742;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5743;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5744;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5745;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5746;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5747;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5748;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5749;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5750;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }

    private function NUM10($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 356;
        $num = $arrOpenCode[9];
        switch ($num){
            case 1:
                $play_id = 5755;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5756;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5757;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5758;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5759;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5760;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5761;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5762;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5763;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 5764;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
        return $win;
    }
}
