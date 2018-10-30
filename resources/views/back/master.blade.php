<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>@yield('title') - 管理后台</title>

    <link rel="shortcut icon" type="image/png" href="{{ env('ICON') }}"/>
    <link rel="stylesheet" href="/vendor/Semantic/semantic.min.css">
    <link rel="stylesheet" href="/vendor/formvalidation/dist/css/formValidation.min.css">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="/vendor/dataTables/DataTables-1.10.16/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="/vendor/contextJs/context.standalone.css">
    <link rel="stylesheet" href="/back/css/core.css">
    @yield('page-css')
    <script src="/js/jquery.min.js"></script>
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/dataTables.semanticui.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/vendor/clipboard/dist/clipboard.js"></script>
    <script src="/vendor/contextJs/context.js"></script>
</head>
<body class="dash">
<audio id="rechargeSound" src="{{ asset('back/audio/ti.mp3') }}"></audio>
<audio id="darwingSound" src="{{ asset('back/audio/chong.wav') }}"></audio>

<div class="loading-mask">
    <div class="loading-spinner"></div>
</div>
<div class="nav-top">
    <div class="nav-logo">
        <a href="{{ url('/back/control/dash') }}"><img style="width: {{ env('BACK_LOGO_WIDTH') }}px;" src="{{ env('BACK_LOGO') }}"></a>
    </div>
    <div class="nav-user-info">
        <ul style="margin-top: 20px;">
            <li onclick="javascript:(location.href='/back/control/userManage/sub_account')">当前子帐号在线人数：<span id="onlineAdminCount">0</span></li>
            <li onclick="javascript:(location.href='/back/control/userManage/onlineUser')">当前在线人数：<span id="onlineUserCount">0</span></li>
            <li onclick="javascript:(location.href='/back/control/systemManage/feedback')" id="feedbackContent">今天未回复反馈：<span id="feedbackCount">0</span></li>
            {{--<li>修改密码</li>--}}
            <li onclick="logout()">退出</li>
        </ul>
        <div class="user-info">
            <span class="name">{{ Session::get('account_name') }}</span>
            <a href="/back/control/financeManage/rechargeRecord" class="cz">
                <i>充值</i>
                <b id="rechargeCount">0</b>
            </a>
            <a href="/back/control/financeManage/drawingRecord" class="tx">
                <i>提现</i>
                <b id="drawingCount">0</b>
            </a>
        </div>
    </div>
</div>
@inject('hasPermission','App\Http\Proxy\CheckPermission')
<div class="nav">
    <ul>
        <li id="menu-dash" class="lefttop">
            <span></span> 菜单
        </li>
        <li class="nav-item"><a href="{{ url('/back/control/dash') }}">
                <span><img src="/back/old/images/leftico01.png"></span>
                控制台首页</a>
        </li>
        @if($hasPermission->hasPermission('m') == "has")
        <li id="menu-userManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                用户管理</a>
            <ul>
                @if($hasPermission->hasPermission('m.gAgent') == "has")
                <li id="menu-userManage-gagent"><a href="{{ route('m.gAgent') }}"><cite></cite><span>总代理</span><i></i></a></li>
                @endif
                @if($hasPermission->hasPermission('m.agent') == "has")
                <li id="menu-userManage-agent"><a href="{{ route('m.agent') }}"><cite></cite><span>代理</span><i></i></a></li>
                @endif
                @if($hasPermission->hasPermission('m.user') == "has")
                <li id="menu-userManage-user"><a href="{{ route('m.user') }}"><cite></cite><span>会员</span><i></i></a></li>
                @endif
                @if($hasPermission->hasPermission('m.onlineUser') == "has")
                <li id="menu-userManage-online"><a href="{{ route('m.onlineUser') }}"><cite></cite><span>在线会员</span><i></i></a></li>
                @endif
                @if($hasPermission->hasPermission('m.subAccount') == "has")
                <li id="menu-userManage-subaccount"><a href="{{ route('m.subAccount') }}"><cite></cite><span>子账号</span><i></i></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('finance') == "has")
        <li id="menu-financeManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                财务管理</a>
            <ul>
                @if($hasPermission->hasPermission('finance.rechargeRecord') == "has")
                <li id="menu-financeManage-rechargeRecord"><a href="{{ route('finance.rechargeRecord') }}"><cite></cite><span>充值记录</span></a></li>
                @endif
                @if($hasPermission->hasPermission('finance.drawingRecord') == "has")
                <li id="menu-financeManage-drawingRecord"><a href="{{ route('finance.drawingRecord') }}"><cite></cite><span>提款记录</span></a></li>
                @endif
                @if($hasPermission->hasPermission('finance.capitalDetails') == "has")
                <li id="menu-financeManage-capitalDetails"><a href="{{ route('finance.capitalDetails') }}"><cite></cite><span>资金明细</span></a></li>
                @endif
                @if($hasPermission->hasPermission('finance.memberReconciliation') == "has")
                <li id="menu-financeManage-memberReconciliation"><a href="{{ route('finance.memberReconciliation') }}"><cite></cite><span>会员对账</span></a></li>
                @endif
                @if($hasPermission->hasPermission('finance.agentReconciliation') == "has")
                <li id="menu-financeManage-agentReconciliation"><a href="{{ route('finance.agentReconciliation') }}"><cite></cite><span>代理对账</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('report') == "has")
        <li id="menu-reportManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                报表管理</a>
            <ul>
                @if($hasPermission->hasPermission('report.gAgent') == "has")
                <li id="menu-reportManage-gAgent"><a href="{{ route('report.gAgent') }}"><cite></cite><span>总代理报表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('report.agent') == "has")
                <li id="menu-reportManage-agent"><a href="{{ route('report.agent') }}"><cite></cite><span>代理报表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('report.user') == "has")
                <li id="menu-reportManage-user"><a href="{{ route('report.user') }}"><cite></cite><span>会员报表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('report.statistics') == "has")
                    <li id="menu-reportManage-statistics"><a href="{{ route('report.statistics') }}"><cite></cite><span>操作报表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('report.bet') == "has")
                    <li id="menu-reportManage-bet"><a href="{{ route('report.bet') }}"><cite></cite><span>投注报表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('report.online') == "has")
                <li id="menu-reportManage-online"><a href="{{ route('report.online') }}"><cite></cite><span>在线报表</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('charts') == "has")
            <li id="menu-chartsManage" class="nav-item"><a href="javascript:void(0)">
                    <span><img src="/back/old/images/leftico01.png"></span>
                    图表统计</a>
                <ul>
                    @if($hasPermission->hasPermission('charts.gameBunko') == "has")
                        <li id="menu-chartsManage-gameBunko"><a href="{{ route('charts.gameBunko') }}"><cite></cite><span>盈亏统计</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('charts.recharges') == "has")
                        <li id="menu-chartsManage-recharges"><a href="{{ route('charts.recharges') }}"><cite></cite><span>充值统计</span></a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if($hasPermission->hasPermission('bet') == "has")
        <li id="menu-betManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                投注记录</a>
            <ul>
                @if($hasPermission->hasPermission('bet.todaySearch') == "has")
                <li id="menu-betManage-today"><a href="{{ route('bet.todaySearch') }}"><cite></cite><span>今日注单搜索</span></a></li>
                @endif
                @if($hasPermission->hasPermission('bet.historySearch') == "has")
                <li id="menu-betManage-history"><a href="{{ route('bet.historySearch') }}"><cite></cite><span>历史注单搜索</span></a></li>
                @endif
                @if($hasPermission->hasPermission('bet.betRealTime') == "has")
                <li id="menu-betManage-betRealTime"><a href="{{ route('bet.betRealTime') }}"><cite></cite><span>实时滚单</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('cardGame') == "has")
        <li id="menu-cardGameManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                棋牌管理</a>
            <ul>
                {{--@if($hasPermission->hasPermission('cardGame.upDownSearch') == "has")--}}
                {{--<li id="menu-cardGameManage-upDownSearch"><a href="{{ route('cardGame.upDownSearch') }}"><cite></cite><span>上下分记录查询</span></a></li>--}}
                {{--@endif--}}
                @if($hasPermission->hasPermission('cardGame.cardBetInfo') == "has")
                <li id="menu-cardGameManage-cardBetInfo"><a href="{{ route('cardGame.cardBetInfo') }}"><cite></cite><span>棋牌下注查询</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('game') == "has")
        <li id="menu-gameManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                游戏管理</a>
            <ul>
                @if($hasPermission->hasPermission('game.gameSetting') == "has")
                <li id="menu-gameManage-gameSetting"><a href="{{ route('game.gameSetting') }}"><cite></cite><span>游戏设定</span></a></li>
                @endif
                @if($hasPermission->hasPermission('game.tradeSetting') == "has")
                <li id="menu-gameManage-tradeSetting"><a href="{{ route('game.tradeSetting') }}"><cite></cite><span>交易设定</span></a></li>
                @endif
                @if($hasPermission->hasPermission('game.handicapSetting') == "has")
                <li id="menu-gameManage-handicapSetting"><a href="{{ route('game.handicapSetting') }}"><cite></cite><span>盘口设定</span></a></li>
                @endif
                {{--@if($hasPermission->hasPermission('game.killSetting') == "has")--}}
                @if(\Illuminate\Support\Facades\Session::get('account') == "admin")
                <li id="menu-gameManage-killSetting"><a href="{{ route('game.killSetting') }}"><cite></cite><span>杀率设定</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('historyLottery') == "has")
        <li id="menu-openManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                历史开奖</a>
            <ul style="height: 220px;overflow: auto;">
                @if($hasPermission->hasPermission('historyLottery.cqssc') == "has")
                <li id="menu-openManage-cqssc"><a href="{{ route('historyLottery.cqssc') }}"><cite></cite><span>重庆时时彩</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.bjpk10') == "has")
                <li id="menu-openManage-bjpk10"><a href="{{ route('historyLottery.bjpk10') }}"><cite></cite><span>北京PK10</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.bjkl8') == "has")
                <li id="menu-openManage-bjkl8"><a href="{{ route('historyLottery.bjkl8') }}"><cite></cite><span>北京快乐8</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.mssc') == "has")
                <li id="menu-openManage-mssc"><a href="{{ route('historyLottery.mssc') }}"><cite></cite><span>秒速赛车</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.msft') == "has")
                    <li id="menu-openManage-msft"><a href="{{ route('historyLottery.msft') }}"><cite></cite><span>秒速飞艇</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.paoma') == "has")
                    <li id="menu-openManage-paoma"><a href="{{ route('historyLottery.paoma') }}"><cite></cite><span>香港跑马</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.msssc') == "has")
                    <li id="menu-openManage-msssc"><a href="{{ route('historyLottery.msssc') }}"><cite></cite><span>秒速时时彩</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.msjsk3') == "has")
                    <li id="menu-openManage-msjsk3"><a href="{{ route('historyLottery.msjsk3') }}"><cite></cite><span>秒速快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.jsk3') == "has")
                    <li id="menu-openManage-jsk3"><a href="{{ route('historyLottery.jsk3') }}"><cite></cite><span>江苏快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.ahk3') == "has")
                    <li id="menu-openManage-ahk3"><a href="{{ route('historyLottery.ahk3') }}"><cite></cite><span>安徽快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.hbk3') == "has")
                    <li id="menu-openManage-hbk3"><a href="{{ route('historyLottery.hbk3') }}"><cite></cite><span>湖北快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.gxk3') == "has")
                    <li id="menu-openManage-gxk3"><a href="{{ route('historyLottery.gxk3') }}"><cite></cite><span>广西快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.jlk3') == "has")
                    <li id="menu-openManage-jlk3"><a href="{{ route('historyLottery.jlk3') }}"><cite></cite><span>吉林快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.xglhc') == "has")
                <li id="menu-openManage-lhc"><a href="{{ route('historyLottery.xglhc') }}"><cite></cite><span>六合彩</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.xylhc') == "has")
                <li id="menu-openManage-xylhc"><a href="{{ route('historyLottery.xylhc') }}"><cite></cite><span>幸运六合彩</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.cqxync') == "has")
                    <li id="menu-openManage-cqxync"><a href="{{ route('historyLottery.cqxync') }}"><cite></cite><span>重庆幸运农场</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.gdklsf') == "has")
                    <li id="menu-openManage-gdklsf"><a href="{{ route('historyLottery.gdklsf') }}"><cite></cite><span>广东快乐十分</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.gd11x5') == "has")
                    <li id="menu-openManage-gd11x5"><a href="{{ route('historyLottery.gd11x5') }}"><cite></cite><span>广东11选5</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.xjssc') == "has")
                    <li id="menu-openManage-xjssc"><a href="{{ route('historyLottery.xjssc') }}"><cite></cite><span>新疆时时彩</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.hebk3') == "has")
                    <li id="menu-openManage-hebk3"><a href="{{ route('historyLottery.hebk3') }}"><cite></cite><span>河北快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.gzk3') == "has")
                    <li id="menu-openManage-gzk3"><a href="{{ route('historyLottery.gzk3') }}"><cite></cite><span>贵州快3</span></a></li>
                @endif
                @if($hasPermission->hasPermission('historyLottery.gsk3') == "has")
                    <li id="menu-openManage-gsk3"><a href="{{ route('historyLottery.gsk3') }}"><cite></cite><span>甘肃快3</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('notice') == "has")
        <li id="menu-noticeManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                公告管理</a>
            <ul>
                @if($hasPermission->hasPermission('notice.noticeSetting') == "has")
                <li id="menu-noticeManage-noticeSetting"><a href="{{ route('notice.noticeSetting') }}"><cite></cite><span>公告设置</span></a></li>
                @endif
                @if($hasPermission->hasPermission('notice.messageSend') == "has")
                <li id="menu-noticeManage-messageSend"><a href="{{ route('notice.messageSend') }}"><cite></cite><span>消息推送</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('payNew') == "has")
            <li id="menu-payNewManage" class="nav-item"><a href="javascript:void(0)">
                    <span><img src="/back/old/images/leftico01.png"></span>
                    充值配置</a>
                <ul>
                    @if($hasPermission->hasPermission('payNew.online') == "has")
                        <li id="menu-payNewManage-payOnline"><a href="{{ route('payNew.online') }}"><cite></cite><span>在线支付配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.bank') == "has")
                        <li id="menu-payNewManage-payBank"><a href="{{ route('payNew.bank') }}"><cite></cite><span>银行支付配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.alipay') == "has")
                        <li id="menu-payNewManage-alipay"><a href="{{ route('payNew.alipay') }}"><cite></cite><span>支付宝配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.wechat') == "has")
                        <li id="menu-payNewManage-wechat"><a href="{{ route('payNew.wechat') }}"><cite></cite><span>微信配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.payYunShanPay') == "has")
                        <li id="menu-payNewManage-payYunShanPay"><a href="{{ route('payNew.payYunShanPay') }}"><cite></cite><span>云闪付配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.cft') == "has")
                        <li id="menu-payNewManage-cft"><a href="{{ route('payNew.cft') }}"><cite></cite><span>财付通配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.payLayout') == "has")
                        <li id="menu-payNewManage-payLayout"><a href="{{ route('payNew.payLayout') }}"><cite></cite><span>支付层级配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.bindBank') == "has")
                        <li id="menu-payNewManage-bindBank"><a href="{{ route('payNew.bindBank') }}"><cite></cite><span>绑定银行配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.rechargeWay') == "has")
                        <li id="menu-payNewManage-rechargeWay"><a href="{{ route('payNew.rechargeWay') }}"><cite></cite><span>充值方式配置</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('payNew.rechType') == "has")
                        <li id="menu-payNewManage-rechType"><a href="{{ route('payNew.rechType') }}"><cite></cite><span>支付前端显示</span></a></li>
                    @endif
                </ul>
            </li>
        @endif
        @if($hasPermission->hasPermission('system') == "has")
        <li id="menu-systemManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                系统管理</a>
            <ul>
                <li id="menu-systemManage-permissionsAuth"><a href="{{ route('system.PermissionsAuth') }}"><cite></cite><span>权限控制管理</span></a></li>
                @if($hasPermission->hasPermission('system.permission') == "has")
                <li id="menu-systemManage-permissions"><a href="{{ route('system.permission') }}"><cite></cite><span>权限管理</span></a></li>
                @endif
                @if($hasPermission->hasPermission('system.role') == "has")
                <li id="menu-systemManage-role"><a href="{{ route('system.role') }}"><cite></cite><span>角色管理</span></a></li>
                @endif
                @if($hasPermission->hasPermission('system.systemSetting') == "has")
                <li id="menu-systemManage-setting"><a href="{{ route('system.systemSetting') }}"><cite></cite><span>系统参数配置</span></a></li>
                @endif
                @if($hasPermission->hasPermission('system.articleManage') == "has")
                <li id="menu-systemManage-article"><a href="{{ route('system.articleManage') }}"><cite></cite><span>文章管理</span></a></li>
                @endif
                @if($hasPermission->hasPermission('system.whitelist') == "has")
                    <li id="menu-systemManage-whitelist"><a href="{{ route('system.whitelist') }}"><cite></cite><span>ip白名单设置</span></a></li>
                @endif
                @if($hasPermission->hasPermission('system.feedback') == "has")
                    <li id="menu-systemManage-feedback"><a href="{{ route('system.feedback') }}"><cite></cite><span>意见反馈</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('log') == "has")
        <li id="menu-logManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                日志管理</a>
            <ul>
                @if($hasPermission->hasPermission('log.login') == "has")
                <li id="menu-logManage-login"><a href="{{ route('log.login') }}"><cite></cite><span>登录日志</span></a></li>
                @endif
                @if($hasPermission->hasPermission('log.handle') == "has")
                <li id="menu-logManage-handle"><a href="{{ route('log.handle') }}"><cite></cite><span>操作日志</span></a></li>
                @endif
                @if($hasPermission->hasPermission('log.abnormal') == "has")
                <li id="menu-logManage-abnormal"><a href="{{ route('log.abnormal') }}"><cite></cite><span>异常日志</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('activity') == "has")
        <li id="menu-activityManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                活动管理</a>
            <ul>
                @if($hasPermission->hasPermission('activity.list') == "has")
                    <li id="menu-activityManage-list"><a href="{{ route('activity.list') }}"><cite></cite><span>活动列表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('activity.condition') == "has")
                    <li id="menu-activityManage-condition"><a href="{{ route('activity.condition') }}"><cite></cite><span>活动条件</span></a></li>
                @endif
                @if($hasPermission->hasPermission('activity.gift') == "has")
                    <li id="menu-activityManage-gift"><a href="{{ route('activity.gift') }}"><cite></cite><span>奖品配置</span></a></li>
                @endif
                @if($hasPermission->hasPermission('activity.review') == "has")
                    <li id="menu-activityManage-review"><a href="{{ route('activity.review') }}"><cite></cite><span>派奖审核</span></a></li>
                @endif
                @if($hasPermission->hasPermission('activity.daily') == "has")
                    <li id="menu-activityManage-daily"><a href="{{ route('activity.daily') }}"><cite></cite><span>每日数据统计</span></a></li>
                @endif
                @if($hasPermission->hasPermission('activity.data') == "has")
                    <li id="menu-activityManage-data"><a href="{{ route('activity.data') }}"><cite></cite><span>活动数据统计</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('agentSettle') == "has")
        <li id="menu-agentManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                代理结算</a>
            <ul>
                @if($hasPermission->hasPermission('agentSettle.report') == "has")
                <li id="menu-agentManage-report"><a href="{{ route('agentSettle.report') }}"><cite></cite><span>代理结算报表</span></a></li>
                @endif
                @if($hasPermission->hasPermission('agentSettle.review') == "has")
                <li id="menu-agentManage-review"><a href="{{ route('agentSettle.review') }}"><cite></cite><span>代理结算审核</span></a></li>
                @endif
                @if($hasPermission->hasPermission('agentSettle.draw') == "has")
                <li id="menu-agentManage-draw"><a href="{{ route('agentSettle.draw') }}"><cite></cite><span>代理提现</span></a></li>
                @endif
                @if($hasPermission->hasPermission('agentSettle.setting') == "has")
                <li id="menu-agentManage-setting"><a href="{{ route('agentSettle.setting') }}"><cite></cite><span>代理结算配置</span></a></li>
                @endif
                @if($hasPermission->hasPermission('agentSettle.domain') == "has")
                    <li id="menu-agentManage-domain"><a href="{{ route('agentSettle.domain') }}"><cite></cite><span>代理专属域名</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('platform') == "has")
        <li id="menu-platformManage"  class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                平台费用</a>
            <ul>
                @if($hasPermission->hasPermission('platform.settlement') == "has")
                <li id="menu-platformManage-settlement"><a href="{{ route('platform.settlement') }}"><cite></cite><span>平台费用结算</span></a></li>
                @endif
                @if($hasPermission->hasPermission('platform.payRecord') == "has")
                <li id="menu-platformManage-payRecord"><a href="{{ route('platform.payRecord') }}"><cite></cite><span>付款记录</span></a></li>
                @endif
            </ul>
        </li>
        @endif
        @if($hasPermission->hasPermission('promotion') == "has")
            <li id="menu-promotionManage" class="nav-item"><a href="javascript:void(0)">
                    <span><img src="/back/old/images/leftico01.png"></span>
                    推广结算</a>
                <ul>
                    @if($hasPermission->hasPermission('promotion.report') == "has")
                        <li id="menu-promotionManage-report"><a href="{{ route('promotion.report') }}"><cite></cite><span>推广结算报表</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('promotion.review') == "has")
                        <li id="menu-promotionManage-review"><a href="{{ route('promotion.review') }}"><cite></cite><span>推广结算审核</span></a></li>
                    @endif
                    @if($hasPermission->hasPermission('promotion.setting') == "has")
                        <li id="menu-promotionManage-setting"><a href="{{ route('promotion.setting') }}"><cite></cite><span>推广结算配置</span></a></li>
                    @endif
                </ul>
            </li>
        @endif
    </ul>
</div>
<div class="main-content">
    @yield('content')
</div>

<script src="/vendor/Semantic/semantic.min.js"></script>
<script src="/vendor/formvalidation/dist/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/dist/js/framework/semantic.min.js"></script>
<script src="/back/js/core.js"></script>
@yield('page-js')
<script>
    $(function () {
       var marginTop = $('#menu-openManage li.active').index() * 30;
       $('#menu-openManage ul').scrollTop(marginTop);
    })
</script>
</body>
</html>
