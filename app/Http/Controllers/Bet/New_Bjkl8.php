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

class New_Bjkl8 extends Excel
{
    protected $arrPlay_id = array(65211259,65211260,65211261,65211262,65211263,65211264,65211265,65211266,65211267,65221268,65221269,65221270,65231271,65231272,65231273,65241274,65241275,65241276,65241277,65241278,65251279,65251280,65251281,65251282,65251283,65251284,65251285,65251286,65251287,65251288,65251289,65251290,65251291,65251292,65251293,65251294,65251295,65251296,65251297,65251298,65251299,65251300,65251301,65251302,65251303,65251304,65251305,65251306,65251307,65251308,65251309,65251310,65251311,65251312,65251313,65251314,65251315,65251316,65251317,65251318,65251319,65251320,65251321,65251322,65251323,65251324,65251325,65251326,65251327,65251328,65251329,65251330,65251331,65251332,65251333,65251334,65251335,65251336,65251337,65251338,65251339,65251340,65251341,65251342,65251343,65251344,65251345,65251346,65251347,65251348,65251349,65251350,65251351,65251352,65251353,65251354,65251355,65251356,65251357,65251358);
    protected $arrPlayCate = array(
        'ZH' => 21,
        'QHH' => 22,
        'DSH' => 23,
        'WX' => 24,
        'ZM' => 25,
    );
    protected $arrPlayId = array(
        'ZONGHEDA' => 1259,
        'ZONGHEXIAO' => 1260,
        'ZONGHEDAN' => 1261,
        'ZONGHESHUANG' => 1262,
        'ZONGHE810' => 1263,
        'ZONGDADAN' => 1264,
        'ZONGDASHUANG' => 1265,
        'ZONGXIAODAN' => 1266,
        'ZONGXIAOSHUANG' => 1267,
        'QIAN_DUO' => 1268,
        'HOU_DUO' => 1269,
        'QIANHOUHE' => 1270,
        'DAN_DUO' => 1271,
        'SHUANG_DUO' => 1272,
        'DANSHUANG_HE' => 1273,
        'JIN' => 1274,
        'MU' => 1275,
        'SHUI' => 1276,
        'HUO' => 1277,
        'TU' => 1278,
        'ZHENGMA1' => 1279,
        'ZHENGMA2' => 1280,
        'ZHENGMA3' => 1281,
        'ZHENGMA4' => 1282,
        'ZHENGMA5' => 1283,
        'ZHENGMA6' => 1284,
        'ZHENGMA7' => 1285,
        'ZHENGMA8' => 1286,
        'ZHENGMA9' => 1287,
        'ZHENGMA10' => 1288,
        'ZHENGMA11' => 1289,
        'ZHENGMA12' => 1290,
        'ZHENGMA13' => 1291,
        'ZHENGMA14' => 1292,
        'ZHENGMA15' => 1293,
        'ZHENGMA16' => 1294,
        'ZHENGMA17' => 1295,
        'ZHENGMA18' => 1296,
        'ZHENGMA19' => 1297,
        'ZHENGMA20' => 1298,
        'ZHENGMA21' => 1299,
        'ZHENGMA22' => 1300,
        'ZHENGMA23' => 1301,
        'ZHENGMA24' => 1302,
        'ZHENGMA25' => 1303,
        'ZHENGMA26' => 1304,
        'ZHENGMA27' => 1305,
        'ZHENGMA28' => 1306,
        'ZHENGMA29' => 1307,
        'ZHENGMA30' => 1308,
        'ZHENGMA31' => 1309,
        'ZHENGMA32' => 1310,
        'ZHENGMA33' => 1311,
        'ZHENGMA34' => 1312,
        'ZHENGMA35' => 1313,
        'ZHENGMA36' => 1314,
        'ZHENGMA37' => 1315,
        'ZHENGMA38' => 1316,
        'ZHENGMA39' => 1317,
        'ZHENGMA40' => 1318,
        'ZHENGMA41' => 1319,
        'ZHENGMA42' => 1320,
        'ZHENGMA43' => 1321,
        'ZHENGMA44' => 1322,
        'ZHENGMA45' => 1323,
        'ZHENGMA46' => 1324,
        'ZHENGMA47' => 1325,
        'ZHENGMA48' => 1326,
        'ZHENGMA49' => 1327,
        'ZHENGMA50' => 1328,
        'ZHENGMA51' => 1329,
        'ZHENGMA52' => 1330,
        'ZHENGMA53' => 1331,
        'ZHENGMA54' => 1332,
        'ZHENGMA55' => 1333,
        'ZHENGMA56' => 1334,
        'ZHENGMA57' => 1335,
        'ZHENGMA58' => 1336,
        'ZHENGMA59' => 1337,
        'ZHENGMA60' => 1338,
        'ZHENGMA61' => 1339,
        'ZHENGMA62' => 1340,
        'ZHENGMA63' => 1341,
        'ZHENGMA64' => 1342,
        'ZHENGMA65' => 1343,
        'ZHENGMA66' => 1344,
        'ZHENGMA67' => 1345,
        'ZHENGMA68' => 1346,
        'ZHENGMA69' => 1347,
        'ZHENGMA70' => 1348,
        'ZHENGMA71' => 1349,
        'ZHENGMA72' => 1350,
        'ZHENGMA73' => 1351,
        'ZHENGMA74' => 1352,
        'ZHENGMA75' => 1353,
        'ZHENGMA76' => 1354,
        'ZHENGMA77' => 1355,
        'ZHENGMA78' => 1356,
        'ZHENGMA79' => 1357,
        'ZHENGMA80' => 1358,
    );

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
    public function all($openCode,$issue,$gameId,$id)
    {
        $table = 'game_bjkl8';
        $gameName = '北京快乐8';
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