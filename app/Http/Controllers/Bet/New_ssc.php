<?php
/**
 * Created by PhpStorm.
 * User: jeremy
 * Date: 2019/3/14
 * Time: 上午2:01
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class New_ssc extends Excel
{
    public $arrPlay_id = array();
    public $arrPlayCate = array();
    public $arrPlayId = array();

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
    public function all($openCode,$issue,$id,$excel,$code,$lotterys)
    {
        $gameId = $lotterys['gameId'];
        $table = $lotterys['table'];
        $gameName = $lotterys['lottery'];

        $game = Config::get('game.'.$table);
        $this->arrPlay_id = $game['arrPlay_id'];
        $this->arrPlayCate = $game['arrPlayCate'];
        $this->arrPlayId = $game['arrPlayId'];
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
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
        if($excel){
            $update = DB::table($table)->where('id',$id)->whereIn('excel_num',[2,3])->update([
                'excel_num' => 1
            ]);
            if ($update !== 1) {
                writeLog('New_Kill', $gameName . $issue . "杀率not Finshed");
            }
        }else{
            $this->updateTableFinished($table,$id,$gameName,$issue,$gameId,$code);
        }
    }
}