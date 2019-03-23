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

class New_Jsk3 extends Excel
{
    protected $arrPlay_id = array(102144279,102144280,102144281,102144282,102144283,102144284,102144285,102144286,102144287,102144288,102144289,102144290,102144291,102144292,102144293,102144294,102144295,102144296,102144297,102144298,102154299,102154300,102154301,102154302,102154303,102164304,102164305,102164306,102164307,102164308,102164309,102164310,102174311,102174312,102174313,102174314,102174315,102174316,102184317,102184318,102184319,102184320,102184321,102184322,102184323,102184324,102184325,102184326,102194327,102194328,102194329,102194330,102194331,102194332,102194333,102194334,102194335,102194336,102194337,102194338,102194339,102194340,102204341,102204342,102204343,102204344,102204345,102204346,102214347,102214348,102214349,102214350,102214351,102214352);
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
        $table = 'game_jsk3';
        $gameName = '江苏快3';
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
        $playCate = 214;
        $HZ = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $TS = 0;

        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && (int)$arrOpenCode[0] == (int)$arrOpenCode[2]){ //通杀
            $TS = 1;
        }
        if($HZ >= 11 && $HZ <= 18 && $TS == 0){ //大
            $playId = 4295;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ >= 3 && $HZ <= 10 && $TS == 0){ //小
            $playId = 4296;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($HZ%2 == 0){ //双
            $playId = 4298;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 4297;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        $HZDS_arr = [3=>4279,4=>4280,5=>4281,6=>4282,7=>4283,8=>4284,9=>4285,10=>4286,11=>4287,12=>4288,13=>4289,14=>4290,15=>4291,16=>4292,17=>4293,18=>4294];
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
        $playCate = 215;
        $SLH_TX = 0;
        $SLH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $SLH_arr = [
            '123' => 4299,
            '234' => 4300,
            '345' => 4301,
            '456' => 4302,
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
            $playId = 4303;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function STH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 216;
        $STH_TX = 0;
        $STH_string = $arrOpenCode[0].$arrOpenCode[1].$arrOpenCode[2];
        $STH_arr = [
            '111' => 4304,
            '222' => 4305,
            '333' => 4306,
            '444' => 4307,
            '555' => 4308,
            '666' => 4309,
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
            $playId = 4310;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    public function ETH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 217;
        $isBaoZi = 0;
        $ETH_arr = [
            1 => 4311,
            2 => 4312,
            3 => 4313,
            4 => 4314,
            5 => 4315,
            6 => 4316,
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
        $playCate = 218;

        $KD_NUM = (int)$arrOpenCode[2] - (int)$arrOpenCode[0];
        $KD_DX_arr = [0 => 4324, 1 => 4324, 2 => 4324, 3 => 4323, 4 => 4323, 5 => 4323];
        $KD_DS_arr = [0 => 4326, 1 => 4325, 2 => 4326, 3 => 4325, 4 => 4326, 5 => 4325];
        $KD_KDZ_arr = [0 => 4317, 1 => 4318, 2 => 4319, 3 => 4320, 4 => 4321, 5 => 4322];
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
        $playCate = 219;
        $PD_NUM = (int)$arrOpenCode[0] + (int)$arrOpenCode[1] + (int)$arrOpenCode[2];
        $PD_GEWEI = $PD_NUM % 10;
        $PD_DX_arr = [0 => 4337, 6 => 4337, 7 => 4337, 8 => 4337, 9 => 4337, 1 => 4338, 2 => 4338, 3 => 4338, 4 => 4338, 5 => 4338];
        $PD_PDZ_arr = [1 => 4327, 2 => 4328, 3 => 4329, 4 => 4330, 5 => 4331, 6 => 4332, 7 => 4333, 8 => 4334, 9 => 4335, 0 => 4336];
        foreach ($PD_DX_arr as $k => $v){
            if($PD_GEWEI == $k){
                $playId = $v;
                $winCode = $gameId.$playCate.$playId;
                $win->push($winCode);
            }
        }
        if($PD_GEWEI%2 == 0){
            $playId = 4340;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 4339;
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
        $playCate = 220;
        $BUCHU_arr = [
            1 => 4341,
            2 => 4342,
            3 => 4343,
            4 => 4344,
            5 => 4345,
            6 => 4346
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
        $playCate = 221;
        $BICHU_arr = [
            1 => 4347,
            2 => 4348,
            3 => 4349,
            4 => 4350,
            5 => 4351,
            6 => 4352
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