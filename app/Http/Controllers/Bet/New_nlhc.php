<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 2019/3/14
 * Time: 下午20:01
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryLHC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;
use SameClass\Config\LotteryGames\Games;

class New_nlhc extends Excel
{
    protected $arrPlay_id = array();
    protected $arrPlayCate = array();
    protected $arrPlayId = array();

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $ids_he = collect([]);
        $LHC = new ExcelLotteryLHC();
        $LHC->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $LHC->LHC_TM($gameId,$win);
        $LHC->LHC_LM($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_SB($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_TX($openCode,$gameId,$win);
        $LHC->LHC_TMTWS($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_ZM($openCode,$gameId,$win);
        $LHC->LHC_ZMT($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_WX($openCode,$gameId,$win);
        $LHC->LHC_QSB($openCode,$gameId,$win,$ids_he);
        $LHC->LHC_PTYXWS($openCode,$gameId,$win);
        $LHC->LHC_ZONGXIAO($gameId,$win);
        return array('win'=>$win,'ids_he'=>$ids_he,'LHC'=>$LHC);
    }

    public function all($openCode,$issue,$gameId,$id,$excel,$code,$table,$gameName)
    {
        $game = Games::$games[$table];
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();

        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                writeLog('New_Kill', 'excel_num:'.$update);
                if($update == 1) {
                    writeLog('New_Kill', $code.' killing...');
                    $this->excel($openCode, $exeBase, $issue, $gameId, $code, $table);
                }
            }
            if(!$excel){
                $resData = $this->exc_play($openCode,$gameId);
                $win = @$resData['win'];
                $he = isset($resData['ids_he'])?$resData['ids_he']:array();
                $LHC = isset($resData['LHC'])?$resData['LHC']:null;
                try {
                    $bunko = $this->BUNKO_LHC($openCode, $win, $gameId, $issue, $he, $excel,$LHC);
                }catch (\exception $exception){
                    writeLog('New_Bet', __CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                    DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->update(['status' => 0,'bunko' => 0]);
                }
                $this->bet_total($issue,$gameId);
                if(isset($bunko) && $bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if($excel){
            $update = DB::table($table)->where('id',$id)->whereIn('excel_num',[2,3])->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }else
                $this->stopBunko($gameId,1,'Kill');
        }else{
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
}