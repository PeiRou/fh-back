<?php

namespace App\Http\Controllers\Mobile;

use App\Bets;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class MoneyController extends Controller
{
    public function getMoney(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        return $user->money;
    }

    public function getLotteryData(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $gameId = $request->gameId;
        $unbalancedMoney = DB::table('bet')->where('user_id',$user->id)->where('bunko',0)->sum('bet_money');
        $today_begin = Carbon::parse(date('Y-m-d 00:00:00'));
        $today_end = Carbon::parse(date('Y-m-d 23:59:59'));
        $winMoney = Bets::where('user_id',$user->id)->where('game_id',$gameId)->where('created_at','>',$today_begin)->where('created_at','<',$today_end)->get();
        $win1 = 0;
        $win2 = 0;
        foreach($winMoney as $item){
            if($item->bunko < 0){
                $win1 += $item->bunko;
            }
            if($item->bunko > 0){
                $win2 += $item->bunko - $item->bet_money;
            }
        }
        $winTotal = $win1 + $win2;
        return response()->json([
            'unbalancedMoney' => $unbalancedMoney,
            'winMoney' => sprintf('%.3d',$winTotal)
        ]);
    }

    public function getSettled(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $today_begin = Carbon::parse(date('Y-m-d 00:00:00'));
        $today_end = Carbon::parse(date('Y-m-d 23:59:59'));
        $row = $request->rows;
        $settled = Bets::where('user_id',$user->id)->where('created_at','>',$today_begin)->where('created_at','<',$today_end)->where('bunko','!=',0)->orderBy('created_at','desc')->paginate($row);
        if(count($settled) !== 0){
            foreach($settled as $item){
                if($item->bunko > 0){
                    $resultMoney = $item->bunko - $item->bet_money;
                } else {
                    $resultMoney = $item->bunko;
                }
                $data[] = [
                    'addTime' => $item->created_at,
                    'formatAddTime' => date('m-d H:i',strtotime($item->created_at)),
                    'gameId' => $item->game_id,
                    'id' => $item->bet_id,
                    'money' => $item->bet_money,
                    'odds' => $item->play_odds,
                    'orderNo' => $item->order_id,
                    'betInfo' => "",
                    'playCateId' => $item->playcate_id,
                    'playId' => $item->play_id,
                    'rebate' => $item->play_rebate,
                    'rebateDouble' => $item->play_rebate,
                    'rebateMoney' => 0,
                    'resultMoney' => $resultMoney,
                    'rewardRebate' => $item->bunko,
                    'rewardRebateDouble' => $item->bunko,
                    'status' => 1,
                    'reward' => $item->bunko,
                    'turnNum' => $item->issue,
                    'unbalancedMoney' => ($item->bet_money * $item->play_odds)-$item->bet_money,
                    'userId' => $user->id,
                    'winMoney' => $item->bet_money * $item->play_odds
                ];
            }
        } else {
            $data = [];
        }

        $totalCount = Bets::where('user_id',$user->id)->where('created_at','>',$today_begin)->where('created_at','<',$today_end)->count();
        $totalBetMoney = Bets::where('user_id',$user->id)->where('created_at','>',$today_begin)->where('created_at','<',$today_end)->sum('bet_money');
        $winMoney = Bets::where('user_id',$user->id)->where('created_at','>',$today_begin)->where('created_at','<',$today_end)->get();
        $win1 = 0;
        $win2 = 0;
        foreach($winMoney as $item){
            if($item->bunko < 0){
                $win1 += $item->bunko;
            }
            if($item->bunko > 0){
                $win2 += $item->bunko - $item->bet_money;
            }
        }

        $winTotal = $win1 + $win2;
        return response()->json([
            'data' => $data,
            'otherData' => [
                'totalBetMoney' => $totalBetMoney,
                'totalRebateMoney' => 0,
                'totalResultMoney' => number_format($winTotal,3)
            ],
            'totalCount' => $totalCount
        ]);
    }
}
