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

class New_Ksssc extends Excel
{
    protected $arrPlay_id = array(8033375502,8033375503,8033375504,8033375505,8033375506,8033375507,8033375508,8033385509,8033385510,8033385511,8033385512,8033385513,8033385514,8033385515,8033385516,8033385517,8033385518,8033385519,8033385520,8033385521,8033385522,8033395523,8033395524,8033395525,8033395526,8033395527,8033395528,8033395529,8033395530,8033395531,8033395532,8033395533,8033395534,8033395535,8033395536,8033405537,8033405538,8033405539,8033405540,8033405541,8033405542,8033405543,8033405544,8033405545,8033405546,8033405547,8033405548,8033405549,8033405550,8033415551,8033415552,8033415553,8033415554,8033415555,8033415556,8033415557,8033415558,8033415559,8033415560,8033415561,8033415562,8033415563,8033415564,8033425565,8033425566,8033425567,8033425568,8033425569,8033425570,8033425571,8033425572,8033425573,8033425574,8033425575,8033425576,8033425577,8033425578,8033435579,8033435580,8033435581,8033435582,8033435583,8033445584,8033445585,8033445586,8033445587,8033445588,8033455589,8033455590,8033455591,8033455592,8033455593);
    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $this->NUM1($openCode,$gameId,$win);
        $this->NUM2($openCode,$gameId,$win);
        $this->NUM3($openCode,$gameId,$win);
        $this->NUM4($openCode,$gameId,$win);
        $this->NUM5($openCode,$gameId,$win);
        $this->NUM1_DXDS($openCode,$gameId,$win);
        $this->NUM2_DXDS($openCode,$gameId,$win);
        $this->NUM3_DXDS($openCode,$gameId,$win);
        $this->NUM4_DXDS($openCode,$gameId,$win);
        $this->NUM5_DXDS($openCode,$gameId,$win);
        $this->ZHDXDS($openCode,$gameId,$win);
        $this->QIANSAN($openCode,$gameId,$win);
        $this->ZHONGSAN($openCode,$gameId,$win);
        $this->HOUSAN($openCode,$gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_ksssc';
        $gameName = '快速时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'ksssc killing...');
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

    private function QIANSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 343;
        $zaliu = 0;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 5579;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5580;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5580;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5580;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5582;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 5581;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 5582;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 5582;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 5582;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 5582;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 5582;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 5582;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 5583;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHONGSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 344;
        $zaliu = 0;
        $num1 = $arrOpenCode[1];
        $num2 = $arrOpenCode[2];
        $num3 = $arrOpenCode[3];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 5584;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5585;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5585;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5585;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5587;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 5586;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 5587;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 5587;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 5587;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 5587;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 5587;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 5587;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 5588;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function HOUSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 345;
        $zaliu = 0;
        $num1 = $arrOpenCode[2];
        $num2 = $arrOpenCode[3];
        $num3 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 5589;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5590;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5590;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5590;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5592;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 5591;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 5592;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 5592;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 5592;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 5592;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 5592;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 5592;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 5593;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHDXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 337;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        $num_total = $num1+$num2+$num3+$num4+$num5;
        if($num_total >= 23){ //总和大
            $playId = 5502;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total <= 22){ //总和小
            $playId = 5503;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total%2 == 0){ //总和双
            $playId = 5505;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = 5504;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num5){ //龙
            $playId = 5506;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($num1 < $num5){ //虎
            $playId = 5507;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($num1 == $num5) { //和
            $playId = 5508;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 338;
        $num = $arrOpenCode[0];
        //大小
        if($num >= 5){
            $playId = 5519;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5520;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5522;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5521;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM2_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 339;
        $num = $arrOpenCode[1];
        //大小
        if($num >= 5){
            $playId = 5533;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5534;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5536;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5535;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM3_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 340;
        $num = $arrOpenCode[2];
        //大小
        if($num >= 5){
            $playId = 5547;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5548;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5550;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5549;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM4_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 341;
        $num = $arrOpenCode[3];
        //大小
        if($num >= 5){
            $playId = 5561;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5562;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5564;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5563;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM5_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 342;
        $num = $arrOpenCode[4];
        //大小
        if($num >= 5){
            $playId = 5575;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5576;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5578;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5577;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 338;
        $num = $arrOpenCode[0];
        switch ($num){
            case 0:
                $play_id = 5509;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 5510;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5511;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5512;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5513;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5514;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5515;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5516;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5517;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5518;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM2($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 339;
        $num = $arrOpenCode[1];
        switch ($num){
            case 0:
                $play_id = 5523;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 5524;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5525;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5526;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5527;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5528;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5529;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5530;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5531;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5532;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM3($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 340;
        $num = $arrOpenCode[2];
        switch ($num){
            case 0:
                $play_id = 5537;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 5538;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5539;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5540;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5541;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5542;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5543;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5544;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5545;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5546;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM4($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 341;
        $num = $arrOpenCode[3];
        switch ($num){
            case 0:
                $play_id = 5551;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 5552;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5553;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5554;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5555;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5556;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5557;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5558;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5559;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5560;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function NUM5($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 342;
        $num = $arrOpenCode[4];
        switch ($num){
            case 0:
                $play_id = 5565;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 5566;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 5567;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 5568;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 5569;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 5570;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 5571;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 5572;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 5573;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 5574;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }
}
