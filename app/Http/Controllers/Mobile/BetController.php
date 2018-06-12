<?php

namespace App\Http\Controllers\Mobile;

use App\Bets;
use App\Play;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class BetController extends Controller
{
    public function bet(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $data = json_decode($request->get('data'),true);
        $gameId = $data['gameId'];
        $orderIssue = $data['turnNum'];
        $totalNums = $data['totalNums'];
        $totalMoney = $data['totalMoney'];
        $betSrc = $data['betSrc'];
        $order_id = orderNumber();
        $userMoney = $user->money;
        $nowMoney = $userMoney - $totalMoney;
        $testFlag = $user->testFlag;

        if($totalMoney > $userMoney){
            return response()->json([
                'success' => false,
                'msg' => '余额不足',
                'info' => '',
                'code' => 400
            ],500);
        }
        $changeMoney = User::where('id',$user->id)->update([
            'money' => $nowMoney
        ]);
        if($changeMoney == 1){
            $sql = "INSERT INTO bet (order_id,user_id,testFlag,game_id,playcate_id,play_id,play_odds,play_rebate,bet_money,agent_rebate,issue,bunko,created_at,updated_at) VALUES ";
            for($i=0;$i<$totalNums;$i++){
                $betBean_money = $data['betBean_money['.$i.']'];
                $betBean_playId = $data['betBean_playId['.$i.']'];
                $betBean_odds = $data['betBean_odds['.$i.']'];
                $betBean_rebate = $data['betBean_rebate['.$i.']'];
                $getPlayCate = $this->getPlayCate($betBean_playId,$gameId);
                $time = Carbon::now();
                $sql .= "('$order_id','$user->id',$testFlag,'$gameId','$getPlayCate','$betBean_playId','$betBean_odds','$betBean_rebate','$betBean_money',null,'$orderIssue',0,'$time','$time'),";
            }
            $run = DB::statement(rtrim($sql, ',').";");
            if($run == 1){
                return response()->json([
                    'success' => true,
                    'msg' => '',
                    'info' => '',
                    'code' => 200
                ],200);
            } else {
                return response()->json([
                    'success' => false,
                    'msg' => '下注失败',
                    'info' => '',
                    'code' => 400
                ],500);
            }
//            for($i=0;$i<$totalNums;$i++){
//                $betBean_money = $data['betBean_money['.$i.']'];
//                $betBean_playId = $data['betBean_playId['.$i.']'];
//                $betBean_odds = $data['betBean_odds['.$i.']'];
//                $betBean_rebate = $data['betBean_rebate['.$i.']'];
//                //echo "money:".$betBean_money."palyId:".$betBean_playId."odds:".$betBean_odds."rebate:".$betBean_rebate."\n";
//                $bet = new Bets();
//                $bet->order_id = $this->orderNumber();
//                $bet->user_id = $user->id;
//                $bet->game_id = $gameId;
//                $bet->issue = $orderIssue;
//                $bet->bet_money = $betBean_money;
//                //$bet->play_id = $this->getPlay($betBean_playId,$gameId);
//                $bet->play_id = $betBean_playId;
//                $bet->playcate_id = $this->getPlayCate($betBean_playId,$gameId);
//                $bet->play_odds = $betBean_odds;
//                $bet->bunko = 0;
//                $bet->play_rebate = $betBean_rebate;
//                $bet->save();
//            }
        }

        //print_r($betBean);
    }

    //下注记录
    public function getStatBets(Request $request)
    {
        $endDate = strtotime($request->endDate. '23:59:59');
        $startDate = strtotime($request->startDate.' 00:00:00');

//        $betsRecord = Bets::select()
//            ->where(function ($query) use($startDate){
//                if(isset($startDate) && $startDate){
//                    $query->whereRaw('unix_timestamp(created_at) >= '.$startDate);
//                }
//            })
//            ->get();
//        foreach($betsRecord as $item){
//            $data = [
//                'agentOddsMoney' => null,
//                'agentRebateMoney' => null,
//                'awardMoney' => null,
//                'betCount' =>
//            ];
//        }

        return response()->json([
            'data' => [],
            'otherData' => null,
            'totalCount' => 0
        ]);
    }
    
    //即时注单
    public function getNotCount(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $NoCount = DB::table('bet')->select(DB::raw('count(game_id) count, sum(bet_money) as sum, any_value(user_id), any_value(bet_money), any_value(bet_id), any_value(game_id)'))->where('bunko',0)->where('user_id',$user->id)->groupBy('game_id')->get();
        if(count($NoCount) !== 0){
            foreach($NoCount as $item){
                $data[] = [
                    'gameId' => $item->game_id,
                    'totalMoney' => $item->sum,
                    'totalNums' => $item->count
                ];
            }
        } else {
            $data = [];
        }

        return response()->json($data);
    }

    //即时注单详情
    public function getNotcountDetail(Request $request)
    {
        $user = JWTAuth::toUser($request->token);
        $gameId = $request->gameId;

        $betDetail = DB::table('bet')->select('created_at','game_id','bet_id','bet_money','play_odds','order_id','playcate_id','play_id','play_rebate','issue','user_id')->where('bunko',0)->where('user_id',$user->id)->where('game_id',$gameId)->get();
        foreach($betDetail as $item){
            $data[] = [
                'addTime' => $item->created_at,
                'formatAddTime' => date('m-d H:i'),
                'gameId' => $item->game_id,
                'id' => $item->bet_id,
                'money' => $item->bet_money,
                'odds' => $item->play_odds,
                'orderNo' => $item->order_id,
                'playCateId' => $item->playcate_id,
                'playId' => $item->play_id,
                'rebate' => $item->play_rebate,
                'resultMoney' => ($item->bet_money * $item->play_odds) - $item->bet_money,
                'turnNum' => $item->issue,
                'unbalancedMoney' => ($item->bet_money * $item->play_odds) - $item->bet_money,
                'userId' => $item->user_id,
                'userName' => $user->username,
                'winMoney' => $item->bet_money * $item->play_odds
            ];
        }

        $betDetailCount = DB::table('bet')->where('bunko',0)->where('user_id',$user->id)->where('game_id',$gameId)->count();
        $totalBetMoney = DB::table('bet')->where('bunko',0)->where('user_id',$user->id)->where('game_id',$gameId)->sum("bet_money");

        return response()->json([
            'data' => $data,
            'otherData' => [
                'totalBetMoney' => $totalBetMoney,
                'totalResultMoney' => ''
            ],
            'totalCount' => $betDetailCount
        ]);
    }

    function getPlayCate($playId,$gameId){
        if($gameId == 80 || $gameId == 82 || $gameId == 50 || $gameId == 81){
            $playCate = substr($playId,2,3);
        }
        if($gameId == 1){
            $playCate = substr($playId,1,1);
        }
        return $playCate;
    }

    function getPlay($playId,$gameId){
        if($gameId == 80 || $gameId == 82 || $gameId == 50 || $gameId == 81){
            $play = substr($playId,5,4);
        }
        return $play;
    }
}
