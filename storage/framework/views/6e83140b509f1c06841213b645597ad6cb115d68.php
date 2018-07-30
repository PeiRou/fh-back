<?php $__env->startSection('title','在线支付配置'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>在线支付配置
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('payOnlineTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addPayOnline()">添加</span>
        </div>
    </div>
    <div class="table-content">
        <table id="payOnlineTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>支付名称</th>
                <th>在线充值类型</th>
                <th>商户号</th>
                <th>回调域名</th>
                <th>状态</th>
                <th>层级设置</th>
                <th>备注说明</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/pay_online.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>