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

class New_Efssc extends Excel
{
    protected $arrPlay_id = array(91252812198,91252812199,91252812200,91252812201,91252812202,91252812203,91252812204,91252912205,91252912206,91252912207,91252912208,91252912209,91252912210,91252912211,91252912212,91252912213,91252912214,91252912215,91252912216,91252912217,91252912218,91253012219,91253012220,91253012221,91253012222,91253012223,91253012224,91253012225,91253012226,91253012227,91253012228,91253012229,91253012230,91253012231,91253012232,91253112233,91253112234,91253112235,91253112236,91253112237,91253112238,91253112239,91253112240,91253112241,91253112242,91253112243,91253112244,91253112245,91253112246,91253212247,91253212248,91253212249,91253212250,91253212251,91253212252,91253212253,91253212254,91253212255,91253212256,91253212257,91253212258,91253212259,91253212260,91253312261,91253312262,91253312263,91253312264,91253312265,91253312266,91253312267,91253312268,91253312269,91253312270,91253312271,91253312272,91253312273,91253312274,91253412275,91253412276,91253412277,91253412278,91253412279,91253512280,91253512281,91253512282,91253512283,91253512284,91253612285,91253612286,91253612287,91253612288,91253612289);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' => 528,
        'DIYIQIU' => 529,
        'DIERQIU' => 530,
        'DISANQIU' => 531,
        'DISIQIU' => 532,
        'DIWUQIU' => 533,
        'QIANSAN' => 534,
        'ZHONGSAN' => 535,
        'HOUSAN' => 536
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 12198,
        'ZONGHEXIAO' => 12199,
        'ZONGHEDAN' => 12200,
        'ZONGHESHUANG' => 12201,
        'LONG' => 12202,
        'HU' => 12203,
        'HE' => 12204,
        'DIYIQIU0' => 12205,
        'DIYIQIU1' => 12206,
        'DIYIQIU2' => 12207,
        'DIYIQIU3' => 12208,
        'DIYIQIU4' => 12209,
        'DIYIQIU5' => 12210,
        'DIYIQIU6' => 12211,
        'DIYIQIU7' => 12212,
        'DIYIQIU8' => 12213,
        'DIYIQIU9' => 12214,
        'DIYIQIUDA' => 12215,
        'DIYIQIUXIAO' => 12216,
        'DIYIQIUDAN' => 12217,
        'DIYIQIUSHUANG' => 12218,
        'DIERQIU0' => 12219,
        'DIERQIU1' => 12220,
        'DIERQIU2' => 12221,
        'DIERQIU3' => 12222,
        'DIERQIU4' => 12223,
        'DIERQIU5' => 12224,
        'DIERQIU6' => 12225,
        'DIERQIU7' => 12226,
        'DIERQIU8' => 12227,
        'DIERQIU9' => 12228,
        'DIERQIUDA' => 12229,
        'DIERQIUXIAO' => 12230,
        'DIERQIUDAN' => 12231,
        'DIERQIUSHUANG' => 12232,
        'DISANQIU0' => 12233,
        'DISANQIU1' => 12234,
        'DISANQIU2' => 12235,
        'DISANQIU3' => 12236,
        'DISANQIU4' => 12237,
        'DISANQIU5' => 12238,
        'DISANQIU6' => 12239,
        'DISANQIU7' => 12240,
        'DISANQIU8' => 12241,
        'DISANQIU9' => 12242,
        'DISANQIUDA' => 12243,
        'DISANQIUXIAO' => 12244,
        'DISANQIUDAN' => 12245,
        'DISANQIUSHUANG' => 12246,
        'DISIQIU0' => 12247,
        'DISIQIU1' => 12248,
        'DISIQIU2' => 12249,
        'DISIQIU3' => 12250,
        'DISIQIU4' => 12251,
        'DISIQIU5' => 12252,
        'DISIQIU6' => 12253,
        'DISIQIU7' => 12254,
        'DISIQIU8' => 12255,
        'DISIQIU9' => 12256,
        'DISIQIUDA' => 12257,
        'DISIQIUXIAO' => 12258,
        'DISIQIUDAN' => 12259,
        'DISIQIUSHUANG' => 12260,
        'DIWUQIU0' => 12261,
        'DIWUQIU1' => 12262,
        'DIWUQIU2' => 12263,
        'DIWUQIU3' => 12264,
        'DIWUQIU4' => 12265,
        'DIWUQIU5' => 12266,
        'DIWUQIU6' => 12267,
        'DIWUQIU7' => 12268,
        'DIWUQIU8' => 12269,
        'DIWUQIU9' => 12270,
        'DIWUQIUDA' => 12271,
        'DIWUQIUXIAO' => 12272,
        'DIWUQIUDAN' => 12273,
        'DIWUQIUSHUANG' => 12274,
        'QIANSANBAOZI' => 12275,
        'QIANSANSHUNZI' => 12276,
        'QIANSANDUIZI' => 12277,
        'QIANSANBANSHUN' => 12278,
        'QIANSANZALIU' => 12279,
        'ZHONGSANBAOZI' => 12280,
        'ZHONGSANSHUNZI' => 12281,
        'ZHONGSANDUIZI' => 12282,
        'ZHONGSANBANSHUN' => 12283,
        'ZHONGSANZALIU' => 12284,
        'HOUSANBAOZI' => 12285,
        'HOUSANSHUNZI' => 12286,
        'HOUSANDUIZI' => 12287,
        'HOUSANBANSHUN' => 12288,
        'HOUSANZALIU' => 12289
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
        $table = 'game_efssc';
        $gameName = '二分时时彩';
        $betCount = DB::connection('mysql::write')->table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $exeIssue = $this->getNeedKillIssue($table,2);
            $exeBase = $this->getNeedKillBase($gameId);
            if(isset($exeIssue->excel_num) && $exeBase->excel_num > 0 && $excel){
                $update = DB::table($table)->where('id',$id)->where('excel_num',2)->update([
                    'excel_num' => 3
                ]);
                if($update == 1) {
                    writeLog('New_Kill', 'efssc killing...');
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