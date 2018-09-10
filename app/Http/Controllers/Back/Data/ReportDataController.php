<?php

namespace App\Http\Controllers\Back\Data;

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
        $game = $request->get('game');                  //游戏
        $account = $request->get('account');            //总代帐号
        $starttime = $request->get('timeStart');
        $endtime = $request->get('timeEnd');
        $chkTest = $request->get('chkTest');            //是否过滤测试帐号
        $start = $request->get('start');
        $length = $request->get('length');

        $aSql1 = "SELECT zd.ga_id,count(DISTINCT(u.id)) as countMember,count(b.bet_id) as countBet,zd.account as zdaccount, sum(b.bet_money) as sumMoney,
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as sumWinbet,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko,
sum(case WHEN cp.type = 't08' then cp.money else 0 end) as sumActivity,
sum(case WHEN cp.type = 't04' then cp.money else 0 end) as sumRecharge_fee ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        if(isset($game) && $game){
            $whereB .= " and b.game_id = ".$game;
        }
        if(isset($account) && $account){
            $where .= " and zd.account = '".$account."'";
        }
        if(isset($starttime) && $starttime){
            $whereB .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereCp .= " and cp.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $whereB .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereCp .= " and cp.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        if(isset($chkTest) && $chkTest=='on'){
            $whereB .= " and b.testFlag = 0";
            $whereU .= " and u.testFlag = 0";
        }else{
            $whereB .= " and b.testFlag in(0,2)";
            $whereU .= " and u.testFlag in(0,2)";
        }
        $aSql = "";
        $aSql .= " FROM (select user_id,game_id,agent_id,count(bet_id) as bet_id,sum(bet_money) as bet_money,sum(bunko) as bunko,sum(nn_view_money) as nn_view_money from bet b where 1 ".$whereB." group by user_id,game_id) b ";
        $aSql .= " LEFT JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " LEFT JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN `general_agent` zd on ag.gagent_id = zd.ga_id ";
        $aSql .= " LEFT JOIN (select type,to_user,sum(money) as money from `capital` cp where 1 ".$whereCp." group by to_user,type) cp ON cp.to_user = u.id and cp.type in ('t08','t04') ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSqlCount = "SELECT COUNT(DISTINCT(zd.ga_id)) AS count ".$aSql;
        $aSql = $aSql1.$aSql;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY zd.ga_id ORDER BY sumBunko ASC LIMIT ".$start.','.$length;
        $agent = DB::select($aSql);
        $agentCount = DB::select($aSqlCount);

        return DataTables::of($agent)
            ->setTotalRecords($agentCount[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //代理报表
    public function Agent(Request $request)
    {
        $game = $request->get('game');                  //游戏
        $account = $request->get('account');            //代理帐号
        $starttime = $request->get('timeStart');
        $endtime = $request->get('timeEnd');
        $zd = $request->get('zd');            //总代帐号
        $start = $request->get('start');
        $length = $request->get('length');

        $aSql1 = "SELECT ag.a_id,count(DISTINCT(u.id)) as countMember,count(b.bet_id) as countBet,sum(b.bet_money) as sumMoney,ag.account as agaccount,ag.name as agname, 
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as sumWinbet,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko, 
sum(case WHEN cp.type = 't08' then cp.money else 0 end) as sumActivity,
sum(case WHEN cp.type = 't04' then cp.money else 0 end) as sumRecharge_fee,
sum(dr.amount) as sumDrawing,
sum(re.amount) as sumRecharges ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($game) && $game){
            $whereB .= " and b.game_id = ".$game;
        }
        if(isset($account) && $account){
            $where .= " and ag.account = '".$account."'";
        }
        if(isset($starttime) && $starttime){
            $whereB .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereCp .= " and cp.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereDr .= " and dr.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereRe .= " and re.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $whereB .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereCp .= " and cp.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereDr .= " and dr.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereRe .= " and re.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        if(isset($zd) && $zd>0 ){
            $where .= " and ag.gagent_id = ".$zd." and u.testFlag in(0,2)";
        }else{
            $whereB .= " and b.testFlag = 0 ";
            $whereU .= " and u.testFlag = 0 ";
        }
        $aSql = "";
        $aSql .= " FROM (select user_id,game_id,agent_id,count(bet_id) as bet_id,sum(bet_money) as bet_money,sum(bunko) as bunko,sum(nn_view_money) as nn_view_money from bet b where 1 ".$whereB." group by user_id,game_id) b ";
        $aSql .= " LEFT JOIN `users` u on b.user_id = u.id ".$whereU;
        $aSql .= " LEFT JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` dr where 1 ".$whereDr." group by user_id) dr on dr.user_id = u.id and dr.status = 2 ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` re where 1 ".$whereRe." group by userId) re ON re.userId = u.id and re.status = 2 ";
        $aSql .= " LEFT JOIN (select type,to_user,sum(money) as money from `capital` cp where 1 ".$whereCp." group by to_user,type) cp ON cp.to_user = u.id and cp.type in ('t08','t04') ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSqlCount = "SELECT COUNT(DISTINCT(u.agent)) AS count ".$aSql;
        $aSql = $aSql1.$aSql;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY u.agent ORDER BY sumBunko ASC LIMIT ".$start.','.$length;
        $agent = DB::select($aSql);
        $agentCount = DB::select($aSqlCount);
        return DataTables::of($agent)
            ->editColumn('sumRecharges',function ($agent){
                return empty($agent->sumRecharges)?0:$agent->sumRecharges;
            })
            ->editColumn('sumDrawing',function ($agent){
                return empty($agent->sumDrawing)?0:$agent->sumDrawing;
            })
            ->setTotalRecords($agentCount[0]->count)
            ->skipPaging()
            ->make(true);
    }

    //会员报表
    public function User(Request $request)
    {
        $game = $request->get('game');                  //游戏
        $account = $request->get('account');            //会员帐号
        $starttime = $request->get('timeStart');
        $endtime = $request->get('timeEnd');
        $minBunko = $request->get('minBunko');          //最小输赢
        $maxBunko = $request->get('maxBunko');          //最大输赢
        $chkTest = $request->get('chkTest');            //是否过滤测试帐号
        $chkDouble = $request->get('chkDouble');        //显示重复姓名会员
        $ag = $request->get('ag');            //代理帐号
        $start = $request->get('start');
        $length = $request->get('length');

        $aSql1 = "SELECT u.id,u.username,u.fullName,u.agent,count(b.bet_id) as countBet,sum(b.bet_money) as sumMoney,ag.account as agaccount,
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as sumWinbet,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko,
sum(case WHEN cp.type = 't08' then cp.money else 0 end) as sumActivity,
sum(case WHEN cp.type = 't04' then cp.money else 0 end) as sumRecharge_fee,
sum(dr.amount) as sumDrawing,
sum(re.amount) as sumRecharges ";
        $where = "";
        $whereB = "";
        $whereU = "";
        $whereCp = "";
        $whereDr = "";
        $whereRe = "";
        if(isset($game) && $game){
            $whereB .= " and b.game_id = ".$game;
        }
        if(isset($account) && $account){
            $where .= " and u.username = '".$account."'";
        }
        if(isset($starttime) && $starttime){
            $whereB .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereCp .= " and cp.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereDr .= " and dr.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
            $whereRe .= " and re.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $whereB .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereCp .= " and cp.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereDr .= " and dr.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
            $whereRe .= " and re.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        if(isset($minBunko) && $minBunko){
            $where .= " and sumBunko >= ".$minBunko;
        }
        if(isset($maxBunko) && $maxBunko){
            $where .= " and sumBunko <= ".$maxBunko;
        }
        if(isset($ag) && $ag > 0 ){
            $whereU .= " and u.agent = ".$ag;
        }
        if(isset($chkTest) && $chkTest=='1'){
            $whereB .= " and b.testFlag = 0 ";
            $whereU .= " and u.testFlag = 0 ";
        }else {
            $whereB .= " and b.testFlag in (0,2) ";
            $whereU .= " and u.testFlag in (0,2) ";
        }

        $aSql = "";
        $aSql .= " FROM (select user_id,game_id,agent_id,count(bet_id) as bet_id,sum(bet_money) as bet_money,sum(bunko) as bunko,sum(nn_view_money) as nn_view_money from bet b where 1 ".$whereB." group by user_id,game_id) b ";

        if(isset($chkDouble) && $chkDouble=="on"){      //显示重复姓名会员
            $aUser = "(select * from users WHERE fullName in(select fullName from users group by fullName having count(fullName) >= 2) and ".$whereU.")";
            $aSql .= " JOIN ".$aUser." u on b.user_id = u.id ";
        }else{
            $aUser = "(select * from `users` u where 1 ".$whereU.")";
            $aSql .= " LEFT JOIN ".$aUser." u on b.user_id = u.id ";
        }
        $aSql .= " LEFT JOIN `agent` ag on u.agent = ag.a_id ";
        $aSql .= " LEFT JOIN (select user_id,status,sum(amount) as amount from `drawing` dr where 1 ".$whereDr." group by user_id) dr on dr.user_id = u.id and dr.status = 2 ";
        $aSql .= " LEFT JOIN (select userId,status,sum(amount) as amount from `recharges` re where 1 ".$whereRe." group by userId) re ON re.userId = u.id and re.status = 2 ";
        $aSql .= " LEFT JOIN (select type,to_user,sum(money) as money from `capital` cp where 1 ".$whereCp." group by to_user,type) cp ON cp.to_user = u.id and cp.type in ('t08','t04') ";
        $aSql .= " WHERE 1 ";
        $aSql .= $where;
        $aSqlCount = "SELECT COUNT(DISTINCT(u.id)) AS count ".$aSql;
        $aSql = $aSql1.$aSql;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY u.id ORDER BY sumBunko ASC LIMIT ".$start.','.$length;
        $user = DB::select($aSql);
        $agentCount = DB::select($aSqlCount);

        return DataTables::of($user)
            ->setTotalRecords($agentCount[0]->count)
            ->skipPaging()
            ->make(true);
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
        $sql1 = "SELECT g.game_name,g.status,g.game_id, sum(b.bet_money) as sumMoney, COUNT(b.bet_id) AS countBets,count(DISTINCT(b.user_id)) as countMember, sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bunko else 0 end) else(case WHEN bunko >0 then bunko else 0 end) end) as sumWinBunko, count(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.bet_id else Null end) else(case WHEN bunko >0 then b.bet_id else Null end) end) as countWinBunkoBet, count(DISTINCT(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.user_id else Null end) else(case WHEN bunko >0 then b.user_id else Null end) end)) as countWinBunkoMember, sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko FROM `game` AS g LEFT JOIN bet as b ON g.game_id = b.game_id and b.testFlag = 0 ";
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
        $sql = "";
        $sql .= $whereBet ;
        $aSqlCount = "SELECT COUNT(DISTINCT(g.game_id)) AS count FROM `game` AS g LEFT JOIN bet as b ON g.game_id = b.game_id and b.testFlag = 0 ".$sql." WHERE 1 ".$where;
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
