<?php

namespace App\Http\Controllers\Back\Data;

use App\Agent;
use App\GeneralAgent;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;

class ReportDataController extends Controller
{
    //总代理报表
    public function Gagent()
    {
        $Gagent = GeneralAgent::all();
        return DataTables::of($Gagent)
            ->make(true);
    }
    
    //代理报表
    public function Agent()
    {
        $agent = Agent::all();
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

        $aUser = '`users`';
        if(isset($chkDouble) && $chkDouble=="on"){
            $aUser = "(select * from users WHERE fullName in(select fullName from users group by fullName having count(fullName) > 1))";
        }

        $aSql = "SELECT u.id,u.username,u.fullName,u.agent,count(b.bet_id) as countBet,sum(b.bet_money) as sumMoney,ag.account as agaccount,
            sum(case WHEN bunko >0 then bet_money else 0 end) as sumWinbet,sum(bunko) as sumBunko
            FROM {$aUser} u LEFT JOIN `bet` b on u.id = b.user_id LEFT JOIN `agent` ag on u.agent = ag.a_id WHERE u.testFlag = 0 ";
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
        if(isset($chkTest) && $chkTest=='on'){
            $where .= " and ( u.agent  =1 OR u.agent  >= 3 )";
        }
        $aSql = $aSql.$where." GROUP BY u.id ";
        $user = DB::select($aSql);

        return DataTables::of($user)
            ->make(true);
    }
}
