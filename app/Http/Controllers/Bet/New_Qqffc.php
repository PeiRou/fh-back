<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/4
 * Time: 下午11:57
 */

namespace App\Http\Controllers\Bet;


use App\Excel;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Qqffc extends Excel
{
    protected $arrPlay_id = array(1132874963,1132874964,1132874965,1132874966,1132874967,1132874968,1132874969,1132884970,1132884971,1132884972,1132884973,1132884974,1132884975,1132884976,1132884977,1132884978,1132884979,1132884980,1132884981,1132884982,1132884983,1132894984,1132894985,1132894986,1132894987,1132894988,1132894989,1132894990,1132894991,1132894992,1132894993,1132894994,1132894995,1132894996,1132894997,1132904998,1132904999,1132905000,1132905001,1132905002,1132905003,1132905004,1132905005,1132905006,1132905007,1132905008,1132905009,1132905010,1132905011,1132915012,1132915013,1132915014,1132915015,1132915016,1132915017,1132915018,1132915019,1132915020,1132915021,1132915022,1132915023,1132915024,1132915025,1132925026,1132925027,1132925028,1132925029,1132925030,1132925031,1132925032,1132925033,1132925034,1132925035,1132925036,1132925037,1132925038,1132925039,1132935040,1132935041,1132935042,1132935043,1132935044,1132945045,1132945046,1132945047,1132945048,1132945049,1132955050,1132955051,1132955052,1132955053,1132955054);
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
        $table = 'game_qqffc';
        $gameName = 'QQ分分彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Bet', 'qqffc killing...');
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

    private function QIANSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 293;
        $zaliu = 0;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 5040;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5041;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5041;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5041;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5043;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 5042;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 5043;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 5043;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 5043;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 5043;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 5043;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 5043;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 5044;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHONGSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 294;
        $zaliu = 0;
        $num1 = $arrOpenCode[1];
        $num2 = $arrOpenCode[2];
        $num3 = $arrOpenCode[3];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 5045;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5046;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5046;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5046;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5048;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 5047;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 5048;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 5048;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 5048;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 5048;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 5048;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 5048;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 5049;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function HOUSAN($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 295;
        $zaliu = 0;
        $num1 = $arrOpenCode[2];
        $num2 = $arrOpenCode[3];
        $num3 = $arrOpenCode[4];
        if($num1 == $num2 && $num2 == $num3){ //豹子
            $zaliu = 1;
            $playId = 5050;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //顺子
        $arr = [$num1,$num2,$num3];
        sort($arr);
        if($arr[0] == 0 && $arr[1] == 1 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5051;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[0] == 0 && $arr[1] == 8 && $arr[2] == 9){
            $zaliu = 1;
            $playId = 5051;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5051;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //半顺
        if($arr[1] - $arr[0] == 1 && $arr[2] - $arr[1] !== 1 || $arr[1] - $arr[0] !== 1 && $arr[2] - $arr[1] == 1){
            $zaliu = 1;
            $playId = 5053;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //对子
        if($arr[0] == $arr[1] || $arr[1] == $arr[2]){
            if($arr[0] !== $arr[2]){
                $zaliu = 1;
                $playId = 5052;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        $toString = (string)$arr[0].$arr[1].$arr[2];
        switch ($toString){
            case '029':
                $zaliu = 1;
                $playId = 5053;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '039':
                $zaliu = 1;
                $playId = 5053;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '049':
                $zaliu = 1;
                $playId = 5053;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '059':
                $zaliu = 1;
                $playId = 5053;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '069':
                $zaliu = 1;
                $playId = 5053;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case '079':
                $zaliu = 1;
                $playId = 5053;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
        //杂六
        if($zaliu == 0){
            $playId = 5054;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZHDXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 287;
        $num1 = $arrOpenCode[0];
        $num2 = $arrOpenCode[1];
        $num3 = $arrOpenCode[2];
        $num4 = $arrOpenCode[3];
        $num5 = $arrOpenCode[4];
        $num_total = $num1+$num2+$num3+$num4+$num5;
        if($num_total >= 23){ //总和大
            $playId = 4963;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total <= 22){ //总和小
            $playId = 4964;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num_total%2 == 0){ //总和双
            $playId = 4966;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和单
            $playId = 4965;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num1 > $num5){ //龙
            $playId = 4967;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($num1 < $num5){ //虎
            $playId = 4968;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else if($num1 == $num5) { //和
            $playId = 4969;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 288;
        $num = $arrOpenCode[0];
        //大小
        if($num >= 5){
            $playId = 4980;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 4981;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 4983;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4982;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM2_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 289;
        $num = $arrOpenCode[1];
        //大小
        if($num >= 5){
            $playId = 4994;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 4995;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 4997;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4996;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM3_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 290;
        $num = $arrOpenCode[2];
        //大小
        if($num >= 5){
            $playId = 5008;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5009;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5011;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5010;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM4_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 291;
        $num = $arrOpenCode[3];
        //大小
        if($num >= 5){
            $playId = 5022;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5023;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5025;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5024;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM5_DXDS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 292;
        $num = $arrOpenCode[4];
        //大小
        if($num >= 5){
            $playId = 5036;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($num <= 4){
            $playId = 5037;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //单双
        if($num%2 == 0){ //双
            $playId = 5039;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 5038;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function NUM1($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 288;
        $num = $arrOpenCode[0];
        switch ($num){
            case 0:
                $playId = 4970;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 1:
                $playId = 4971;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 4972;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 4973;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 4974;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 4975;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 4976;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 4977;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 4978;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 4979;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
    }

    private function NUM2($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 289;
        $num = $arrOpenCode[1];
        switch ($num){
            case 0:
                $playId = 4984;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 1:
                $playId = 4985;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 4986;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 4987;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 4988;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 4989;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 4990;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 4991;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 4992;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 4993;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
    }

    private function NUM3($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 290;
        $num = $arrOpenCode[2];
        switch ($num){
            case 0:
                $playId = 4998;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 1:
                $playId = 4999;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 5000;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 5001;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 5002;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 5003;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 5004;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 5005;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 5006;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 5007;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
    }

    private function NUM4($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 291;
        $num = $arrOpenCode[3];
        switch ($num){
            case 0:
                $playId = 5012;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 1:
                $playId = 5013;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 5014;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 5015;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 5016;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 5017;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 5018;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 5019;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 5020;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 5021;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
    }

    private function NUM5($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 292;
        $num = $arrOpenCode[4];
        switch ($num){
            case 0:
                $playId = 5026;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 1:
                $playId = 5027;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 5028;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 5029;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 5030;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 5031;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 5032;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 5033;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 5034;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 5035;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
                break;
        }
    }
}
