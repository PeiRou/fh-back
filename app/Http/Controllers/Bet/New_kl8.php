<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/20
 * Time: 下午4:43
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotteryKL8;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class New_kl8 extends Excel
{
    public $arrPlay_id = array();
    public $arrPlayCate = array();
    public $arrPlayId = array();

    protected function exc_play($openCode,$gameId){
        $win = collect([]);
        $KL8 = new ExcelLotteryKL8();
        $KL8->setArrPlay($openCode,$this->arrPlayCate,$this->arrPlayId);
        $KL8->ZM($openCode,$gameId,$win);
        $KL8->ZH($openCode,$gameId,$win);
        $KL8->QHH($openCode,$gameId,$win);
        $KL8->DSH($openCode,$gameId,$win);
        $KL8->WX($openCode,$gameId,$win);
        return $win;
    }
    public function all($openCode,$issue,$id,$excel,$code,$lotterys)
    {
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $gameName = $lotterys['lottery'];

        $game = Config::get('game.'.$table);
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];
        $betCount = DB::table('bet')->where('status', 0)->where('game_id', $gameId)->where('issue', $issue)->where('bunko', '=', 0.00)->count();
        if ($betCount > 0) {
            if($excel){
                $exeIssue = $this->getNeedKillIssue($table,2);
                $exeBase = $this->getNeedKillBase($gameId);
                if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0){
                    $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                        'excel_num' => 3
                    ]);
                    if($update == 1) {
                        writeLog('New_Kill', $gameName.' killing...');
                        $this->excel($openCode, $exeBase, $issue, $code,$lotterys);
                    }
                }
            }else{
                $win = $this->exc_play($openCode,$gameId);
                $bunko = $this->bunko($win,$gameId,$issue,$excel,$this->arrPlay_id,true);
                $this->bet_total($issue,$lotterys);
                if($bunko == 1){
                    $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName,$table,$id,true);
                    if($updateUserMoney == 1){
                        writeLog('New_Bet', $gameName . $issue . "结算出错");
                    }
                }
            }
        }
        if ($excel) {
            $update = DB::table($table)->where('id', $id)->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            } else
                $this->stopBunko($gameId, 1, 'Kill');
        } else {
            $update = DB::table($table)->where('id',$id)->where('is_open',1)->where('bunko',2)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Bet', $gameName . $issue . "结算not Finshed");
            } else {
                $this->stopBunko($gameId, 1);
                //玩法退水
                $res = DB::table($table)->where('id', $id)->where('returnwater', 0)->update(['returnwater' => 2]);
                if (!$res) {
                    writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                    return 0;
                }else{
                    //退水
                    $res = $this->reBackUser($gameId, $issue, $gameName);
                    if (!$res) {
                        $res = DB::table($table)->where('id', $id)->where('returnwater', 2)->update(['returnwater' => 1]);
                        if (empty($res)) {
                            writeLog('New_Bet', $gameName . $issue . '退水中失败！');
                            return 0;
                        }
                    } else
                        writeLog('New_Bet', $gameName . $issue . "退水前失败！");
                }

                //层层代理退水
                $curlService = new CurService();
                $curlService->curlGet('http://127.0.0.1:9500?thread=AgentOdds:AgentBackwaterCp-'.$code.'-'.$issue);
            }
        }
    }
}