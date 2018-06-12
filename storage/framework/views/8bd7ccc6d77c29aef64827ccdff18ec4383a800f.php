<!DOCTYPE html>
<html lang="zh_CN">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>聊天室后台</title>
    <link rel="stylesheet" href="<?php echo e(mix('chat-backend/css/app.css')); ?>">
</head>
<body>
<div id="app">
    <login></login>
</div>
<script>
    window.App = {'url':'<?php echo e(route('chat')); ?>'};
</script>
<script src="<?php echo e(mix('chat-backend/js/manifest.js')); ?>"></script>
<script src="<?php echo e(mix('chat-backend/js/vendor.js')); ?>"></script>
<script src="<?php echo e(mix('chat-backend/js/app.js')); ?>"></script>
</body>
</html>