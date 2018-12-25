<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;

class BetHis extends Model
{
    protected $table = 'bet_his';
    protected $primaryKey = 'bet_id';

    public static function userBetSearch($request,$user){
        $games = $request->get('games');
        $status = $request->get('status');
        $start = $request->get('startTime');
        $end = $request->get('endTime');
        $issue = $request->get('issue');
        $orderNum = $request->get('orderNum');

        $Sql = 'select bet_his.bet_id as bet_bet_id,bet_his.play_rebate as bet_play_rebate,bet_his.order_id as bet_order_id,game.game_name as g_game_name,bet_his.color as bet_color,bet_his.issue as bet_issue,bet_his.playcate_id as bet_playcate_id,bet_his.play_id as bet_play_id,bet_his.bet_money as bet_bet_money,bet_his.bunko as bet_bunko,bet_his.created_at as bet_created_at,bet_his.play_odds as bet_play_odds,bet_his.playcate_name as bet_playcate_name,bet_his.play_name as bet_play_name,bet_his.platform as bet_platform,bet_his.game_id as bet_game_id,bet_his.freeze_money as bet_freeze_money,bet_his.nn_view_money as bet_nn_view_money,bet_his.bet_info as bet_bet_info,bet_his.status from bet_his LEFT JOIN game ON bet_his.game_id = game.game_id WHERE 1 = 1 ';
        $betSql = "";
        if(count($games) > 0){
            $games = implode(",",$games);
            $betSql .= " AND bet_his.game_id in(".$games.")";
        }
        switch ($status){
            case 1: //未结
                $betSql .= " AND bet_his.bunko =0";
                break;
            case 2: //已结
                $betSql .= " AND bet_his.bunko !=0 AND bet_his.bet_money != bet_his.bunko ";
                break;
            case 3: //撤单
                $betSql .= " AND bet_his.bet_money = bet_his.bunko ";
                break;
        }
        if(isset($issue) && isset($issue)){
            $betSql .= " AND bet_his.issue ='".$issue."'";
        }
        if(isset($orderNum) && isset($orderNum)){
            $betSql .= " AND bet_his.order_id ='".$orderNum."'";
        }
        if(isset($start) && isset($end)){
            $betSql .= " AND bet_his.created_at BETWEEN '{$start} 00:00:00' and '{$end} 23:59:59' ";
        }
        $betSql .= " AND bet_his.user_id =".$user->id;
        return $Sql.$betSql;
    }

    public static function userBetSearchCount($request,$user){
        $games = $request->get('games');
        $status = $request->get('status');
        $start = $request->get('startTime');
        $end = $request->get('endTime');
        $issue = $request->get('issue');
        $orderNum = $request->get('orderNum');

        $aSql = 'select count(bet_his.bet_id) as count from bet_his LEFT JOIN game ON bet_his.game_id = game.game_id WHERE 1 = 1 ';
        $betSql = "";
        if(count($games) > 0){
            $games = implode(",",$games);
            $betSql .= " AND bet_his.game_id in(".$games.")";
        }
        switch ($status){
            case 1: //未结
                $betSql .= " AND bet_his.bunko =0";
                break;
            case 2: //已结
                $betSql .= " AND bet_his.bunko !=0 AND bet_his.bet_money != bet_his.bunko ";
                break;
            case 3: //撤单
                $betSql .= " AND bet_his.bet_money = bet_his.bunko ";
                break;
        }
        if(isset($issue) && isset($issue)){
            $betSql .= " AND bet_his.issue ='".$issue."'";
        }
        if(isset($orderNum) && isset($orderNum)){
            $betSql .= " AND bet_his.order_id ='".$orderNum."'";
        }
        if(isset($start) && isset($end)){
            $betSql .= " AND bet_his.created_at BETWEEN '{$start} 00:00:00' and '{$end} 23:59:59' ";
        }
        $betSql .= " AND bet_his.user_id =".$user->id;

        return DB::select($aSql.$betSql)[0]->count;
    }

    public static function AssemblyFundDetails($param){
        $aSql = self::select(DB::raw("users.username,bet_his.user_id,bet_his.order_id,bet_his.created_at,bet_his.status,bet_his.bet_money as money,bet_his.bet_balance as balance,bet_his.issue,bet_his.game_id,game.game_name,concat(bet_his.playcate_name,concat('-',bet_his.play_name)) as playcate_name,'' as agent,bet_his.color as agent_id,bet_his.bet_info as content,'' as content1,bet_his.freeze_money,bet_his.unfreeze_money,bet_his.nn_view_money,bet_his.bunko as c_money,bet_his.bet_id,'' as rechargesType"))
            ->where(function ($sql) use ($param) {
                if(isset($param['startTime']) && array_key_exists('startTime',$param) && isset($param['endTime']) && array_key_exists('endTime',$param)){
                    $sql->whereBetween('bet_his.updated_at',[date("Y-m-d 00:00:00",strtotime($param['startTime'])),date("Y-m-d 23:59:59",strtotime($param['endTime']))]);
                }else{
                    if (isset($param['time_point']) && array_key_exists('time_point', $param)) {
                        if ($param['time_point'] == 'today') {
                            $time = date('Y-m-d');
                            $sql->whereBetween('bet_his.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        } elseif ($param['time_point'] == 'yesterday') {
                            $time = date('Y-m-d', strtotime('- 1 day', time()));
                            $sql->whereBetween('bet_his.updated_at', [$time . ' 00:00:00', $time . ' 23:59:59']);
                        } else {
                            $time = date('Y-m-d', strtotime('- 2 day', time()));
                            $sql->where('bet_his.updated_at', '<=', $time . '23:59:59');
                        }
                    }
                }
                if(isset($param['account_id']) && array_key_exists('account_id',$param)){
                    $sql->where('users.id','=',$param['account_id']);
                }
                if (isset($param['account']) && array_key_exists('account', $param)) {
                    $sql->where('users.username', '=', $param['account']);
                }
                if (isset($param['game_id']) && array_key_exists('game_id', $param)) {
                    $sql->where('bet_his.game_id', '=', $param['game_id']);
                }
                if (isset($param['order_id']) && array_key_exists('order_id', $param)) {
                    $sql->where('bet_his.order_id', '=', $param['order_id']);
                }
                if (isset($param['issue']) && array_key_exists('issue', $param)) {
                    $sql->where('bet_his.issue', '=', $param['issue']);
                }
                if (isset($param['amount_min']) && array_key_exists('amount_min', $param)) {
                    $sql->where('bet_his.bunko', '>=', $param['amount_min']);
                }
                if (isset($param['amount_max']) && array_key_exists('amount_max', $param)) {
                    $sql->where('bet_his.bunko', '<=', $param['amount_max']);
                }
            })->leftJoin('users', 'users.id', '=', 'bet_his.user_id')->leftJoin('game', 'game.game_id', '=', 'bet_his.game_id')
            ->orderBy('bet_his.bet_id','desc');
        return $aSql;
    }

    public static function betHistory($request){
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
        $Sql = 'select users.username as users_username,game.game_name as game_game_name,bet_his.color as bet_color,bet_his.issue as bet_issue,bet_his.bet_money as bet_bet_money,bet_his.game_id as bet_game_id,bet_his.playcate_name as bet_playcate_name,bet_his.play_name as bet_play_name,bet_his.play_odds as bet_play_odds,bet_his.agnet_odds as bet_agnet_odds,bet_his.agent_rebate as bet_agent_rebate,bet_his.bunko as bet_bunko,bet_his.order_id as bet_order_id,bet_his.created_at as bet_created_at,bet_his.platform as bet_platform,bet_his.nn_view_money as bet_nn_view_money,bet_his.bet_info as bet_bet_info,bet_his.status from bet_his LEFT JOIN game ON bet_his.game_id = game.game_id LEFT JOIN users ON bet_his.user_id = users.id WHERE 1 = 1 ';
        $betSql = "";
        switch ($status){
            case 1: //未结
                $betSql .= " AND bet_his.bunko =0";
                break;
            case 2: //已结
                $betSql .= " AND bet_his.bunko !=0 AND bet_his.bet_money != bet_his.bunko ";
                break;
            case 3: //撤单
                $betSql .= " AND bet_his.bet_money = bet_his.bunko ";
                break;
        }
        if(isset($markSix) && $markSix == 2){
            $betSql .= " AND bet_his.game_id != 70";
        }
        if(isset($timeStart) && isset($timeEnd)){
            $betSql .= " AND bet_his.created_at BETWEEN '{$timeStart} 00:00:00' and '{$timeEnd} 23:59:59' ";
        }
        if(isset($game) && $game>0){
            $betSql .= " AND bet_his.game_id = ".$game;
        }
        if(isset($playCate) && $playCate>0){
            $betSql .= " AND bet_his.playcate_id = ".$playCate;
        }
        if(isset($issue) && $issue>0){
            $betSql .= " AND bet_his.issue = ".$issue;
        }
        if(isset($order) && $order){
            $betSql .= " AND bet_his.order_id = '".trim($order)."'";
        }
        if(isset($username) && $username){
            $betSql .= " AND users.username ='".$username."'";
        }
        if($minMoney){
            $betSql .= " AND bet_his.bet_money >= ".$minMoney;
        }
        if($maxMoney){
            $betSql .= " AND bet_his.bet_money <= ".$maxMoney;
        }
        $betSql .= " AND bet_his.testFlag = 0 ";
        $betSql .= " ORDER BY bet_his.created_at desc,bet_his.bet_id desc LIMIT $start,$length";
        return DB::select($Sql.$betSql);
    }

    public static function betHistoryCount($request){
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
        $Sql = "select count(bet_his.bet_id) as count from bet_his LEFT JOIN game ON bet_his.game_id = game.game_id LEFT JOIN users ON bet_his.user_id = users.id WHERE 1 = 1 ";
        $betSql = "";
        switch ($status){
            case 1: //未结
                $betSql .= " AND bet_his.bunko =0";
                break;
            case 2: //已结
                $betSql .= " AND bet_his.bunko !=0 AND bet_his.bet_money != bet_his.bunko ";
                break;
            case 3: //撤单
                $betSql .= " AND bet_his.bet_money = bet_his.bunko ";
                break;
        }
        if(isset($markSix) && $markSix == 2){
            $betSql .= " AND bet_his.game_id != 70";
        }
        if(isset($timeStart) && isset($timeEnd)){
            $betSql .= " AND bet_his.created_at BETWEEN '{$timeStart} 00:00:00' and '{$timeEnd} 23:59:59' ";
        }
        if(isset($game) && $game>0){
            $betSql .= " AND bet_his.game_id = ".$game;
        }
        if(isset($playCate) && $playCate>0){
            $betSql .= " AND bet_his.playcate_id = ".$playCate;
        }
        if(isset($issue) && $issue>0){
            $betSql .= " AND bet_his.issue = ".$issue;
        }
        if(isset($order) && $order){
            $betSql .= " AND bet_his.order_id = '".trim($order)."'";
        }
        if(isset($username) && $username){
            $betSql .= " AND users.username ='".$username."'";
        }
        if($minMoney){
            $betSql .= " AND bet_his.bet_money >= ".$minMoney;
        }
        if($maxMoney){
            $betSql .= " AND bet_his.bet_money <= ".$maxMoney;
        }
        $betSql .= " AND bet_his.testFlag = 0 ";
        return DB::select($Sql.$betSql);
    }

    public static function betHistoryBetMoney($request){
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

        return DB::table('bet_his')
            ->leftJoin('users','bet_his.user_id','=','users.id')
            ->where(function ($query) use ($timeStart){
                $query->where('bet_his.updated_at','>=',$timeStart.' 00:00:00');
            })
            ->where(function ($query) use ($timeEnd){
                $query->where('bet_his.updated_at','<=',$timeEnd.' 23:59:59');
            })
            ->where(function ($query) use ($markSix){
                if(isset($markSix) && $markSix){
                    if($markSix == 2)
                        $query->where("bet_his.game_id",'!=',70);
                }
            })
            ->where(function ($query) use($status){
                $query->where("bet_his.bunko",'=',0);
            })
            ->where(function ($query) use ($game){
                if(isset($game) && $game){
                    $query->where("bet_his.game_id",$game);
                }
            })
            ->where(function ($query) use ($playCate){
                if(isset($playCate) && $playCate){
                    $query->where("bet_his.playcate_id",$playCate);
                }
            })
            ->where(function ($query) use ($issue){
                if(isset($issue) && $issue){
                    $query->where("bet_his.issue",$issue);
                }
            })
            ->where(function ($query) use ($order){
                if(isset($order) && $order){
                    $query->where("bet_his.order_id",$order);
                }
            })
            ->where(function ($query) use ($username){
                if(isset($username) && $username){
                    $query->where("users.username",$username);
                }
            })
            ->where('bet_his.testFlag',0)->sum('bet_his.bet_money');
    }
}
