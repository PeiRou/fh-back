<?php $__env->startSection('title','消息推送'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>消息推送
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('onlineUserTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">展开所有</span>
        </div>
    </div>
    <div class="table-content">

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/message_send.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>