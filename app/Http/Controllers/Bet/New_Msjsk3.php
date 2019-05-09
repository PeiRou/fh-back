<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/8/3
 * Time: 上午2:58
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryK3;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Msjsk3 extends Excel
{
    protected $arrPlay_id = array(862464575,862464576,862464577,862464578,862464579,862464580,862464581,862464582,862464583,862464584,862464585,862464586,862464587,862464588,862464589,862464590,862464591,862464592,862464593,862464594,862474595,862474596,862474597,862474598,862474599,862484600,862484601,862484602,862484603,862484604,862484605,862484606,862494607,862494608,862494609,862494610,862494611,862494612,862504613,862504614,862504615,862504616,862504617,862504618,862504619,862504620,862504621,862504622,862514623,862514624,862514625,862514626,862514627,862514628,862514629,862514630,862514631,862514632,862514633,862514634,862514635,862514636,862524637,862524638,862524639,862524640,862524641,862524642,862534643,862534644,862534645,862534646,862534647,862534648);
    protected $arrPlayCate = array(
        'HZ' =>246,
        'SLH' =>247,
        'STH' =>248,
        'ETH' =>249,
        'KD' =>250,
        'PD' =>251,
        'BUCHM' =>252,
        'BICHM' =>253
    );
    protected $arrPlayId = array(
        'HEZHI3' => 4575,
        'HEZHI4' => 4576,
        'HEZHI5' => 4577,
        'HEZHI6' => 4578,
        'HEZHI7' => 4579,
        'HEZHI8' => 4580,
        'HEZHI9' => 4581,
        'HEZHI10' => 4582,
        'HEZHI11' => 4583,
        'HEZHI12' => 4584,
        'HEZHI13' => 4585,
        'HEZHI14' => 4586,
        'HEZHI15' => 4587,
        'HEZHI16' => 4588,
        'HEZHI17' => 4589,
        'HEZHI18' => 4590,
        'HEZHIDA' => 4591,
        'HEZHIXIAO' => 4592,
        'HEZHIDAN' => 4593,
        'HEZHISHUANG' => 4594,
        'SANLIANHAO123' => 4595,
        'SANLIANHAO234' => 4596,
        'SANLIANHAO345' => 4597,
        'SANLIANHAO456' => 4598,
        'SANLIANTONGXUAN' => 4599,
        'SANTONGHAO111' => 4600,
        'SANTONGHAO222' => 4601,
        'SANTONGHAO333' => 4602,
        'SANTONGHAO444' => 4603,
        'SANTONGHAO555' => 4604,
        'SANTONGHAO666' => 4605,
        'SANTONGTONGXUAN' => 4606,
        'ERTONGHAO11' => 4607,
        'ERTONGHAO22' => 4608,
        'ERTONGHAO33' => 4609,
        'ERTONGHAO44' => 4610,
        'ERTONGHAO55' => 4611,
        'ERTONGHAO66' => 4612,
        'KUADU0' => 4613,
        'KUADU1' => 4614,
        'KUADU2' => 4615,
        'KUADU3' => 4616,
        'KUADU4' => 4617,
        'KUADU5' => 4618,
        'KUADUDA' => 4619,
        'KUADUXIAO' => 4620,
        'KUADUDAN' => 4621,
        'KUADUSHUANG' => 4622,
        'PAIDIAN1' => 4623,
        'PAIDIAN2' => 4624,
        'PAIDIAN3' => 4625,
        'PAIDIAN4' => 4626,
        'PAIDIAN5' => 4627,
        'PAIDIAN6' => 4628,
        'PAIDIAN7' => 4629,
        'PAIDIAN8' => 4630,
        'PAIDIAN9' => 4631,
        'PAIDIAN10' => 4632,
        'PAIDIANDA' => 4633,
        'PAIDIANXIAO' => 4634,
        'PAIDIANDAN' => 4635,
        'PAIDIANSHUANG' => 4636,
        'BUCHUHAOMA1' => 4637,
        'BUCHUHAOMA2' => 4638,
        'BUCHUHAOMA3' => 4639,
        'BUCHUHAOMA4' => 4640,
        'BUCHUHAOMA5' => 4641,
        'BUCHUHAOMA6' => 4642,
        'BICHUHAOMA1' => 4643,
        'BICHUHAOMA2' => 4644,
        'BICHUHAOMA3' => 4645,
        'BICHUHAOMA4' => 4646,
        'BICHUHAOMA5' => 4647,
        'BICHUHAOMA6' => 4648,
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
    public function all($openCode,$issue,$gameId,$id,$excel)
    {
        $table = 'game_msjsk3';
        $gameName = '秒速快3';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'msjsk3 killing...');
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
}