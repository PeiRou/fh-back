<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/7/11
 * Time: 下午10:59
 */

namespace App\Http\Controllers\Bet;


use Illuminate\Support\Facades\DB;

class New_LHC
{
    public function all($openCode,$issue,$gameId)
    {
        $win = collect([]);
        $this->TM_B($openCode,$gameId,$win);
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->count();
        if($betCount > 0){
            $bunko = $this->BUNKO($win,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    return 1;
                }
            }
        }
    }
    
    //特码B
    public function TM_B($openCode,$gameId,$win)
    {
        $arrOpenCode = explode(',',$openCode); // 分割开奖号码
        $tm_playCate = 64; //特码分类ID
        $tm = $arrOpenCode[6]; //特码号码
        switch ($tm){
            case 1:
                $playId = 1408;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 2:
                $playId = 1409;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 3:
                $playId = 1410;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 4:
                $playId = 1411;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 5:
                $playId = 1412;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 6:
                $playId = 1413;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 7:
                $playId = 1414;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 8:
                $playId = 1415;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 9:
                $playId = 1416;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 10:
                $playId = 1417;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 11:
                $playId = 1418;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 12:
                $playId = 1419;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 13:
                $playId = 1420;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 14:
                $playId = 1421;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 15:
                $playId = 1422;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 16:
                $playId = 1423;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 17:
                $playId = 1424;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 18:
                $playId = 1425;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 19:
                $playId = 1426;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 20:
                $playId = 1427;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 21:
                $playId = 1428;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 22:
                $playId = 1429;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 23:
                $playId = 1430;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 24:
                $playId = 1431;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 25:
                $playId = 1432;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 26:
                $playId = 1433;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 27:
                $playId = 1434;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 28:
                $playId = 1435;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 29:
                $playId = 1436;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 30:
                $playId = 1437;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 31:
                $playId = 1438;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 32:
                $playId = 1439;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 33:
                $playId = 1440;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 34:
                $playId = 1441;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 35:
                $playId = 1442;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 36:
                $playId = 1443;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 37:
                $playId = 1444;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 38:
                $playId = 1445;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 39:
                $playId = 1446;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 40:
                $playId = 1447;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 41:
                $playId = 1448;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 42:
                $playId = 1449;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 43:
                $playId = 1450;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 44:
                $playId = 1451;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 45:
                $playId = 1452;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 46:
                $playId = 1453;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 47:
                $playId = 1454;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 48:
                $playId = 1455;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
            case 49:
                $playId = 1456;
                $winCode = $gameId.$tm_playCate.$playId;
                $win->push($winCode);
                break;
        }
    }

    //投注结算
    function BUNKO($win,$gameId,$issue)
    {
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = DB::table('bet')->where('game_id',$gameId)->where('issue',$issue)->get();
        $sql = "UPDATE bet SET bunko = CASE "; //中奖的SQL语句
        $sql_lose = "UPDATE bet SET bunko = CASE "; //未中奖的SQL语句
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

    function updateUserMoney($gameId,$issue){
        $get = DB::table('bet')->select(DB::raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        $sql = "UPDATE users SET money = money+ CASE id ";
        $users = [];
        foreach ($get as $i){
            $users[] = $i->user_id;
            $sql .= "WHEN $i->user_id THEN $i->s ";
        }
        $ids = implode(',',$users);
        $sql .= "END WHERE id IN (0,$ids)";
        $up = DB::statement($sql);
        if($up == 1){
            return 1;
        } else {
            \Log::info('更新用户余额，失败！');
        }
    }
}