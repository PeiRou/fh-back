<?php

namespace App\Http\Controllers\Back;

use App\Activity;
use App\ActivitySend;
use App\Agent;
use App\AgentDrawDetails;
use App\AgentReport;
use App\AgentReportBase;
use App\AgentReportReview;
use App\Capital;
use App\Feedback;
use App\Games;
use App\Levels;
use App\LogHandle;
use App\MessagePush;
use App\PayOnline;
use App\PayOnlineNew;
use App\PermissionsAuth;
use App\PlatformDeposit;
use App\PlatformSettlement;
use App\PlayCates;
use App\PromotionConfig;
use App\PromotionReport;
use App\PromotionReview;
use App\Recharges;
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
        if(Session::get('account_id'))
            return view('back.dash');
        else
            return view('back.O_adminLogin');
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
        $aStatus = Agent::$agentStatus;
        return view('back.agent',compact('gaid','aStatus'));
    }
    //会员
    public function user(Request $request)
    {
        $aid = $request->get('id');         //代理id
        $gaid = $request->get('ga_id');         //总代id
        $levels = DB::table('level')->where('status',1)->get();
        $agent = DB::table('agent')->where('status',1)->get();

//        //统计会员数据
//        $allUser = DB::table('users')->where('testFlag',0)->count();
//        $todayRegUsers = DB::table('users')->where('testFlag',0)->whereDate('created_at',date('Y-m-d'))->count();
//        $yesterday = Carbon::now()->addDays(-1)->toDateString();
//        $yesterdayRegUsers = DB::table('users')->where('testFlag',0)->whereDate('created_at',$yesterday)->count();
//        $monthRegUsers = DB::table('users')->where('testFlag',0)->whereRaw('DATE_FORMAT(created_at, "%Y%m" ) = DATE_FORMAT( CURDATE( ) , "%Y%m" )')->count();
//        $lastMonthRegUsers = DB::table('users')->where('testFlag',0)->whereRaw('PERIOD_DIFF( date_format( now( ) , "%Y%m" ) , date_format( created_at, "%Y%m" ) ) =1')->count();
//        $todayRechargesUser = DB::table('users')->where('testFlag',0)->where('PayTimes',1)->whereDate('created_at',date('Y-m-d'))->count();
//        $yesterdayRechargesUser = DB::table('users')->where('testFlag',0)->where('PayTimes',1)->whereDate('created_at',Carbon::now()->addDays(-1)->toDateString())->count();
//        $monthRechargesUser = DB::table('users')->where('testFlag',0)->where('PayTimes',1)->whereRaw('DATE_FORMAT(created_at, "%Y%m" ) = DATE_FORMAT( CURDATE( ) , "%Y%m" )')->count();

        return view('back.user',compact('aid','gaid','levels','agent','allUser','todayRegUsers','monthRegUsers','lastMonthRegUsers','todayRechargesUser','yesterdayRegUsers','yesterdayRechargesUser','monthRechargesUser'));
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
    //会员注单统计
    public function userBetListTotal(Request $request)
    {
        //$userId = $request->get('userId');
        $username = $request->get('username');
        $startTime = $request->get('startTime');
        $endTime = $request->get('endTime');
        $issue = $request->get('issue');
        $orderNum = $request->get('orderNum');
        $userInfo = DB::table('users')->where('username',$username)->first();

        $get = DB::table('bet')->select(DB::raw('sum(bet_money) as betTotal, sum(case WHEN game_id in (90,91) then nn_view_money else(case when bunko >0 then bunko-bet_money else bunko end)end) as winTotal'))
            ->where(function ($query) use($issue) {
                if($issue && isset($issue)){
                    $query->where('issue',$issue);
                }
            })
            ->where(function ($query) use($orderNum) {
                if($orderNum && isset($orderNum)){
                    $query->where('order_id',$orderNum);
                }
            })
            ->where('user_id',$userInfo->id)->whereBetween('created_at',[$startTime.' 00:00:00', $endTime.' 23:59:59'])->get();
        return response()->json($get);
    }
    //注单明细获取开奖历史
    public function BetListOpenHistory($gameId,$issue)
    {
        if($gameId == 50){
            $gameTable = 'game_bjpk10';
            $game_name = '北京赛车';
        }
        if($gameId == 80){
            $gameTable = 'game_mssc';
            $game_name = '秒速赛车';
        }
        if($gameId == 82){
            $gameTable = 'game_msft';
            $game_name = '秒速飞艇';
        }
        if($gameId == 81){
            $gameTable = 'game_msssc';
            $game_name = '秒速时时彩';
        }
        if($gameId == 1){
            $gameTable = 'game_cqssc';
            $game_name = '重庆时时彩';
        }
        if($gameId == 66){
            $gameTable = 'game_pcdd';
            $game_name = 'PC蛋蛋';
        }
        if($gameId == 99){
            $gameTable = 'game_paoma';
            $game_name = '跑马';
        }
        if($gameId == 70){
            $gameTable = 'game_lhc';
            $game_name = '香港六合彩';
        }
        if($gameId == 65){
            $gameTable = 'game_bjkl8';
            $game_name = '北京快乐8';
        }
        if($gameId == 85){
            $gameTable = 'game_xylhc';
            $game_name = '幸运六合彩';
        }
        if($gameId == 86){
            $gameTable = 'game_msjsk3';
            $game_name = '秒速快3';
        }
        if(!isset($gameTable))
            return response()->json([
                'status' => false
            ]);
        $get = DB::table($gameTable)->where('issue',$issue)->first();
        if($gameId == 70 || $gameId == 85){
            if($get->open_num == ''){
                return response()->json([
                    'status' => false
                ]);
            } else {
                $openNum = explode(',',$get->open_num);
                $str = "<div>
                    <div style='background: #f56363;padding: 5px;color: #fff;'>".$game_name." - 第".$issue."期</div>
                    <div class='open-float-num'>";
                foreach ($openNum as $item){
                    $str .= '<span>'.$item.'</span>';
                }
                $str .= "</div></div>";
                return response()->json([
                    'status' => true,
                    'openNum' => $str
                ]);
            }
        } else {
            if($get->opennum == ''){
                return response()->json([
                    'status' => false
                ]);
            } else {
                $openNum = explode(',',$get->opennum);
                $str = "<div>
                    <div style='background: #f56363;padding: 5px;color: #fff;'>".$game_name." - 第".$issue."期</div>
                    <div class='open-float-num'>";
                foreach ($openNum as $item){
                    $str .= '<span>'.$item.'</span>';
                }
                $str .= "</div></div>";
                return response()->json([
                    'status' => true,
                    'openNum' => $str
                ]);
            }
        }
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
        $aRechargesType = Recharges::$rechargesType;
        return view('back.rechargeRecord',compact('today','aRechargesType'));
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
        $games = Games::getGameOption();
        $playTypes = Capital::$playTypeOption;
        $capitalTimes = Capital::getCapitalTimeOption();
        $aRechargesType = Recharges::$rechargesType;
        return view('back.capitalDetails',compact('games','playTypes','capitalTimes','aRechargesType'));
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
    
    //棋牌管理
    //上分下分查询
    public function upDownSearch()
    {
        return view('back.cardGame.upDownSearch');
    }

    //棋牌投注查询
    public function cardBetInfo()
    {
        return view('back.cardGame.cardBetInfo');
    }

    //开奖记录
    //重庆幸运农场
    public function openManage_cqxync()
    {
        return view('back.open.cqxync');
    }
    //广东快乐十分
    public function openManage_gdklsf()
    {
        return view('back.open.gdklsf');
    }//广东11选5
    public function openManage_gd11x5()
    {
        return view('back.open.gd11x5');
    }

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
    //秒速赛车
    public function openManage_mssc()
    {
        return view('back.open.mssc');
    }
    //秒速飞艇
    public function openManage_msft()
    {
        return view('back.open.msft');
    }
    //跑马
    public function openManage_paoma()
    {
        return view('back.open.paoma');
    }
    //秒速时时彩
    public function openManage_msssc()
    {
        return view('back.open.msssc');
    }
    //秒速快3
    public function openManage_msjsk3()
    {
        return view('back.open.msjsk3');
    }
    //江苏快3
    public function openManage_jsk3()
    {
        return view('back.open.jsk3');
    }
    //安徽快3
    public function openManage_ahk3()
    {
        return view('back.open.ahk3');
    }
    //吉林快3
    public function openManage_jlk3()
    {
        return view('back.open.jlk3');
    }
    //湖北快3
    public function openManage_hbk3()
    {
        return view('back.open.hbk3');
    }
    //广西快3
    public function openManage_gxk3()
    {
        return view('back.open.gxk3');
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
    //报表统计
    public function reportStatistics(Request $request){
        return view('back.reportStatistics');
    }
    //投注报表
    public function reportBet()
    {
        return view('back.reportBet');
    }
    //在线报表
    public function reportOnline()
    {
        return view('back.reportOnline');
    }
    
    //图表统计
    //盈亏统计
    public function chartsGameBunko()
    {
        return view('back.charts.gameBunko');
    }
    //充值统计
    public function chartsRecharges()
    {
        return view('back.charts.recharges');
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

    /**
     * 批量删除
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function batchDelSendMessage(Request $request)
    {
        $message_ids = explode(',', $request->message_ids);
        foreach ($message_ids as $id) {
            MessagePush::where('id', $id)->delete();
        }
        return response()->json([
            'code' => 0,
            'msg' => '删除成功'
        ]);
    }

    /**
     * 获取层级数据
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLevel()
    {
        $levels = Levels::select('value as id','name')->get();
        return response()->json([
            'code' => 0,
            'msg' => 'success',
            'data' => $levels
        ]);
    }


    //游戏管理
    //游戏设定
    public function gameSetting()
    {
        return view('back.gameManage.gameSetting');
    }
    //交易设定
    public function tradeSetting()
    {
        return view('back.gameManage.tradeSetting');
    }
    //盘口设定
    public function handicapSetting()
    {
        $gameData = json_decode(Storage::disk('local')->get('gameData.php'),true);
        $game = Games::all();
        return view('back.gameManage.handicapSetting',compact('gameData','game'));
    }
    //杀率设定
    public function killSetting()
    {
        return view('back.gameManage.killSetting');
    }

    //权限控制
    public function PermissionsAuth(Request $request)
    {
        //return $this->hasPermission->hasPermission(['system.permission','system.role','system.systemSetting']);
        $params = $request->all();
        if(isset($params['pid']) && array_key_exists('pid',$params)){
            $auth_id = $params['pid'];
        }else{
            $auth_id = 0;
        }
        $aPermissionsAuths = PermissionsAuth::getPermissionLowerLevelList();
        return view('back.system.permissionsAuth',compact('auth_id','aPermissionsAuths'));
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
    //ip白名单设置
    public function whitelist(){
        return view('back.system.whitelist');
    }
    //意见反馈
    public function feedback(){
        $aType = Feedback::$feedbackType;
        $aStatus = Feedback::$feedbackStatus;
        return view('back.system.feedback',compact('aType','aStatus'));
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
        $routeLists = LogHandle::getTypeOption();
        return view('back.log.handle',compact('routeLists'));
    }
    //异常日志
    public function abnormalLog()
    {
        $routeLists = LogHandle::getTypeOption();
        return view('back.log.abnormal',compact('routeLists'));
    }

    //代理结算
    //代理结算报表
    public function agentSettleReport(){
        //获取状态
        $aStatus = AgentReport::$reportStatus;
        return view('back.agentSettle.report',compact('aStatus'));
    }
    //代理结算审核
    public function agentSettleReview(){
        //获取状态
        $aStatus = AgentReportReview::$reportStatus;
        return view('back.agentSettle.review',compact('aStatus'));
    }
    //代理结配置
    public function agentSettleConfig(){
        $aConfigInfo = AgentReportBase::getAgentBaseInfo();
        return view('back.agentSettle.config',compact('aConfigInfo'));
    }
    //代理专属域名
    public function agentSettleDomain(){
        return view('back.agentSettle.domain');
    }
    //代理提现
    public function agentSettleWithdraw(){
        //获取状态
        $aStatus = AgentDrawDetails::$reportStatus;
        return view('back.agentSettle.withdraw',compact('aStatus'));
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
    //云闪付配置
    public function payYunShanPay()
    {
        return view('back.pay.payYunShanPay');
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
    //支付前端显示
    public function rechType(){
        return view('back.pay.rechType');
    }

    public function payOnlineSelectData($rechargeType = "")
    {
        if($rechargeType){
            $get = PayOnlineNew::select('payeeName','id','status')->where('rechType',$rechargeType)->orderBy('status','desc')->get();
            return response()->json($get);
        }
    }

    //充值配置新
    //在线支付配置新
    public function payOnlineNew(){
        return view('back.payNew.payOnline');
    }
    //银行支付配置
    public function payBankNew()
    {
        return view('back.payNew.payBank');
    }
    //支付宝支付配置
    public function payAlipayNew()
    {
        return view('back.payNew.payAlipay');
    }
    //微信支付配置
    public function payWechatNew()
    {
        return view('back.payNew.payWechat');
    }
    //云闪付配置
    public function payYunShanPayNew()
    {
        return view('back.payNew.payYunShanPay');
    }
    //微信支付配置
    public function payCftNew()
    {
        return view('back.payNew.payCft');
    }
    //绑定银行配置
    public function bindBankNew()
    {
        return view('back.payNew.bindBank');
    }
    //支付层级配置
    public function payLayoutNew()
    {
        return view('back.payNew.payLayout');
    }
    //cho
    public function rechargeWayNew()
    {
        return view('back.payNew.rechargeWay');
    }
    //支付前端显示
    public function rechTypeNew(){
        return view('back.payNew.rechType');
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
        if($date == 'lastlastMonth'){
            return response()->json([
                'start'=> date('Y-m-d', mktime(0,0,0,date('m')-2,1,date('Y'))),
                'end' => date('Y-m-d', mktime(0,0,0,date('m')-2,$t,date('Y')))
            ]);
        }
        if($date == 'lastthisMonth'){
            return response()->json([
                'start'=> date('Y-m-d', mktime(0,0,0,date('m')-2,1,date('Y'))),
                'end' => date('Y-m-d', mktime(0,0,0,date('m')-1,$t,date('Y')))
            ]);
        }
    }
    //活动管理
    //活动列表
    public function activityList(){
        return view('back.activity.list');
    }
    //活动条件
    public function activityCondition(){
        $aActivitys = Activity::select('id','name')->orderBy('sort','asc')->get();
        return view('back.activity.condition',compact('aActivitys'));
    }
    //奖品配置
    public function activityPrize(){
        return view('back.activity.prize');
    }
    //派奖审核
    public function activityReview(){
        $aStatuss = ActivitySend::$activityStatus;
        return view('back.activity.review',compact('aStatuss'));
    }
    //每日数据统计
    public function activityDaily(){
        return view('back.activity.daily');
    }
    //活动数据统计
    public function activityData(){
        $aActivityType = Activity::$activityType;
        return view('back.activity.data',compact('aActivityType'));
    }

    //推广结算报表
    public function promotionReport(){
        $aStatus = PromotionReport::$reportStatus;
        //获取层级
        $aLevel = PromotionConfig::get();
        return view('back.promotion.report',compact('aStatus','aLevel'));
    }

    //推广结算审核
    public function promotionReview(){
        $aStatus = PromotionReview::$reportStatus;
        //获取层级
        $aLevel = PromotionConfig::get();
        return view('back.promotion.review',compact('aStatus','aLevel'));
    }

    //推广结算配置
    public function promotionSetting(){
        return view('back.promotion.config');
    }

    //平台费用结算
    public function platformSettlement(){
        $aStatus = PlatformSettlement::$PlatformStatus;
        return view('back.platform.settlement',compact('aStatus'));
    }

    //付款记录
    public function platformRecord(){
        $aStatus = PlatformDeposit::$PlatformStatus;
        $aType = PlatformDeposit::$PlatformType;
        return view('back.platform.record',compact('aStatus','aType'));
    }
}
