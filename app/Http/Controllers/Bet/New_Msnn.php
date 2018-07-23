<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 2018/5/21
 * Time: 下午7:28
 */

namespace App\Http\Controllers\Bet;


use App\Bets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class New_Msnn
{
    public function all($openCode,$nn,$issue,$gameId)
    {
        $win = collect([]);
        $lose = collect([]);
        $this->NN($openCode,$nn,$gameId,$win,$lose);
//        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
//        if($betCount > 0){
//            $bunko = $this->bunko($win,$lose,$winArr1,$gameId,$issue);
//            if($bunko == 1){
//                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
//                if($updateUserMoney == 1){
//                    return 1;
//                }
//            }
//        }
    }

    public function NN($openCode,$nn,$gameId,$win,$lose)
    {
//        $nn = '7,3,-1,9,7,8';
//        $openCode = '3,2,4,8,10,9,5,7,6,1';
        \Log::info($openCode);
        \Log::info($nn);

        $niuniuArr = explode(',',$nn); //分割牛牛结果
        $explodeNum = explode(',',$openCode); //分割秒速赛车开奖结果
        $playCate = 189; //秒速牛牛玩法大类ID
        $allWin = [911893457,911893458,911893459,911893460,911893461];

        $banker_nn = $niuniuArr[0];
        $player1_nn = $niuniuArr[1];
        $player2_nn = $niuniuArr[2];
        $player3_nn = $niuniuArr[3];
        $player4_nn = $niuniuArr[4];
        $player5_nn = $niuniuArr[5];

        if((int)$banker_nn > (int)$player1_nn){
            $lose->push(911893457);
            \Log::info('闲一输');
        } else if((int)$banker_nn == (int)$player1_nn && (int)$banker_nn <= 6){
            $lose->push(911893457);
            \Log::info('闲一输');
        } else if((int)$banker_nn == (int)$player1_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[1]){
            $lose->push(911893457);
            \Log::info('闲一输');
        } else {
            $win->push(911893457);
            \Log::info('闲一赢');
        }

        if((int)$banker_nn > (int)$player2_nn){
            $lose->push(911893458);
            \Log::info('闲二输');
        } else if((int)$banker_nn == (int)$player2_nn && (int)$banker_nn <= 6){
            $lose->push(911893458);
            \Log::info('闲二输');
        } else if((int)$banker_nn == (int)$player2_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[2]){
            $lose->push(911893458);
            \Log::info('闲二输');
        } else {
            $win->push(911893458);
            \Log::info('闲二赢');
        }

        if((int)$banker_nn > (int)$player3_nn){
            $lose->push(911893459);
            \Log::info('闲三输');
        } else if((int)$banker_nn == (int)$player3_nn && (int)$banker_nn <= 6){
            $lose->push(911893459);
            \Log::info('闲三输');
        } else if((int)$banker_nn == (int)$player3_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[3]){
            $lose->push(911893459);
            \Log::info('闲三输');
        } else {
            $win->push(911893459);
            \Log::info('闲三赢');
        }

        if((int)$banker_nn > (int)$player4_nn){
            $lose->push(911893460);
            \Log::info('闲四输');
        } else if((int)$banker_nn == (int)$player4_nn && (int)$banker_nn <= 6){
            $lose->push(911893460);
            \Log::info('闲四输');
        } else if((int)$banker_nn == (int)$player4_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[4]){
            $lose->push(911893460);
            \Log::info('闲四输');
        } else {
            $win->push(911893460);
            \Log::info('闲四赢');
        }

        if((int)$banker_nn > (int)$player5_nn){
            $lose->push(911893461);
            \Log::info('闲五输');
        } else if((int)$banker_nn == (int)$player5_nn && (int)$banker_nn <= 6){
            $lose->push(911893461);
            \Log::info('闲五输');
        } else if((int)$banker_nn == (int)$player5_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[5]){
            $lose->push(911893461);
            \Log::info('闲五输');
        } else {
            $win->push(911893461);
            \Log::info('闲五赢');
        }

        \Log::info('赢'.$win);
        \Log::info('输'.$lose);

    }

//    private function NN($openCode,$nn,$gameId,$win,$lose,$winArr1)
//    {
//        $niuniuArr = explode(',',$nn);
//        $replace = str_replace('10','0',$openCode);
//        $explodeNum = explode(',',$replace);
//        $playCate = 189;
//        $banker = (int)$explodeNum[0].','.(int)$explodeNum[1].','.(int)$explodeNum[2].','.(int)$explodeNum[3].','.(int)$explodeNum[4];
//        $player1 = (int)$explodeNum[1].','.(int)$explodeNum[2].','.(int)$explodeNum[3].','.(int)$explodeNum[4].','.(int)$explodeNum[5];
//        $player2 = (int)$explodeNum[2].','.(int)$explodeNum[3].','.(int)$explodeNum[4].','.(int)$explodeNum[5].','.(int)$explodeNum[6];
//        $player3 = (int)$explodeNum[3].','.(int)$explodeNum[4].','.(int)$explodeNum[5].','.(int)$explodeNum[6].','.(int)$explodeNum[7];
//        $player4 = (int)$explodeNum[4].','.(int)$explodeNum[5].','.(int)$explodeNum[6].','.(int)$explodeNum[7].','.(int)$explodeNum[8];
//        $player5 = (int)$explodeNum[5].','.(int)$explodeNum[6].','.(int)$explodeNum[7].','.(int)$explodeNum[8].','.(int)$explodeNum[9];
//
//        $arr = [
//            [explode(",",$banker),$niuniuArr[0],0],
//            [explode(",",$player1),$niuniuArr[1],0],
//            [explode(",",$player2),$niuniuArr[2],0],
//            [explode(",",$player3),$niuniuArr[3],0],
//            [explode(",",$player4),$niuniuArr[4],0],
//            [explode(",",$player5),$niuniuArr[5],0],
//        ];
//        $index = 0;
//        for($i=0;$i<count($arr);$i++)
//        {
//            $bankerNN = $arr[0][1];
//            Session::put('BankerNN',$arr[0][1]);
//            $playerNN = $arr[$i][1];
//            if($i!==0 && (($playerNN > $bankerNN) || (($playerNN == $bankerNN) && ($bankerNN > 6) && ($arr[$i][0][0] > $arr[0][0][0])))){
//                $arr[$i][2] = 1;
//                $index++;
//                if($i == 1){
//                    $playId = 3457;
//                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
//                    $win->push($winCode);
//                    $winArr1->push($gameId.$playCate.$playId);
//                }
//                if($i == 2){
//                    $playId = 3458;
//                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
//                    $win->push($winCode);
//                    $winArr1->push($gameId.$playCate.$playId);
//                }
//                if($i == 3){
//                    $playId = 3459;
//                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
//                    $win->push($winCode);
//                    $winArr1->push($gameId.$playCate.$playId);
//                }
//                if($i == 4){
//                    $playId = 3460;
//                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
//                    $win->push($winCode);
//                    $winArr1->push($gameId.$playCate.$playId);
//                }
//                if($i == 5){
//                    $playId = 3461;
//                    $winCode = [$gameId.$playCate.$playId,$arr[$i][1]];
//                    $win->push($winCode);
//                    $winArr1->push($gameId.$playCate.$playId);
//                }
//            }
//        }
////        \Log::info('开奖号码：'.$openCode);
////        \Log::info('Win：'.$win);
////        \Log::info('WinArr1：'.$winArr1);
//    }
//
//    private function bunko($win,$lose,$winArr1,$gameId,$issue)
//    {
//        $BankerNN = Session::get('BankerNN');
//        $allWin = ["911893457","911893458","911893459","911893460","911893461"];
//        $winList = $winArr1->all();
//        $loseList = array_diff($allWin,$winList);
//        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
//        if($getUserBets){
//            $winArr = [];
//            $loseArr = [];
//
//            $sql = "UPDATE bet SET bunko = CASE ";
//            foreach ($getUserBets as $item){
//                foreach ($win as $k => $v) {
//                    if($v[0] == $item->play_id){
//                        if($v[1] <= 6) {
//                            //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*6);
//                            $bunko = $item->bet_money*6;
//                            $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
//                            $winArr[] = $item->play_id;
//                        }
//                        if($v[1] == 7 || $v[1] == 8){
//                            //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*7);
//                            $bunko = $item->bet_money*7;
//                            $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
//                            $winArr[] = $item->play_id;
//                        }
//                        if($v[1] == 9){
//                            //\Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*8);
//                            $bunko = $item->bet_money*8;
//                            $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
//                            $winArr[] = $item->play_id;
//                        }
//                        if($v[1] == 10){
//                            // \Log::info('中了'.$item->bet_id.'牛：'.$v[1].'输赢：'.$item->bet_money*10);
//                            $bunko = $item->bet_money*10 ;
//                            $sql .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
//                            $winArr[] = $item->play_id;
//                        }
//                    }
//                }
//            }
//
//
//            $sql_lose = "UPDATE bet SET bunko = CASE ";
//            foreach ($getUserBets as $item){
//                foreach ($loseList as $k => $v) {
//                    if($v == $item->play_id){
//                        if($BankerNN <= 6){
//                            $bunko_lose = $item->bet_money*5 - $item->bet_money;
//                            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
//                        }
//                        if($BankerNN == 7 || $BankerNN == 8){
//                            $bunko_lose = $item->bet_money*5 - $item->bet_money*2;
//                            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
//                        }
//                        if($BankerNN == 9){
//                            $bunko_lose = $item->bet_money*5 - $item->bet_money*3;
//                            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
//                        }
//                        if($BankerNN == 10){
//                            $bunko_lose = $item->bet_money*5 - $item->bet_money*5;
//                            $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko_lose ";
//                        }
//                        $loseArr[] = $item->play_id;
//                    }
//                }
//            }
//
//
//            $WinListIn = implode(',', $winArr);
//            $LoseListIn = implode(',', $loseArr);
//            $sql .= "END WHERE `play_id` IN ($WinListIn) AND `issue` = $issue AND `game_id` = $gameId";
//            $sql_lose .= "END WHERE `play_id` IN ($LoseListIn) AND `issue` = $issue AND `game_id` = $gameId";
//            $winUpdate = 0;
//            if(count($winArr) > 0){
//                $run = DB::statement($sql);
//                if($run == 1){
//                    $winUpdate = 1;
//                }
//            }
//            if(count($loseArr) > 0){
//                $run2 = DB::statement($sql_lose);
//                if($run2 == 1){
//                    $winUpdate = 1;
//                }
//            }
//            if($winUpdate == 1){
//                return 1;
//            }
//        }
//    }
//
//    private function updateUserMoney($gameId,$issue){
//        $get = DB::table('bet')->select(DB::raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
//        $sql = "UPDATE users SET money = money+ CASE id ";
//        $users = [];
//        foreach ($get as $i){
//            $users[] = $i->user_id;
//            $sql .= "WHEN $i->user_id THEN $i->s ";
//        }
//        $ids = implode(',',$users);
//        if($ids && isset($ids)){
//            $sql .= "END WHERE id IN (0,$ids)";
//            $up = DB::statement($sql);
//            if($up == 1){
//                return 1;
//            }
//        }
//    }
}