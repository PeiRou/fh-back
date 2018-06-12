<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;
use App\Bets;

class OrderController extends Controller
{

    public function index(Request $request){

        if($request->ajax()){
            $items = $request->input('cartList');
            $_data = [];
            $_money = 0;
            $id     = auth()->user()['id'];
            $testFlag     = auth()->user()['testFlag'];
            foreach ($items as  $k=>$v){
                $_money += (float)$v['count'];
                $_data [] = [
                    'order_id' => orderNumber(),
                    'user_id' => $id ,
                    'testFlag' =>$testFlag,
                    'game_id' => $v['gameId'],  //80 81 82
                    'playcate_id' => $v['playCateId'],
                    'play_id' => $v['id'],
                    'play_odds' => $v['odds'],
                    'play_rebate' => $v['rebate'],
                    'bet_money' => $v['count'],
                    'bunko' => 0 ,
                    'agnet_odds' => '',
                    'agent_rebate' => '',
                    'issue' => $v['expect'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
            }
            $user = User::find($id);
            if($user->money<$_money){
                return  response()->json(['code'=>-1],200);
            }
            $user->money = $user->money - $_money;
            try{
                $result = DB::table('bet')->insert($_data);
                if(!$result){
                    return  response()->json(['code'=>-1],200);
                }
                $user->save();
                return response()->json(['code'=>1],200);
            }catch (\Exception $exception) {
                \Log::info(__CLASS__ . '->' . __FUNCTION__ . ' Line:' . $exception->getLine() . ' ' . $exception->getMessage());
                return  response()->json(['code'=>-1],200);
            }
        }


    }


    public function getUser(Request $request){
        if($request->ajax()){
            $auth = auth()->user();
            $user = User::find($auth['id']);
            $sel_money = Bets::where('user_id',$auth['id'])->where('bunko','=',0)->pluck('bet_money')->sum();
            $data = [
                'user' => $auth['username'],
                'money' =>  $user->money,    //　余额          　
                'sel_money' => $sel_money,  //未结金额
            ];
            return response()->json($data,200);
        }

    }

    /***
     * @param $gameId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOrders($gameId){
        $bets = Bets::where('game_id',$gameId)->where('bunko','=',0)->orderBy('bet_id','DESC')->get(['issue as expect','bet_money as count','play_id as id','play_odds as odds']);
        return response()->json(['orders'=>$bets],200);
    }

    /***
     * @param $gameId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentWin($gameId){
        $sum = Bets::where('game_id',$gameId)->whereBetween('created_at',[Carbon::today()->toDateTimeString(),Carbon::tomorrow()->toDateTimeString()])->where('bunko','!=',0)->pluck('bunko')->sum();
        return response()->json(['money'=>$sum],200);
    }

    /***
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentSelMoneyList(){

        $items = Bets::where('bunko','=',0)->whereBetween('created_at',[Carbon::today()->toDateTimeString(),Carbon::tomorrow()->toDateTimeString()])->orderBy('bet_id','DESC')->get(['order_id','issue','play_id','created_at','game_id','play_odds','play_rebate','bet_money']);

        return response()->json(['list'=>$items,200]);
    }

    /***
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCurrentSettledMoneyList(){

        $items = Bets::where('bunko','=',0)->whereBetween('created_at',[Carbon::today()->toDateTimeString(),Carbon::tomorrow()->toDateTimeString()])->orderBy('bet_id','DESC')->get(['order_id','issue','play_id','created_at','game_id','play_odds','play_rebate','bet_money']);
        return response()->json(['list'=>$items,200]);
    }


}
