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

class New_Shfssc extends Excel
{
    protected $arrPlay_id = array(91860014248,91860014249,91860014250,91860014251,91860014252,91860014253,91860014254,91860114255,91860114256,91860114257,91860114258,91860114259,91860114260,91860114261,91860114262,91860114263,91860114264,91860114265,91860114266,91860114267,91860114268,91860214269,91860214270,91860214271,91860214272,91860214273,91860214274,91860214275,91860214276,91860214277,91860214278,91860214279,91860214280,91860214281,91860214282,91860314283,91860314284,91860314285,91860314286,91860314287,91860314288,91860314289,91860314290,91860314291,91860314292,91860314293,91860314294,91860314295,91860314296,91860414297,91860414298,91860414299,91860414300,91860414301,91860414302,91860414303,91860414304,91860414305,91860414306,91860414307,91860414308,91860414309,91860414310,91860514311,91860514312,91860514313,91860514314,91860514315,91860514316,91860514317,91860514318,91860514319,91860514320,91860514321,91860514322,91860514323,91860514324,91860614325,91860614326,91860614327,91860614328,91860614329,91860714330,91860714331,91860714332,91860714333,91860714334,91860814335,91860814336,91860814337,91860814338,91860814339);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' => 600,
        'DIYIQIU' => 601,
        'DIERQIU' => 602,
        'DISANQIU' => 603,
        'DISIQIU' => 604,
        'DIWUQIU' => 605,
        'QIANSAN' => 606,
        'ZHONGSAN' => 607,
        'HOUSAN' => 608
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 14248,
        'ZONGHEXIAO' => 14249,
        'ZONGHEDAN' => 14250,
        'ZONGHESHUANG' => 14251,
        'LONG' => 14252,
        'HU' => 14253,
        'HE' => 14254,
        'DIYIQIU0' => 14255,
        'DIYIQIU1' => 14256,
        'DIYIQIU2' => 14257,
        'DIYIQIU3' => 14258,
        'DIYIQIU4' => 14259,
        'DIYIQIU5' => 14260,
        'DIYIQIU6' => 14261,
        'DIYIQIU7' => 14262,
        'DIYIQIU8' => 14263,
        'DIYIQIU9' => 14264,
        'DIYIQIUDA' => 14265,
        'DIYIQIUXIAO' => 14266,
        'DIYIQIUDAN' => 14267,
        'DIYIQIUSHUANG' => 14268,
        'DIERQIU0' => 14269,
        'DIERQIU1' => 14270,
        'DIERQIU2' => 14271,
        'DIERQIU3' => 14272,
        'DIERQIU4' => 14273,
        'DIERQIU5' => 14274,
        'DIERQIU6' => 14275,
        'DIERQIU7' => 14276,
        'DIERQIU8' => 14277,
        'DIERQIU9' => 14278,
        'DIERQIUDA' => 14279,
        'DIERQIUXIAO' => 14280,
        'DIERQIUDAN' => 14281,
        'DIERQIUSHUANG' => 14282,
        'DISANQIU0' => 14283,
        'DISANQIU1' => 14284,
        'DISANQIU2' => 14285,
        'DISANQIU3' => 14286,
        'DISANQIU4' => 14287,
        'DISANQIU5' => 14288,
        'DISANQIU6' => 14289,
        'DISANQIU7' => 14290,
        'DISANQIU8' => 14291,
        'DISANQIU9' => 14292,
        'DISANQIUDA' => 14293,
        'DISANQIUXIAO' => 14294,
        'DISANQIUDAN' => 14295,
        'DISANQIUSHUANG' => 14296,
        'DISIQIU0' => 14297,
        'DISIQIU1' => 14298,
        'DISIQIU2' => 14299,
        'DISIQIU3' => 14300,
        'DISIQIU4' => 14301,
        'DISIQIU5' => 14302,
        'DISIQIU6' => 14303,
        'DISIQIU7' => 14304,
        'DISIQIU8' => 14305,
        'DISIQIU9' => 14306,
        'DISIQIUDA' => 14307,
        'DISIQIUXIAO' => 14308,
        'DISIQIUDAN' => 14309,
        'DISIQIUSHUANG' => 14310,
        'DIWUQIU0' => 14311,
        'DIWUQIU1' => 14312,
        'DIWUQIU2' => 14313,
        'DIWUQIU3' => 14314,
        'DIWUQIU4' => 14315,
        'DIWUQIU5' => 14316,
        'DIWUQIU6' => 14317,
        'DIWUQIU7' => 14318,
        'DIWUQIU8' => 14319,
        'DIWUQIU9' => 14320,
        'DIWUQIUDA' => 14321,
        'DIWUQIUXIAO' => 14322,
        'DIWUQIUDAN' => 14323,
        'DIWUQIUSHUANG' => 14324,
        'QIANSANBAOZI' => 14325,
        'QIANSANSHUNZI' => 14326,
        'QIANSANDUIZI' => 14327,
        'QIANSANBANSHUN' => 14328,
        'QIANSANZALIU' => 14329,
        'ZHONGSANBAOZI' => 14330,
        'ZHONGSANSHUNZI' => 14331,
        'ZHONGSANDUIZI' => 14332,
        'ZHONGSANBANSHUN' => 14333,
        'ZHONGSANZALIU' => 14334,
        'HOUSANBAOZI' => 14335,
        'HOUSANSHUNZI' => 14336,
        'HOUSANDUIZI' => 14337,
        'HOUSANBANSHUN' => 14338,
        'HOUSANZALIU' => 14339
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
        $table = 'game_shfssc';
        $gameName = '十分时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'shfssc killing...');
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