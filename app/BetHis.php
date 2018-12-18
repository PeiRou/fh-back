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

        $Sql = 'select bet_his.bet_id as bet_bet_id,bet_his.play_rebate as bet_play_rebate,bet_his.order_id as bet_order_id,game.game_name as g_game_name,bet_his.color as bet_color,bet_his.issue as bet_issue,bet_his.playcate_id as bet_playcate_id,bet_his.play_id as bet_play_id,bet_his.bet_money as bet_bet_money,bet_his.bunko as bet_bunko,bet_his.created_at as bet_created_at,bet_his.play_odds as bet_play_odds,bet_his.playcate_name as bet_playcate_name,bet_his.play_name as bet_play_name,bet_his.platform as bet_platform,bet_his.game_id as bet_game_id,bet_his.freeze_money as bet_freeze_money,bet_his.nn_view_money as bet_nn_view_money,bet_his.bet_info as bet_bet_info from bet_his LEFT JOIN game ON bet_his.game_id = game.game_id WHERE 1 = 1 ';
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
            $betSql .= " AND bet_his.issue =".$issue;
        }
        if(isset($orderNum) && isset($orderNum)){
            $betSql .= " AND bet_his.order_id =".$orderNum;
        }
        if(isset($start) && isset($end)){
            $betSql .= " AND bet_his.created_at BETWEEN '{$start} 00:00:00' and '{$end} 23:59:59' ";
        }
        $betSql .= " AND bet_his.user_id =".$user->id;
        return $Sql.$betSql.' ORDER BY bet_his.created_at desc,bet_his.bet_id desc ';
    }
}
