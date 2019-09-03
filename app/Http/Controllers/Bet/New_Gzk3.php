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

class New_Gzk3 extends Excel
{
    protected $arrPlay_id = array(182774889,182774890,182774891,182774892,182774893,182774894,182764895,182764896,182764897,182764898,182764899,182764900,182754901,182754902,182754903,182754904,182754905,182754906,182754907,182754908,182754909,182754910,182754911,182754912,182754913,182754914,182744915,182744916,182744917,182744918,182744919,182744920,182744921,182744922,182744923,182744924,182734925,182734926,182734927,182734928,182734929,182734930,182724931,182724932,182724933,182724934,182724935,182724936,182724937,182714938,182714939,182714940,182714941,182714942,182704943,182704944,182704945,182704946,182704947,182704948,182704949,182704950,182704951,182704952,182704953,182704954,182704955,182704956,182704957,182704958,182704959,182704960,182704961,182704962);
    protected $arrPlayCate = array(
        'HZ' =>270,
        'SLH' =>271,
        'STH' =>272,
        'ETH' =>273,
        'KD' =>274,
        'PD' =>275,
        'BUCHM' =>276,
        'BICHM' =>277,
    );
    protected $arrPlayId = array(
        'BICHUHAOMA6' => 4889,
        'BICHUHAOMA5' => 4890,
        'BICHUHAOMA4' => 4891,
        'BICHUHAOMA3' => 4892,
        'BICHUHAOMA2' => 4893,
        'BICHUHAOMA1' => 4894,
        'BUCHUHAOMA6' => 4895,
        'BUCHUHAOMA5' => 4896,
        'BUCHUHAOMA4' => 4897,
        'BUCHUHAOMA3' => 4898,
        'BUCHUHAOMA2' => 4899,
        'BUCHUHAOMA1' => 4900,
        'PAIDIANSHUANG' => 4901,
        'PAIDIANDAN' => 4902,
        'PAIDIANXIAO' => 4903,
        'PAIDIANDA' => 4904,
        'PAIDIAN10' => 4905,
        'PAIDIAN9' => 4906,
        'PAIDIAN8' => 4907,
        'PAIDIAN7' => 4908,
        'PAIDIAN6' => 4909,
        'PAIDIAN5' => 4910,
        'PAIDIAN4' => 4911,
        'PAIDIAN3' => 4912,
        'PAIDIAN2' => 4913,
        'PAIDIAN1' => 4914,
        'KUADUSHUANG' => 4915,
        'KUADUDAN' => 4916,
        'KUADUXIAO' => 4917,
        'KUADUDA' => 4918,
        'KUADU5' => 4919,
        'KUADU4' => 4920,
        'KUADU3' => 4921,
        'KUADU2' => 4922,
        'KUADU1' => 4923,
        'KUADU0' => 4924,
        'ERTONGHAO66' => 4925,
        'ERTONGHAO55' => 4926,
        'ERTONGHAO44' => 4927,
        'ERTONGHAO33' => 4928,
        'ERTONGHAO22' => 4929,
        'ERTONGHAO11' => 4930,
        'SANTONGTONGXUAN' => 4931,
        'SANTONGHAO666' => 4932,
        'SANTONGHAO555' => 4933,
        'SANTONGHAO444' => 4934,
        'SANTONGHAO333' => 4935,
        'SANTONGHAO222' => 4936,
        'SANTONGHAO111' => 4937,
        'SANLIANTONGXUAN' => 4938,
        'SANLIANHAO456' => 4939,
        'SANLIANHAO345' => 4940,
        'SANLIANHAO234' => 4941,
        'SANLIANHAO123' => 4942,
        'HEZHISHUANG' => 4943,
        'HEZHIDAN' => 4944,
        'HEZHIXIAO' => 4945,
        'HEZHIDA' => 4946,
        'HEZHI18' => 4947,
        'HEZHI17' => 4948,
        'HEZHI16' => 4949,
        'HEZHI15' => 4950,
        'HEZHI14' => 4951,
        'HEZHI13' => 4952,
        'HEZHI12' => 4953,
        'HEZHI11' => 4954,
        'HEZHI10' => 4955,
        'HEZHI9' => 4956,
        'HEZHI8' => 4957,
        'HEZHI7' => 4958,
        'HEZHI6' => 4959,
        'HEZHI5' => 4960,
        'HEZHI4' => 4961,
        'HEZHI3' => 4962,
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
        $table = 'game_gzk3';
        $gameName = '贵州快3';
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