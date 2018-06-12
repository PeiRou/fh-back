<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎登录代理商管理平台</title>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/vendor/formvalidation/dist/css/formValidation.min.css">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="{{ asset('agent_back/theme/main.css') }}">
    <link rel="stylesheet" href="{{ asset('agent_back/css/core.css') }}">
    <script src="https://cdn.bootcss.com/jquery/1.12.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="/vendor/formvalidation/dist/js/formValidation.min.js"></script>
    <script src="/vendor/formvalidation/dist/js/framework/bootstrap.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="{{ asset('agent_back/js/login.js') }}"></script>
</head>
<body>
<div id='stars'></div>
<div id='stars2'></div>
<div id='stars3'></div>
<div class="content">
    <div class="login-box">
        <div class="title">代理商管理平台<br><span class="sub-title">AGENT MANAGEMENT PLATFORM</span></div>
        <form action="{{ url('/agent/action/account/login') }}" id="loginForm">
            <div class="form-group">
                <input type="text" class="form-control" name="username" placeholder="代理账号" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="登录密码" />
            </div>
            <div>
                <div class="form-group" style="width: 56%;float: left;">
                    <input type="text" class="form-control" name="vlicode" placeholder="验证码" />
                </div>
                <div class="form-group" style="float: right;">
                    <img src="{{ $captcha->inline() }}" onclick="refreshCode()" class="captcha" alt="" style="border-radius: 3px;cursor: pointer">
                </div>
            </div>

            <!-- Do NOT use name="submit" or id="submit" for the Submit button -->
            <button type="submit" class="btn btn-primary login-btn btn-block">登 录</button>
            {{ csrf_field() }}
        </form>
    </div>
    <div class="copyright">
        ©️ 2018 SRC-SOFTWARE Inc.
    </div>
</div>
</body>
</html>