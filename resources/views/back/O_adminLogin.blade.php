<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <title>欢迎登录后台管理系统</title>

    <link rel="shortcut icon" type="image/png" href="{{ env('ICON') }}"/>
    <script src="/js/jquery.min.js"></script>
    <script src="{{ asset('back/old/cloud.js') }}"></script>
    <script src="{{ asset('back/old/login.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('back/old/login.css') }}">
</head>
<body id="login">
<div id="mainBody">
    <div id="cloud1" class="cloud"></div>
    <div id="cloud2" class="cloud"></div>
</div>
<div class="logintop">
    <span>欢迎登录后台管理平台</span>
    <ul>
        <li><a href="#">回首页</a></li>
        <li><a href="#">帮助</a></li>
        <li><a href="#">关于</a></li>
    </ul>
</div>

<div class="loginbody">
    <span class="systemlogo"></span>
    <div class="loginbox">
        <img style="width: 210px;position: absolute;top: 128px;left: 10px;" src="{{ env('BACK_LOGO') }}">
        <ul>
            <li><input id="userName" type="text" class="loginuser" value="" onclick="javascript:this.value=''" /></li>
            <li><input id="userPwd" type="password" class="loginpwd" value="" onclick="javascript:this.value=''" /></li>
            <li>
                <input id="valiCode" placeholder="OTP随机码"  type="text" class="logincode" value="" onclick="javascript:this.value=''" />
            </li>
            <li>
                <input id="loginBtn" type="button" class="loginbtn" value="登录" onclick="login();" />
                <label><input id="remember" type="checkbox" checked="checked" />记住密码</label>
                <label><a href="#">忘记密码？</a></label>
            </li>
        </ul>
    </div>
</div>
</body>
</html>