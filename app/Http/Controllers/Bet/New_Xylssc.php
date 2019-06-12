<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/2/12
 * Time: 22:50
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Xylssc extends Excel
{
    protected $arrPlay_id = array(90743810442,90743810443,90743810444,90743810445,90743810446,90743810447,90743810448,90743910449,90743910450,90743910451,90743910452,90743910453,90743910454,90743910455,90743910456,90743910457,90743910458,90743910459,90743910460,90743910461,90743910462,90744010463,90744010464,90744010465,90744010466,90744010467,90744010468,90744010469,90744010470,90744010471,90744010472,90744010473,90744010474,90744010475,90744010476,90744110477,90744110478,90744110479,90744110480,90744110481,90744110482,90744110483,90744110484,90744110485,90744110486,90744110487,90744110488,90744110489,90744110490,90744210491,90744210492,90744210493,90744210494,90744210495,90744210496,90744210497,90744210498,90744210499,90744210500,90744210501,90744210502,90744210503,90744210504,90744310505,90744310506,90744310507,90744310508,90744310509,90744310510,90744310511,90744310512,90744310513,90744310514,90744310515,90744310516,90744310517,90744310518,90744410519,90744410520,90744410521,90744410522,90744410523,90744510524,90744510525,90744510526,90744510527,90744510528,90744610529,90744610530,90744610531,90744610532,90744610533);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>438,
        'DIYIQIU' =>439,
        'DIERQIU' =>440,
        'DISANQIU' =>441,
        'DISIQIU' =>442,
        'DIWUQIU' =>443,
        'QIANSAN' =>444,
        'ZHONGSAN' =>445,
        'HOUSAN' =>446
    );
    protected $arrPlayId = array(
        'ZONGHEDA' =>10442,
        'ZONGHEXIAO' =>10443,
        'ZONGHEDAN' =>10444,
        'ZONGHESHUANG' =>10445,
        'LONG' =>10446,
        'HU' =>10447,
        'HE' =>10448,
        'DIYIQIU0' =>10449,
        'DIYIQIU1' =>10450,
        'DIYIQIU2' =>10451,
        'DIYIQIU3' =>10452,
        'DIYIQIU4' =>10453,
        'DIYIQIU5' =>10454,
        'DIYIQIU6' =>10455,
        'DIYIQIU7' =>10456,
        'DIYIQIU8' =>10457,
        'DIYIQIU9' =>10458,
        'DIYIQIUDA' =>10459,
        'DIYIQIUXIAO' =>10460,
        'DIYIQIUDAN' =>10461,
        'DIYIQIUSHUANG' =>10462,
        'DIERQIU0' =>10463,
        'DIERQIU1' =>10464,
        'DIERQIU2' =>10465,
        'DIERQIU3' =>10466,
        'DIERQIU4' =>10467,
        'DIERQIU5' =>10468,
        'DIERQIU6' =>10469,
        'DIERQIU7' =>10470,
        'DIERQIU8' =>10471,
        'DIERQIU9' =>10472,
        'DIERQIUDA' =>10473,
        'DIERQIUXIAO' =>10474,
        'DIERQIUDAN' =>10475,
        'DIERQIUSHUANG' =>10476,
        'DISANQIU0' =>10477,
        'DISANQIU1' =>10478,
        'DISANQIU2' =>10479,
        'DISANQIU3' =>10480,
        'DISANQIU4' =>10481,
        'DISANQIU5' =>10482,
        'DISANQIU6' =>10483,
        'DISANQIU7' =>10484,
        'DISANQIU8' =>10485,
        'DISANQIU9' =>10486,
        'DISANQIUDA' =>10487,
        'DISANQIUXIAO' =>10488,
        'DISANQIUDAN' =>10489,
        'DISANQIUSHUANG' =>10490,
        'DISIQIU0' =>10491,
        'DISIQIU1' =>10492,
        'DISIQIU2' =>10493,
        'DISIQIU3' =>10494,
        'DISIQIU4' =>10495,
        'DISIQIU5' =>10496,
        'DISIQIU6' =>10497,
        'DISIQIU7' =>10498,
        'DISIQIU8' =>10499,
        'DISIQIU9' =>10500,
        'DISIQIUDA' =>10501,
        'DISIQIUXIAO' =>10502,
        'DISIQIUDAN' =>10503,
        'DISIQIUSHUANG' =>10504,
        'DIWUQIU0' =>10505,
        'DIWUQIU1' =>10506,
        'DIWUQIU2' =>10507,
        'DIWUQIU3' =>10508,
        'DIWUQIU4' =>10509,
        'DIWUQIU5' =>10510,
        'DIWUQIU6' =>10511,
        'DIWUQIU7' =>10512,
        'DIWUQIU8' =>10513,
        'DIWUQIU9' =>10514,
        'DIWUQIUDA' =>10515,
        'DIWUQIUXIAO' =>10516,
        'DIWUQIUDAN' =>10517,
        'DIWUQIUSHUANG' =>10518,
        'QIANSANBAOZI' =>10519,
        'QIANSANSHUNZI' =>10520,
        'QIANSANDUIZI' =>10521,
        'QIANSANBANSHUN' =>10522,
        'QIANSANZALIU' =>10523,
        'ZHONGSANBAOZI' =>10524,
        'ZHONGSANSHUNZI' =>10525,
        'ZHONGSANDUIZI' =>10526,
        'ZHONGSANBANSHUN' =>10527,
        'ZHONGSANZALIU' =>10528,
        'HOUSANBAOZI' =>10529,
        'HOUSANSHUNZI' =>10530,
        'HOUSANDUIZI' =>10531,
        'HOUSANBANSHUN' =>10532,
        'HOUSANZALIU' =>10533
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $SSC = new ExcelLotterySSC();
        $SSC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $SSC->NUM1($gameId,$win);
        $SSC->NUM2($gameId,$win);
        $SSC->NUM3($gameId,$win);
        $SSC->NUM4($gameId,$win);
        $SSC->NUM5($gameId,$win);
        $SSC->NUM1_DXDS($gameId,$win);
        $SSC->NUM2_DXDS($gameId,$win);
        $SSC->NUM3_DXDS($gameId,$win);
        $SSC->NUM4_DXDS($gameId,$win);
        $SSC->NUM5_DXDS($gameId,$win);
        $SSC->ZHDXDS($gameId,$win);
        $SSC->QIANSAN($gameId,$win);
        $SSC->ZHONGSAN($gameId,$win);
        $SSC->HOUSAN($gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_xylssc';
        $gameName = '匈牙利时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'xylssc killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $table);
                }
            }
            if(!$excel){
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel,$this->arrPlay_id,true);
                $this->bet_total($issue,$gameId);
                if($bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
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
}
