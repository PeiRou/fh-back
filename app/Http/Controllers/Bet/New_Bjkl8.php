<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/20
 * Time: 下午4:43
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use App\Excel;
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

    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->ZM($openCode,$gameId,$win);
        $this->ZH($openCode,$gameId,$win);
        $this->QHH($openCode,$gameId,$win);
        $this->DSH($openCode,$gameId,$win);
        $this->WX($openCode,$gameId,$win);
        $table = 'game_bjkl8';
        $gameName = '北京快乐8';
        $betCount = DB::table('bet')->where('status',0)->where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$gameId,$issue,false,$this->arrPlay_id);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue,$gameName);
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
            $agentJob = new AgentBackwaterJob($gameId,$issue);
            $agentJob->addQueue();
        }
    }

    private function ZM($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $playCate = 25;
        for($i=0;$i<count($arrOpenCode);$i++){
            $winCode = $gameId.$playCate.$this->ZM_NUMS($arrOpenCode[$i]);
            $win->push($winCode);
        }
    }

    private function ZH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $sum = 0;
        $playCate = 21;
        for($i=0;$i<count($arrOpenCode);$i++){
            $sum += (int)$arrOpenCode[$i];
        }
        if($sum > 810){ //总和大
            $playId = 1259;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //总和小
            $playId = 1260;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        if($sum%2 == 0) {
            $playId = 1262; //总和双
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1261; //总和单
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        if($sum == 810){
            $playId = 1263; //和值
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }

        if($sum%2 == 0 && $sum > 810){ //大双
            $playId = 1265;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 == 0 && $sum < 810){ //小双
            $playId = 1267;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 !== 0 && $sum > 810){ //大单
            $playId = 1264;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 !== 0 && $sum < 810){ //小单
            $playId = 1266;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function QHH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $qian = 0;
        $hou = 0;
        $playCate = 22;
        for($i=0;$i<count($arrOpenCode);$i++){
            $num = (int)$arrOpenCode[$i];
            if($num >= 1 && $num <= 40){
                $qian += 1;
            }
            if($num >= 41 && $num <= 80){
                $hou += 1;
            }
        }
        if($qian > $hou){
            $playId = 1268; //前多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else {
            $playId = 1269; //后多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($qian == $hou){
            $playId = 1270; //前后和
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function WX($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $sum = 0;
        $playCate = 24;
        for($i=0;$i<count($arrOpenCode);$i++){
            $sum += (int)$arrOpenCode[$i];
        }
        if($sum >= 210 && $sum <= 695){ //金
            $playId = 1274;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 696 && $sum <= 763){ //木
            $playId = 1275;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 764 && $sum <= 855){ //水
            $playId = 1276;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 856 && $sum <= 923){ //火
            $playId = 1277;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 924 && $sum <= 1410){ //土
            $playId = 1278;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function DSH($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode);
        $dan = 0;
        $shuang = 0;
        $playCate = 23;
        for($i=0;$i<count($arrOpenCode);$i++){
            $num = (int)$arrOpenCode[$i];
            if($num%2 == 0){
                $shuang += 1;
            } else {
                $dan += 1;
            }
        }
        if($dan > 10){
            $playId = 1271; //单多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if ($shuang > 10) {
            $playId = 1272; //双多
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($dan == $shuang){
            $playId = 1273; //单双和
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function ZM_NUMS($num)
    {
        switch ($num){
            case 1:
                $play_id = 1279;
                return $play_id;
                break;
            case 2:
                $play_id = 1280;
                return $play_id;
                break;
            case 3:
                $play_id = 1281;
                return $play_id;
                break;
            case 4:
                $play_id = 1282;
                return $play_id;
                break;
            case 5:
                $play_id = 1283;
                return $play_id;
                break;
            case 6:
                $play_id = 1284;
                return $play_id;
                break;
            case 7:
                $play_id = 1285;
                return $play_id;
                break;
            case 8:
                $play_id = 1286;
                return $play_id;
                break;
            case 9:
                $play_id = 1287;
                return $play_id;
                break;
            case 10:
                $play_id = 1288;
                return $play_id;
                break;
            case 11:
                $play_id = 1289;
                return $play_id;
                break;
            case 12:
                $play_id = 1290;
                return $play_id;
                break;
            case 13:
                $play_id = 1291;
                return $play_id;
                break;
            case 14:
                $play_id = 1292;
                return $play_id;
                break;
            case 15:
                $play_id = 1293;
                return $play_id;
                break;
            case 16:
                $play_id = 1294;
                return $play_id;
                break;
            case 17:
                $play_id = 1295;
                return $play_id;
                break;
            case 18:
                $play_id = 1296;
                return $play_id;
                break;
            case 19:
                $play_id = 1297;
                return $play_id;
                break;
            case 20:
                $play_id = 1298;
                return $play_id;
                break;
            case 21:
                $play_id = 1299;
                return $play_id;
                break;
            case 22:
                $play_id = 1300;
                return $play_id;
                break;
            case 23:
                $play_id = 1301;
                return $play_id;
                break;
            case 24:
                $play_id = 1302;
                return $play_id;
                break;
            case 25:
                $play_id = 1303;
                return $play_id;
                break;
            case 26:
                $play_id = 1304;
                return $play_id;
                break;
            case 27:
                $play_id = 1305;
                return $play_id;
                break;
            case 28:
                $play_id = 1306;
                return $play_id;
                break;
            case 29:
                $play_id = 1307;
                return $play_id;
                break;
            case 30:
                $play_id = 1308;
                return $play_id;
                break;
            case 31:
                $play_id = 1309;
                return $play_id;
                break;
            case 32:
                $play_id = 1310;
                return $play_id;
                break;
            case 33:
                $play_id = 1311;
                return $play_id;
                break;
            case 34:
                $play_id = 1312;
                return $play_id;
                break;
            case 35:
                $play_id = 1313;
                return $play_id;
                break;
            case 36:
                $play_id = 1314;
                return $play_id;
                break;
            case 37:
                $play_id = 1315;
                return $play_id;
                break;
            case 38:
                $play_id = 1316;
                return $play_id;
                break;
            case 39:
                $play_id = 1317;
                return $play_id;
                break;
            case 40:
                $play_id = 1318;
                return $play_id;
                break;
            case 41:
                $play_id = 1319;
                return $play_id;
                break;
            case 42:
                $play_id = 1320;
                return $play_id;
                break;
            case 43:
                $play_id = 1321;
                return $play_id;
                break;
            case 44:
                $play_id = 1322;
                return $play_id;
                break;
            case 45:
                $play_id = 1323;
                return $play_id;
                break;
            case 46:
                $play_id = 1324;
                return $play_id;
                break;
            case 47:
                $play_id = 1325;
                return $play_id;
                break;
            case 48:
                $play_id = 1326;
                return $play_id;
                break;
            case 49:
                $play_id = 1327;
                return $play_id;
                break;
            case 50:
                $play_id = 1328;
                return $play_id;
                break;
            case 51:
                $play_id = 1329;
                return $play_id;
                break;
            case 52:
                $play_id = 1330;
                return $play_id;
                break;
            case 53:
                $play_id = 1331;
                return $play_id;
                break;
            case 54:
                $play_id = 1332;
                return $play_id;
                break;
            case 55:
                $play_id = 1333;
                return $play_id;
                break;
            case 56:
                $play_id = 1334;
                return $play_id;
                break;
            case 57:
                $play_id = 1335;
                return $play_id;
                break;
            case 58:
                $play_id = 1336;
                return $play_id;
                break;
            case 59:
                $play_id = 1337;
                return $play_id;
                break;
            case 60:
                $play_id = 1338;
                return $play_id;
                break;
            case 61:
                $play_id = 1339;
                return $play_id;
                break;
            case 62:
                $play_id = 1340;
                return $play_id;
                break;
            case 63:
                $play_id = 1341;
                return $play_id;
                break;
            case 64:
                $play_id = 1342;
                return $play_id;
                break;
            case 65:
                $play_id = 1343;
                return $play_id;
                break;
            case 66:
                $play_id = 1344;
                return $play_id;
                break;
            case 67:
                $play_id = 1345;
                return $play_id;
                break;
            case 68:
                $play_id = 1346;
                return $play_id;
                break;
            case 69:
                $play_id = 1347;
                return $play_id;
                break;
            case 70:
                $play_id = 1348;
                return $play_id;
                break;
            case 71:
                $play_id = 1349;
                return $play_id;
                break;
            case 72:
                $play_id = 1350;
                return $play_id;
                break;
            case 73:
                $play_id = 1351;
                return $play_id;
                break;
            case 74:
                $play_id = 1352;
                return $play_id;
                break;
            case 75:
                $play_id = 1353;
                return $play_id;
                break;
            case 76:
                $play_id = 1354;
                return $play_id;
                break;
            case 77:
                $play_id = 1355;
                return $play_id;
                break;
            case 78:
                $play_id = 1356;
                return $play_id;
                break;
            case 79:
                $play_id = 1357;
                return $play_id;
                break;
            case 80:
                $play_id = 1358;
                return $play_id;
                break;
        }
    }
}