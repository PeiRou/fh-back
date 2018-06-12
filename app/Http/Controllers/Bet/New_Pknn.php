<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/23
 * Time: 下午6:39
 */

namespace App\Http\Controllers\Bet;

use App\Bets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class New_Pknn
{
    public function all($openCode,$nn,$issue,$gameId){
        $win = collect([]);
        $lose = collect([]);
        $winArr1 = collect([]);
        $this->NN($openCode,$nn,$gameId,$win,$lose,$winArr1);
        $betCount = Bets::where('issue',$issue)->where('game_id',$gameId)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$lose,$winArr1,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    return 1;
                }
            }
        }
    }

    private function NN($openCode,$nn,$gameId,$win,$lose,$winArr1)
    {
        $niuniuArr = explode(',',$nn);
        $replace = str_replace('10','0',$openCode);
        $explodeNum = explode(',',$replace);
        $playCate = 190;
        $banker = (int)$explodeNum[0].','.(int)$explodeNum[1].','.(int)$explodeNum[2].','.(int)$explodeNum[3].','.(int)$explodeNum[4];
        $player1 = (int)$explodeNum[1].','.(int)$explodeNum[2].','.(int)$explodeNum[3].','.(int)$explodeNum[4].','.(int)$explodeNum[5];
        $player2 = (int)$explodeNum[2].','.(int)$explodeNum[3].','.(int)$explodeNum[4].','.(int)$explodeNum[5].','.(int)$explodeNum[6];
        $player3 = (int)$explodeNum[3].','.(int)$explodeNum[4].','.(int)$explodeNum[5].','.(int)$explodeNum[6].','.(int)$explodeNum[7];
        $player4 = (int)$explodeNum[4].','.(int)$explodeNum[5].','.(int)$explodeNum[6].','.(int)$explodeNum[7].','.(int)$explodeNum[8];
        $player5 = (int)$explodeNum[5].','.(int)$explodeNum[6].','.(int)$explodeNum[7].','.(int)$explodeNum[8].','.(int)$explodeNum[9];

        $arr = [
            [explode(",",$banker),$niuniuArr[0],0],
            [explode(",",$player1),$niuniuArr[1],0],
            [explode(",",$player2),$niuniuArr[2],0],
            [explode(",",$player3),$niuniuArr[3],0],
            [explode(",",$player4),$niuniuArr[4],0],
            [explode(",",$player5),$niuniuArr[5],0],
        ];
        $index = 0;
        for($i=0;$i<count($arr);$i++)
        {
            $bankerNN = $arr[0][1];
            Session::put('PKNN_BankerNN',$arr[0][1]);
            $playerNN = $arr[$i][1];
            if($i!==0 && (($playerNN > $bankerNN) || (($playerNN == $bankerNN) && ($bankerNN > 6) && ($arr[$i][0][0] > $arr[0][0][0])))){
                $arr[$i][2] = 1;
                $index++;
                if($i == 1){
                    $playId = 3462;
                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
                    $win->push($winCode);
                    $winArr1->push($gameId.$playCate.$playId);
                }
                if($i == 2){
                    $playId = 3463;
                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
                    $win->push($winCode);
                    $winArr1->push($gameId.$playCate.$playId);
                }
                if($i == 3){
                    $playId = 3464;
                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
                    $win->push($winCode);
                    $winArr1->push($gameId.$playCate.$playId);
                }
                if($i == 4){
                    $playId = 3465;
                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
                    $win->push($winCode);
                    $winArr1->push($gameId.$playCate.$playId);
                }
                if($i == 5){
                    $playId = 3466;
                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
                    $win->push($winCode);
                    $winArr1->push($gameId.$playCate.$playId);
                }
            }
        }
    }

    private function bunko($win,$lose,$winArr1,$gameId,$issue)
    {
        $BankerNN = Session::get('PKNN_BankerNN');
        $allWin = ["901903462","901903463","901903464","901903465","901903466"];
        $winList = $winArr1->all();
        $loseList = array_diff($allWin,$winList);
        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->get();
        $winArr = [];
        $loseArr = [];

        $sql = "UPDATE bet SET bunko = CASE ";
        foreach ($getUserBets as $item){
            foreach ($win as $k => $v) {
                if($v[0] == $item->play_id){
                    if($v[1] <= 6) {
                        //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*6);
                        $bunko = $item->bet_money*6;
                        $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                        $winArr[] = $item->play_id;
                    }
                    if($v[1] == 7 || $v[1] == 8){
                        //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*7);
                        $bunko = $item->bet_money*7;
                        $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                        $winArr[] = $item->play_id;
                    }
                    if($v[1] == 9){
                        //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*8);
                        $bunko = $item->bet_money*8;
                        $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                        $winArr[] = $item->play_id;
                    }
                    if($v[1] == 10){
                        //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*10);
                        $bunko = $item->bet_money*10 ;
                        $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                        $winArr[] = $item->play_id;
                    }
                }
            }
        }


        $sql_lose = "UPDATE bet SET bunko = CASE ";
        foreach ($getUserBets as $item){
            foreach ($loseList as $k => $v) {
                if($v == $item->play_id){
                    if($BankerNN <= 6){
                        $bunko_lose = $item->bet_money*5 - $item->bet_money;
                        $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    }
                    if($BankerNN == 7 || $BankerNN == 8){
                        $bunko_lose = $item->bet_money*5 - $item->bet_money*2;
                        $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    }
                    if($BankerNN == 9){
                        $bunko_lose = $item->bet_money*5 - $item->bet_money*3;
                        $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    }
                    if($BankerNN == 10){
                        $bunko_lose = $item->bet_money*5 - $item->bet_money*5;
                        $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
                    }
                    $loseArr[] = $item->play_id;
                }
            }
        }


        $WinListIn = implode(',', $winArr);
        $LoseListIn = implode(',', $loseArr);
        $sql .= "END WHERE `play_id` IN ($WinListIn) AND `issue` = $issue AND `game_id` = $gameId";
        $sql_lose .= "END WHERE `play_id` IN ($LoseListIn) AND `issue` = $issue AND `game_id` = $gameId";
        $winUpdate = 0;
        if(count($winArr) > 0){
            $run = DB::statement($sql);
            if($run == 1){
                $winUpdate = 1;
            }
        }
        if(count($loseArr) > 0){
            $run2 = DB::statement($sql_lose);
            if($run2 == 1){
                $winUpdate = 1;
            }
        }
        if($winUpdate == 1){
            return 1;
        }
    }

    private function updateUserMoney($gameId,$issue){
        $get = DB::table('bet')->select(DB::raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        $sql = "UPDATE users SET money = money+ CASE id ";
        $users = [];
        foreach ($get as $i){
            $users[] = $i->user_id;
            $sql .= "WHEN $i->user_id THEN $i->s ";
        }
        $ids = implode(',',$users);
        $sql .= "END WHERE id IN ($ids)";
        $up = DB::statement($sql);
        if($up == 1){
            return 1;
        } else {
            \Log::info('更新用户余额，失败！');
        }
    }
}