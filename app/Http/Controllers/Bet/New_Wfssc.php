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

class New_Wfssc extends Excel
{
    protected $arrPlay_id = array(91556413223,91556413224,91556413225,91556413226,91556413227,91556413228,91556413229,91556513230,91556513231,91556513232,91556513233,91556513234,91556513235,91556513236,91556513237,91556513238,91556513239,91556513240,91556513241,91556513242,91556513243,91556613244,91556613245,91556613246,91556613247,91556613248,91556613249,91556613250,91556613251,91556613252,91556613253,91556613254,91556613255,91556613256,91556613257,91556713258,91556713259,91556713260,91556713261,91556713262,91556713263,91556713264,91556713265,91556713266,91556713267,91556713268,91556713269,91556713270,91556713271,91556813272,91556813273,91556813274,91556813275,91556813276,91556813277,91556813278,91556813279,91556813280,91556813281,91556813282,91556813283,91556813284,91556813285,91556913286,91556913287,91556913288,91556913289,91556913290,91556913291,91556913292,91556913293,91556913294,91556913295,91556913296,91556913297,91556913298,91556913299,91557013300,91557013301,91557013302,91557013303,91557013304,91557113305,91557113306,91557113307,91557113308,91557113309,91557213310,91557213311,91557213312,91557213313,91557213314);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' => 564,
        'DIYIQIU' => 565,
        'DIERQIU' => 566,
        'DISANQIU' => 567,
        'DISIQIU' => 568,
        'DIWUQIU' => 569,
        'QIANSAN' => 570,
        'ZHONGSAN' => 571,
        'HOUSAN' => 572
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 13223,
        'ZONGHEXIAO' => 13224,
        'ZONGHEDAN' => 13225,
        'ZONGHESHUANG' => 13226,
        'LONG' => 13227,
        'HU' => 13228,
        'HE' => 13229,
        'DIYIQIU0' => 13230,
        'DIYIQIU1' => 13231,
        'DIYIQIU2' => 13232,
        'DIYIQIU3' => 13233,
        'DIYIQIU4' => 13234,
        'DIYIQIU5' => 13235,
        'DIYIQIU6' => 13236,
        'DIYIQIU7' => 13237,
        'DIYIQIU8' => 13238,
        'DIYIQIU9' => 13239,
        'DIYIQIUDA' => 13240,
        'DIYIQIUXIAO' => 13241,
        'DIYIQIUDAN' => 13242,
        'DIYIQIUSHUANG' => 13243,
        'DIERQIU0' => 13244,
        'DIERQIU1' => 13245,
        'DIERQIU2' => 13246,
        'DIERQIU3' => 13247,
        'DIERQIU4' => 13248,
        'DIERQIU5' => 13249,
        'DIERQIU6' => 13250,
        'DIERQIU7' => 13251,
        'DIERQIU8' => 13252,
        'DIERQIU9' => 13253,
        'DIERQIUDA' => 13254,
        'DIERQIUXIAO' => 13255,
        'DIERQIUDAN' => 13256,
        'DIERQIUSHUANG' => 13257,
        'DISANQIU0' => 13258,
        'DISANQIU1' => 13259,
        'DISANQIU2' => 13260,
        'DISANQIU3' => 13261,
        'DISANQIU4' => 13262,
        'DISANQIU5' => 13263,
        'DISANQIU6' => 13264,
        'DISANQIU7' => 13265,
        'DISANQIU8' => 13266,
        'DISANQIU9' => 13267,
        'DISANQIUDA' => 13268,
        'DISANQIUXIAO' => 13269,
        'DISANQIUDAN' => 13270,
        'DISANQIUSHUANG' => 13271,
        'DISIQIU0' => 13272,
        'DISIQIU1' => 13273,
        'DISIQIU2' => 13274,
        'DISIQIU3' => 13275,
        'DISIQIU4' => 13276,
        'DISIQIU5' => 13277,
        'DISIQIU6' => 13278,
        'DISIQIU7' => 13279,
        'DISIQIU8' => 13280,
        'DISIQIU9' => 13281,
        'DISIQIUDA' => 13282,
        'DISIQIUXIAO' => 13283,
        'DISIQIUDAN' => 13284,
        'DISIQIUSHUANG' => 13285,
        'DIWUQIU0' => 13286,
        'DIWUQIU1' => 13287,
        'DIWUQIU2' => 13288,
        'DIWUQIU3' => 13289,
        'DIWUQIU4' => 13290,
        'DIWUQIU5' => 13291,
        'DIWUQIU6' => 13292,
        'DIWUQIU7' => 13293,
        'DIWUQIU8' => 13294,
        'DIWUQIU9' => 13295,
        'DIWUQIUDA' => 13296,
        'DIWUQIUXIAO' => 13297,
        'DIWUQIUDAN' => 13298,
        'DIWUQIUSHUANG' => 13299,
        'QIANSANBAOZI' => 13300,
        'QIANSANSHUNZI' => 13301,
        'QIANSANDUIZI' => 13302,
        'QIANSANBANSHUN' => 13303,
        'QIANSANZALIU' => 13304,
        'ZHONGSANBAOZI' => 13305,
        'ZHONGSANSHUNZI' => 13306,
        'ZHONGSANDUIZI' => 13307,
        'ZHONGSANBANSHUN' => 13308,
        'ZHONGSANZALIU' => 13309,
        'HOUSANBAOZI' => 13310,
        'HOUSANSHUNZI' => 13311,
        'HOUSANDUIZI' => 13312,
        'HOUSANBANSHUN' => 13313,
        'HOUSANZALIU' => 13314
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
        $table = 'game_wfssc';
        $gameName = '五分时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'wfssc killing...');
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