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

class New_Xy28 extends Excel
{
    protected $arrPlay_id = array(841592771,841592772,841592773,841592774,841592775,841592776,841592777,841592778,841592779,841592780,841592781,841602782,841602783,841602784,841612785,841612786,841612787,841612788,841612789,841612790,841612791,841612792,841612793,841612794,841612795,841612796,841612797,841612798,841612799,841612800,841612801,841612802,841612803,841612804,841612805,841612806,841612807,841612808,841612809,841612810,841612811,841612812);
    protected $arrPlayCate = array(
        'HH' => 159,
        'BS' => 160,
        'TM' => 161,
    );
    protected $arrPlayId = array(
        'DA' => 2771,
        'XIAO' => 2772,
        'DAN' => 2773,
        'SHUANG' => 2774,
        'DADAN' => 2775,
        'DASHUANG' => 2776,
        'XIAODAN' => 2777,
        'XIAOSHUANG' => 2778,
        'JIDA' => 2779,
        'JIXIAO' => 2780,
        'BAOZI' => 2781,
        'HONGBO' => 2782,
        'LUBO' => 2783,
        'LANBO' => 2784,
        'TEMA0' => 2785,
        'TEMA1' => 2786,
        'TEMA2' => 2787,
        'TEMA3' => 2788,
        'TEMA4' => 2789,
        'TEMA5' => 2790,
        'TEMA6' => 2791,
        'TEMA7' => 2792,
        'TEMA8' => 2793,
        'TEMA9' => 2794,
        'TEMA10' => 2795,
        'TEMA11' => 2796,
        'TEMA12' => 2797,
        'TEMA13' => 2798,
        'TEMA14' => 2799,
        'TEMA15' => 2800,
        'TEMA16' => 2801,
        'TEMA17' => 2802,
        'TEMA18' => 2803,
        'TEMA19' => 2804,
        'TEMA20' => 2805,
        'TEMA21' => 2806,
        'TEMA22' => 2807,
        'TEMA23' => 2808,
        'TEMA24' => 2809,
        'TEMA25' => 2810,
        'TEMA26' => 2811,
        'TEMA27' => 2812,
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
        $table = 'game_xy28';
        $gameName = '幸运28';
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