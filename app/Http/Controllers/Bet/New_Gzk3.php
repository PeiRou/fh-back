<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/27
 * Time: 下午9:48
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Gzk3 extends Excel
{
    protected $arrPlay_id = array(182774889,182774890,182774891,182774892,182774893,182774894,182764895,182764896,182764897,182764898,182764899,182764900,182754901,182754902,182754903,182754904,182754905,182754906,182754907,182754908,182754909,182754910,182754911,182754912,182754913,182754914,182744915,182744916,182744917,182744918,182744919,182744920,182744921,182744922,182744923,182744924,182734925,182734926,182734927,182734928,182734929,182734930,182724931,182724932,182724933,182724934,182724935,182724936,182724937,182714938,182714939,182714940,182714941,182714942,182704943,182704944,182704945,182704946,182704947,182704948,182704949,182704950,182704951,182704952,182704953,182704954,182704955,182704956,182704957,182704958,182704959,182704960,182704961,182704962);
    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->HZ($openCode,$gameId,$win); //和值
        $this->SLH($openCode,$gameId,$win); //三连号
        $this->STH($openCode,$gameId,$win); //三同号
        $this->ETH($openCode,$gameId,$win); //二同号
        $this->KD($openCode,$gameId,$win); //跨度
        $this->PD($openCode,$gameId,$win); //牌点
        $this->BUCHU($openCode,$gameId,$win); //不出号码
        $this->BICHU($openCode,$gameId,$win); //必出号码
        $table = 'game_gzk3';
        $gameName = '贵州快3';
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
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
        }
    }

    public function HZ($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 270;
        $HZ = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $TS = 0;

        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && (int)$arrOpenCode[0] == (int)$arrOpenCode[2]){ //通杀
            $TS = 1;
        }
        if($HZ >= 11 && $HZ <= 18 && $TS == 0){ //大
            $playId = 4946;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ >= 3 && $HZ <= 10 && $TS == 0){ //小
            $playId = 4945;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ%2 == 0){ //双
            $playId = 4943;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 4944;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        $HZDS_arr = [3=>4962,4=>4961,5=>4960,6=>4959,7=>4958,8=>4957,9=>4956,10=>4955,11=>4954,12=>4953,13=>4952,14=>4951,15=>4950,16=>4949,17=>4948,18=>4947];
        foreach ($HZDS_arr as $k => $v){
            if($HZ == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    public function SLH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 271;
        $SLH_TX = 0;
        $SLH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $SLH_arr = [
            '123' => 4942,
            '234' => 4941,
            '345' => 4940,
            '456' => 4939,
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
            $playId = 4938;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function STH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 272;
        $STH_TX = 0;
        $STH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $STH_arr = [
            '111' => 4937,
            '222' => 4936,
            '333' => 4935,
            '444' => 4934,
            '555' => 4933,
            '666' => 4932,
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
            $playId = 4931;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function ETH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 273;
        $isBaoZi = 0;
        $ETH_arr = [
            1 => 4930,
            2 => 4929,
            3 => 4928,
            4 => 4927,
            5 => 4926,
            6 => 4925,
        ];
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && (int)$arrOpenCode[0] == (int)$arrOpenCode[2]){
            $isBaoZi = 1;
        }
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && $isBaoZi == 0){
            foreach ($ETH_arr as $k => $v){
                if((int)$arrOpenCode[0] == $k){
                    $playId = $v;
                    $winCode = $gameId.$playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
        if((int)$arrOpenCode[1] == (int)$arrOpenCode[2] && $isBaoZi == 0){
            foreach ($ETH_arr as $k => $v){
                if((int)$arrOpenCode[1] == $k){
                    $playId = $v;
                    $winCode = $gameId.$playCate.$playId;
                    $win->push($winCode);
                }
            }
        }
    }

    public function KD($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 274;

        $KD_NUM = (int)$arrOpenCode[2] - (int)$arrOpenCode[0];
        $KD_DX_arr = [0 => 4917, 1 => 4917, 2 => 4917, 3 => 4918, 4 => 4918, 5 => 4918];
        $KD_DS_arr = [0 => 4915, 1 => 4916, 2 => 4915, 3 => 4916, 4 => 4915, 5 => 4916];
        $KD_KDZ_arr = [0 => 4924, 1 => 4923, 2 => 4922, 3 => 4921, 4 => 4920, 5 => 4919];
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

    public function PD($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 275;
        $PD_NUM = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $PD_GEWEI = $PD_NUM % 10;
        $PD_DX_arr = [0 => 4904, 6 => 4904, 7 => 4904, 8 => 4904, 9 => 4904, 1 => 4903, 2 => 4903, 3 => 4903, 4 => 4903, 5 => 4903];
        $PD_PDZ_arr = [1 => 4914, 2 => 4913, 3 => 4912, 4 => 4911, 5 => 4910, 6 => 4909, 7 => 4908, 8 => 4907, 9 => 4906, 0 => 4905];
        foreach ($PD_DX_arr as $k => $v){
            if($PD_GEWEI == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($PD_GEWEI%2 == 0){
            $playId = 4901;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4902;
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

    public function BUCHU($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 276;
        $BUCHU_arr = [
            1 => 4900,
            2 => 4899,
            3 => 4898,
            4 => 4897,
            5 => 4896,
            6 => 4895
        ];
        foreach ($BUCHU_arr as $k => $v){
            if(!in_array($k,$arrOpenCode)){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
    }

    public function BICHU($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 277;
        $BICHU_arr = [
            1 => 4894,
            2 => 4893,
            3 => 4892,
            4 => 4891,
            5 => 4890,
            6 => 4889
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