<?php
/**
 * Created by PhpStorm.
 * User: zoe
 * Date: 2019/9/18
 * Time: 下午1:31
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryK3;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Hkk3 extends Excel
{
    protected $arrPlay_id = array(92062515102,92062515103,92062515104,92062515105,92062515106,92062515107,92062515108,92062515109,92062515110,92062515111,92062515112,92062515113,92062515114,92062515115,92062515116,92062515117,92062515118,92062515119,92062515120,92062515121,92062615122,92062615123,92062615124,92062615125,92062615126,92062715127,92062715128,92062715129,92062715130,92062715131,92062715132,92062715133,92062815134,92062815135,92062815136,92062815137,92062815138,92062815139,92062915140,92062915141,92062915142,92062915143,92062915144,92062915145,92062915146,92062915147,92062915148,92062915149,92063015150,92063015151,92063015152,92063015153,92063015154,92063015155,92063015156,92063015157,92063015158,92063015159,92063015160,92063015161,92063015162,92063015163,92063115164,92063115165,92063115166,92063115167,92063115168,92063115169,92063215170,92063215171,92063215172,92063215173,92063215174,92063215175);
    protected $arrPlayCate = array(
        'HZ' => 625,
        'SLH' => 626,
        'STH' => 627,
        'ETH' => 628,
        'KD' => 629,
        'PD' => 630,
        'BUCHM' => 631,
        'BICHM' => 632,
    );
    protected $arrPlayId = array(
        'HEZHI3' => 15102,
        'HEZHI4' => 15103,
        'HEZHI5' => 15104,
        'HEZHI6' => 15105,
        'HEZHI7' => 15106,
        'HEZHI8' => 15107,
        'HEZHI9' => 15108,
        'HEZHI10' => 15109,
        'HEZHI11' => 15110,
        'HEZHI12' => 15111,
        'HEZHI13' => 15112,
        'HEZHI14' => 15113,
        'HEZHI15' => 15114,
        'HEZHI16' => 15115,
        'HEZHI17' => 15116,
        'HEZHI18' => 15117,
        'HEZHIDA' => 15118,
        'HEZHIXIAO' => 15119,
        'HEZHIDAN' => 15120,
        'HEZHISHUANG' => 15121,
        'SANLIANHAO123' => 15122,
        'SANLIANHAO234' => 15123,
        'SANLIANHAO345' => 15124,
        'SANLIANHAO456' => 15125,
        'SANLIANTONGXUAN' => 15126,
        'SANTONGHAO111' => 15127,
        'SANTONGHAO222' => 15128,
        'SANTONGHAO333' => 15129,
        'SANTONGHAO444' => 15130,
        'SANTONGHAO555' => 15131,
        'SANTONGHAO666' => 15132,
        'SANTONGTONGXUAN' => 15133,
        'ERTONGHAO11' => 15134,
        'ERTONGHAO22' => 15135,
        'ERTONGHAO33' => 15136,
        'ERTONGHAO44' => 15137,
        'ERTONGHAO55' => 15138,
        'ERTONGHAO66' => 15139,
        'KUADU0' => 15140,
        'KUADU1' => 15141,
        'KUADU2' => 15142,
        'KUADU3' => 15143,
        'KUADU4' => 15144,
        'KUADU5' => 15145,
        'KUADUDA' => 15146,
        'KUADUXIAO' => 15147,
        'KUADUDAN' => 15148,
        'KUADUSHUANG' => 15149,
        'PAIDIAN1' => 15150,
        'PAIDIAN2' => 15151,
        'PAIDIAN3' => 15152,
        'PAIDIAN4' => 15153,
        'PAIDIAN5' => 15154,
        'PAIDIAN6' => 15155,
        'PAIDIAN7' => 15156,
        'PAIDIAN8' => 15157,
        'PAIDIAN9' => 15158,
        'PAIDIAN10' => 15159,
        'PAIDIANDA' => 15160,
        'PAIDIANXIAO' => 15161,
        'PAIDIANDAN' => 15162,
        'PAIDIANSHUANG' => 15163,
        'BUCHUHAOMA1' => 15164,
        'BUCHUHAOMA2' => 15165,
        'BUCHUHAOMA3' => 15166,
        'BUCHUHAOMA4' => 15167,
        'BUCHUHAOMA5' => 15168,
        'BUCHUHAOMA6' => 15169,
        'BICHUHAOMA1' => 15170,
        'BICHUHAOMA2' => 15171,
        'BICHUHAOMA3' => 15172,
        'BICHUHAOMA4' => 15173,
        'BICHUHAOMA5' => 15174,
        'BICHUHAOMA6' => 15175,
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