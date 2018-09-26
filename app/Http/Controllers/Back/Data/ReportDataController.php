<?php

namespace App\Http\Controllers\Back\Data;

use App\ReportAgent;
use App\ReportGeneral;
use App\ReportMember;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ReportDataController extends Controller
{

    //总代理报表
    public function Gagent(Request $request)
    {
        $aParam = $request->all();

        $aData = ReportGeneral::reportQuery($aParam);
        $aDataCount = ReportGeneral::reportQueryCount($aParam);

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //总代理报表-总计
    public function GagentTotal(Request $request)
    {
        $aParam = $request->all();

        $aData = ReportGeneral::reportQuerySum($aParam);

        return response()->json($aData);
    }

    //代理报表
    public function Agent(Request $request)
    {
        $aParam = $request->all();

        $aData = ReportAgent::reportQuery($aParam);
        $aDataCount = ReportAgent::reportQueryCount($aParam);

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //代理报表-总计
    public function AgentTotal(Request $request)
    {
        $aParam = $request->all();

        $aData = ReportAgent::reportQuerySum($aParam);

        return response()->json($aData);
    }

    //会员报表
    public function User(Request $request)
    {
        $aParam = $request->all();

        $aData = ReportMember::reportQuery($aParam);
        $aDataCount = ReportMember::reportQueryCount($aParam);

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //会员报表-总计
    public function UserTotal(Request $request)
    {
        $aParam = $request->all();

        $aData = ReportMember::reportQuerySum($aParam);
        return response()->json($aData);
    }

    //投注报表
    public function Bet(Request $request)
    {
        $starttime = $request->get('startTime');
        $endtime = $request->get('endTime');
        $killZeroBetGame = $request->get('killZeroBetGame');
        $killCloseGame = $request->get('killCloseGame');
        $start = $request->get('start');
        $length = $request->get('length');
        $sql1 = "SELECT g.game_name,g.status,g.game_id, sum(b.bet_money) as sumMoney, COUNT(b.bet_id) AS countBets,count(DISTINCT(b.user_id)) as countMember, sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bunko else 0 end) else(case WHEN bunko >0 then bunko else 0 end) end) as sumWinBunko, count(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.bet_id else Null end) else(case WHEN bunko >0 then b.bet_id else Null end) end) as countWinBunkoBet, count(DISTINCT(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.user_id else Null end) else(case WHEN bunko >0 then b.user_id else Null end) end)) as countWinBunkoMember, sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko FROM `game` AS g ";
        $whereBet = "";
        $where = "";
        if(isset($killZeroBetGame) && $killZeroBetGame){        //过滤零投注彩种
            $where .= " and b.user_id >= 1 ";
        }
        if(isset($killCloseGame) && $killCloseGame){        //过滤未开启彩种
            $where .= " and g.status = 1 ";
        }
        if(isset($starttime) && $starttime){
            $whereBet .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $whereBet .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        $sql = "LEFT JOIN (select * from bet where 1 AND testFlag = 0 ".$whereBet.") as b ON g.game_id = b.game_id";
        $aSqlCount = "SELECT COUNT(DISTINCT(g.game_id)) AS count FROM `game` AS g ".$sql." WHERE 1 ".$where;
        $sql .= " WHERE 1 ".$where." GROUP BY g.game_id order BY sumBunko asc LIMIT ".$start.','.$length;
        $sql = $sql1.$sql;
        $bet = DB::select($sql);
        $agentCount = DB::select($aSqlCount);
        return DataTables::of($bet)
            ->setTotalRecords($agentCount[0]->count)
            ->skipPaging()
            ->make(true);
    }


    //报表-总计
    public function Total()
    {
        $user = DB::select(Session::get('reportSql'));
        return response()->json([
            'status'=>true,
            'result'=>$user[0]
        ]);
    }
}
