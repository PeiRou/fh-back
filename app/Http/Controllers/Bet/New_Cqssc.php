<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/4/5
 * Time: 上午9:19
 */

namespace App\Http\Controllers\Bet;

use App\Excel;
use App\ExcelLotterySSC;
use App\Http\Controllers\Job\AgentBackwaterJob;
use Illuminate\Support\Facades\DB;

class New_Cqssc extends Excel
{
    protected $arrPlay_id = array(111,112,113,114,115,116,117,128,129,1210,1211,1212,1213,1214,1215,1216,1217,1218,1219,1220,1221,1322,1323,1324,1325,1326,1327,1328,1329,1330,1331,1332,1333,1334,1335,1436,1437,1438,1439,1440,1441,1442,1443,1444,1445,1446,1447,1448,1449,1550,1551,1552,1553,1554,1555,1556,1557,1558,1559,1560,1561,1562,1563,1664,1665,1666,1667,1668,1669,1670,1671,1672,1673,1674,1675,1676,1677,1778,1779,1780,1781,1782,1883,1884,1885,1886,1887,1988,1989,1990,1991,1992);
    protected $arrPlayCate = array(
        'ZONGHELONGHUHE' =>1,
        'DIYIQIU' =>2,
        'DIERQIU' =>3,
        'DISANQIU' =>4,
        'DISIQIU' =>5,
        'DIWUQIU' =>6,
        'QIANSAN' =>7,
        'ZHONGSAN' =>8,
        'HOUSAN' =>9
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 1,
        'ZONGHEXIAO' => 2,
        'ZONGHEDAN' => 3,
        'ZONGHESHUANG' => 4,
        'LONG' => 5,
        'HU' => 6,
        'HE' => 7,
        'DIYIQIU0' => 8,
        'DIYIQIU1' => 9,
        'DIYIQIU2' => 10,
        'DIYIQIU3' => 11,
        'DIYIQIU4' => 12,
        'DIYIQIU5' => 13,
        'DIYIQIU6' => 14,
        'DIYIQIU7' => 15,
        'DIYIQIU8' => 16,
        'DIYIQIU9' => 17,
        'DIYIQIUDA' => 18,
        'DIYIQIUXIAO' => 19,
        'DIYIQIUDAN' => 20,
        'DIYIQIUSHUANG' => 21,
        'DIERQIU0' => 22,
        'DIERQIU1' => 23,
        'DIERQIU2' => 24,
        'DIERQIU3' => 25,
        'DIERQIU4' => 26,
        'DIERQIU5' => 27,
        'DIERQIU6' => 28,
        'DIERQIU7' => 29,
        'DIERQIU8' => 30,
        'DIERQIU9' => 31,
        'DIERQIUDA' => 32,
        'DIERQIUXIAO' => 33,
        'DIERQIUDAN' => 34,
        'DIERQIUSHUANG' => 35,
        'DISANQIU0' => 36,
        'DISANQIU1' => 37,
        'DISANQIU2' => 38,
        'DISANQIU3' => 39,
        'DISANQIU4' => 40,
        'DISANQIU5' => 41,
        'DISANQIU6' => 42,
        'DISANQIU7' => 43,
        'DISANQIU8' => 44,
        'DISANQIU9' => 45,
        'DISANQIUDA' => 46,
        'DISANQIUXIAO' => 47,
        'DISANQIUDAN' => 48,
        'DISANQIUSHUANG' => 49,
        'DISIQIU0' => 50,
        'DISIQIU1' => 51,
        'DISIQIU2' => 52,
        'DISIQIU3' => 53,
        'DISIQIU4' => 54,
        'DISIQIU5' => 55,
        'DISIQIU6' => 56,
        'DISIQIU7' => 57,
        'DISIQIU8' => 58,
        'DISIQIU9' => 59,
        'DISIQIUDA' => 60,
        'DISIQIUXIAO' => 61,
        'DISIQIUDAN' => 62,
        'DISIQIUSHUANG' => 63,
        'DIWUQIU0' => 64,
        'DIWUQIU1' => 65,
        'DIWUQIU2' => 66,
        'DIWUQIU3' => 67,
        'DIWUQIU4' => 68,
        'DIWUQIU5' => 69,
        'DIWUQIU6' => 70,
        'DIWUQIU7' => 71,
        'DIWUQIU8' => 72,
        'DIWUQIU9' => 73,
        'DIWUQIUDA' => 74,
        'DIWUQIUXIAO' => 75,
        'DIWUQIUDAN' => 76,
        'DIWUQIUSHUANG' => 77,
        'QIANSANBAOZI' => 78,
        'QIANSANSHUNZI' => 79,
        'QIANSANDUIZI' => 80,
        'QIANSANBANSHUN' => 81,
        'QIANSANZALIU' => 82,
        'ZHONGSANBAOZI' => 83,
        'ZHONGSANSHUNZI' => 84,
        'ZHONGSANDUIZI' => 85,
        'ZHONGSANBANSHUN' => 86,
        'ZHONGSANZALIU' => 87,
        'HOUSANBAOZI' => 88,
        'HOUSANSHUNZI' => 89,
        'HOUSANDUIZI' => 90,
        'HOUSANBANSHUN' => 91,
        'HOUSANZALIU' => 92
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
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_cqssc';
        $gameName = '重庆时时彩';
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