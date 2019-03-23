<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/8/3
 * Time: 上午2:58
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Msjsk3 extends Excel
{
    protected $arrPlay_id = array(862464575,862464576,862464577,862464578,862464579,862464580,862464581,862464582,862464583,862464584,862464585,862464586,862464587,862464588,862464589,862464590,862464591,862464592,862464593,862464594,862474595,862474596,862474597,862474598,862474599,862484600,862484601,862484602,862484603,862484604,862484605,862484606,862494607,862494608,862494609,862494610,862494611,862494612,862504613,862504614,862504615,862504616,862504617,862504618,862504619,862504620,862504621,862504622,862514623,862514624,862514625,862514626,862514627,862514628,862514629,862514630,862514631,862514632,862514633,862514634,862514635,862514636,862524637,862524638,862524639,862524640,862524641,862524642,862534643,862534644,862534645,862534646,862534647,862534648);
    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $this->HZ($openCode,$gameId,$win); //和值
        $this->SLH($openCode,$gameId,$win); //三连号
        $this->STH($openCode,$gameId,$win); //三同号
        $this->ETH($openCode,$gameId,$win); //二同号
        $this->KD($openCode,$gameId,$win); //跨度
        $this->PD($openCode,$gameId,$win); //牌点
        $this->BUCHU($openCode,$gameId,$win); //不出号码
        $this->BICHU($openCode,$gameId,$win); //必出号码
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_msjsk3';
        $gameName = '秒速快3';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'msjsk3 killing...');
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

    public function HZ($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 246;
        $HZ = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $TS = 0;

        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && (int)$arrOpenCode[0] == (int)$arrOpenCode[2]){ //通杀
            $TS = 1;
        }
        if($HZ >= 11 && $HZ <= 18 && $TS == 0){ //大
            $playId = 4591;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ >= 3 && $HZ <= 10 && $TS == 0){ //小
            $playId = 4592;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ%2 == 0){ //双
            $playId = 4594;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 4593;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        $HZDS_arr = [3=>4575,4=>4576,5=>4577,6=>4578,7=>4579,8=>4580,9=>4581,10=>4582,11=>4583,12=>4584,13=>4585,14=>4586,15=>4587,16=>4588,17=>4589,18=>4590];
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
        $playCate = 247;
        $SLH_TX = 0;
        $SLH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $SLH_arr = [
            '123' => 4595,
            '234' => 4596,
            '345' => 4597,
            '456' => 4598,
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
            $playId = 4599;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function STH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 248;
        $STH_TX = 0;
        $STH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $STH_arr = [
            '111' => 4600,
            '222' => 4601,
            '333' => 4602,
            '444' => 4603,
            '555' => 4604,
            '666' => 4605,
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
            $playId = 4606;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function ETH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 249;
        $isBaoZi = 0;
        $ETH_arr = [
            1 => 4607,
            2 => 4608,
            3 => 4609,
            4 => 4610,
            5 => 4611,
            6 => 4612,
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
        $playCate = 250;

        $KD_NUM = (int)$arrOpenCode[2] - (int)$arrOpenCode[0];
        $KD_DX_arr = [0 => 4620, 1 => 4620, 2 => 4620, 3 => 4619, 4 => 4619, 5 => 4619];
        $KD_DS_arr = [0 => 4622, 1 => 4621, 2 => 4622, 3 => 4621, 4 => 4622, 5 => 4621];
        $KD_KDZ_arr = [0 => 4613, 1 => 4614, 2 => 4615, 3 => 4616, 4 => 4617, 5 => 4618];
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
        $playCate = 251;
        $PD_NUM = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $PD_GEWEI = $PD_NUM % 10;
        $PD_DX_arr = [0 => 4633, 6 => 4633, 7 => 4633, 8 => 4633, 9 => 4633, 1 => 4634, 2 => 4634, 3 => 4634, 4 => 4634, 5 => 4634];
        $PD_PDZ_arr = [1 => 4623, 2 => 4624, 3 => 4625, 4 => 4626, 5 => 4627, 6 => 4628, 7 => 4629, 8 => 4630, 9 => 4631, 0 => 4632];
        foreach ($PD_DX_arr as $k => $v){
            if($PD_GEWEI == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($PD_GEWEI%2 == 0){
            $playId = 4636;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4635;
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
        $playCate = 252;
        $BUCHU_arr = [
            1 => 4637,
            2 => 4638,
            3 => 4639,
            4 => 4640,
            5 => 4641,
            6 => 4642
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
        $playCate = 253;
        $BICHU_arr = [
            1 => 4643,
            2 => 4644,
            3 => 4645,
            4 => 4646,
            5 => 4647,
            6 => 4648
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