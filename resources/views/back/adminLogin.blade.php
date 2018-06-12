<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>欢迎使用管理系统</title>

    <link rel="stylesheet" href="/vendor/Semantic/semantic.min.css">
    <link rel="stylesheet" href="/vendor/formvalidation/dist/css/formValidation.min.css">
    <link rel="stylesheet" href="/vendor/confirm/dist/jquery-confirm.min.css">
    <link rel="stylesheet" href="/back/css/core.css">
    <link rel="stylesheet" href="/back/css/pages/adminLogin.css">
    <script src="/js/jquery.min.js"></script>
    <script src="/vendor/Semantic/semantic.min.js"></script>
    <script src="/vendor/confirm/dist/jquery-confirm.min.js"></script>
    <script src="/js/particles.min.js"></script>
</head>
<body id="particles-js">
<div class="login-box">
    <div class="login-header">
        <h2>登录管理系统</h2>
        <i class="iconfont">&#xe613;</i>
    </div>
    <div class="login-form">
        <form class="ui form" id="loginForm" action="{{ url('/action/admin/login') }}">
            <div class="field">
                <label>账号</label>
                <div class="ui input icon">
                    <input type="text" name="account" placeholder="已授权账号">
                </div>
            </div>
            <div class="field">
                <label>密码</label>
                <div class="ui input icon">
                    <input type="password" name="password" placeholder="******">
                </div>
            </div>
            <div class="field">
                <label>OTP</label>
                <div class="ui input icon">
                    <input type="text" name="otp" placeholder="OTP两重验证码">
                </div>
            </div>
            <button class="ui red button" type="submit">登 录</button>
            {{ csrf_field() }}
        </form>
    </div>
</div>

<script src="/vendor/Semantic/semantic.min.js"></script>
<script src="/vendor/formvalidation/dist/js/formValidation.min.js"></script>
<script src="/vendor/formvalidation/dist/js/framework/semantic.min.js"></script>
<script src="/back/js/core.js"></script>
<script src="/back/js/pages/adminLogin.js"></script>
</body>
</html>