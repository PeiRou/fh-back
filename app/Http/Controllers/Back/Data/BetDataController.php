<?php

namespace App\Http\Controllers\Back\Data;

use App\Bets;
use App\Games;
use App\Play;
use App\PlayCates;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class BetDataController extends Controller
{
    public function betToday(Request $request)
    {
        $searchType = $request->get('searchType');
        $game = $request->get('game');
        $playCate = $request->get('playCate');
        $issue = $request->get('issue');
        $status = $request->get('status');
        $username = $request->get('username');
        $order = $request->get('order');
        $minMoney = $request->get('minMoney');
        $maxMoney = $request->get('maxMoney');
        $timeStart = strtotime($request->get('timeStart')." 00:00:00");
        $timeEnd = strtotime($request->get('timeEnd')." 23:59:59");

        $bet = DB::table('bet')
            ->leftJoin('game','bet.game_id','=','game.game_id')
            ->leftJoin('users','bet.user_id','=','users.id')
            ->select('users.username as users_username','game.game_name as game_game_name','bet.color as bet_color','bet.issue as bet_issue','bet.bet_money as bet_bet_money','bet.game_id as bet_game_id','bet.playcate_name as bet_playcate_name','bet.play_name as bet_play_name','bet.play_odds as bet_play_odds','bet.agnet_odds as bet_agnet_odds','bet.agent_rebate as bet_agent_rebate','bet.bunko as bet_bunko','bet.order_id as bet_order_id','bet.created_at as bet_created_at')
            ->where(function ($query) use ($searchType){
                if(isset($searchType) && $searchType){
                    if($searchType == 'yestoday'){
                        $yesterday = Carbon::now()->addDays(-1)->toDateString();
                        $query->whereDate('bet.created_at',$yesterday);
                    }
                } else {
                    $now = date('Y-m-d');
                    $query->whereDate('bet.created_at',$now);
                }
            })
            ->where(function ($query) use($status){
                if($status && isset($status)){
                    if($status == 'weijiesuan'){
                        $query->where("bet.bunko",'=',0);
                    } else if($status == 'jiesuan'){
                        $query->where("bet.bunko",'!=',0);
                    } else {
                        $query->where("bet.bunko",'=',-8888);
                    }
                }
            })
            ->where(function ($query) use ($game){
                if(isset($game) && $game){
                    $query->where("bet.game_id",$game);
                }
            })
            ->where(function ($query) use ($playCate){
                if(isset($playCate) && $playCate){
                    $query->where("bet.playcate_id",$playCate);
                }
            })
            ->where(function ($query) use ($issue){
                if(isset($issue) && $issue){
                    $query->where("bet.issue",$issue);
                }
            })
            ->where(function ($query) use ($order){
                if(isset($order) && $order){
                    $query->where("bet.order_id",$order);
                }
            })
//            ->where(function ($query) use ($minMoney){
//                if(isset($minMoney) && $minMoney){
//                    $query->where("bet.bet_money",'>=',$minMoney);
//                }
//            })
//            ->where(function ($query) use ($maxMoney){
//                if(isset($maxMoney) && $maxMoney){
//                    $query->where("bet.bet_money",'<=',$maxMoney);
//                }
//            })
//            ->where(function ($query) use ($timeStart){
//                if(isset($timeStart) && $timeStart){
//                    $query->whereRaw('unix_timestamp(bet.created_at) >= '.$timeStart);
//                }
//            })
//            ->where(function ($query) use ($timeEnd){
//                if(isset($timeEnd) && $timeEnd){
//                    $query->whereRaw('unix_timestamp(bet.created_at) <= '.$timeEnd);
//                }
//            })
//            ->where(function ($query) use ($username){
//                if(isset($username) && $username){
//                    $query->where("users.username",$username);
//                }
//            })
//            ->where(function ($query) use ($status){
//                if(isset($status) && $status){
//                    if($status == 'weijiesuan'){
//                        $query->where("bet.bunko",'=',0);
//                    }
//                    if($status == 'jiesuan'){
//                        $query->where("bet.bunko",'!=',0);
//                    }
//                    if($status == '-8888'){
//                        $query->where("bet.bunko",'=',-8888);
//                    }
//                }
//            })
            ->where('bet.testFlag',0)->orderBy('bet.created_at','desc')->get();
        return DataTables::of($bet)
            ->editColumn('order_id',function ($bet){
                return $bet->bet_order_id;
            })
            ->editColumn('created_at',function ($bet){
                return $bet->bet_created_at;
            })
            ->editColumn('user',function ($bet){
                if($bet->users_username){
                    return $bet->users_username;
                } else {
                    return "<span class='red-text'>用户不存在,请核实</span>";
                }
            })
            ->editColumn('game',function ($bet){
                return $bet->game_game_name;
            })
            ->editColumn('issue',function ($bet){
                return '<span style="color: #'.$bet->bet_color.'">'.$bet->bet_issue.'</span> 期';
            })
            ->editColumn('bet_money',function ($bet){
                return "<span class='bet-text'>$bet->bet_bet_money</span>";
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span>";
            })
            ->editColumn('agnet_odds',function ($bet){
                if($bet->bet_agnet_odds == ""){
                    return "--";
                } else {
                    return $bet->bet_agnet_odds;
                }
            })
            ->editColumn('agent_rebate',function ($bet){
                if($bet->bet_agent_rebate == ""){
                    return "--";
                } else {
                    return $bet->bet_agent_rebate;
                }
            })
            ->editColumn('bunko',function ($bet){
                if($bet->bet_bunko == 0){
                    return "<span class='tiny-blue-text'>未结算</span>";
                } else {
                    if($bet->bet_bunko > 0){
                        $lastMoney = $bet->bet_bunko - $bet->bet_bet_money;
                        return "<span class='blue-text'><b>$lastMoney</b></span>";
                    }
                    if($bet->bet_bunko < 0){
                        return "<span class='red-text'><b>$bet->bet_bunko</b></span>";
                    }
                }
            })
            ->editColumn('control',function ($bet){
                return "取消注单";
            })
            ->rawColumns(['user','play','issue','bunko','bet_money'])
            ->make(true);
    }
    
    //历史注单
    public function betHistory(Request $request)
    {
        $startSearch = $request->get('startSearch');
        $game = $request->get('game');
        $playCate = $request->get('playCate');
        $issue = $request->get('issue');
        $status = $request->get('status');
        $username = $request->get('username');
        $order = $request->get('order');
        $timeStart = strtotime($request->get('timeStart')." 00:00:00");
        $timeEnd = strtotime($request->get('timeEnd')." 23:59:59");

        if($startSearch == 1){
            $bet = Bets::select()
                ->where(function ($query) use ($playCate){
                    if(isset($playCate) && $playCate){
                        $query->where("playcate_id",$playCate);
                    }
                })
                ->where(function ($query) use ($game){
                    if(isset($game) && $game){
                        $query->where("game_id",$game);
                    }
                })
                ->where(function ($query) use ($issue){
                    if(isset($issue) && $issue){
                        $query->where("issue",$issue);
                    }
                })
                ->where(function ($query) use ($order){
                    if(isset($order) && $order){
                        $query->where("order_id",$order);
                    }
                })
                ->where(function ($query) use ($timeStart){
                    if(isset($timeStart) && $timeStart){
                        $query->whereRaw('unix_timestamp(created_at) >= '.$timeStart);
                    }
                })
                ->where(function ($query) use ($timeEnd){
                    if(isset($timeEnd) && $timeEnd){
                        $query->whereRaw('unix_timestamp(created_at) <= '.$timeEnd);
                    }
                })
                ->where(function ($query) use ($username){
                    if(isset($username) && $username){
                        $findUserid = User::where('username',$username)->first();
                        if($findUserid){
                            $query->where("user_id",$findUserid->id);
                        }
                    }
                })
                ->where(function ($query) use ($status){
                    if(isset($status) && $status){
                        if($status == 'jiesuan'){
                            $query->where("bunko",'!=',0);
                        }
                        if($status == '-8888'){
                            $query->where("bunko",'=',-8888);
                        }
                    }
                })
                ->where('testFlag',0)->orderBy('created_at','desc')->get();
        } else {
            $bet = Bets::where('order_id',888888)->get();
        }
        return DataTables::of($bet)
            ->editColumn('user',function ($bet){
                $user = User::where('id',$bet->user_id)->first();
                if($user){
                    return $user->username;
                } else {
                    return "<span class='red-text'>用户不存在,请核实</span>";
                }
            })
            ->editColumn('game',function ($bet){
                $game = Games::where('game_id',$bet->game_id)->first();
                return $game->game_name;
            })
            ->editColumn('issue',function ($bet){
                return '<span style="color: #'.$bet->color.'">'.$bet->issue.'</span> 期';
            })
            ->editColumn('bet_money',function ($bet){
                return "<span class='bet-text'>$bet->bet_money</span>";
            })
            ->editColumn('play',function ($bet){
                if($bet->game_id == 1){
                    $weishu = strlen((int)$bet->game_id.$bet->playcate_id);
                    $playid_weishu = strlen((int)$bet->play_id);
                    $playCate = $bet->playcate_id;
                    $play = substr($bet->play_id,$weishu,$playid_weishu-$weishu);
                }
                if($bet->game_id == 80 || $bet->game_id == 81 || $bet->game_id == 82 || $bet->game_id == 99 || $bet->game_id == 90 || $bet->game_id == 91){
                    $playCate = substr($bet->play_id,2,3);
                    $play = substr($bet->play_id,5,4);
                }
                if($bet->game_id == 50){
                    $playCate = substr($bet->play_id,2,2);
                    $play = substr($bet->play_id,4,3);
                }
                if($bet->game_id == 85){
                    $playCate = substr($bet->play_id,2,3);
                    $play = substr($bet->play_id,5,4);
                }
                if($bet->game_id == 70){
                    $playCate = substr($bet->play_id,2,2);
                    $play = substr($bet->play_id,4,4);
                }
                if($bet->game_id == 66 || $bet->game_id == 65){
                    $playCate = substr($bet->play_id,2,2);
                    $play = substr($bet->play_id,4,4);
                }
                $cate_txt = PlayCates::where('gameId',$bet->game_id)->where('id',$playCate)->first();
                $play_txt = Play::where('gameId',$bet->game_id)->where('id',$play)->first();
                return "<span class='blue-text'>$cate_txt->name - </span><span class='blue-text'>$play_txt->name</span> @ <span class='red-text'>$bet->play_odds</span>";
            })
            ->editColumn('agnet_odds',function ($bet){
                if($bet->agnet_odds == ""){
                    return "--";
                } else {
                    return $bet->agnet_odds;
                }
            })
            ->editColumn('agent_rebate',function ($bet){
                if($bet->agent_rebate == ""){
                    return "--";
                } else {
                    return $bet->agent_rebate;
                }
            })
            ->editColumn('bunko',function ($bet){
                if($bet->bunko == 0){
                    return "<span class='tiny-blue-text'>未结算</span>";
                } else {
                    if($bet->bunko > 0){
                        $lastMoney = $bet->bunko - $bet->bet_money;
                        return "<span class='blue-text'><b>$lastMoney</b></span>";
                    }
                    if($bet->bunko < 0){
                        return "<span class='red-text'><b>$bet->bunko</b></span>";
                    }
                }
            })
            ->rawColumns(['user','play','issue','bunko','bet_money'])
            ->make(true);
    }
    
    //实时滚单
    public function betRealTime(Request $request)
    {
        $games = $request->get('games');
        $issue = $request->get('issue');
        $username = $request->get('username');
        $minMoney = $request->get('minMoney');
        if(isset($games) && $games){
            $foreach = explode(',',implode(',',$games));
            $q = '';
            foreach($foreach as $item){
                $q .= 'game_id = "'.$item.'" and ';
            }
        } else {
            $q = '';
        }

        $bet = Bets::select()
            ->where(function ($query) use ($games,$q){
                if(isset($games) && $games){
                    $query->whereRaw(rtrim($q,'and '));
                }
            })
            ->where(function ($query) use ($issue){
                if(isset($issue) && $issue){
                    $query->where('issue',$issue);
                }
            })
            ->where(function ($query) use ($username){
                if(isset($username) && $username){
                    $findUserid = User::where('username',$username)->first();
                    if($findUserid){
                        $query->where("user_id",$findUserid->id);
                    }
                }
            })
            ->where(function ($query) use ($minMoney){
                if(isset($minMoney) && $minMoney){
                    $query->where('bet_money','>=',$minMoney);
                }
            })
            ->where('testFlag',0)->where('bunko',0)->orderBy('created_at','desc')->get();
        return DataTables::of($bet)
            ->editColumn('user',function ($bet){
                $user = User::where('id',$bet->user_id)->first();
                if($user){
                    return $user->username;
                } else {
                    return "<span class='red-text'>用户不存在,请核实</span>";
                }
            })
            ->editColumn('game',function ($bet){
                $game = Games::where('game_id',$bet->game_id)->first();
                return $game->game_name;
            })
            ->editColumn('issue',function ($bet){
                return '<span style="color: #'.$bet->color.'">'.$bet->issue.'</span> 期';
            })
            ->editColumn('bet_money',function ($bet){
                return "<span class='bet-text'>$bet->bet_money</span>";
            })
            ->editColumn('bet_rebate',function ($bet){
                return "<span class='bet-text'>$bet->play_rebate</span>";
            })
            ->editColumn('play',function ($bet){
                if($bet->game_id == 1){
                    $weishu = strlen((int)$bet->game_id.$bet->playcate_id);
                    $playid_weishu = strlen((int)$bet->play_id);
                    $playCate = $bet->playcate_id;
                    $play = substr($bet->play_id,$weishu,$playid_weishu-$weishu);
                }
                if($bet->game_id == 80 || $bet->game_id == 81 || $bet->game_id == 82 || $bet->game_id == 99 || $bet->game_id == 90 || $bet->game_id == 91){
                    $playCate = substr($bet->play_id,2,3);
                    $play = substr($bet->play_id,5,4);
                }
                if($bet->game_id == 70){
                    $playCate = substr($bet->play_id,2,2);
                    $play = substr($bet->play_id,4,4);
                }
                if($bet->game_id == 85){
                    $playCate = substr($bet->play_id,2,3);
                    $play = substr($bet->play_id,5,4);
                }
                if($bet->game_id == 50){
                    $playCate = substr($bet->play_id,2,2);
                    $play = substr($bet->play_id,4,3);
                }
                if($bet->game_id == 66 || $bet->game_id == 65){
                    $playCate = substr($bet->play_id,2,2);
                    $play = substr($bet->play_id,4,4);
                }
                $cate_txt = PlayCates::where('gameId',$bet->game_id)->where('id',$playCate)->first();
                $play_txt = Play::where('gameId',$bet->game_id)->where('id',$play)->first();
                return "<span class='blue-text'>$cate_txt->name - </span><span class='blue-text'>$play_txt->name</span> @ <span class='red-text'>$bet->play_odds</span>";
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','bet_rebate'])
            ->make(true);
    }
    
    //用户注单-独占页面
    public function userBetSearch(Request $request)
    {
        $games = $request->get('games');
        $userId = $request->get('userId');
        $date = $request->get('date');
        $status = $request->get('status');
        $user = DB::table('users')->where('id',$userId)->first();
//        return count($games);
        $bet = DB::table('bet')
            ->leftJoin('game','bet.game_id','=','game.game_id')
            ->select('bet.order_id as bet_order_id','game.game_name as g_game_name','bet.color as bet_color','bet.issue as bet_issue','bet.playcate_id as bet_playcate_id','bet.play_id as bet_play_id','bet.bet_money as bet_bet_money','bet.bunko as bet_bunko','bet.created_at as bet_created_at','bet.play_odds as bet_play_odds','bet.playcate_name as bet_playcate_name','bet.play_name as bet_play_name','bet.platform as bet_platform')
            ->where(function ($query) use ($games){
                if(count($games) !== 0){
                    foreach ($games as $item){
                        $query->orWhere("bet.game_id",$item);
                    }
                }
            })
            ->where(function ($query) use ($date){
                if(isset($date) && $date){
                    if($date == 'today'){
                        $query->whereDate('bet.created_at',date('Y-m-d'));
                    }
                    if($date == 'yesterday'){
                        $yesterday = Carbon::now()->addDays(-1)->toDateString();
                        $query->whereDate('bet.created_at',$yesterday);
                    }
                    if($date == 'history'){

                    }
                }
            })
            ->where('bet.user_id',$userId)->orderBy('bet.created_at','desc')->get();
        return DataTables::of($bet)
            ->editColumn('order_id',function ($bet){
                return '<span>'.$bet->bet_order_id.'</span>';
            })
            ->editColumn('user',function ($bet) use ($user){
                return '<span>'.$user->username.'</span>';
            })
            ->editColumn('created_at',function ($bet) {
                return $bet->bet_created_at;
            })
            ->editColumn('game',function ($bet){
                return '<span>'.$bet->g_game_name.'</span>';
            })
            ->editColumn('issue',function ($bet){
                return '<span style="color: #'.$bet->bet_color.'">'.$bet->bet_issue.'</span>';
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span>";
            })
            ->editColumn('rebate',function ($bet){
                return '0';
            })
            ->editColumn('bet_money',function ($bet){
                return '<span><b>'.$bet->bet_bet_money.'</b></span>';
            })
            ->editColumn('platform',function ($bet){
                if($bet->bet_platform == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                } else if($bet->bet_platform == 2){
                    return "<i class='iconfont'>&#xe686;</i> 移动端";
                } else {
                    return "--";
                }
            })
            ->editColumn('none1',function ($bet){
                return '-';
            })
            ->editColumn('none2',function ($bet){
                return '-';
            })
            ->editColumn('bunko',function ($bet){
                if($bet->bet_bunko == 0){
                    return '<span class="gary-text">未结算</span>';
                }
                if($bet->bet_bunko < 0){
                    return '<span class="red-text">'.$bet->bet_bunko.'</span>';
                } else {
                    return '<span class="blue-text">'.$bet->bet_bunko.'</span>';
                }
            })
            ->editColumn('dongjie',function ($bet){
                return '0';
            })
            ->editColumn('jiedong',function ($bet){
                return '0';
            })
            ->rawColumns(['order_id','user','game','issue','play','bunko','bet_money','platform'])
            ->make(true);
    }

    private function play($gameId,$playCate,$play,$odds){
        $cate_txt = PlayCates::where('gameId',$gameId)->where('id',$playCate)->first();
        $play_txt = Play::where('gameId',$gameId)->where('id',$play)->first();
        return "<span class='blue-text'>$cate_txt->name - </span><span class='blue-text'>$play_txt->name</span> @ <span class='red-text'>$odds</span>";
    }
}
