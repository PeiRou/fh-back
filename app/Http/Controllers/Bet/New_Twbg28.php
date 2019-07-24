<?php
/**
 * Created by PhpStorm.
 * User: Jeremy
 * Date: 2019/07/23
 * Time: 下午20:24
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryDD;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Twbg28 extends Excel
{
    protected $arrPlay_id = array(4345210634,4345210635,4345210636,4345210637,4345210638,4345210639,4345210640,4345210641,4345210642,4345210643,4345210644,4345310645,4345310646,4345310647,4345410648,4345410649,4345410650,4345410651,4345410652,4345410653,4345410654,4345410655,4345410656,4345410657,4345410658,4345410659,4345410660,4345410661,4345410662,4345410663,4345410664,4345410665,4345410666,4345410667,4345410668,4345410669,4345410670,4345410671,4345410672,4345410673,4345410674,4345410675);
    protected $arrPlayCate = array(
        'HH' => 452,
        'BS' => 453,
        'TM' => 454,
    );
    protected $arrPlayId = array(
        'DA' => 10634,
        'XIAO' => 10635,
        'DAN' => 10636,
        'SHUANG' => 10637,
        'DADAN' => 10638,
        'DASHUANG' => 10639,
        'XIAODAN' => 10640,
        'XIAOSHUANG' => 10641,
        'JIDA' => 10642,
        'JIXIAO' => 10643,
        'BAOZI' => 10644,
        'HONGBO' => 10645,
        'LUBO' => 10646,
        'LANBO' => 10647,
        'TEMA0' => 10648,
        'TEMA1' => 10649,
        'TEMA2' => 10650,
        'TEMA3' => 10651,
        'TEMA4' => 10652,
        'TEMA5' => 10653,
        'TEMA6' => 10654,
        'TEMA7' => 10655,
        'TEMA8' => 10656,
        'TEMA9' => 10657,
        'TEMA10' => 10658,
        'TEMA11' => 10659,
        'TEMA12' => 10660,
        'TEMA13' => 10661,
        'TEMA14' => 10662,
        'TEMA15' => 10663,
        'TEMA16' => 10664,
        'TEMA17' => 10665,
        'TEMA18' => 10666,
        'TEMA19' => 10667,
        'TEMA20' => 10668,
        'TEMA21' => 10669,
        'TEMA22' => 10670,
        'TEMA23' => 10671,
        'TEMA24' => 10672,
        'TEMA25' => 10673,
        'TEMA26' => 10674,
        'TEMA27' => 10675,
    );

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $DD = new ExcelLotteryDD();
        $DD->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $DD->HH($gameId,$win); //混合
        $DD->BS($gameId,$win); //波色
        $DD->TM($gameId,$win); //特码
        return $win;
    }

    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_twbg28';
        $gameName = '台湾宾果28';
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