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
        $betCount = DB::table('bet')->where('issue',$issue)->where('game_id',$gameId)->where('bunko','=',0.00)->count();
        if($betCount > 0){
            $bunko = $this->bunko($win,$lose,$nn,$gameId,$issue);
            if($bunko == 1){
                $updateUserMoney = $this->updateUserMoney($gameId,$issue);
                if($updateUserMoney == 1){
                    \Log::info('秒速牛牛第'.$issue.'已结算');
                    return 1;
                }
            }
        }
    }

    public function NN($openCode,$nn,$gameId,$win,$lose)
    {
        $nn = '10,1,-1,5,6,5';
        $openCode = '9,6,8,4,3,10,1,7,5,2';
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
            $lose->push([911893457,(int)$banker_nn]);
            \Log::info('闲一输');
        } else if((int)$banker_nn == (int)$player1_nn && (int)$banker_nn <= 6){
            $lose->push([911893457,(int)$banker_nn]);
            \Log::info('闲一输');
        } else if((int)$banker_nn == (int)$player1_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[1]){
            $lose->push([911893457,(int)$banker_nn]);
            \Log::info('闲一输');
        } else {
            $win->push([911893457,(int)$player1_nn]);
            \Log::info('闲一赢');
        }

        if((int)$banker_nn > (int)$player2_nn){
            $lose->push([911893458,(int)$banker_nn]);
            \Log::info('闲二输');
        } else if((int)$banker_nn == (int)$player2_nn && (int)$banker_nn <= 6){
            $lose->push([911893458,(int)$banker_nn]);
            \Log::info('闲二输');
        } else if((int)$banker_nn == (int)$player2_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[2]){
            $lose->push([911893458,(int)$banker_nn]);
            \Log::info('闲二输');
        } else {
            $win->push([911893458,(int)$player2_nn]);
            \Log::info('闲二赢');
        }

        if((int)$banker_nn > (int)$player3_nn){
            $lose->push([911893459,(int)$banker_nn]);
            \Log::info('闲三输');
        } else if((int)$banker_nn == (int)$player3_nn && (int)$banker_nn <= 6){
            $lose->push([911893459,(int)$banker_nn]);
            \Log::info('闲三输');
        } else if((int)$banker_nn == (int)$player3_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[3]){
            $lose->push([911893459,(int)$banker_nn]);
            \Log::info('闲三输');
        } else {
            $win->push([911893459,(int)$player3_nn]);
            \Log::info('闲三赢');
        }

        if((int)$banker_nn > (int)$player4_nn){
            $lose->push([911893460,(int)$banker_nn]);
            \Log::info('闲四输');
        } else if((int)$banker_nn == (int)$player4_nn && (int)$banker_nn <= 6){
            $lose->push([911893460,(int)$banker_nn]);
            \Log::info('闲四输');
        } else if((int)$banker_nn == (int)$player4_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[4]){
            $lose->push([911893460,(int)$banker_nn]);
            \Log::info('闲四输');
        } else {
            $win->push([911893460,(int)$player4_nn]);
            \Log::info('闲四赢');
        }

        if((int)$banker_nn > (int)$player5_nn){
            $lose->push([911893461,(int)$banker_nn]);
            \Log::info('闲五输');
        } else if((int)$banker_nn == (int)$player5_nn && (int)$banker_nn <= 6){
            $lose->push([911893461,(int)$banker_nn]);
            \Log::info('闲五输');
        } else if((int)$banker_nn == (int)$player5_nn && (int)$banker_nn > 6 && (int)$explodeNum[0] > (int)$explodeNum[5]){
            $lose->push([911893461,(int)$banker_nn]);
            \Log::info('闲五输');
        } else {
            $win->push([911893461,(int)$player5_nn]);
            \Log::info('闲五赢');
        }
    }

    public function bunko($win,$lose,$nn,$gameId,$issue)
    {
        global $index;
        $niuniuArr = explode(',',$nn); //分割牛牛结果
        $banker_nn = $niuniuArr[0];
        $player1_nn = $niuniuArr[1];
        $player2_nn = $niuniuArr[2];
        $player3_nn = $niuniuArr[3];
        $player4_nn = $niuniuArr[4];
        $player5_nn = $niuniuArr[5];

        $loseArr = [];
        $winArr = [];

        $getUserBets = Bets::where('game_id',$gameId)->where('issue',$issue)->where('bunko','=',0.00)->get();
        \Log::info('赢'.$win);
        \Log::info('输'.$lose);
        if($getUserBets){
            $index = 0;
            if(count($win) !== 0){
                $sql_win = "UPDATE bet SET bunko = CASE ";
                $sql_unfreeze_win = "UPDATE bet SET unfreeze_money = CASE ";
                foreach ($getUserBets as $item){
                    foreach ($win as $k=>$v){
                        if($v[0] == $item->play_id){
                            if((int)$v[1] <= 6 || (int)$v[1] <= 6 || (int)$v[1] <= 6 || (int)$v[1] <= 6 || (int)$v[1] <= 6){
                                $bunko = $item->bet_money+$item->bet_money*1;
                                $unfreeze = $item->freeze_money;
                                $sql_win .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_win .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $winArr[] = $item->play_id;
                            }
                            if((int)$v[1] == 7 || (int)$v[1] == 8 || (int)$v[1] == 7 || (int)$v[1] == 8 || (int)$v[1] == 7 || (int)$v[1] == 8 || (int)$v[1] == 7 || (int)$v[1] == 8 || (int)$v[1] == 7 || (int)$v[1] == 8){
                                $bunko = $item->bet_money+$item->bet_money*2;
                                $unfreeze = $item->freeze_money;
                                $sql_win .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_win .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $winArr[] = $item->play_id;
                            }
                            if((int)$v[1] == 9 || (int)$v[1] == 9 || (int)$v[1] == 9 || (int)$v[1] == 9 || (int)$v[1] == 9){
                                $bunko = $item->bet_money+$item->bet_money*3;
                                $unfreeze = $item->freeze_money;
                                $sql_win .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_win .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $winArr[] = $item->play_id;
                            }
                            if((int)$v[1] == 10 || (int)$v[1] == 10 || (int)$v[1] == 10 || (int)$v[1] == 10 || (int)$v[1] == 10){
                                $bunko = $item->bet_money+$item->bet_money*5;
                                $unfreeze = $item->freeze_money;
                                $sql_win .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_win .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $winArr[] = $item->play_id;
                            }
                        }
                    }
                }
                $WinListIn = implode(',', $winArr);
                $sql_win .= "END WHERE `play_id` IN ($WinListIn) AND `issue` = $issue AND `game_id` = $gameId";
                $sql_unfreeze_win .= "END WHERE `play_id` IN ($WinListIn) AND `issue` = $issue AND `game_id` = $gameId";
                $run = DB::statement($sql_win);
                if($run == 1){
                    $run2 = DB::statement($sql_unfreeze_win);
                    if($run2 == 1){
                        return $index++;
                    }
                }
            }

            if(count($lose) !== 0){
                $sql_lose = "UPDATE bet SET bunko = CASE ";
                $sql_unfreeze_lose = "UPDATE bet SET unfreeze_money = CASE ";
                foreach ($getUserBets as $item){
                    foreach ($lose as $k=>$v){
                        if($v[0] == $item->play_id){
                            if($v[1] <= 6){
                                $bunko = ($item->bet_money+$item->freeze_money)-$item->bet_money;
                                $unfreeze = $item->freeze_money;
                                $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_lose .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $loseArr[] = $item->play_id;
                            }
                            if($v[1] == 7 || $v[1] == 8){
                                $bunko = ($item->bet_money+$item->freeze_money)-$item->bet_money*2;
                                $unfreeze = $item->freeze_money - $item->bet_money;
                                $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_lose .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $loseArr[] = $item->play_id;
                            }
                            if($v[1] == 9){
                                $bunko = ($item->bet_money+$item->freeze_money)-$item->bet_money*3;
                                $unfreeze = $item->freeze_money - $item->bet_money*2;
                                $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_lose .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $loseArr[] = $item->play_id;
                            }
                            if($v[1] == 10){
                                $bunko = ($item->bet_money+$item->freeze_money)-$item->bet_money*5;
                                if($bunko == 0){
                                    $bunko = -1;
                                }
                                $unfreeze = 0;
                                $sql_lose .= "WHEN `bet_id` = $item->bet_id THEN $bunko ";
                                $sql_unfreeze_lose .= "WHEN `bet_id` = $item->bet_id THEN $unfreeze ";
                                $loseArr[] = $item->play_id;
                            }
                        }
                    }
                }
                $LoseListIn = implode(',', $loseArr);
                $sql_lose .= "END WHERE `play_id` IN ($LoseListIn) AND `issue` = $issue AND `game_id` = $gameId";
                $sql_unfreeze_lose .= "END WHERE `play_id` IN ($LoseListIn) AND `issue` = $issue AND `game_id` = $gameId";
                $run = DB::statement($sql_lose);
                if($run == 1){
                    $run2 = DB::statement($sql_unfreeze_lose);
                    if($run2 == 1){
                        return $index++;
                    }
                }
            }
        }

        if($index == 1 || $index == 2){
            return 1;
        }
    }

    public function updateUserMoney($gameId,$issue)
    {
        $get = DB::table('bet')->select(DB::raw("sum(bunko) as s"),'user_id')->where('game_id',$gameId)->where('issue',$issue)->where('bunko','>=',0.01)->groupBy('user_id')->get();
        $sql = "UPDATE users SET money = money+ CASE id ";
        $users = [];
        foreach ($get as $i){
            $users[] = $i->user_id;
            $sql .= "WHEN $i->user_id THEN $i->s ";
        }
        $ids = implode(',',$users);
        if($ids && isset($ids)){
            $sql .= "END WHERE id IN (0,$ids)";
            $up = DB::statement($sql);
            if($up == 1){
                return 1;
            }
        }
    }
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