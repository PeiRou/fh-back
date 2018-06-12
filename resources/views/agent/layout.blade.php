<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎登录代理商登录平台</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('agent_back/css/core.css') }}">
    <script src="https://cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="{{ asset('agent_back/js/jquery.pjax.js') }}"></script>
</head>
<body>
<div class="errorTips"></div>
<header>
    <div class="wrap clearfix">
        <div class="logo fl">
            <img src="/home/images/SS500LOGO.png" alt="">
        </div>
        <div class="userinfo fr">
            <i class="icon-head"></i> <span>{{ Session::get('agent_account') }}</span>
            <a href="javascript:void(0);"><img src="/agent_back/img/btn_lgout.png" alt=""></a>
        </div>
    </div>
</header>
<div class="main clearfix">
    <div class="leftmenu fl">
        <div class="tit">
            <i class="icon-drop"></i>菜单
        </div>
        <div id="menu" class="menu">
            <div class="item"><a href="/agent/dash"><i class="icon-book"></i>代理商首页</a></div>
            <div class="item"><a href="/agent/member"><i class="icon-book"></i>会员管理</a></div>
            <div class="item"><i class="icon-book"></i>会员报表</div>
            <div class="item"><i class="icon-book"></i>佣金提现</div>
            <div class="item"><i class="icon-book"></i>投注记录</div>
            <div class="item"><i class="icon-book"></i>资料修改</div>
        </div>
    </div>

    <div class="rightbox fl">
        @yield('content')
    </div>
</div>
<script src="{{ asset('agent_back/js/core.js') }}"></script>
<script src="{{ asset('agent_back/js/dash.js') }}"></script>
</body>
</html>