<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/20
 * Time: 下午4:43
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use Illuminate\Support\Facades\DB;

class New_Bjkl8
{
    public function all($openCode,$issue,$gameId)
    {
        $win = collect([]);
        $this->ZM($openCode,$gameId,$win);
        $this->ZH($openCode,$gameId,$win);
        $this->QHH($openCode,$gameId,$win);
        $this->DSH($openCode,$gameId,$win);
        $this->WX($openCode,$gameId,$win);
        $betCount = Bets::where('issue',$issue)->where('game_id',$gameId)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    return 1;
                }
            }
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

    private function bunko($win,$gameId,$issue){
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->get();
        $sql = "UPDATE bet SET bunko = CASE ";
        $sql_lose = "UPDATE bet SET bunko = CASE ";
        $ids = implode(',', $id);
        foreach ($getUserBets as $item){
            $bunko = $item->bet_money * $item->play_odds;
            $bunko_lose = 0-$item->bet_money;
            $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
        }
        $sql .= "END WHERE `play_id` IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
        $sql_lose .= "END WHERE `play_id` NOT IN ($ids) AND `issue` = $issue AND `game_id` = $gameId";
        $run = DB::statement($sql);
        if($run == 1){
            $run2 = DB::statement($sql_lose);
            if($run2 == 1){
                return 1;
            }
        }
    }

    private function updateUserMoney($gameId, $issue){
        $get = DB::table('bet')->select(DB::raw("sum(bunko) as s"),'user_id','bet_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->where('status',0)->groupBy('user_id')->get();
        if($get){
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            $betsId = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->s ";
            }

            $getBets = DB::table('bet')->select('bet_id')->where('game_id',$gameId)->where('issue',$issue)->where('status',0)->get();

            foreach ($getBets as $m){
                $betsId[] = $m->bet_id;
            }
            //\Log::info($users);
            $ids = implode(',',$users);
            $bets = implode(',',$betsId);
            //\Log::info($ids);
            $sql .= "END WHERE id IN (0,$ids)";
            //\Log::info($sql);
            $up = DB::statement($sql);
            if($up == 1){
                $sql_bet_status = "UPDATE bet SET status = 2 WHERE `bet_id` IN ($bets)";
                $update_bet_status = DB::statement($sql_bet_status);
                if($update_bet_status == 1){
                    return 1;
                }
            } else {
                \Log::info('更新用户余额，失败！');
            }
        } else {
            \Log::info('北京快乐8已结算过，已阻止！');
        }
    }
}