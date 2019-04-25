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
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Sfssc extends Excel
{
    protected $arrPlay_id = array(9023685936,9023685937,9023685938,9023685939,9023685940,9023685941,9023685942,9023695943,9023695944,9023695945,9023695946,9023695947,9023695948,9023695949,9023695950,9023695951,9023695952,9023695953,9023695954,9023695955,9023695956,9023705957,9023705958,9023705959,9023705960,9023705961,9023705962,9023705963,9023705964,9023705965,9023705966,9023705967,9023705968,9023705969,9023705970,9023715971,9023715972,9023715973,9023715974,9023715975,9023715976,9023715977,9023715978,9023715979,9023715980,9023715981,9023715982,9023715983,9023715984,9023725985,9023725986,9023725987,9023725988,9023725989,9023725990,9023725991,9023725992,9023725993,9023725994,9023725995,9023725996,9023725997,9023725998,9023735999,9023736000,9023736001,9023736002,9023736003,9023736004,9023736005,9023736006,9023736007,9023736008,9023736009,9023736010,9023736011,9023736012,9023746013,9023746014,9023746015,9023746016,9023746017,9023756018,9023756019,9023756020,9023756021,9023756022,9023766023,9023766024,9023766025,9023766026,9023766027);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>368,
        'DIYIQIU' =>369,
        'DIERQIU' =>370,
        'DISANQIU' =>371,
        'DISIQIU' =>372,
        'DIWUQIU' =>373,
        'QIANSAN' =>374,
        'ZHONGSAN' =>375,
        'HOUSAN' =>376
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 5936,
        'ZONGHEXIAO' => 5937,
        'ZONGHEDAN' => 5938,
        'ZONGHESHUANG' => 5939,
        'LONG' => 5940,
        'HU' => 5941,
        'HE' => 5942,
        'DIYIQIU0' => 5943,
        'DIYIQIU1' => 5944,
        'DIYIQIU2' => 5945,
        'DIYIQIU3' => 5946,
        'DIYIQIU4' => 5947,
        'DIYIQIU5' => 5948,
        'DIYIQIU6' => 5949,
        'DIYIQIU7' => 5950,
        'DIYIQIU8' => 5951,
        'DIYIQIU9' => 5952,
        'DIYIQIUDA' => 5953,
        'DIYIQIUXIAO' => 5954,
        'DIYIQIUDAN' => 5955,
        'DIYIQIUSHUANG' => 5956,
        'DIERQIU0' => 5957,
        'DIERQIU1' => 5958,
        'DIERQIU2' => 5959,
        'DIERQIU3' => 5960,
        'DIERQIU4' => 5961,
        'DIERQIU5' => 5962,
        'DIERQIU6' => 5963,
        'DIERQIU7' => 5964,
        'DIERQIU8' => 5965,
        'DIERQIU9' => 5966,
        'DIERQIUDA' => 5967,
        'DIERQIUXIAO' => 5968,
        'DIERQIUDAN' => 5969,
        'DIERQIUSHUANG' => 5970,
        'DISANQIU0' => 5971,
        'DISANQIU1' => 5972,
        'DISANQIU2' => 5973,
        'DISANQIU3' => 5974,
        'DISANQIU4' => 5975,
        'DISANQIU5' => 5976,
        'DISANQIU6' => 5977,
        'DISANQIU7' => 5978,
        'DISANQIU8' => 5979,
        'DISANQIU9' => 5980,
        'DISANQIUDA' => 5981,
        'DISANQIUXIAO' => 5982,
        'DISANQIUDAN' => 5983,
        'DISANQIUSHUANG' => 5984,
        'DISIQIU0' => 5985,
        'DISIQIU1' => 5986,
        'DISIQIU2' => 5987,
        'DISIQIU3' => 5988,
        'DISIQIU4' => 5989,
        'DISIQIU5' => 5990,
        'DISIQIU6' => 5991,
        'DISIQIU7' => 5992,
        'DISIQIU8' => 5993,
        'DISIQIU9' => 5994,
        'DISIQIUDA' => 5995,
        'DISIQIUXIAO' => 5996,
        'DISIQIUDAN' => 5997,
        'DISIQIUSHUANG' => 5998,
        'DIWUQIU0' => 5999,
        'DIWUQIU1' => 6000,
        'DIWUQIU2' => 6001,
        'DIWUQIU3' => 6002,
        'DIWUQIU4' => 6003,
        'DIWUQIU5' => 6004,
        'DIWUQIU6' => 6005,
        'DIWUQIU7' => 6006,
        'DIWUQIU8' => 6007,
        'DIWUQIU9' => 6008,
        'DIWUQIUDA' => 6009,
        'DIWUQIUXIAO' => 6010,
        'DIWUQIUDAN' => 6011,
        'DIWUQIUSHUANG' => 6012,
        'QIANSANBAOZI' => 6013,
        'QIANSANSHUNZI' => 6014,
        'QIANSANDUIZI' => 6015,
        'QIANSANBANSHUN' => 6016,
        'QIANSANZALIU' => 6017,
        'ZHONGSANBAOZI' => 6018,
        'ZHONGSANSHUNZI' => 6019,
        'ZHONGSANDUIZI' => 6020,
        'ZHONGSANBANSHUN' => 6021,
        'ZHONGSANZALIU' => 6022,
        'HOUSANBAOZI' => 6023,
        'HOUSANSHUNZI' => 6024,
        'HOUSANDUIZI' => 6025,
        'HOUSANBANSHUN' => 6026,
        'HOUSANZALIU' => 6027
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
        $table = 'game_sfssc';
        $gameName = '三分时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'sfssc killing...');
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
                        \Log::info($gameName.$issue.'退水前失败！');
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
                        \Log::info($gameName.$issue.'退水前失败！');
                }else{//代理退水
                    $agentJob = new AgentBackwaterJob($gameId,$issue);
                    $agentJob->addQueue();
                }
            }
        }
    }
}