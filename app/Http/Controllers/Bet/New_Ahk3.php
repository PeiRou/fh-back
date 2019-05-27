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

class New_Ahk3 extends Excel
{
    protected $arrPlay_id = array(112304353,112304354,112304355,112304356,112304357,112304358,112304359,112304360,112304361,112304362,112304363,112304364,112304365,112304366,112304367,112304368,112304369,112304370,112304371,112304372,112314373,112314374,112314375,112314376,112314377,112324378,112324379,112324380,112324381,112324382,112324383,112324384,112334385,112334386,112334387,112334388,112334389,112334390,112344391,112344392,112344393,112344394,112344395,112344396,112344397,112344398,112344399,112344400,112354401,112354402,112354403,112354404,112354405,112354406,112354407,112354408,112354409,112354410,112354411,112354412,112354413,112354414,112364415,112364416,112364417,112364418,112364419,112364420,112374421,112374422,112374423,112374424,112374425,112374426);
    protected $arrPlayCate = array(
        'HZ' =>230,
        'SLH' =>231,
        'STH' =>232,
        'ETH' =>233,
        'KD' =>234,
        'PD' =>235,
        'BUCHM' =>236,
        'BICHM' =>237,
    );
    protected $arrPlayId = array(
        'HEZHI3' => 4353,
        'HEZHI4' => 4354,
        'HEZHI5' => 4355,
        'HEZHI6' => 4356,
        'HEZHI7' => 4357,
        'HEZHI8' => 4358,
        'HEZHI9' => 4359,
        'HEZHI10' => 4360,
        'HEZHI11' => 4361,
        'HEZHI12' => 4362,
        'HEZHI13' => 4363,
        'HEZHI14' => 4364,
        'HEZHI15' => 4365,
        'HEZHI16' => 4366,
        'HEZHI17' => 4367,
        'HEZHI18' => 4368,
        'HEZHIDA' => 4369,
        'HEZHIXIAO' => 4370,
        'HEZHIDAN' => 4371,
        'HEZHISHUANG' => 4372,
        'SANLIANHAO123' => 4373,
        'SANLIANHAO234' => 4374,
        'SANLIANHAO345' => 4375,
        'SANLIANHAO456' => 4376,
        'SANLIANTONGXUAN' => 4377,
        'SANTONGHAO111' => 4378,
        'SANTONGHAO222' => 4379,
        'SANTONGHAO333' => 4380,
        'SANTONGHAO444' => 4381,
        'SANTONGHAO555' => 4382,
        'SANTONGHAO666' => 4383,
        'SANTONGTONGXUAN' => 4384,
        'ERTONGHAO11' => 4385,
        'ERTONGHAO22' => 4386,
        'ERTONGHAO33' => 4387,
        'ERTONGHAO44' => 4388,
        'ERTONGHAO55' => 4389,
        'ERTONGHAO66' => 4390,
        'KUADU0' => 4391,
        'KUADU1' => 4392,
        'KUADU2' => 4393,
        'KUADU3' => 4394,
        'KUADU4' => 4395,
        'KUADU5' => 4396,
        'KUADUDA' => 4397,
        'KUADUXIAO' => 4398,
        'KUADUDAN' => 4399,
        'KUADUSHUANG' => 4400,
        'PAIDIAN1' => 4401,
        'PAIDIAN2' => 4402,
        'PAIDIAN3' => 4403,
        'PAIDIAN4' => 4404,
        'PAIDIAN5' => 4405,
        'PAIDIAN6' => 4406,
        'PAIDIAN7' => 4407,
        'PAIDIAN8' => 4408,
        'PAIDIAN9' => 4409,
        'PAIDIAN10' => 4410,
        'PAIDIANDA' => 4411,
        'PAIDIANXIAO' => 4412,
        'PAIDIANDAN' => 4413,
        'PAIDIANSHUANG' => 4414,
        'BUCHUHAOMA1' => 4415,
        'BUCHUHAOMA2' => 4416,
        'BUCHUHAOMA3' => 4417,
        'BUCHUHAOMA4' => 4418,
        'BUCHUHAOMA5' => 4419,
        'BUCHUHAOMA6' => 4420,
        'BICHUHAOMA1' => 4421,
        'BICHUHAOMA2' => 4422,
        'BICHUHAOMA3' => 4423,
        'BICHUHAOMA4' => 4424,
        'BICHUHAOMA5' => 4425,
        'BICHUHAOMA6' => 4426,
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
        $table = 'game_ahk3';
        $gameName = '安徽快3';
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
            writeLog('New_Ahk3', $gameName . $issue . "结算not Finshed");
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