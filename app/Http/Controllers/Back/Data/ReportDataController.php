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
use App\Agent;

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
            ->editColumn('fact_bet_bunko', function ($aData){
                $activity_money = empty($aData->activity_money)?0:$aData->activity_money;
                $handling_fee = empty($aData->handling_fee)?0:$aData->handling_fee;
                return $aData->bet_bunko + $activity_money + $handling_fee;
            })
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

        $activity_money = empty($aData->activity_money)?0.00:$aData->activity_money;
        $handling_fee = empty($aData->handling_fee)?0.00:$aData->handling_fee;


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
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee,3),
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
            ->editColumn('fact_bet_bunko', function ($aData){
                $activity_money = empty($aData->activity_money)?0:$aData->activity_money;
                $handling_fee = empty($aData->handling_fee)?0:$aData->handling_fee;
                return $aData->bet_bunko + $activity_money + $handling_fee;
            })
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

        $activity_money = empty($aData->activity_money)?0.00:$aData->activity_money;
        $handling_fee = empty($aData->handling_fee)?0.00:$aData->handling_fee;

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
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee,2),
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
        }else{
            if (isset($aParam['game_id']) && array_key_exists('game_id', $aParam)) {
                $aData = ReportBetMember::reportQuery($aParam);
                $aDataCount = ReportBetMember::reportQueryCount($aParam);
            } else {
                $aData = ReportMember::reportQuery($aParam);
                $aDataCount = ReportMember::reportQueryCount($aParam);
            }
        }

        return DataTables::of($aData)
            ->editColumn('fact_bet_bunko', function ($aData){
                $activity_money = empty($aData->activity_money)?0:$aData->activity_money;
                $handling_fee = empty($aData->handling_fee)?0:$aData->handling_fee;
                return $aData->bet_bunko + $activity_money + $handling_fee;
            })
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

        $activity_money = empty($aData->activity_money)?0.00:$aData->activity_money;
        $handling_fee = empty($aData->handling_fee)?0.00:$aData->handling_fee;

        return response()->json([
            'recharges_money' => empty($aData->recharges_money)?'':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'':$aData->drawing_money,
            'bet_count' => empty($aData->bet_count)?'':$aData->bet_count,
            'bet_money' => empty($aData->bet_money)?'':$aData->bet_money,
            'bet_amount' => empty($aData->bet_amount)?'':$aData->bet_amount,
            'activity_money' => empty($aData->activity_money)?'':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'':$aData->handling_fee,
            'bet_bunko' => empty($aData->bet_bunko)?'':$aData->bet_bunko,
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee,2),
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
//        $sql1 = "SELECT g.game_name,g.status,g.game_id, sum(b.bet_money) as sumMoney, COUNT(b.bet_id) AS countBets,count(DISTINCT(b.user_id)) as countMember, sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bunko else 0 end) else(case WHEN bunko >0 then bunko else 0 end) end) as sumWinBunko, count(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.bet_id else Null end) else(case WHEN bunko >0 then b.bet_id else Null end) end) as countWinBunkoBet, count(DISTINCT(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.user_id else Null end) else(case WHEN bunko >0 then b.user_id else Null end) end)) as countWinBunkoMember, sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko FROM `game` AS g ";
//        $whereBet = "";
//        $where = "";
//        if(isset($killZeroBetGame) && $killZeroBetGame){        //过滤零投注彩种
//            $where .= " and b.user_id >= 1 ";
//        }
//        if(isset($killCloseGame) && $killCloseGame){        //过滤未开启彩种
//            $where .= " and g.status = 1 ";
//        }
//        if(isset($starttime) && $starttime){
//            $whereBet .= " and created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
//        }
//        if(isset($endtime) && $endtime){
//            $whereBet .= " and created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
//        }
//        $sql = "LEFT JOIN (select * from bet where 1 AND testFlag = 0 ".$whereBet.") as b ON g.game_id = b.game_id";
//        $aSqlCount = "SELECT COUNT(`c`.`game_id`) AS `count` FROM (SELECT g.game_id FROM `game` AS g ".$sql." WHERE 1 ".$where." GROUP BY g.game_id) AS `c`";
//        $sql .= " WHERE 1 ".$where." GROUP BY g.game_id order BY sumBunko asc LIMIT ".$start.','.$length;
//        $sql = $sql1.$sql;
        $sql1 = "SELECT g.game_name,g.status,g.game_id, `b`.`sumMoney`, `b`.`countBets`,`b`.`countMember`, `b`.`sumWinBunko`, `b`.`countWinBunkoBet`,`b`.`countWinBunkoMember`, `b`.`sumBunko` FROM `game` AS g ";
        $whereBet = "";
        $where = "";
        if(isset($killZeroBetGame) && $killZeroBetGame){        //过滤零投注彩种
            $whereBet .= " and user_id >= 1 ";
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
        $sql = "JOIN (select sum(`bet_money`) as `sumMoney`,COUNT(`bet_id`) AS `countBets`,count(DISTINCT(`user_id`)) as `countMember`,sum(case WHEN `game_id` in (90,91) then (case WHEN `nn_view_money` > 0 then `bunko` else 0 end) else(case WHEN `bunko` >0 then `bunko` else 0 end) end) as `sumWinBunko`,count(case WHEN `game_id` in (90,91) then (case WHEN `nn_view_money` > 0 then `bet_id` else Null end) else(case WHEN `bunko` >0 then `bet_id` else Null end) end) as `countWinBunkoBet`,count(DISTINCT(case WHEN `game_id` in (90,91) then (case WHEN `nn_view_money` > 0 then `user_id` else Null end) else(case WHEN `bunko` >0 then `user_id` else Null end) end)) as `countWinBunkoMember`,sum(case WHEN `game_id` in (90,91) then `nn_view_money` else(case when `bunko` >0 then `bunko` - `bet_money` else `bunko` end)end) as `sumBunko`,`game_id` from bet where 1 AND testFlag = 0 ".$whereBet." GROUP BY `game_id`) as b ON g.game_id = b.game_id ";
        $sql .= " WHERE 1 ".$where." order BY sumBunko asc LIMIT ".$start.','.$length;
        $sql = $sql1.$sql;
        $bet = DB::select($sql);
        return DataTables::of($bet)
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
    //注册报表
    public function Register(Request $request){
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $start = $request->get('start');
        $length = $request->get('length');
        $where = '';
        $having = '';
        if($startTime && $endTime){
            $where .= " AND created_at BETWEEN '{$startTime}' AND '{$endTime}' ";
            $having .= " AND created_at BETWEEN '{$startTime}' AND '{$endTime}' ";
        }
        $cSql = "SELECT COUNT(`a_id`) AS `count` FROM `agent`  WHERE 1";
//        $aSql = "SELECT COUNT(u.id) as countMember, SUM(bet_bunko) AS bet_bunko, SUM(Damount) AS Damount, SUM(Ramount) AS Ramount, SUM(money) AS money, ag.name, ag.a_id as agent, COUNT(FirstTime) AS FirstTimeNum
//                FROM `agent` AS ag
//                LEFT JOIN (
//                    SELECT u.id, b.bet_bunko, d.Damount, r.Ramount, u.money, d.user_id, u.agent, FirstTime
//                    FROM `users` as u
//                    LEFT JOIN ( SELECT sum( CASE  WHEN b.game_id IN ( 90, 91 ) THEN
//                                        nn_view_money ELSE ( CASE WHEN bunko > 0 THEN bunko - bet_money ELSE bunko END )
//                                    END  ) AS bet_bunko,user_id FROM `bet` AS b GROUP BY user_id ) AS b ON b.user_id = u.id
//                    LEFT JOIN ( SELECT SUM(d.amount) AS Damount, d.user_id FROM `drawing` AS d WHERE STATUS = 2  GROUP BY user_id ) AS d ON d.user_id = u.id
//                    LEFT JOIN ( SELECT SUM(re.amount) AS Ramount, re.userId FROM `recharges` AS re WHERE STATUS = 2 AND payType != 'adminAddMoney' GROUP BY userId ) AS r ON r.userId = u.id
//                    LEFT JOIN ( SELECT userId, created_at AS FirstTime FROM `recharges` WHERE STATUS = 2 AND payType != 'adminAddMoney' GROUP BY userId {$having} ) AS sc ON sc.userId = u.id
//                    WHERE testFlag IN ( 0, 2 )
//                    {$where}
//                ) AS u ON u.agent = ag.a_id
//                GROUP BY a_id";
        $aSql = Agent::agentReportRegister_aSql($where, $having);
        $countSql = $cSql.$where;
        $count = DB::select($countSql);
        $aSql = $aSql . " LIMIT {$start},{$length}";
        $res = DB::select($aSql);
        return DataTables::of($res)
            ->setTotalRecords($count[0]->count)
            ->skipPaging()
            ->make(true);
    }
    public function RegisterTotal(){
        $aSql = Agent::agentReportRegister_aSql();
        //总计
        $TotalSql = "SELECT SUM(countMember) AS countMember, SUM(bet_bunko) AS bet_bunko, SUM(Damount) AS Damount, SUM(Ramount) AS Ramount, SUM(money) AS money,  SUM(FirstTimeNum) AS FirstTimeNum
                    FROM ( {$aSql} ) AS ag";
        $res = DB::select($TotalSql);
        if($res){
            return response()->json([
                'code' => 0,
                'data' => $res[0]
            ]);
        }
        return response()->json([
            'code' => 1,
                'data' => []
        ]);
        print_r($res);
    }
}
