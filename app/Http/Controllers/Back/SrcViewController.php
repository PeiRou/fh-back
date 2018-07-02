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
    public function agent()
    {
        return view('back.agent');
    }
    //会员
    public function user()
    {
        $levels = DB::table('level')->where('status',1)->get();
        return view('back.user',compact('levels'));
    }
    //会员注单详情 - 独占页面
    public function userBetList($userId)
    {
        $getUserInfo = User::where('id',$userId)->first();
        $games = DB::table('game')->where('status',1)->get();
        $nowDate = date('Y-m-d');
        $yesterday = Carbon::parse($nowDate)->addDays(-1)->toDateString();
        return view('back.userBetList',compact('getUserInfo','games','userId','nowDate','yesterday'));
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
        //今日在线支付充值总数
        $onlinePayToday = DB::table('recharges')
//            ->leftJoin('users','recharges.userId', '=', 'users.id')
//            ->where('')
            ->where('payType','onlinePayment')->where('status',2)->whereDate('created_at',date('Y-m-d'))->sum('amount');
        return view('back.rechargeRecord',compact('today','onlinePayToday'));
    }
    //提款记录
    public function drawingRecord()
    {
        return view('back.drawingRecord');
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
        return view('back.reportGagent');
    }
    //代理报表
    public function reportAgent()
    {
        return view('back.reportAgent');
    }
    //会员报表
    public function reportUser()
    {
        return view('back.reportUser');
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
        if($date == 'yesterday'){
            return response()->json([
                'start'=> $dt->yesterday(),
                'end' => $dt->yesterday()
            ]);
        }
    }
}
