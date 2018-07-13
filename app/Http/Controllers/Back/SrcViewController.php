<?php

namespace App\Http\Controllers\Back;

use App\Games;
use App\PayOnline;
use App\PlayCates;
use App\SubAccount;
use App\SystemSetting;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SrcViewController extends Controller
{

    //代理登录页面
    /**
     * SrcViewController constructor.
     */
    public function AgentLogin()
    {
        return view('back.agentLogin');
    }
    
    //管理登录页面
    public function AdminLogin()
    {
        //return view('back.adminLogin');
        return view('back.O_adminLogin');
    }
    
    //控制台
    public function Dash()
    {
        return view('back.dash');
    }

    //总代理
    public function generalAgent()
    {
        return view('back.generalAgent');
    }
    //代理
    public function agent(Request $request)
    {
        $gaid = $request->get('id');
        return view('back.agent',compact('gaid'));
    }
    //会员
    public function user(Request $request)
    {
        $aid = $request->get('id');         //代理id
        $gaid = $request->get('ga_id');         //总代id
        $levels = DB::table('level')->where('status',1)->get();
        $agent = DB::table('agent')->where('status',1)->get();

        //统计会员数据
        $allUser = DB::table('users')->where('testFlag',0)->count();
        $todayRegUsers = DB::table('users')->where('testFlag',0)->whereDate('created_at',date('Y-m-d'))->count();
        $monthRegUsers = DB::table('users')->where('testFlag',0)->whereRaw('DATE_FORMAT(created_at, "%Y%m" ) = DATE_FORMAT( CURDATE( ) , "%Y%m" )')->count();
        $lastMonthRegUsers = DB::table('users')->where('testFlag',0)->whereRaw('PERIOD_DIFF( date_format( now( ) , "%Y%m" ) , date_format( created_at, "%Y%m" ) ) =1')->count();

        return view('back.user',compact('aid','gaid','levels','agent','allUser','todayRegUsers','monthRegUsers','lastMonthRegUsers'));
    }
    //会员注单详情 - 独占页面
    public function userBetList($userId)
    {
        $getUserInfo = User::where('id',$userId)->first();
        $games = DB::table('game')->where('status',1)->get();
        $nowDate = date('Y-m-d');
        $yesterday = Carbon::parse($nowDate)->addDays(-1)->toDateString();
        $today = date('Y-m-d');
        return view('back.userBetList',compact('getUserInfo','games','userId','nowDate','yesterday','today'));
    }
    //子账号
    public function subAccount()
    {
        return view('back.subAccount');
    }
    //在线会员
    public function onlineUser()
    {
        return view('back.onlineUser');
    }

    //财务管理
    //充值记录
    public function rechargeRecord()
    {
        $today = date('Y-m-d');
        return view('back.rechargeRecord',compact('today'));
    }
    //提款记录
    public function drawingRecord()
    {
        $today = date('Y-m-d');
        $rechLevel = DB::table('level')->where('status',1)->get();
        return view('back.drawingRecord',compact('today','rechLevel'));
    }
    //资金明细
    public function capitalDetails()
    {
        return view('back.capitalDetails');
    }
    //会员对账
    public function memberReconciliation()
    {
        return view('back.memberReconciliation');
    }
    //代理对账
    public function agentReconciliation()
    {
        return view('back.agentReconciliation');
    }

    //开奖记录
    //重庆时时彩
    public function openManage_cqssc()
    {
        return view('back.open.cqssc');
    }
    //北京pk10
    public function openManage_bjpk10()
    {
        return view('back.open.bjpk10');
    }
    //北京快乐8
    public function openManage_bjkl8()
    {
        return view('back.open.bjkl8');
    }
    //六合彩
    public function openManage_xglhc()
    {
        return view('back.open.lhc');
    }
    //幸运六合彩
    public function openManage_xylhc()
    {
        return view('back.open.xylhc');
    }
    
    //报表管理
    //总代理报表
    public function reportGagent()
    {
        $games = Games::where('status',1)->get();
        return view('back.reportGagent',compact('games'));
    }
    //代理报表
    public function reportAgent(Request $request)
    {
        $zd = $request->get('zd');            //总代帐号
        $start = $request->get('start');
        $end = $request->get('end');
        $games = Games::where('status',1)->get();
        return view('back.reportAgent',compact('games','zd','start','end'));
    }
    //会员报表
    public function reportUser(Request $request)
    {
        $ag = $request->get('ag');            //代理帐号
        $start = $request->get('start');
        $end = $request->get('end');
        $games = Games::where('status',1)->get();
        return view('back.reportUser',compact('games','ag','start','end'));
    }
    //在线报表
    public function reportOnline()
    {
        return view('back.reportOnline');
    }

    //投注记录
    //今日注单搜索
    public function betTodaySearch()
    {
        $games = Games::where('status',1)->get();
        return view('back.betTodaySearch',compact('games'));
    }

    public function playCate($gameId = "")
    {
        $getCate = PlayCates::where('gameId',$gameId)->get();
        return response()->json($getCate);
    }
    //历史注单搜索
    public function betHistorySearch()
    {
        $games = Games::where('status',1)->get();
        return view('back.betHistorySearch',compact('games'));
    }
    //实时滚单
    public function betRealTime()
    {
        $games = Games::where('status',1)->get();
        return view('back.betRealTime',compact('games'));
    }

    //公告管理
    //公告设置
    public function noticeSetting()
    {
        return view('back.noticeSetting');
    }
    //消息推送
    public function messageSend()
    {
        return view('back.messageSend');
    }
    
    //游戏管理
    public function gameSetting()
    {
        return view('back.gameSetting');
    }
    //盘口设定
    public function handicapSetting()
    {
        $gameData = json_decode(Storage::disk('local')->get('gameData.php'),true);
        $game = Games::all();
        return view('back.handicapSetting',compact('gameData','game'));
    }
    
    //权限
    public function Permissions()
    {
        //return $this->hasPermission->hasPermission(['system.permission','system.role','system.systemSetting']);
        return view('back.system.permissions');
    }
    //角色
    public function role()
    {
        return view('back.system.role');
    }
    //系统参数设置
    public function systemSetting()
    {
        $set = SystemSetting::where('id',1)->first();
        return view('back.system.systemSetting',compact('set'));
    }
    //文章管理
    public function articleManage()
    {
        return view('back.system.articleManage');
    }

    //日志管理
    //登录日志
    public function loginLog()
    {
        return view('back.log.login');
    }
    //操作日志
    public function handleLog()
    {
        return view('back.log.handle');
    }
    //异常日志
    public function abnormalLog()
    {
        return view('back.log.abnormal');
    }


    //充值配置
    //绑定银行配置
    public function payOnline()
    {
        return view('back.pay.payOnline');
    }
    //银行支付配置
    public function payBank()
    {
        return view('back.pay.payBank');
    }
    //支付宝支付配置
    public function payAlipay()
    {
        return view('back.pay.payAlipay');
    }
    //微信支付配置
    public function payWechat()
    {
        return view('back.pay.payWechat');
    }
    //微信支付配置
    public function payCft()
    {
        return view('back.pay.payCft');
    }
    //绑定银行配置
    public function bindBank()
    {
        return view('back.pay.bindBank');
    }
    //支付层级配置
    public function payLayout()
    {
        return view('back.pay.payLayout');
    }
    //cho
    public function rechargeWay()
    {
        return view('back.pay.rechargeWay');
    }

    public function payOnlineSelectData($rechargeType = "")
    {
        if($rechargeType){
            $get = PayOnline::select('payeeName','id')->where('rechType',$rechargeType)->where('status',1)->get();
            return response()->json($get);
        }
    }

    public function payOnlineDateChange($date = "")
    {
        $dt = Carbon::now();
        //本周
        //当前日期
        $sdefaultDate = date("Y-m-d");
        //$first =1 表示每周星期一为开始日期 0表示每周日为开始日期
        $first=1;
        //获取当前周的第几天 周日是 0 周一到周六是 1 - 6
        $w=date('w',strtotime($sdefaultDate));
        //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
        $week_start = date('Y-m-d',strtotime("$sdefaultDate -".($w ? $w - $first : 6).' days'));
        //本周结束日期
        $week_end = date('Y-m-d',strtotime("$week_start +6 days"));

        $m = date('Y-m-d', mktime(0,0,0,date('m')-1,1,date('Y'))); //上个月的开始日期
        $t = date('t',strtotime($m)); //上个月共多少天


        if($date == 'today'){
            return response()->json([
                'start'=> $sdefaultDate,
                'end' => $sdefaultDate
            ]);
        }
        if($date == 'yesterday'){
            return response()->json([
                'start'=> $dt->yesterday()->toDateString(),
                'end' => $dt->yesterday()->toDateString()
            ]);
        }
        if($date == 'week'){
            return response()->json([
                'start'=> $week_start,
                'end' => $week_end
            ]);
        }
        if($date == 'month'){
            return response()->json([
                'start'=> date('Y-m-d',mktime(0,0,0,date('m'),1,date('Y'))),
                'end' => date('Y-m-d',mktime(23,59,59,date('m'),date('t'),date('Y')))
            ]);
        }
        if($date == 'lastMonth'){
            return response()->json([
                'start'=> date('Y-m-d', mktime(0,0,0,date('m')-1,1,date('Y'))),
                'end' => date('Y-m-d', mktime(0,0,0,date('m')-1,$t,date('Y')))
            ]);
        }
    }
}
