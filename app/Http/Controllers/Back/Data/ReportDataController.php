<?php

namespace App\Http\Controllers\Back\Data;

use App\Bets;
use App\DomainAccess;
use App\DomainInfo;
use App\GamesApi;
use App\ReportAgent;
use App\ReportBet;
use App\ReportBetAgent;
use App\ReportBetGeneral;
use App\ReportBetMember;
use App\ReportGeneral;
use App\ReportMember;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use tests\Mockery\Adapter\Phpunit\EmptyTestCase;
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
            ->editColumn('fact_return_amount', function ($aData){
                return round($aData->fact_return_amount,2);
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
            'fact_return_amount' => empty($aData->fact_return_amount)?'':round($aData->fact_return_amount,2),
            'return_amount' => empty($aData->return_amount)?'':$aData->return_amount,
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
            ->editColumn('fact_return_amount', function ($aData){
                return round($aData->fact_return_amount,2);
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
            'return_amount' => empty($aData->return_amount)?'':$aData->return_amount,
            'fact_return_amount' => empty($aData->fact_return_amount)?'':round($aData->fact_return_amount,2),
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
            ->editColumn('fact_return_amount', function ($aData){
                return round($aData->fact_return_amount,2);
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
            'fact_return_amount' => empty($aData->fact_return_amount)?'':round($aData->fact_return_amount,2),
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee,2),
        ]);
    }

    //投注报表
    public function Bet(Request $request)
    {
        $aParam = $request->input();

        if(strtotime($aParam['startTime']) == strtotime(date('Y-m-d'))){
            $aBet = Bets::todayReportBet($aParam);
        }else{
            $aBet = ReportBet::reportQuery($aParam);
        }

        return DataTables::of($aBet)
            ->editColumn('countWinBunkoMember', function ($aBet){
                return empty($aBet->countWinBunkoMember)?0:$aBet->countWinBunkoMember;
            })
            ->editColumn('sumMoney', function ($aBet){
                return empty($aBet->sumMoney)?'0.00':$aBet->sumMoney;
            })
            ->editColumn('countBets', function ($aBet){
                return empty($aBet->countBets)?0:$aBet->countBets;
            })
            ->editColumn('countMember', function ($aBet){
                return empty($aBet->countMember)?0:$aBet->countMember;
            })
            ->editColumn('sumWinBunko', function ($aBet){
                return empty($aBet->sumWinBunko)?'0.00':$aBet->sumWinBunko;
            })
            ->editColumn('rebate', function (){
                return 0;
            })
            ->editColumn('countWinBunkoBet', function ($aBet){
                $countWinBunkoBet = empty($aBet->countWinBunkoBet)?0:$aBet->countWinBunkoBet;
                $countBets =  empty($aBet->countBets)?1:$aBet->countBets;
                $bfb = $countWinBunkoBet/$countBets * 100;
                return $countWinBunkoBet.' ('.round($bfb,1).'%)';
            })
            ->rawColumns(['sumBunko'])
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
            $where .= " AND created_at BETWEEN '{$startTime} 00:00:00' AND '{$endTime} 23:59:59' ";
            $having .= " AND created_at BETWEEN '{$startTime} 00:00:00' AND '{$endTime}  23:59:59' ";
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
    public function RegisterTotal(Request $request){
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $where = '';
        $having = '';
        if($startTime && $endTime){
            $where .= " AND created_at BETWEEN '{$startTime} 00:00:00' AND '{$endTime} 23:59:59' ";
            $having .= " AND created_at BETWEEN '{$startTime} 00:00:00' AND '{$endTime}  23:59:59' ";
        }
        $aSql = Agent::agentReportRegister_aSql($where, $having);
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
    }
    //重新获取棋牌投注报表
    public function getCard(Request $request){
        $iDate = date('Y-m-d',strtotime($request->date ?? '-1 day'));
        try{
            $repo = new \App\Repository\GamesApi\Card\Report($iDate);
            $repo->getRes();
            $repo->createData();
            if($repo->insertData()){
                return response()->json([
                    'status' => true
                ]);
            }
        }catch (\Exception $e){
            return response()->json([
                'status' => false,
                'msg' => $e->getMessage()
            ]);
        }
        return response()->json([
            'status' => false,
            'msg' => '没有数据'
        ]);
    }
    //棋牌投注报表
    public function Card(Request $request){
        if(isset($request->startTime))
            $request->startTime = date('Y-m-d', strtotime($request->startTime));
        if(isset($request->endTime))
            $request->endTime = date('Y-m-d', strtotime($request->endTime));
        if(isset($request->startTime) && ($request->startTime == date('Y-m-d')) && ($request->startTime == $request->endTime))
            return $this->dayCard($request);
        $table = DB::table('report_card')->where(function($aSql) use($request){
            if(isset($request->startTime) && isset($request->endTime))
                $aSql->whereBetween('date', [$request->startTime, $request->endTime]);
        });
        $totalTable = clone $table;
        $count = $table->count();
        $totalArr = $totalTable->select(DB::raw('SUM(`bet_count`) AS `BetCountSum`,SUM(`up_money`) AS totalUp,SUM(`down_money`) AS totaldown, SUM(`bet_money`) AS `betMoney`, SUM(`bet_bunko`) AS betBunko'))->first();
        $res = $table->skip($request->start ?? 0)->take($request->length ?? 100)->get();
        return DataTables::of($res)
            ->setTotalRecords($count)
            ->with('totalArr',$totalArr)
            ->skipPaging()
            ->make(true);
    }
    public function dayCard($request){
        $repo = new \App\Repository\GamesApi\Card\Report();
        $repo->param->startTime = $request->startTime;
        $repo->param->endTime = $request->endTime;
        $repo->param->start = $request->start ?? 0;
        $repo->param->length = $request->length ?? 100;
        $repo->getRes();
        $repo->createData();
        $res = $repo->getData();
        $Total = GamesApi::card_betInfoTotal($request, $repo->sqlArr);
        $sqlCount =  'SELECT COUNT(`Accounts`) AS `count` FROM ( '.implode(' UNION ALL ', $repo->sqlArr).' ) AS b';
        $resCount = DB::select($sqlCount)[0]->count;
        $totalArr = [
            'betMoney' => $Total->BetSum ?? 0,
            'betBunko' => $Total->ProfitSum ?? 0,
            'BetCountSum' => $Total->BetCountSum ?? 0,
            'totalUp' => $Total->totalUp ?? 0,
            'totalDown' => $Total->totalDown ?? 0,
        ];
        return DataTables::of($res)
            ->setTotalRecords($resCount)
            ->with('totalArr',$totalArr)
            ->skipPaging()
            ->make(true);
    }

    /**
     * @param Request $request
     */
    public function Browse(Request $request){
        $params = $request->all();
        $startTime = $params['startTime'] ?? date('Y-m-d');
        $endTime = $params['endTime'] ?? date('Y-m-d');
        $startTime = $startTime > date('Y-m-d') ? date('Y-m-d') : $startTime;
        $endTime = $endTime > date('Y-m-d') ? date('Y-m-d') : $endTime;
        $total = DomainAccess::getData([$startTime,$endTime]);
        $arr = array_slice($total,$params['start'],$params['length']);
        return DataTables::of($arr)
            ->setTotalRecords(count($total))
            ->skipPaging()
            ->make(true);
    }
}
