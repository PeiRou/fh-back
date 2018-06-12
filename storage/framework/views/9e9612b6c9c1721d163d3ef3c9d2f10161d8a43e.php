<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
    <meta name="format-detection" content="telephone=no">
    <title>欢迎使用手机版</title>

    <script type="text/javascript">
        //var url = '/api/checkwh.do?t='+Math.random();
        //document.write("<script type='text/javascript' src='"+url+"'><\/script>");
        //document.close();
    </script>

    <link href="/mobile/lib/ionic/css/ionic.min.css" rel="stylesheet" />
    <!-- mergeCssTo:css/main.pack.min.css -->
    <link href="/mobile/css/iconfont.css" rel="stylesheet" />
    <link href="/mobile/css/default.css" rel="stylesheet">
    <link href="/mobile/css/skin.css" rel="stylesheet">
    <link href="/mobile/css/ball.css" rel="stylesheet">
    <link href="/mobile/css/lottery.css" rel="stylesheet">
    <style type="text/css">
        body {background-color: #88a6b1}
        #spinner {
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,.4);
            opacity: 1;
            position: absolute;
            z-index: 11;
        }
    </style>
    <!-- mergeCssTo -->
</head>
<body class="{{'skin_' + appConfig.defaultSkin }}" ng-app="ionicz" ng-controller="AppCtrl" >
<ion-nav-bar class="bar-header bar-positive"></ion-nav-bar>
<!-- <div ng-if="inited"><ion-nav-view></ion-nav-view></div> -->
<ion-nav-view></ion-nav-view>
</body>
<script type="text/javascript">
    var webAppConfig = {};
</script>
<script src="/mobile/lib/spin.min.js"></script>
<script src="/mobile/lib/ionic/js/ionic.bundle.min.js"></script>
<!-- mergeTo:js/lib.pack.js -->
<script src="/mobile/lib/zepto1.3_min.js"></script>
<script src="/mobile/lib/ocLazyLoad.min.js"></script>
<script src="/mobile/lib/angular-cookies.min.js"></script>
<script src="/mobile/lib/angular-messages.min.js"></script>
<script src="/mobile/lib/angular-md5.min.js"></script>
<script src="/mobile/lib/moment/moment.min.js"></script>
<script src="/mobile/lib/moment/zh-cn.js"></script>
<script src="/mobile/lib/stomp.min.js"></script>
<script src="/mobile/lib/sockjs.min.js"></script>
<!-- mergeTo -->
<!-- mergeTo:js/app.pack.js -->
<script src="/mobile/static/lib/util/httpUtil.js"></script>
<script src="/mobile/js/app/app.js"></script>
<script src="/mobile/js/app/config.js"></script>
<script src="/mobile/js/app/directive.js"></script>
<script src="/mobile/js/app/filter.js"></script>
<script src="/mobile/js/app/provider.js"></script>
<script src="/mobile/js/app/service.js"></script>
<script src="/mobile/js/app/controller.js"></script>
<!-- <script src="js/app/route.js"></script>
<script src="js/app/route2.js"></script>
<script src="js/app/route3.js"></script> -->
<!-- mergeTo -->

<script src="/mobile/views/home/home.js"></script>
<script src="/mobile/views/ucenter/ucenter.js"></script>
</html>