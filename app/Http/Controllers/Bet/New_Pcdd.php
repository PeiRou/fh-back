<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/21
 * Time: 下午4:13
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use Illuminate\Support\Facades\DB;

class New_Pcdd
{
    public function all($openCode,$issue,$gameId,$id)
    {
        $win = collect([]);
        $this->HH($openCode,$gameId,$win); //混合
        $this->BS($openCode,$gameId,$win); //波色
        $this->TM($openCode,$gameId,$win); //特码
        $table = 'game_pcdd';
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    $update = DB::table($table)->where('id',$id)->update([
                        'bunko' => 1
                    ]);
                    if (!$update) {
                        \Log::info("PC蛋蛋" . $issue . "结算出错");
                    }
                }
            }
        }else{
            $update = DB::table($table)->where('id',$id)->update([
                'bunko' => 1
            ]);
            if ($update !== 1) {
                \Log::info("PC蛋蛋" . $issue . "结算出错");
            }
        }
    }

    private function HH($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $sum = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2];
        $playCate = 91;
        if($sum >= 14){ //大
            $playId = 1741;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //小
            $playId = 1742;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum%2 == 0){ //双
            $playId = 1744;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        } else { //单
            $playId = 1743;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum >= 23){ //极大
            $playId = 1749;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if($sum <= 4){ //极小
            $playId = 1750;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        if((int)$arrOpenCode[0] == (int)$arrOpenCode[1] && (int)$arrOpenCode[1] == (int)$arrOpenCode[2]){ //豹子
            $playId = 1751;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function BS($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $sum = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2];
        $playCate = 92;
        //红
        if($sum == 3 || $sum == 6 || $sum == 9 || $sum == 12 || $sum == 15 || $sum == 18 || $sum == 21 || $sum == 24){
            $playId = 1752;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //绿
        if($sum == 1 || $sum == 4 || $sum == 7 || $sum == 10 || $sum == 16 || $sum == 19 || $sum == 22 || $sum == 25){
            $playId = 1753;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
        //蓝
        if($sum == 2 || $sum == 5 || $sum == 8 || $sum == 11 || $sum == 17 || $sum == 20 || $sum == 23 || $sum == 27){
            $playId = 1754;
            $winCode = $gameId.$playCate.$playId;
            $win->push($winCode);
        }
    }

    private function TM($openCode,$gameId,$win){
        $arrOpenCode = explode(',',$openCode);
        $playCate = 93;
        $sum = (int)$arrOpenCode[0]+(int)$arrOpenCode[1]+(int)$arrOpenCode[2];
        switch ($sum){
            case 0:
                $play_id = 1755;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 1:
                $play_id = 1756;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 2:
                $play_id = 1757;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 3:
                $play_id = 1758;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 4:
                $play_id = 1759;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 5:
                $play_id = 1760;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 6:
                $play_id = 1761;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 7:
                $play_id = 1762;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 8:
                $play_id = 1763;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 9:
                $play_id = 1764;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 10:
                $play_id = 1765;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 11:
                $play_id = 1766;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 12:
                $play_id = 1767;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 13:
                $play_id = 1768;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 14:
                $play_id = 1769;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 15:
                $play_id = 1770;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 16:
                $play_id = 1771;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 17:
                $play_id = 1772;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 18:
                $play_id = 1773;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 19:
                $play_id = 1774;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 20:
                $play_id = 1775;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 21:
                $play_id = 1776;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 22:
                $play_id = 1777;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 23:
                $play_id = 1778;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 24:
                $play_id = 1779;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 25:
                $play_id = 1780;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 26:
                $play_id = 1781;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
            case 27:
                $play_id = 1782;
                $winCode = $gameId.$playCate.$play_id;
                $win->push($winCode);
                break;
        }
    }

    private function bunko($win,$gameId,$issue){
        $id = [];
        foreach ($win as $k=>$v){
            $id[] = $v;
        }
        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        if($getUserBets){
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
    }

    private function updateUserMoney($gameId, $issue){
        $get = DB::connection('mysql::write')->table('bet')->select(DB::connection('mysql::write')->raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        if($get){
            $sql = "UPDATE users SET money = money+ CASE id ";
            $users = [];
            foreach ($get as $i){
                $users[] = $i->user_id;
                $sql .= "WHEN $i->user_id THEN $i->s ";
            }

            //\Log::info($users);
            $ids = implode(',',$users);
            //\Log::info($ids);
            if($ids && isset($ids)){
                $sql .= "END WHERE id IN (0,$ids)";
                //\Log::info($sql);
                $up = DB::connection('mysql::write')->statement($sql);
                if($up == 1){
                    return 1;
                }
            }
        } else {
            \Log::info('PCDD已结算过，已阻止！');
        }
    }
}