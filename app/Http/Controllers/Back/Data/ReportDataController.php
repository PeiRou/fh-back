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

        $aSql = "SELECT zd.ga_id,count(DISTINCT(u.id)) as countMember,count(b.bet_id) as countBet,zd.account as zdaccount, sum(b.bet_money) as sumMoney,
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as sumWinbet,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko 
FROM `bet` b LEFT JOIN `users` u on b.user_id = u.id LEFT JOIN `agent` ag on u.agent = ag.a_id LEFT JOIN `general_agent` zd on ag.gagent_id = zd.ga_id WHERE 1 ";
        $where = "";
        if(isset($game) && $game){
            $where .= " and b.game_id = ".$game;
        }
        if(isset($account) && $account){
            $where .= " and zd.account = '".$account."'";
        }
        if(isset($starttime) && $starttime){
            $where .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $where .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        if(isset($chkTest) && $chkTest=='on'){
            $where .= " and u.testFlag = 0";
        }else{
            $where .= " and u.testFlag in(0,2)";
        }
        $aSql .= $where;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY zd.ga_id ORDER BY sumBunko ASC ";
        $agent = DB::select($aSql);

        return DataTables::of($agent)
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

        $aSql = "SELECT ag.a_id,count(DISTINCT(u.id)) as countMember,count(b.bet_id) as countBet,sum(b.bet_money) as sumMoney,ag.account as agaccount,ag.name as agname, 
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as sumWinbet,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko 
FROM `bet` b LEFT JOIN `users` u on b.user_id = u.id LEFT JOIN `agent` ag on u.agent = ag.a_id WHERE 1";
        $where = "";
        if(isset($game) && $game){
            $where .= " and b.game_id = ".$game;
        }
        if(isset($account) && $account){
            $where .= " and ag.account = '".$account."'";
        }
        if(isset($starttime) && $starttime){
            $where .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $where .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        if(isset($zd) && $zd>0 ){
            $where .= " and ag.gagent_id = ".$zd;
        }else{
            $where .= " and u.testFlag = 0 ";
        }
        $aSql .= $where;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY u.agent ORDER BY sumBunko ASC ";
        $agent = DB::select($aSql);

        return DataTables::of($agent)
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

        $aUser = '`users`';
        if(isset($chkDouble) && $chkDouble=="on"){
            $aUser = "(select * from users WHERE fullName in(select fullName from users group by fullName having count(fullName) > 1))";
        }

        $aSql = "SELECT u.id,u.username,u.fullName,u.agent,count(b.bet_id) as countBet,sum(b.bet_money) as sumMoney,ag.account as agaccount,
sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bet_money else 0 end) else(case WHEN bunko >0 then bet_money else 0 end) end) as sumWinbet,
sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko
            FROM {$aUser} u LEFT JOIN `bet` b on u.id = b.user_id LEFT JOIN `agent` ag on u.agent = ag.a_id WHERE 1 ";
        $where = "";
        if(isset($game) && $game){
            $where .= " and b.game_id = ".$game;
        }
        if(isset($account) && $account){
            $where .= " and u.username = '".$account."'";
        }
        if(isset($starttime) && $starttime){
            $where .= " and b.created_at >= '".date("Y-m-d 00:00:00",strtotime($starttime))."'";
        }
        if(isset($endtime) && $endtime){
            $where .= " and b.created_at <= '".date("Y-m-d 23:59:59",strtotime($endtime))."'";
        }
        if(isset($minBunko) && $minBunko){
            $where .= " and sumBunko >= ".$minBunko;
        }
        if(isset($maxBunko) && $maxBunko){
            $where .= " and sumBunko <= ".$maxBunko;
        }
        if(isset($ag) && $ag > 0 ){
            $where .= " and u.agent = ".$ag;
        }
        if(isset($chkTest) && $chkTest=='on'){
            $where .= " and u.testFlag = 0 ";
        }else {
            $where .= " and u.testFlag in (0,2) ";
        }
        $aSql .= $where;
        Session::put('reportSql',$aSql);
        $aSql .= " GROUP BY u.id ORDER BY sumBunko ASC ";
        $user = DB::select($aSql);

        return DataTables::of($user)
            ->make(true);
    }

    //投注报表
    public function Bet(Request $request)
    {
        $starttime = '2018-08-05';
        $endtime = '2018-08-05';
        $sql = "SELECT g.game_name,g.status,g.game_id, sum(b.bet_money) as sumMoney, COUNT(b.bet_id) AS countBets,count(DISTINCT(b.user_id)) as countMember, sum(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then bunko else 0 end) else(case WHEN bunko >0 then bunko else 0 end) end) as sumWinBunko, count(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.bet_id else Null end) else(case WHEN bunko >0 then b.bet_id else Null end) end) as countWinBunkoBet, count(DISTINCT(case WHEN b.game_id in (90,91) then (case WHEN nn_view_money > 0 then b.user_id else Null end) else(case WHEN bunko >0 then b.user_id else Null end) end)) as countWinBunkoMember, sum(case WHEN b.game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as sumBunko FROM `game` AS g LEFT JOIN bet as b ON g.game_id = b.game_id and b.testFlag = 0 ";
        $whereBet = "";
        if(isset($starttime) && $starttime){
            $whereBet .= " and b.created_at >= '2018-08-05 00:00:00'";
        }
        if(isset($endtime) && $endtime){
            $whereBet .= " and b.created_at <= '2018-08-05 23:59:59'";
        }
        $sql .= $whereBet ;
        $sql .= " WHERE 1 GROUP BY g.game_id order BY sumBunko desc";
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
}
