<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/27
 * Time: 下午9:48
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryK3;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Gsk3 extends Excel
{
    protected $arrPlay_id = array(162694815,162694816,162694817,162694818,162694819,162694820,162684821,162684822,162684823,162684824,162684825,162684826,162674827,162674828,162674829,162674830,162674831,162674832,162674833,162674834,162674835,162674836,162674837,162674838,162674839,162674840,162664841,162664842,162664843,162664844,162664845,162664846,162664847,162664848,162664849,162664850,162654851,162654852,162654853,162654854,162654855,162654856,162644857,162644858,162644859,162644860,162644861,162644862,162644863,162634864,162634865,162634866,162634867,162634868,162624869,162624870,162624871,162624872,162624873,162624874,162624875,162624876,162624877,162624878,162624879,162624880,162624881,162624882,162624883,162624884,162624885,162624886,162624887,162624888);
    protected $arrPlayCate = array(
        'HZ' =>262,
        'SLH' =>263,
        'STH' =>264,
        'ETH' =>265,
        'KD' =>266,
        'PD' =>267,
        'BUCHM' =>268,
        'BICHM' =>269,
    );
    protected $arrPlayId = array(
        'BICHUHAOMA6' => 4815,
        'BICHUHAOMA5' => 4816,
        'BICHUHAOMA4' => 4817,
        'BICHUHAOMA3' => 4818,
        'BICHUHAOMA2' => 4819,
        'BICHUHAOMA1' => 4820,
        'BUCHUHAOMA6' => 4821,
        'BUCHUHAOMA5' => 4822,
        'BUCHUHAOMA4' => 4823,
        'BUCHUHAOMA3' => 4824,
        'BUCHUHAOMA2' => 4825,
        'BUCHUHAOMA1' => 4826,
        'PAIDIANSHUANG' => 4827,
        'PAIDIANDAN' => 4828,
        'PAIDIANXIAO' => 4829,
        'PAIDIANDA' => 4830,
        'PAIDIAN10' => 4831,
        'PAIDIAN9' => 4832,
        'PAIDIAN8' => 4833,
        'PAIDIAN7' => 4834,
        'PAIDIAN6' => 4835,
        'PAIDIAN5' => 4836,
        'PAIDIAN4' => 4837,
        'PAIDIAN3' => 4838,
        'PAIDIAN2' => 4839,
        'PAIDIAN1' => 4840,
        'KUADUSHUANG' => 4841,
        'KUADUDAN' => 4842,
        'KUADUXIAO' => 4843,
        'KUADUDA' => 4844,
        'KUADU5' => 4845,
        'KUADU4' => 4846,
        'KUADU3' => 4847,
        'KUADU2' => 4848,
        'KUADU1' => 4849,
        'KUADU0' => 4850,
        'ERTONGHAO66' => 4851,
        'ERTONGHAO55' => 4852,
        'ERTONGHAO44' => 4853,
        'ERTONGHAO33' => 4854,
        'ERTONGHAO22' => 4855,
        'ERTONGHAO11' => 4856,
        'SANTONGTONGXUAN' => 4857,
        'SANTONGHAO666' => 4858,
        'SANTONGHAO555' => 4859,
        'SANTONGHAO444' => 4860,
        'SANTONGHAO333' => 4861,
        'SANTONGHAO222' => 4862,
        'SANTONGHAO111' => 4863,
        'SANLIANTONGXUAN' => 4864,
        'SANLIANHAO456' => 4865,
        'SANLIANHAO345' => 4866,
        'SANLIANHAO234' => 4867,
        'SANLIANHAO123' => 4868,
        'HEZHISHUANG' => 4869,
        'HEZHIDAN' => 4870,
        'HEZHIXIAO' => 4871,
        'HEZHIDA' => 4872,
        'HEZHI18' => 4873,
        'HEZHI17' => 4874,
        'HEZHI16' => 4875,
        'HEZHI15' => 4876,
        'HEZHI14' => 4877,
        'HEZHI13' => 4878,
        'HEZHI12' => 4879,
        'HEZHI11' => 4880,
        'HEZHI10' => 4881,
        'HEZHI9' => 4882,
        'HEZHI8' => 4883,
        'HEZHI7' => 4884,
        'HEZHI6' => 4885,
        'HEZHI5' => 4886,
        'HEZHI4' => 4887,
        'HEZHI3' => 4888,
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
        $table = 'game_gsk3';
        $gameName = '甘肃快3';
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