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

class New_Hebeik3 extends Excel
{
    protected $arrPlay_id = array(152614741,152614742,152614743,152614744,152614745,152614746,152604747,152604748,152604749,152604750,152604751,152604752,152594753,152594754,152594755,152594756,152594757,152594758,152594759,152594760,152594761,152594762,152594763,152594764,152594765,152594766,152584767,152584768,152584769,152584770,152584771,152584772,152584773,152584774,152584775,152584776,152574777,152574778,152574779,152574780,152574781,152574782,152564783,152564784,152564785,152564786,152564787,152564788,152564789,152554790,152554791,152554792,152554793,152554794,152544795,152544796,152544797,152544798,152544799,152544800,152544801,152544802,152544803,152544804,152544805,152544806,152544807,152544808,152544809,152544810,152544811,152544812,152544813,152544814);
    protected $arrPlayCate = array(
        'HZ' =>254,
        'SLH' =>255,
        'STH' =>256,
        'ETH' =>257,
        'KD' =>258,
        'PD' =>259,
        'BUCHM' =>260,
        'BICHM' =>261,
    );
    protected $arrPlayId = array(
        'BICHUHAOMA6' => 4741,
        'BICHUHAOMA5' => 4742,
        'BICHUHAOMA4' => 4743,
        'BICHUHAOMA3' => 4744,
        'BICHUHAOMA2' => 4745,
        'BICHUHAOMA1' => 4746,
        'BUCHUHAOMA6' => 4747,
        'BUCHUHAOMA5' => 4748,
        'BUCHUHAOMA4' => 4749,
        'BUCHUHAOMA3' => 4750,
        'BUCHUHAOMA2' => 4751,
        'BUCHUHAOMA1' => 4752,
        'PAIDIANSHUANG' => 4753,
        'PAIDIANDAN' => 4754,
        'PAIDIANXIAO' => 4755,
        'PAIDIANDA' => 4756,
        'PAIDIAN10' => 4757,
        'PAIDIAN9' => 4758,
        'PAIDIAN8' => 4759,
        'PAIDIAN7' => 4760,
        'PAIDIAN6' => 4761,
        'PAIDIAN5' => 4762,
        'PAIDIAN4' => 4763,
        'PAIDIAN3' => 4764,
        'PAIDIAN2' => 4765,
        'PAIDIAN1' => 4766,
        'KUADUSHUANG' => 4767,
        'KUADUDAN' => 4768,
        'KUADUXIAO' => 4769,
        'KUADUDA' => 4770,
        'KUADU5' => 4771,
        'KUADU4' => 4772,
        'KUADU3' => 4773,
        'KUADU2' => 4774,
        'KUADU1' => 4775,
        'KUADU0' => 4776,
        'ERTONGHAO66' => 4777,
        'ERTONGHAO55' => 4778,
        'ERTONGHAO44' => 4779,
        'ERTONGHAO33' => 4780,
        'ERTONGHAO22' => 4781,
        'ERTONGHAO11' => 4782,
        'SANTONGTONGXUAN' => 4783,
        'SANTONGHAO666' => 4784,
        'SANTONGHAO555' => 4785,
        'SANTONGHAO444' => 4786,
        'SANTONGHAO333' => 4787,
        'SANTONGHAO222' => 4788,
        'SANTONGHAO111' => 4789,
        'SANLIANTONGXUAN' => 4790,
        'SANLIANHAO456' => 4791,
        'SANLIANHAO345' => 4792,
        'SANLIANHAO234' => 4793,
        'SANLIANHAO123' => 4794,
        'HEZHISHUANG' => 4795,
        'HEZHIDAN' => 4796,
        'HEZHIXIAO' => 4797,
        'HEZHIDA' => 4798,
        'HEZHI18' => 4799,
        'HEZHI17' => 4800,
        'HEZHI16' => 4801,
        'HEZHI15' => 4802,
        'HEZHI14' => 4803,
        'HEZHI13' => 4804,
        'HEZHI12' => 4805,
        'HEZHI11' => 4806,
        'HEZHI10' => 4807,
        'HEZHI9' => 4808,
        'HEZHI8' => 4809,
        'HEZHI7' => 4810,
        'HEZHI6' => 4811,
        'HEZHI5' => 4812,
        'HEZHI4' => 4813,
        'HEZHI3' => 4814,
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
        $table = 'game_hebeik3';
        $gameName = '河北快3';
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
                        \Log::info($gameName.$issue.'退水中失败！');
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