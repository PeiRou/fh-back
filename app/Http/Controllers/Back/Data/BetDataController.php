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
        $game = $request->input('game');
        $playCate = (int)$request->input('playCate');
        $issue = (int)$request->input('issue');
        $status = $request->input('status');
        $username = $request->input('username');
        $order = $request->input('order');
        $minMoney = $request->input('minMoney');
        $maxMoney = $request->input('maxMoney');
        $timeStart = $request->input('timeStart');
        $timeEnd = $request->input('timeEnd');
        $markSix = $request->input('markSix');
        $start = $request->input('start');
        $length = $request->input('length');
        $Sql = 'select users.username as users_username,game.game_name as game_game_name,bet.color as bet_color,bet.issue as bet_issue,bet.bet_money as bet_bet_money,bet.game_id as bet_game_id,bet.playcate_name as bet_playcate_name,bet.play_name as bet_play_name,bet.play_odds as bet_play_odds,bet.agnet_odds as bet_agnet_odds,bet.agent_rebate as bet_agent_rebate,bet.bunko as bet_bunko,bet.order_id as bet_order_id,bet.created_at as bet_created_at,bet.platform as bet_platform,bet.bet_info as bet_bet_info from bet LEFT JOIN game ON bet.game_id = game.game_id LEFT JOIN users ON bet.user_id = users.id WHERE 1 = 1 ';
        $betSql = "";
        switch ($status){
            case 1: //未结
                $betSql .= " AND bet.bunko =0";
                break;
            case 2: //已结
                $betSql .= " AND bet.bunko !=0 AND bet.bet_money != bet.bunko ";
                break;
            case 3: //撤单
                $betSql .= " AND bet.bet_money = bet.bunko ";
                break;
        }
        if(isset($markSix) && $markSix == 2){
            $betSql .= " AND bet.game_id != 70";
        }
        if(isset($start) && isset($end)){
            $betSql .= " AND bet.created_at BETWEEN '{$start} 00:00:00' and '{$end} 23:59:59' ";
        }
        if(isset($game) && $game>0){
            $betSql .= " AND bet.game_id = ".$game;
        }
        if(isset($playCate) && $playCate>0){
            $betSql .= " AND bet.playcate_id = ".$playCate;
        }
        if(isset($issue) && $issue>0){
            $betSql .= " AND bet.issue = ".$issue;
        }
        if(isset($order) && $order){
            $betSql .= " AND bet.order_id = '".trim($order)."'";
        }
        if(isset($username) && $username){
            $betSql .= " AND users.username ='".$username."'";
        }
        if($minMoney){
            $betSql .= " AND bet.bet_money >= ".$minMoney;
        }
        if($maxMoney){
            $betSql .= " AND bet.bet_money <= ".$maxMoney;
        }
        $betSql .= " AND bet.testFlag = 0 ";
        $betSql .= " ORDER BY bet.created_at desc,bet.bet_id desc ";
        $bet = DB::select($Sql.$betSql."LIMIT ".$start.','.$length);
        $betCount = DB::select("select count(bet.bet_id) as count from bet LEFT JOIN game ON bet.game_id = game.game_id LEFT JOIN users ON bet.user_id = users.id WHERE 1 = 1 ".$betSql);
        $betMoney = DB::table('bet')
            ->leftJoin('users','bet.user_id','=','users.id')
            ->where(function ($query) use ($timeStart){
                $query->where('bet.created_at','>=',$timeStart);
            })
            ->where(function ($query) use ($timeEnd){
                $query->where('bet.created_at','<=',$timeEnd);
            })
            ->where(function ($query) use ($markSix){
                if(isset($markSix) && $markSix){
                    if($markSix == 2)
                        $query->where("bet.game_id",'!=',70);
                }
            })
            ->where(function ($query) use($status){
                $query->where("bet.bunko",'=',0);
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
            ->where(function ($query) use ($username){
                if(isset($username) && $username){
                    $query->where("users.username",$username);
                }
            })
            ->where('bet.testFlag',0)->sum('bet.bet_money');
        $currentIssue = '';
        $currentColor = '';
        $betModel = new Bets();
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
            ->editColumn('issue',function ($bet) use(&$currentIssue,&$currentColor,$betModel){
                if($currentIssue != $bet->bet_issue){
                    $currentIssue = $bet->bet_issue;
                    $currentColor = $this->getRandColor($currentColor,$bet->bet_color,$betModel);
                }
                return '<span style="color: #'.$currentColor.'">'.$bet->bet_issue.'</span> 期';
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span> <span>$bet->bet_bet_info</span>";
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
            ->editColumn('platform',function ($bet){
                if($bet->bet_platform == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                } else if($bet->bet_platform == 2){
                    return "<i class='iconfont'>&#xe686;</i> 移动端";
                } else {
                    return "--";
                }
            })
            ->editColumn('control',function ($bet){
                if($bet->bet_bunko ==0)
                    return '<a href="javascript:;" onclick="cancel(\''.$bet->bet_order_id.'\')">取消注单</a>';
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','platform','control'])
            ->setTotalRecords($betCount[0]->count)
            ->skipPaging()
            ->with('betMoney',$betMoney)
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
        $monthStart = date('Y-m-d',mktime(0,0,0,date('m'),1,date('Y')));
        $monthEnd = date('Y-m-d',mktime(23,59,59,date('m'),date('t'),date('Y')));
        $start = $request->get('start');
        $length = $request->get('length');

        if($startSearch == 1){
            $betSQL = DB::table('bet')
                ->leftJoin('game','bet.game_id','=','game.game_id')
                ->leftJoin('users','bet.user_id','=','users.id')
                ->select('users.username as users_username','game.game_name as game_game_name','bet.color as bet_color','bet.issue as bet_issue','bet.bet_money as bet_bet_money','bet.game_id as bet_game_id','bet.playcate_name as bet_playcate_name','bet.play_name as bet_play_name','bet.play_odds as bet_play_odds','bet.agnet_odds as bet_agnet_odds','bet.agent_rebate as bet_agent_rebate','bet.bunko as bet_bunko','bet.order_id as bet_order_id','bet.created_at as bet_created_at','bet.platform as bet_platform')
                ->where(function ($query) use ($playCate){
                    if(isset($playCate) && $playCate){
                        $query->where("bet.playcate_id",$playCate);
                    }
                })
                ->where(function ($query) use ($game){
                    if(isset($game) && $game){
                        $query->where("bet.game_id",$game);
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
                ->where(function ($query) use ($timeStart){
                    if(isset($timeStart) && $timeStart){
                        $query->whereRaw('unix_timestamp(bet.created_at) >= '.$timeStart);
                    }
                })
                ->where(function ($query) use ($timeEnd){
                    if(isset($timeEnd) && $timeEnd){
                        $query->whereRaw('unix_timestamp(bet.created_at) <= '.$timeEnd);
                    }
                })
                ->where(function ($query) use ($username){
                    if(isset($username) && $username){
                        $query->where("users.username",$username);
                    }
                })
                ->where(function ($query) use ($status){
                    if(isset($status) && $status){
                        if($status == 'jiesuan'){
                            $query->where("bet.bunko",'!=',0);
                        }
                        if($status == '-8888'){
                            $query->where("bet.bunko",'=',-8888);
                        }
                    }
                })
                ->where('bet.testFlag',0)->whereBetween('bet.created_at',[$monthStart.' 00:00:00', $monthEnd.' 23:59:59']);
            $betCount = $betSQL->count();
            $bet = $betSQL->orderBy('bet.created_at','desc')->skip($start)->take($length)->get();
        } else {
            $betCount = Bets::where('order_id',888888)->count();
            $bet = Bets::where('order_id',888888)->skip($start)->take($length)->get();
        }
        $currentIssue = '';
        $currentColor = '';
        $betModel = new Bets();
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
            ->editColumn('issue',function ($bet) use(&$currentIssue,&$currentColor,$betModel){
                if($currentIssue != $bet->bet_issue){
                    $currentIssue = $bet->bet_issue;
                    $currentColor = $this->getRandColor($currentColor,$bet->bet_color,$betModel);
                }
                return '<span style="color: #'.$currentColor.'">'.$bet->bet_issue.'</span> 期';
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
            ->editColumn('platform',function ($bet){
                if($bet->bet_platform == 1){
                    return "<i class='iconfont'>&#xe696;</i> PC端";
                } else if($bet->bet_platform == 2){
                    return "<i class='iconfont'>&#xe686;</i> 移动端";
                } else {
                    return "--";
                }
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','platform'])
            ->setTotalRecords($betCount)
            ->skipPaging()
            ->make(true);
    }
    
    //实时滚单
    public function betRealTime(Request $request)
    {
        $games = $request->get('games');
        $issue = $request->get('issue');
        $username = $request->get('username');
        $minMoney = $request->get('minMoney');
        $start = $request->get('start');
        $length = $request->get('length');
        if(isset($games) && $games){
            $foreach = explode(',',implode(',',$games));
            $q = '';
            foreach($foreach as $item){
                $q .= '`bet`.`game_id` = "'.$item.'" and ';
            }
        } else {
            $q = '';
        }

        $betSQL = DB::table('bet')
            ->leftJoin('game','bet.game_id','=','game.game_id')
            ->leftJoin('users','bet.user_id','=','users.id')
            ->select('users.username as users_username','game.game_name as game_game_name','bet.color as bet_color','bet.issue as bet_issue','bet.bet_money as bet_bet_money','bet.game_id as bet_game_id','bet.playcate_name as bet_playcate_name','bet.play_name as bet_play_name','bet.play_odds as bet_play_odds','bet.agnet_odds as bet_agnet_odds','bet.agent_rebate as bet_agent_rebate','bet.bunko as bet_bunko','bet.order_id as bet_order_id','bet.created_at as bet_created_at','bet.platform as bet_platform','bet.play_rebate as bet_bet_rebate')
            ->where(function ($query) use ($games,$q){
                if(isset($games) && $games){
                    $query->whereRaw(rtrim($q,'and '));
                }
            })
            ->where(function ($query) use ($issue){
                if(isset($issue) && $issue){
                    $query->where('bet.issue',$issue);
                }
            })
            ->where(function ($query) use ($username){
                if(isset($username) && $username){
                    $query->where("users.username",$username);
                }
            })
            ->where(function ($query) use ($minMoney){
                if(isset($minMoney) && $minMoney){
                    $query->where('bet.bet_money','>=',$minMoney);
                }
            })
            ->where('bet.testFlag',0)->where('bet.bunko',0);
        $betCount = $betSQL->count();
        $bet = $betSQL->orderBy('bet.created_at','desc')->skip($start)->take($length)->get();
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
            ->editColumn('bet_rebate',function ($bet){
                return "<span class='bet-text'>$bet->bet_bet_rebate</span>";
            })
            ->editColumn('play',function ($bet){
                return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span>";
            })
            ->rawColumns(['user','play','issue','bunko','bet_money','bet_rebate'])
            ->setTotalRecords($betCount)
            ->skipPaging()
            ->make(true);
    }
    
    //用户注单-独占页面
    public function userBetSearch(Request $request)
    {
        $games = $request->get('games');
        $username = $request->get('userName');
        $userId = $request->get('userId');
        $date = $request->get('date');
        $status = $request->get('status');
        $start = $request->get('startTime');
        $end = $request->get('endTime');
        $issue = $request->get('issue');
        $orderNum = $request->get('orderNum');
        $startPage = $request->get('start');
        $lengthPage = $request->get('length');
        $user = DB::table('users')->where('username',$username)->first();

        if($user){
            $Sql = 'select bet.bet_id as bet_bet_id,bet.order_id as bet_order_id,game.game_name as g_game_name,bet.color as bet_color,bet.issue as bet_issue,bet.playcate_id as bet_playcate_id,bet.play_id as bet_play_id,bet.bet_money as bet_bet_money,bet.bunko as bet_bunko,bet.created_at as bet_created_at,bet.play_odds as bet_play_odds,bet.playcate_name as bet_playcate_name,bet.play_name as bet_play_name,bet.platform as bet_platform,bet.game_id as bet_game_id,bet.freeze_money as bet_freeze_money,bet.nn_view_money as bet_nn_view_money,bet.bet_info as bet_bet_info from bet LEFT JOIN game ON bet.game_id = game.game_id WHERE 1 = 1 ';
            $betSql = "";
            if(count($games) > 0){
                $games = implode(",",$games);
                $betSql .= " AND bet.game_id in(".$games.")";
            }
            switch ($status){
                case 1: //未结
                    $betSql .= " AND bet.bunko =0";
                    break;
                case 2: //已结
                    $betSql .= " AND bet.bunko !=0 AND bet.bet_money != bet.bunko ";
                    break;
                case 3: //撤单
                    $betSql .= " AND bet.bet_money = bet.bunko ";
                    break;
            }
            if(isset($issue) && isset($issue)){
                $betSql .= " AND bet.issue =".$issue;
            }
            if(isset($orderNum) && isset($orderNum)){
                $betSql .= " AND bet.order_id =".$orderNum;
            }
            if(isset($start) && isset($end)){
                $betSql .= " AND bet.created_at BETWEEN '{$start} 00:00:00' and '{$end} 23:59:59' ";
            }
            $betSql .= " AND bet.user_id =".$user->id;

            $betSql .= " ORDER BY bet.created_at desc,bet.bet_id desc ";
            $bet = DB::select($Sql.$betSql."LIMIT ".$startPage.','.$lengthPage);
            $betCount = DB::select("select count(bet.bet_id) as count from bet LEFT JOIN game ON bet.game_id = game.game_id WHERE 1 = 1 ".$betSql);
            $currentIssue = '';
            $currentColor = '';
            $betModel = new Bets();
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
                ->editColumn('issue',function ($bet) use(&$currentIssue,&$currentColor,$betModel){
                    if($currentIssue != $bet->bet_issue){
                        $currentIssue = $bet->bet_issue;
                        $currentColor = $this->getRandColor($currentColor,$bet->bet_color,$betModel);
                    }
                    return '<div style="position: relative"><div class="show-open" id="openH_'.$bet->bet_bet_id.'"></div><span onmouseover="showOpenHistory(\''.$bet->bet_game_id.'\',\''.$bet->bet_issue.'\',\''.$bet->bet_bet_id.'\')" onmouseout="hideOpenHistory(\''.$bet->bet_game_id.'\',\''.$bet->bet_issue.'\',\''.$bet->bet_bet_id.'\')" style="color: #'.$currentColor.';cursor: pointer;">'.$bet->bet_issue.'</span></div>';
                })
                ->editColumn('play',function ($bet){
                    if($bet->bet_playcate_id == 175 || $bet->bet_playcate_id == 77){
                        $betInfo = $bet->bet_bet_info;
                    } else {
                        $betInfo = '';
                    }
                    return "<span class='blue-text'>$bet->bet_playcate_name - </span><span class='blue-text'>$bet->bet_play_name</span> @ <span class='red-text'>$bet->bet_play_odds</span> <span>$betInfo</span>";
                })
                ->editColumn('rebate',function ($bet){
                    return '0';
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
                ->editColumn('dongjie',function ($bet){
                    return '0';
                })
                ->editColumn('jiedong',function ($bet){
                    return '0';
                })
                ->rawColumns(['order_id','user','game','issue','play','bunko','bet_money','platform'])
                ->setTotalRecords($betCount[0]->count)
                ->skipPaging()
                ->make(true);
        } else {
            return response()->json([
                'status' => false,
                'msg' => '用户不存在，请核实！'
            ],403);
        }
    }

    public function betNumTotal(Request $request)
    {
        $searchType = $request->get('searchType');
        $status = $request->get('status');
        $game = $request->get('game');
        $total = DB::table('bet')
            ->where(function ($query) use ($searchType){
                if($searchType && isset($searchType)){
                    $data = Carbon::now()->addDay(-1)->toDateTimeString();
                    $query->whereDate('created_at',date('Y-m-d',strtotime($data)));
                } else {
                    $query->whereDate('created_at',date('Y-m-d'));
                }
            })->where(function ($query) use($status){
                if($status && isset($status)){
                    if($status == 'weijiesuan'){
                        $query->where('bunko',0);
                    } else if($status == 'jiesuan'){
                        $query->where('bunko','!=',0);
                    } else {
                        $query->where('bunko',-0.01);
                    }
                }
            })
            ->where(function ($query) use ($game){
                if($game && isset($game)){
                    $query->where('game_id',$game);
                }
            })
            ->where('testFlag',0)->sum('bet_money');
        return $total;
    }

    private function play($gameId,$playCate,$play,$odds){
        $cate_txt = PlayCates::where('gameId',$gameId)->where('id',$playCate)->first();
        $play_txt = Play::where('gameId',$gameId)->where('id',$play)->first();
        return "<span class='blue-text'>$cate_txt->name - </span><span class='blue-text'>$play_txt->name</span> @ <span class='red-text'>$odds</span>";
    }

    private function getRandColor($needColor,$currentColor,$betModel){
        if($needColor === $currentColor){
            $needColor = $betModel->randColor();
            if($needColor === $currentColor)
                return $this->getRandColor($needColor,$currentColor,$betModel);
            else
                return $needColor;
        }else{
            return $currentColor;
        }
    }
}
