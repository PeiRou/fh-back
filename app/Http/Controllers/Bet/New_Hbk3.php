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

class New_Hbk3 extends Excel
{
    protected $arrPlay_id = array(132294501,132294502,132294503,132294504,132294505,132294506,132284507,132284508,132284509,132284510,132284511,132284512,132274513,132274514,132274515,132274516,132274517,132274518,132274519,132274520,132274521,132274522,132274523,132274524,132274525,132274526,132264527,132264528,132264529,132264530,132264531,132264532,132264533,132264534,132264535,132264536,132254537,132254538,132254539,132254540,132254541,132254542,132244543,132244544,132244545,132244546,132244547,132244548,132244549,132234550,132234551,132234552,132234553,132234554,132224555,132224556,132224557,132224558,132224559,132224560,132224561,132224562,132224563,132224564,132224565,132224566,132224567,132224568,132224569,132224570,132224571,132224572,132224573,132224574);
    protected $arrPlayCate = array(
        'HZ' =>222,
        'SLH' =>223,
        'STH' =>224,
        'ETH' =>225,
        'KD' =>226,
        'PD' =>227,
        'BUCHM' =>228,
        'BICHM' =>229,
    );
    protected $arrPlayId = array(
        'BICHUHAOMA6' => 4501,
        'BICHUHAOMA5' => 4502,
        'BICHUHAOMA4' => 4503,
        'BICHUHAOMA3' => 4504,
        'BICHUHAOMA2' => 4505,
        'BICHUHAOMA1' => 4506,
        'BUCHUHAOMA6' => 4507,
        'BUCHUHAOMA5' => 4508,
        'BUCHUHAOMA4' => 4509,
        'BUCHUHAOMA3' => 4510,
        'BUCHUHAOMA2' => 4511,
        'BUCHUHAOMA1' => 4512,
        'PAIDIANSHUANG' => 4513,
        'PAIDIANDAN' => 4514,
        'PAIDIANXIAO' => 4515,
        'PAIDIANDA' => 4516,
        'PAIDIAN10' => 4517,
        'PAIDIAN9' => 4518,
        'PAIDIAN8' => 4519,
        'PAIDIAN7' => 4520,
        'PAIDIAN6' => 4521,
        'PAIDIAN5' => 4522,
        'PAIDIAN4' => 4523,
        'PAIDIAN3' => 4524,
        'PAIDIAN2' => 4525,
        'PAIDIAN1' => 4526,
        'KUADUSHUANG' => 4527,
        'KUADUDAN' => 4528,
        'KUADUXIAO' => 4529,
        'KUADUDA' => 4530,
        'KUADU5' => 4531,
        'KUADU4' => 4532,
        'KUADU3' => 4533,
        'KUADU2' => 4534,
        'KUADU1' => 4535,
        'KUADU0' => 4536,
        'ERTONGHAO66' => 4537,
        'ERTONGHAO55' => 4538,
        'ERTONGHAO44' => 4539,
        'ERTONGHAO33' => 4540,
        'ERTONGHAO22' => 4541,
        'ERTONGHAO11' => 4542,
        'SANTONGTONGXUAN' => 4543,
        'SANTONGHAO666' => 4544,
        'SANTONGHAO555' => 4545,
        'SANTONGHAO444' => 4546,
        'SANTONGHAO333' => 4547,
        'SANTONGHAO222' => 4548,
        'SANTONGHAO111' => 4549,
        'SANLIANTONGXUAN' => 4550,
        'SANLIANHAO456' => 4551,
        'SANLIANHAO345' => 4552,
        'SANLIANHAO234' => 4553,
        'SANLIANHAO123' => 4554,
        'HEZHISHUANG' => 4555,
        'HEZHIDAN' => 4556,
        'HEZHIXIAO' => 4557,
        'HEZHIDA' => 4558,
        'HEZHI18' => 4559,
        'HEZHI17' => 4560,
        'HEZHI16' => 4561,
        'HEZHI15' => 4562,
        'HEZHI14' => 4563,
        'HEZHI13' => 4564,
        'HEZHI12' => 4565,
        'HEZHI11' => 4566,
        'HEZHI10' => 4567,
        'HEZHI9' => 4568,
        'HEZHI8' => 4569,
        'HEZHI7' => 4570,
        'HEZHI6' => 4571,
        'HEZHI5' => 4572,
        'HEZHI4' => 4573,
        'HEZHI3' => 4574,
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
        $table = 'game_hbk3';
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
                    \Log::info($gameName.$issue.'退水前失败！');
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
                    \Log::info($gameName.$issue.'退水前失败！');
            }else{//代理退水
                $agentJob = new AgentBackwaterJob($gameId,$issue);
                $agentJob->addQueue();
            }
        }
    }
}