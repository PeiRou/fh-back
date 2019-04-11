<?php

namespace App\Http\Controllers\Back\Data;

use App\Bets;
use App\DomainAccess;
use App\DomainInfo;
use App\GamesApi;
use App\JqBet;
use App\JqReportBet;
use App\ReportAgent;
use App\ReportBet;
use App\ReportBetAgent;
use App\ReportBetGeneral;
use App\ReportBetMember;
use App\ReportGeneral;
use App\ReportMember;
use App\ReportRecharge;
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
                $fact_return_amount = empty($aData->fact_return_amount)?0:$aData->fact_return_amount;
                return round($aData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2);
            })
            ->editColumn('fact_return_amount', function ($aData){
                return round($aData->fact_return_amount,2);
            })
            ->editColumn('win_amount', function ($aData){
                return round($aData->bet_money + $aData->bet_bunko,2);
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
                $aData = ReportBetGeneral::reportQuerySum($aParam, 0);
            else
                $aData = ReportGeneral::reportQuerySum($aParam);
        }

        $activity_money = empty($aData->activity_money)?0.00:$aData->activity_money;
        $handling_fee = empty($aData->handling_fee)?0.00:$aData->handling_fee;
        $fact_return_amount = empty($aData->fact_return_amount)?0:$aData->fact_return_amount;


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
            'win_amount' => empty($aData->bet_money)?'':round($aData->bet_money + $aData->bet_bunko,2),
            'return_amount' => empty($aData->return_amount)?'':$aData->return_amount,
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,3),
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
                $fact_return_amount = empty($aData->fact_return_amount)?0:$aData->fact_return_amount;
                return round($aData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2);
            })
            ->editColumn('win_amount', function ($aData){
                return round($aData->bet_money + $aData->bet_bunko,2);
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
        $fact_return_amount = empty($aData->fact_return_amount)?0.00:$aData->fact_return_amount;

        return response()->json([
            'member_count' => empty($aData->member_count)?'':$aData->member_count,
            'recharges_money' => empty($aData->recharges_money)?'':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'':$aData->drawing_money,
            'bet_count' => empty($aData->bet_count)?'':$aData->bet_count,
            'bet_money' => empty($aData->bet_money)?'':$aData->bet_money,
            'bet_amount' => empty($aData->bet_amount)?'':$aData->bet_amount,
            'win_amount' => empty($aData->bet_money)?'':round($aData->bet_money + $aData->bet_bunko,2),
            'activity_money' => empty($aData->activity_money)?'':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'':$aData->handling_fee,
            'bet_bunko' => empty($aData->bet_bunko)?'':$aData->bet_bunko,
            'return_amount' => empty($aData->return_amount)?'':$aData->return_amount,
            'fact_return_amount' => empty($aData->fact_return_amount)?'':round($aData->fact_return_amount,2),
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2),
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
                $fact_return_amount = empty($aData->fact_return_amount)?0:$aData->fact_return_amount;
                return round($aData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2);
            })
            ->editColumn('fact_return_amount', function ($aData){
                return round($aData->fact_return_amount,2);
            })
            ->editColumn('win_amount', function ($aData){
                return round($aData->bet_money + $aData->bet_bunko,2);
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
        $fact_return_amount = empty($aData->fact_return_amount)?0:$aData->fact_return_amount;
        return response()->json([
            'count_user' => $aData->count_user ?? 0,
            'count_agent' => $aData->count_agent ?? 0,
            'recharges_money' => empty($aData->recharges_money)?'':$aData->recharges_money,
            'drawing_money' => empty($aData->drawing_money)?'':$aData->drawing_money,
            'bet_count' => empty($aData->bet_count)?'':$aData->bet_count,
            'bet_money' => empty($aData->bet_money)?'':$aData->bet_money,
            'bet_amount' => empty($aData->bet_amount)?'':$aData->bet_amount,
            'activity_money' => empty($aData->activity_money)?'':$aData->activity_money,
            'handling_fee' => empty($aData->handling_fee)?'':$aData->handling_fee,
            'bet_bunko' => empty($aData->bet_bunko)?'':$aData->bet_bunko,
            'win_amount' => empty($aData->bet_money)?'':round($aData->bet_money + $aData->bet_bunko,2),
            'fact_return_amount' => empty($aData->fact_return_amount)?'':round($aData->fact_return_amount,2),
            'fact_bet_bunko' => empty($aData->bet_bunko)?'':round($aData->bet_bunko + $activity_money + $handling_fee + $fact_return_amount,2),
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
            ->editColumn('countWinBunkoBetNum', function ($aBet){
                return empty($aBet->countWinBunkoBet)?0:$aBet->countWinBunkoBet;
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

    //报表管理-注册报表
    public function Recharge(Request $request){
        $aParam = $request->input();
        $aData = ReportRecharge::getReportRechargeData($aParam);
        $aDataCount = ReportRecharge::getReportRechargeCount($aParam);
        return DataTables::of($aData)
            ->setTotalRecords($aDataCount)
            ->skipPaging()
            ->make(true);
    }

    //
    public function RechargeTotal(Request $request){
        $aParam = $request->input();
        $aData = ReportRecharge::getReportRechargeTotal($aParam);
        return response()->json([
            'status' => true,
            'data' => $aData[0]
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

    public function CardData(Request $request)
    {
        if(isset($request->startTime))
            $request->startTime = date('Y-m-d', strtotime($request->startTime));
        if(isset($request->endTime))
            $request->endTime = date('Y-m-d', strtotime($request->endTime));
        if(isset($request->startTime) && ($request->startTime == date('Y-m-d')) && ($request->startTime == $request->endTime))
            return $this->dayCard($request);
        $table = DB::table('jq_report_card')->where(function($aSql) use($request){
            if(isset($request->startTime) && isset($request->endTime))
                $aSql->whereBetween('date', [$request->startTime, $request->endTime]);
        });
        $totalTable = clone $table;
        $count = $table->count();
        $totalArr = $totalTable->select(DB::raw('COUNT(distinct `user_id`) AS `count_user` ,SUM(`bet_count`) AS `BetCountSum`,SUM(`up_money`) AS totalUp,SUM(`down_money`) AS totaldown, SUM(`bet_money`) AS `betMoney`, SUM(`bet_bunko`) AS betBunko'))->first();
        if(isset($request->start, $request->length)){
            $table->skip($request->start ?? 0)->take($request->length ?? 100);
        }
        $res = $table->get();
        return [
            'count' => $count,
            'totalArr' => $totalArr,
            'res' => $res,
        ];
    }

    //棋牌投注报表
    public function Card(Request $request){
        $arr = $this->CardData($request);
        return DataTables::of($arr['res'])
            ->setTotalRecords($arr['count'])
            ->with('totalArr',$arr['totalArr'])
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
            'count_user' => $Total->count_user ?? 0,
            'betMoney' => $Total->BetSum ?? 0,
            'betBunko' => $Total->ProfitSum ?? 0,
            'BetCountSum' => $Total->BetCountSum ?? 0,
            'totalUp' => $Total->totalUp ?? 0,
            'totalDown' => $Total->totalDown ?? 0,
        ];
        return [
            'res' => $res,
            'count' => $resCount,
            'totalArr' => $totalArr,
        ];
    }

    public function CardNew(Request $request){
        $aParam = $request->all();
        if(strtotime($aParam['startTime']) == strtotime(date('Y-m-d'))){
            $aUserId = JqBet::reportQuerySelect($aParam);
            $aData = JqBet::reportQuery(implode(',',$aUserId),$aParam);
            $iCount = JqBet::reportQueryCount($aParam);
        }else {
            $aUserId = JqReportBet::reportQuerySelect($aParam);
            $aData = JqReportBet::reportQuery(implode(',',$aUserId),$aParam);
            $iCount = JqReportBet::reportQueryCount($aParam);
        }

        //组装数组
        $aArray = [];
        foreach ($aData as $iData){
            if(isset($aArray[$iData->user_id]) && array_key_exists($iData->user_id,$aArray)){
                $aArray[$iData->user_id]['game'][$iData->game_id] = [
                    'down_fraction' => $iData->down_fraction,
                    'up_fraction' => $iData->up_fraction,
                    'bet_bunko' => $iData->bet_bunko,
                    'bet_money' => $iData->bet_money,
                ];
                $aArray[$iData->user_id]['total']['down_fraction'] += $iData->down_fraction;
                $aArray[$iData->user_id]['total']['up_fraction'] += $iData->up_fraction;
                $aArray[$iData->user_id]['total']['bet_bunko'] += $iData->bet_bunko;
                $aArray[$iData->user_id]['total']['bet_money'] += $iData->bet_money;
            }else{
                $aArray[$iData->user_id]['user_account'] = $iData->user_account;
                $aArray[$iData->user_id]['user_name'] = $iData->user_name;
                $aArray[$iData->user_id]['agent_account'] = $iData->agent_account;
                $aArray[$iData->user_id]['agent_name'] = $iData->agent_name;
                $aArray[$iData->user_id]['game'][$iData->game_id] = [
                    'up_fraction' => $iData->up_fraction,
                    'down_fraction' => $iData->down_fraction,
                    'bet_bunko' => $iData->bet_bunko,
                    'bet_money' => $iData->bet_money,
                ];
                $aArray[$iData->user_id]['total'] = [
                    'down_fraction' => $iData->down_fraction,
                    'up_fraction' => $iData->up_fraction,
                    'bet_bunko' => $iData->bet_bunko,
                    'bet_money' => $iData->bet_money,
                ];
            }
        }

        $aGame = GamesApi::getOpenData();
        $aArrayColumn = ['total'];
        $DataTables = DataTables::of($aArray);
        foreach ($aGame as $iGame){
            $aArrayColumn[] = 'game'.$iGame->g_id;
            $DataTables->editColumn('game'.$iGame->g_id,function ($iArray) use ($iGame){
                $txt = '';
                if(isset($iArray['game'][$iGame->g_id]) && array_key_exists($iGame->g_id,$iArray['game'])) {
                    $txt .= "上分：" . round($iArray['game'][$iGame->g_id]['up_fraction'],2) . "<br/>";
                    $txt .= "下分：" . round($iArray['game'][$iGame->g_id]['down_fraction'],2) . "<br/>";
                    $txt .= "投注额：" . round($iArray['game'][$iGame->g_id]['bet_money'],2) . "<br/>";
                    $txt .= "输赢：" . round($iArray['game'][$iGame->g_id]['bet_bunko'],2);
                }else{
                    $txt .= "上分：0 <br/>";
                    $txt .= "下分：0<br/>";
                    $txt .= "投注额：0.00<br/>";
                    $txt .= "输赢：0.00";
                }
                return $txt;
            });
        }
        return $DataTables
            ->editColumn('user_account', function ($iArray){
                 return $iArray['user_account'].(empty($iArray['user_name'])?'':'('.$iArray['user_name'].')');
            })
            ->editColumn('agent_account', function ($iArray){
                return $iArray['agent_account'].(empty($iArray['agent_name'])?'':'('.$iArray['agent_name'].')');
            })
            ->editColumn('total', function ($iArray){
                return "上分:" . round($iArray['total']['up_fraction'],2) . "<br/>
                        下分：" . round($iArray['total']['down_fraction'],2) . "<br/>
                        投注额：" . round($iArray['total']['bet_bunko'],2) . "<br/>
                        输赢：" . round($iArray['total']['bet_bunko'],2) . "<br/>";
            })
            ->setTotalRecords($iCount)
            ->rawColumns($aArrayColumn)
            ->skipPaging()
            ->make(true);

    }

    public function CardNewTotal(Request $request){
        $aParam = $request->all();
        if(strtotime($aParam['startTime']) == strtotime(date('Y-m-d'))){
            $aData = JqBet::reportQuerySum($aParam);
        }else {
            $aData = JqReportBet::reportQuerySum($aParam);
        }

        $aArray = [];
        $iUpFraction = 0;
        $iDownFraction = 0;
        $iBetBunko = 0;
        $iBetMoney = 0;
        foreach ($aData as $iData){
            if(isset($aArray[$iData->game_id]) && array_key_exists($iData->game_id,$aArray)){
                $aArray[$iData->game_id]['up_fraction'] += $iData->up_fraction;
                $aArray[$iData->game_id]['down_fraction'] += $iData->down_fraction;
                $aArray[$iData->game_id]['bet_bunko'] += $iData->bet_bunko;
                $aArray[$iData->game_id]['bet_money'] += $iData->bet_money;
                $iUpFraction += $iData->up_fraction;
                $iDownFraction += $iData->down_fraction;
                $iBetBunko += $iData->bet_bunko;
                $iBetMoney += $iData->bet_money;
            }else{
                $aArray[$iData->game_id] = [
                    'up_fraction' => $iData->up_fraction,
                    'down_fraction' => $iData->down_fraction,
                    'bet_bunko' => $iData->bet_bunko,
                    'bet_money' => $iData->bet_money,
                ];
                $iUpFraction += $iData->up_fraction;
                $iDownFraction += $iData->down_fraction;
                $iBetBunko += $iData->bet_bunko;
                $iBetMoney += $iData->bet_money;
            }
        }

        $aData = [];
        $aGame = GamesApi::get();

        foreach ($aGame as $iGame){
            if(isset($aArray[$iGame->g_id]) && array_key_exists($iGame->g_id,$aArray)){
                $aData[] = [
                    'key' => 'game'.$iGame->g_id,
                    'value' => "上分:" . round($aArray[$iGame->g_id]['up_fraction'],2) . "<br/>
                                下分：" . round($aArray[$iGame->g_id]['down_fraction'],2) . "<br/>
                                投注额：" . round($aArray[$iGame->g_id]['bet_money'],2) . "<br/>
                                输赢：" . round($aArray[$iGame->g_id]['bet_bunko'],2) . "<br/>",
                ];
            }else{
                $aData[] = [
                    'key' => 'game'.$iGame->g_id,
                    'value' => "上分:0<br/>
                                下分：0<br/>
                                投注额：0.00<br/>
                                输赢：0.00<br/>",
                ];
            }
        }

        return [
            'total' => (array)$aData,
            'betCount' => round($iUpFraction,2),
            'betMoney' => round($iDownFraction,2),
            'betBunko' => round($iBetBunko,2),
            'betMoney1' => round($iBetMoney,2)
        ];
    }

    public function dayTc(Request $request)
    {
        if(isset($request->startTime,$request->endTime)){
            $request->startTime = date('Y-m-d', strtotime($request->startTime));
            $request->endTime = date('Y-m-d', strtotime($request->endTime));
        }
        $res = \App\Repository\GamesApi\Card\TcReport::getData($request);
        foreach ($res as &$v) $v = (object)$v;
        $resCount = GamesApi::tc_betInfoCount($request);
        $totalArr = GamesApi::tc_betInfoTotal($request);
        return [
            'res' => $res,
            'count' => $resCount,
            'totalArr' => $totalArr,
        ];
    }

    public function TcData(Request $request)
    {
        isset($request->startTime) && $request->startTime = date('Y-m-d', strtotime($request->startTime));
        isset($request->endTime) && $request->endTime = date('Y-m-d', strtotime($request->endTime));
        if(isset($request->startTime) && ($request->startTime == date('Y-m-d')) && ($request->startTime == $request->endTime))
            return $this->dayTc($request);
        $model = DB::table('jq_report_tc');
        isset($request->startTime, $request->endTime) &&
        $model->whereBetween('date',[$request->startTime, $request->endTime]);
        isset($request->productType) && $model->where('productType', $request->productType);
        isset($request->username) && $model->where('username', $request->username);
        $model->select(DB::raw('SUM(bet_count) AS `bet_count`,
                SUM(user_count) AS user_count,
                SUM(AllBet) AS AllBet,
                SUM(Profit) AS Profit,
                SUM(validBetAmount) AS validBetAmount,
                productType,
                username,
                agent_account,
                agent_name,
                SUM(upMoney) AS upMoney,
                SUM(downMoney) AS downMoney'));
        $totalModel = clone $model;
        $totalArr = $totalModel->first();
        isset($request->isGroupUser) && $request->isGroupUser && $model->groupBy('username');
        $model->groupBy('productType');
        $resCount = $model->count();
        isset($request->start, $request->length) && $model->skip($request->start)->take($request->length);
        $res = $model->get();
        return [
            'res' => $res,
            'count' => $resCount,
            'totalArr' => $totalArr,
        ];

    }

    public function Tc(Request $request)
    {
        $arr = $this->TcData($request);
        return DataTables::of($arr['res'])
            ->editColumn('productType',function ($v){
                $str = \App\GamesList::$productTypeList[$v->productType]['name'] ?? '';
                $games = [];
                foreach (\App\GamesList::$productTypeList[$v->productType]['games'] ?? [] as $v){
                    $games[] = \App\GamesList::$gameCategory[$v] ?? '';
                }

                !empty($games) && $str .= '('.implode('、', $games).')';
                return $str;
            })
            ->editColumn('control',function ($v){
                return '<span class="edit-link" onclick="info('.$v->productType.')">查看明细</span>';
            })
            ->setTotalRecords($arr['count'])
            ->rawColumns(['control'])
            ->with('totalArr',$arr['totalArr'])
            ->skipPaging()
            ->make(true);
    }

    public function GamesApi(Request $request)
    {
        if($request->dataTag == 'qp')
            return $this->Card($request);
        if($request->dataTag == 'tc')
            return $this->Tc($request);
    }

    public function dayGamesApiBet_Tc(Request $request)
    {
        if(isset($request->startTime,$request->endTime)){
            $request->startTime = date('Y-m-d', strtotime($request->startTime));
            $request->endTime = date('Y-m-d', strtotime($request->endTime));
        }
        $res = GamesApi::report_tc_data($request);
        $resCount = GamesApi::report_tc_Count($request);
        $totalArr = GamesApi::report_tc_Total($request);
        return [
            'res' => $res,
            'count' => $resCount,
            'totalArr' => $totalArr,
        ];
    }
    public function GamesApiBet_TcData(Request $request)
    {
        isset($request->startTime) && $request->startTime = date('Y-m-d', strtotime($request->startTime));
        isset($request->endTime) && $request->endTime = date('Y-m-d', strtotime($request->endTime));
        if(isset($request->startTime) && ($request->startTime == date('Y-m-d')) && ($request->startTime == $request->endTime))
            return $this->dayGamesApiBet_Tc($request);

        $model = DB::table('jq_report_tc_bet');

        isset($request->startTime, $request->endTime) && $model->whereBetween('date',[$request->startTime, $request->endTime]);
        isset($request->productType) && $model->where('productType', $request->productType);
        isset($request->username) && $model->where('username', $request->username);

        $totalModel = clone $model;
        $totalArr = $totalModel->select(DB::raw('SUM(bet_count) AS `bet_count`,
                SUM(AllBet) AS AllBet,
                SUM(Profit) AS Profit,
                SUM(validBetAmount) AS validBetAmount'))->first();

        $resCount = $model->count();

        isset($request->start, $request->length) && $model->skip($request->start)->take($request->length);
        $res = $model->get();
        return [
            'res' => $res,
            'count' => $resCount,
            'totalArr' => $totalArr,
        ];
    }
    public function GamesApiBet_Tc(Request $request)
    {
        $arr = $this->GamesApiBet_TcData($request);

        return DataTables::of($arr['res'])
            ->editColumn('productType',function ($v){
                return \App\GamesList::$productType[$v->productType] ?? '';
            })
            ->editColumn('gameCategory',function ($v){
                return \App\GamesList::$gameCategory[$v->gameCategory] ?? '';
            })
            ->editColumn('control',function ($v){
                return '<span class="edit-link" onclick="info('.$v->productType.',\''.$v->username.'\',\''.$v->gameCategory.'\')">查看明细</span>';
            })
            ->setTotalRecords($arr['count'])
            ->with('totalArr',$arr['totalArr'])
            ->rawColumns(['control'])
            ->skipPaging()
            ->make(true);
    }
    public function GamesApiInfo_tc(Request $request)
    {
        $arr = $this->TcData($request);
        return DataTables::of($arr['res'])
            ->editColumn('productType',function ($v){
                $str = \App\GamesList::$productTypeList[$v->productType]['name'] ?? '';
                $games = [];
                foreach (\App\GamesList::$productTypeList[$v->productType]['games'] ?? [] as $v){
                    $games[] = \App\GamesList::$gameCategory[$v] ?? '';
                }

                !empty($games) && $str .= '('.implode('、', $games).')';
                return $str;
            })
            ->editColumn('control',function ($v){
                return '<span class="edit-link" onclick="info('.$v->productType.',\''.$v->username.'\')">查看明细</span>';
            })
            ->editColumn('agent_account',function ($v){
                return $v->agent_account.'('.$v->agent_name.')';
            })
            ->setTotalRecords($arr['count'])
            ->rawColumns(['control'])
            ->with('totalArr',$arr['totalArr'])
            ->skipPaging()
            ->make(true);
    }

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
