<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/27
 * Time: 下午9:49
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryK3;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Gxk3 extends Excel
{
    protected $arrPlay_id = array(122454427,122454428,122454429,122454430,122454431,122454432,122444433,122444434,122444435,122444436,122444437,122444438,122434439,122434440,122434441,122434442,122434443,122434444,122434445,122434446,122434447,122434448,122434449,122434450,122434451,122434452,122424453,122424454,122424455,122424456,122424457,122424458,122424459,122424460,122424461,122424462,122414463,122414464,122414465,122414466,122414467,122414468,122404469,122404470,122404471,122404472,122404473,122404474,122404475,122394476,122394477,122394478,122394479,122394480,122384481,122384482,122384483,122384484,122384485,122384486,122384487,122384488,122384489,122384490,122384491,122384492,122384493,122384494,122384495,122384496,122384497,122384498,122384499,122384500);
    protected $arrPlayCate = array(
        'HZ' =>238,
        'SLH' =>239,
        'STH' =>240,
        'ETH' =>241,
        'KD' =>242,
        'PD' =>243,
        'BUCHM' =>244,
        'BICHM' =>245,
    );
    protected $arrPlayId = array(
        'BICHUHAOMA6' => 4427,
        'BICHUHAOMA5' => 4428,
        'BICHUHAOMA4' => 4429,
        'BICHUHAOMA3' => 4430,
        'BICHUHAOMA2' => 4431,
        'BICHUHAOMA1' => 4432,
        'BUCHUHAOMA6' => 4433,
        'BUCHUHAOMA5' => 4434,
        'BUCHUHAOMA4' => 4435,
        'BUCHUHAOMA3' => 4436,
        'BUCHUHAOMA2' => 4437,
        'BUCHUHAOMA1' => 4438,
        'PAIDIANSHUANG' => 4439,
        'PAIDIANDAN' => 4440,
        'PAIDIANXIAO' => 4441,
        'PAIDIANDA' => 4442,
        'PAIDIAN10' => 4443,
        'PAIDIAN9' => 4444,
        'PAIDIAN8' => 4445,
        'PAIDIAN7' => 4446,
        'PAIDIAN6' => 4447,
        'PAIDIAN5' => 4448,
        'PAIDIAN4' => 4449,
        'PAIDIAN3' => 4450,
        'PAIDIAN2' => 4451,
        'PAIDIAN1' => 4452,
        'KUADUSHUANG' => 4453,
        'KUADUDAN' => 4454,
        'KUADUXIAO' => 4455,
        'KUADUDA' => 4456,
        'KUADU5' => 4457,
        'KUADU4' => 4458,
        'KUADU3' => 4459,
        'KUADU2' => 4460,
        'KUADU1' => 4461,
        'KUADU0' => 4462,
        'ERTONGHAO66' => 4463,
        'ERTONGHAO55' => 4464,
        'ERTONGHAO44' => 4465,
        'ERTONGHAO33' => 4466,
        'ERTONGHAO22' => 4467,
        'ERTONGHAO11' => 4468,
        'SANTONGTONGXUAN' => 4469,
        'SANTONGHAO666' => 4470,
        'SANTONGHAO555' => 4471,
        'SANTONGHAO444' => 4472,
        'SANTONGHAO333' => 4473,
        'SANTONGHAO222' => 4474,
        'SANTONGHAO111' => 4475,
        'SANLIANTONGXUAN' => 4476,
        'SANLIANHAO456' => 4477,
        'SANLIANHAO345' => 4478,
        'SANLIANHAO234' => 4479,
        'SANLIANHAO123' => 4480,
        'HEZHISHUANG' => 4481,
        'HEZHIDAN' => 4482,
        'HEZHIXIAO' => 4483,
        'HEZHIDA' => 4484,
        'HEZHI18' => 4485,
        'HEZHI17' => 4486,
        'HEZHI16' => 4487,
        'HEZHI15' => 4488,
        'HEZHI14' => 4489,
        'HEZHI13' => 4490,
        'HEZHI12' => 4491,
        'HEZHI11' => 4492,
        'HEZHI10' => 4493,
        'HEZHI9' => 4494,
        'HEZHI8' => 4495,
        'HEZHI7' => 4496,
        'HEZHI6' => 4497,
        'HEZHI5' => 4498,
        'HEZHI4' => 4499,
        'HEZHI3' => 4500,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $K3 = new ExcelLotteryK3();
        $K3->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $K3->HZ($gameId,$win); //和值
        $K3->SLH($gameId,$win); //三连号
        $K3->STH($gameId,$win); //三同号
        $K3->ETH($gameId,$win); //二同号
        $K3->KD($gameId,$win); //跨度
        $K3->PD($gameId,$win); //牌点
        $K3->BUCHU($openCode,$gameId,$win); //不出号码
        $K3->BICHU($openCode,$gameId,$win); //必出号码
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_gxk3';
        $gameName = '广西快3';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $win = $this->exc_play($openCode,$gameId);
            $bunko = $this->bunko($win,$gameId,$issue,false,$this->arrPlay_id,true);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
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
            //玩法退水
            if(env('AGENT_MODEL',1) == 1) {
                $res = DB::table($table)->where('id',$id)->where('returnwater',0)->update(['returnwater' => 2]);
                if(!$res){
                    writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                    return 0;
                }
                //退水
                $res = $this->reBackUser($gameId, $issue, $gameName);
                if(!$res){
                    $res = DB::table($table)->where('id',$id)->where('returnwater',2)->update(['returnwater' => 1]);
                    if(empty($res)){
                        writeLog('New_Bet',$gameName.$issue.'退水中失败！');
                        return 0;
                    }
                }else
                    writeLog('New_Bet', $gameName . $issue . "退水前失败！");
            }else{//代理退水
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }
}