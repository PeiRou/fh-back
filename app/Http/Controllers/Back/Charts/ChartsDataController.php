<?php

namespace App\Http\Controllers\Back\Charts;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ChartsDataController extends Controller
{
    public function gameBunko()
    {
        $starttime = '2018-08-05';
        $endtime = '2018-08-05';
        $killZeroBetGame = 1;
        $killCloseGame = 1;
        $sql = "SELECT g.game_name,g.status,g.game_id, sum(b.bet_money) as sumMoney, COUNT(b.bet_id) AS countBets,count(DISTINCT(b.user_id)) as countMember, sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bunko else 0 end) else(case WHEN bunko >0 then bunko else 0 end) end) as sumWinBunko, count(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.bet_id else Null end) else(case WHEN bunko >0 then b.bet_id else Null end) end) as countWinBunkoBet, count(DISTINCT(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.user_id else Null end) else(case WHEN bunko >0 then b.user_id else Null end) end)) as countWinBunkoMember, sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko FROM `game` AS g LEFT JOIN bet as b ON g.game_id = b.game_id and b.testFlag = 0 ";
        $whereBet = "";
        $where = "";
        if(isset($killZeroBetGame) && $killZeroBetGame){        //过滤零投注彩种
            $where .= " and b.user_id >= 1 ";
        }
        if(isset($killCloseGame) && $killCloseGame){        //过滤未开启彩种
            $where .= " and g.status = 1 ";
        }
        if(isset($starttime) && $starttime){
            $whereBet .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $whereBet .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        $sql .= $whereBet ;
        $sql .= " WHERE 1 ".$where." GROUP BY g.game_id order BY sumBunko asc";
        $bet = DB::select($sql);
        return $bet;
    }

    public function recharges()
    {
        $selectDay = '2018-08-05';
        $sql = "SELECT Hour(created_at) as hours, sum(amount) as sumAmount FROM `recharges` WHERE ";
        $where = "";
        if(isset($selectDay) && $selectDay){
            $where .= " created_at between '".date("Y-m-d 00:00:00",strtotime($selectDay))."' and '".date("Y-m-d 23:59:59",strtotime($selectDay))."'";
        }
        $sql .= " and status = 2 and payType != 'adminAddMoney' GROUP BY Hour(created_at)";
        $recharges = DB::select($sql);
        return $recharges;
    }
}
