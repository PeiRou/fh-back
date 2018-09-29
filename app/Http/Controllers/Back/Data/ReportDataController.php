<?php

namespace App\Http\Controllers\Back\Data;

use App\Bets;
use App\ReportAgent;
use App\ReportBetAgent;
use App\ReportBetGeneral;
use App\ReportBetMember;
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

        if(strtotime($aParam['timeStart']) == strtotime(date('Y-m-d'))){
            $result = Bets::GagentToday($aParam);
            $aData = $result['aData'];
            $aDataCount = $result['aDataCount'];
        }else{
            if(isset($aParam['game_id']) && array_key_exists('game_id',$aParam)){
                $aData = ReportBetGeneral::reportQuery($aParam);
                $aDataCount = ReportBetGeneral::reportQueryCount($aParam);
            }else{
                $aData = ReportGeneral::reportQuery($aParam);
                $aDataCount = ReportGeneral::reportQueryCount($aParam);
            }
        }

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //总代理报表-总计
    public function GagentTotal(Request $request)
    {
        $aParam = $request->all();

        if(strtotime($aParam['timeStart']) == strtotime(date('Y-m-d'))){
            $aData = Bets::GagentTodaySUM($aParam);
        }else {
            if (isset($aParam['game_id']) && array_key_exists('game_id', $aParam))
                $aData = ReportBetGeneral::reportQuerySum($aParam);
            else
                $aData = ReportGeneral::reportQuerySum($aParam);
        }

        return response()->json([
            'member_count' => empty($aData->member_count)?'':$aData->member_count,
            'recharges_money' => empty($aData->recharges_money)?'':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'':$aData->drawing_money,
            'bet_count' => empty($aData->bet_count)?'':$aData->bet_count,
            'bet_money' => empty($aData->bet_money)?'':$aData->bet_money,
            'bet_amount' => empty($aData->bet_amount)?'':$aData->bet_amount,
            'activity_money' => empty($aData->activity_money)?'':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'':$aData->handling_fee,
            'bet_bunko' => empty($aData->bet_bunko)?'':$aData->bet_bunko,
            'fact_bet_bunko' => empty($aData->fact_bet_bunko)?'':$aData->fact_bet_bunko,
        ]);
    }

    //代理报表
    public function Agent(Request $request)
    {
        $aParam = $request->all();
        if(strtotime($aParam['timeStart']) == strtotime(date('Y-m-d'))){
            $result = Bets::AgentToday($aParam);
            $aData = $result['aData'];
            $aDataCount = $result['aDataCount'];
        }else {
            if (isset($aParam['game_id']) && array_key_exists('game_id', $aParam)) {
                $aData = ReportBetAgent::reportQuery($aParam);
                $aDataCount = ReportBetAgent::reportQueryCount($aParam);
            } else {
                $aData = ReportAgent::reportQuery($aParam);
                $aDataCount = ReportAgent::reportQueryCount($aParam);
            }
        }

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //代理报表-总计
    public function AgentTotal(Request $request)
    {
        $aParam = $request->all();
        if(strtotime($aParam['timeStart']) == strtotime(date('Y-m-d'))){
            $aData = Bets::AgentTodaySum($aParam);
        }else {
            if (isset($aParam['game_id']) && array_key_exists('game_id', $aParam))
                $aData = ReportBetAgent::reportQuerySum($aParam);
            else
                $aData = ReportAgent::reportQuerySum($aParam);
        }
        return response()->json([
            'member_count' => empty($aData->member_count)?'':$aData->member_count,
            'recharges_money' => empty($aData->recharges_money)?'':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'':$aData->drawing_money,
            'bet_count' => empty($aData->bet_count)?'':$aData->bet_count,
            'bet_money' => empty($aData->bet_money)?'':$aData->bet_money,
            'bet_amount' => empty($aData->bet_amount)?'':$aData->bet_amount,
            'activity_money' => empty($aData->activity_money)?'':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'':$aData->handling_fee,
            'bet_bunko' => empty($aData->bet_bunko)?'':$aData->bet_bunko,
            'fact_bet_bunko' => empty($aData->fact_bet_bunko)?'':$aData->fact_bet_bunko,
        ]);
    }

    //会员报表
    public function User(Request $request)
    {
        $aParam = $request->all();
        if(strtotime($aParam['timeStart']) == strtotime(date('Y-m-d'))){
            $result = Bets::UserToday($aParam);
            $aData = $result['aData'];
            $aDataCount = $result['aDataCount'];
        }else {
            if (isset($aParam['game_id']) && array_key_exists('game_id', $aParam)) {
                $aData = ReportBetMember::reportQuery($aParam);
                $aDataCount = ReportBetMember::reportQueryCount($aParam);
            } else {
                $aData = ReportMember::reportQuery($aParam);
                $aDataCount = ReportMember::reportQueryCount($aParam);
            }
        }

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //会员报表-总计
    public function UserTotal(Request $request)
    {
        $aParam = $request->all();

        if(strtotime($aParam['timeStart']) == strtotime(date('Y-m-d'))){
            $aData = Bets::UserTodaySum($aParam);
        }else {
            if (isset($aParam['game_id']) && array_key_exists('game_id', $aParam))
                $aData = ReportBetMember::reportQuerySum($aParam);
            else
                $aData = ReportMember::reportQuerySum($aParam);
        }

        return response()->json([
            'recharges_money' => empty($aData->recharges_money)?'':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'':$aData->drawing_money,
            'bet_count' => empty($aData->bet_count)?'':$aData->bet_count,
            'bet_money' => empty($aData->bet_money)?'':$aData->bet_money,
            'bet_amount' => empty($aData->bet_amount)?'':$aData->bet_amount,
            'activity_money' => empty($aData->activity_money)?'':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'':$aData->handling_fee,
            'bet_bunko' => empty($aData->bet_bunko)?'':$aData->bet_bunko,
            'fact_bet_bunko' => empty($aData->fact_bet_bunko)?'':$aData->fact_bet_bunko,
        ]);
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

    //
    public function Statistics(Request $request){
        $aParam = $request->post();

        $aDataSql = DB::table('report_statistics_date')->where(function ($aSql) use($aParam){
            if(isset($aParam['startTime']) && array_key_exists('startTime',$aParam))
                $aSql->where('date','>=',$aParam['startTime']);
            if(isset($aParam['endTime']) && array_key_exists('endTime',$aParam))
                $aSql->where('date','<=',$aParam['endTime']);
        });

        $aDataCount = $aDataSql->count();
        $aData = $aDataSql->orderBy('date','desc')->skip($aParam['start'])->take($aParam['length'])->get();

        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->editColumn('status',function ($logHandle){
                return '已操作';
            })
            ->skipPaging()
            ->make(true);
    }
}
