<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="<?php echo e(csrf_token()); ?>"/>
    <title><?php echo $__env->yieldContent('title'); ?> - 管理后台</title>

    <link rel="stylesheet" href="/vendor/Semantic/semantic.min.css">
    <link rel="stylesheet" href="/vendor/formvalidation/dist/css/formValidation.min.css">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="/vendor/dataTables/DataTables-1.10.16/css/dataTables.semanticui.min.css">
    <link rel="stylesheet" href="/vendor/contextJs/context.standalone.css">
    <link rel="stylesheet" href="/back/css/core.css">
    <?php echo $__env->yieldContent('page-css'); ?>
    <script src="/js/jquery.min.js"></script>
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="/vendor/dataTables/DataTables-1.10.16/js/dataTables.semanticui.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/vendor/contextJs/context.js"></script>
</head>
<body class="dash">
<audio id="rechargeSound" src="<?php echo e(asset('back/audio/ti.mp3')); ?>"></audio>
<audio id="darwingSound" src="<?php echo e(asset('back/audio/chong.wav')); ?>"></audio>

<div class="loading-mask">
    <div class="loading-spinner"></div>
</div>
<div class="nav-top">
    <div class="nav-logo">
        <a href="<?php echo e(url('/back/control/dash')); ?>"><img src="/back/img/logo.png"></a>
    </div>
    
        
    
    <div class="nav-user-info">
        <ul style="margin-top: 20px;">
            <li onclick="javascript:(location.href='/back/control/userManage/sub_account')">当前子帐号在线人数：<span id="onlineAdminCount">0</span></li>
            <li onclick="javascript:(location.href='/back/control/userManage/onlineUser')">当前在线人数：<span id="onlineUserCount">0</span></li>
            <li>修改密码</li>
            <li onclick="logout()">退出</li>
        </ul>
        <div class="user-info">
            <span class="name"><?php echo e(Session::get('account_name')); ?></span>
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
<?php $hasPermission = app('App\Http\Proxy\CheckPermission'); ?>
<div class="nav">
    <ul>
        <li id="menu-dash" class="lefttop">
            <span></span> 菜单
        </li>
        <li class="nav-item"><a href="<?php echo e(url('/back/control/dash')); ?>">
                <span><img src="/back/old/images/leftico01.png"></span>
                控制台首页</a>
        </li>
        <?php if($hasPermission->hasPermission('m') == "has"): ?>
        <li id="menu-userManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                用户管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('m.gAgent') == "has"): ?>
                <li id="menu-userManage-gagent"><a href="<?php echo e(route('m.gAgent')); ?>"><cite></cite><span>总代理</span><i></i></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('m.agent') == "has"): ?>
                <li id="menu-userManage-agent"><a href="<?php echo e(route('m.agent')); ?>"><cite></cite><span>代理</span><i></i></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('m.user') == "has"): ?>
                <li id="menu-userManage-user"><a href="<?php echo e(route('m.user')); ?>"><cite></cite><span>会员</span><i></i></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('m.onlineUser') == "has"): ?>
                <li id="menu-userManage-online"><a href="<?php echo e(route('m.onlineUser')); ?>"><cite></cite><span>在线会员</span><i></i></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('m.subAccount') == "has"): ?>
                <li id="menu-userManage-subaccount"><a href="<?php echo e(route('m.subAccount')); ?>"><cite></cite><span>子账号</span><i></i></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('finance') == "has"): ?>
        <li id="menu-financeManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                财务管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('finance.rechargeRecord') == "has"): ?>
                <li id="menu-financeManage-rechargeRecord"><a href="<?php echo e(route('finance.rechargeRecord')); ?>"><cite></cite><span>充值记录</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('finance.drawingRecord') == "has"): ?>
                <li id="menu-financeManage-drawingRecord"><a href="<?php echo e(route('finance.drawingRecord')); ?>"><cite></cite><span>提款记录</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('finance.capitalDetails') == "has"): ?>
                <li id="menu-financeManage-capitalDetails"><a href="<?php echo e(route('finance.capitalDetails')); ?>"><cite></cite><span>资金明细</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('finance.memberReconciliation') == "has"): ?>
                <li id="menu-financeManage-memberReconciliation"><a href="<?php echo e(route('finance.memberReconciliation')); ?>"><cite></cite><span>会员对账</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('finance.agentReconciliation') == "has"): ?>
                <li id="menu-financeManage-agentReconciliation"><a href="<?php echo e(route('finance.agentReconciliation')); ?>"><cite></cite><span>代理对账</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('report') == "has"): ?>
        <li id="menu-reportManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                报表管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('report.gAgent') == "has"): ?>
                <li id="menu-reportManage-gAgent"><a href="<?php echo e(route('report.gAgent')); ?>"><cite></cite><span>总代理报表</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('report.agent') == "has"): ?>
                <li id="menu-reportManage-agent"><a href="<?php echo e(route('report.agent')); ?>"><cite></cite><span>代理报表</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('report.user') == "has"): ?>
                <li id="menu-reportManage-user"><a href="<?php echo e(route('report.user')); ?>"><cite></cite><span>会员报表</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('report.online') == "has"): ?>
                <li id="menu-reportManage-online"><a href="<?php echo e(route('report.online')); ?>"><cite></cite><span>在线报表</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('bet') == "has"): ?>
        <li id="menu-betManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                投注记录</a>
            <ul>
                <?php if($hasPermission->hasPermission('bet.todaySearch') == "has"): ?>
                <li id="menu-betManage-today"><a href="<?php echo e(route('bet.todaySearch')); ?>"><cite></cite><span>今日注单搜索</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('bet.historySearch') == "has"): ?>
                <li id="menu-betManage-history"><a href="<?php echo e(route('bet.historySearch')); ?>"><cite></cite><span>历史注单搜索</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('bet.betRealTime') == "has"): ?>
                <li id="menu-betManage-betRealTime"><a href="<?php echo e(route('bet.betRealTime')); ?>"><cite></cite><span>实时滚单</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('game') == "has"): ?>
        <li id="menu-gameManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                游戏管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('game.gameSetting') == "has"): ?>
                <li id="menu-gameManage-gameSetting"><a href="<?php echo e(route('game.gameSetting')); ?>"><cite></cite><span>游戏设定</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('game.tradeSetting') == "has"): ?>
                <li><a href="javascript:void(0)"><cite></cite><span>交易设定</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('game.handicapSetting') == "has"): ?>
                <li id="menu-gameManage-handicapSetting"><a href="<?php echo e(route('game.handicapSetting')); ?>"><cite></cite><span>盘口设定</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('historyLottery') == "has"): ?>
        <li id="menu-openManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                历史开奖</a>
            <ul>
                <?php if($hasPermission->hasPermission('historyLottery.cqssc') == "has"): ?>
                <li id="menu-openManage-cqssc"><a href="<?php echo e(route('historyLottery.cqssc')); ?>"><cite></cite><span>重庆时时彩</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.bjpk10') == "has"): ?>
                <li id="menu-openManage-bjpk10"><a href="<?php echo e(route('historyLottery.bjpk10')); ?>"><cite></cite><span>北京PK10</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.bjkl8') == "has"): ?>
                <li id="menu-openManage-bjkl8"><a href="<?php echo e(route('historyLottery.bjkl8')); ?>"><cite></cite><span>北京快乐8</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.mssc') == "has"): ?>
                <li id="menu-openManage-mssc"><a href="<?php echo e(route('historyLottery.mssc')); ?>"><cite></cite><span>秒速赛车</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.msft') == "has"): ?>
                    <li id="menu-openManage-msft"><a href="<?php echo e(route('historyLottery.msft')); ?>"><cite></cite><span>秒速飞艇</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.paoma') == "has"): ?>
                    <li id="menu-openManage-paoma"><a href="<?php echo e(route('historyLottery.paoma')); ?>"><cite></cite><span>跑马</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.msssc') == "has"): ?>
                    <li id="menu-openManage-msssc"><a href="<?php echo e(route('historyLottery.msssc')); ?>"><cite></cite><span>秒速时时彩</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.xglhc') == "has"): ?>
                <li id="menu-openManage-lhc"><a href="<?php echo e(route('historyLottery.xglhc')); ?>"><cite></cite><span>六合彩</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('historyLottery.xylhc') == "has"): ?>
                <li id="menu-openManage-xylhc"><a href="<?php echo e(route('historyLottery.xylhc')); ?>"><cite></cite><span>幸运六合彩</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('notice') == "has"): ?>
        <li id="menu-noticeManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                公告管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('notice.noticeSetting') == "has"): ?>
                <li id="menu-noticeManage-noticeSetting"><a href="<?php echo e(route('notice.noticeSetting')); ?>"><cite></cite><span>公告设置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('notice.messageSend') == "has"): ?>
                <li id="menu-noticeManage-messageSend"><a href="<?php echo e(route('notice.messageSend')); ?>"><cite></cite><span>消息推送</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('pay') == "has"): ?>
        <li id="menu-payManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                充值配置</a>
            <ul>
                <?php if($hasPermission->hasPermission('pay.online') == "has"): ?>
                <li id="menu-payManage-payOnline"><a href="<?php echo e(route('pay.online')); ?>"><cite></cite><span>在线支付配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.bank') == "has"): ?>
                <li id="menu-payManage-payBank"><a href="<?php echo e(route('pay.bank')); ?>"><cite></cite><span>银行支付配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.alipay') == "has"): ?>
                <li id="menu-payManage-alipay"><a href="<?php echo e(route('pay.alipay')); ?>"><cite></cite><span>支付宝配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.wechat') == "has"): ?>
                <li id="menu-payManage-wechat"><a href="<?php echo e(route('pay.wechat')); ?>"><cite></cite><span>微信配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.cft') == "has"): ?>
                <li id="menu-payManage-cft"><a href="<?php echo e(route('pay.cft')); ?>"><cite></cite><span>财付通配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.payLayout') == "has"): ?>
                <li id="menu-payManage-payLayout"><a href="<?php echo e(route('pay.payLayout')); ?>"><cite></cite><span>支付层级配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.bindBank') == "has"): ?>
                <li id="menu-payManage-bindBank"><a href="<?php echo e(route('pay.bindBank')); ?>"><cite></cite><span>绑定银行配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('pay.rechargeWay') == "has"): ?>
                <li id="menu-payManage-rechargeWay"><a href="<?php echo e(route('pay.rechargeWay')); ?>"><cite></cite><span>充值方式配置</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('system') == "has"): ?>
        <li id="menu-systemManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                系统管理</a>
            <ul>
                <li id="menu-systemManage-permissionsAuth"><a href="<?php echo e(route('system.PermissionsAuth')); ?>"><cite></cite><span>权限控制管理</span></a></li>
                <?php if($hasPermission->hasPermission('system.permission') == "has"): ?>
                <li id="menu-systemManage-permissions"><a href="<?php echo e(route('system.permission')); ?>"><cite></cite><span>权限管理</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('system.role') == "has"): ?>
                <li id="menu-systemManage-role"><a href="<?php echo e(route('system.role')); ?>"><cite></cite><span>角色管理</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('system.systemSetting') == "has"): ?>
                <li id="menu-systemManage-setting"><a href="<?php echo e(route('system.systemSetting')); ?>"><cite></cite><span>系统参数配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('system.articleManage') == "has"): ?>
                <li id="menu-systemManage-article"><a href="<?php echo e(route('system.articleManage')); ?>"><cite></cite><span>文章管理</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('log') == "has"): ?>
        <li id="menu-logManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                日志管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('log.login') == "has"): ?>
                <li id="menu-logManage-login"><a href="<?php echo e(route('log.login')); ?>"><cite></cite><span>登录日志</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('log.handle') == "has"): ?>
                <li id="menu-logManage-handle"><a href="<?php echo e(route('log.handle')); ?>"><cite></cite><span>操作日志</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('log.abnormal') == "has"): ?>
                <li id="menu-logManage-abnormal"><a href="<?php echo e(route('log.abnormal')); ?>"><cite></cite><span>异常日志</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('activity') == "has"): ?>
        <li id="menu-activityManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                活动管理</a>
            <ul>
                <?php if($hasPermission->hasPermission('activity.list') == "has"): ?>
                    <li id="menu-activityManage-list"><a href="<?php echo e(route('activity.list')); ?>"><cite></cite><span>活动列表</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('activity.condition') == "has"): ?>
                    <li id="menu-activityManage-condition"><a href="<?php echo e(route('activity.condition')); ?>"><cite></cite><span>活动条件</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('activity.gift') == "has"): ?>
                <li id="menu-activityManage-gift"><a href="<?php echo e(route('activity.gift')); ?>"><cite></cite><span>奖品配置</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('activity.review') == "has"): ?>
                <li id="menu-activityManage-review"><a href="<?php echo e(route('activity.review')); ?>"><cite></cite><span>派奖审核</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('agentSettle') == "has"): ?>
        <li id="menu-agentManage" class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                代理结算</a>
            <ul>
                <?php if($hasPermission->hasPermission('agentSettle.report') == "has"): ?>
                <li id="menu-agentManage-report"><a href="<?php echo e(route('agentSettle.report')); ?>"><cite></cite><span>代理结算报表</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('agentSettle.review') == "has"): ?>
                <li id="menu-agentManage-review"><a href="<?php echo e(route('agentSettle.review')); ?>"><cite></cite><span>代理结算审核</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('agentSettle.draw') == "has"): ?>
                <li id="menu-agentManage-draw"><a href="<?php echo e(route('agentSettle.draw')); ?>"><cite></cite><span>代理提现</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('agentSettle.setting') == "has"): ?>
                <li id="menu-agentManage-setting"><a href="<?php echo e(route('agentSettle.setting')); ?>"><cite></cite><span>代理结算配置</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
        <?php if($hasPermission->hasPermission('platform') == "has"): ?>
        <li class="nav-item"><a href="javascript:void(0)">
                <span><img src="/back/old/images/leftico01.png"></span>
                平台费用</a>
            <ul>
                <?php if($hasPermission->hasPermission('platform.settlement') == "has"): ?>
                <li><a href="javascript:void(0)"><cite></cite><span>平台费用结算</span></a></li>
                <?php endif; ?>
                <?php if($hasPermission->hasPermission('platform.payRecord') == "has"): ?>
                <li><a href="javascript:void(0)"><cite></cite><span>付款记录</span></a></li>
                <?php endif; ?>
            </ul>
        </li>
        <?php endif; ?>
    </ul>
</div>
<div class="main-content">
    
    
    
    <?php echo $__env->yieldContent('content'); ?>
</div>

<script src="/vendor/Semantic/semantic.min.js"></script>
<script src="/vendor/formvalidation/dist/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/dist/js/framework/semantic.min.js"></script>
<script src="/back/js/core.js"></script>
<?php echo $__env->yieldContent('page-js'); ?>

<script>
    
        
        
        
        
        
            
        
        
            
        
    
</script>
</body>
</html>