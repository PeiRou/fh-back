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
use SameClass\Config\LotteryGames\Games;

class New_dd extends Excel
{
    protected $arrPlay_id = array();
    protected $arrPlayCate = array();
    protected $arrPlayId = array();

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $DD = new ExcelLotteryDD();
        $DD->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $DD->HH($gameId,$win); //混合
        $DD->BS($gameId,$win); //波色
        $DD->TM($gameId,$win); //特码
        return $win;
    }

    public function all($openCode,$issue,$gameId,$id,$excel,$code,$table,$gameName)
    {
        $game = Games::$games[$table];
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];
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
        $update = DB::table($table)->where('id',$id)->where('is_open',1)->where('bunko',2)->update([
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