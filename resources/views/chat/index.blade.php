<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>聊天室</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
<div id="app">
    <chat></chat>
</div>
<script src="{{mix('chat-backend/js/manifest.js')}}"></script>
<script src="{{mix('chat-backend/js/vendor.js')}}"></script>
<script src="{{mix('js/app.js')}}"></script>
</body>
</html>