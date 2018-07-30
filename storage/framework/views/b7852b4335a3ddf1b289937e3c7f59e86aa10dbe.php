<?php $__env->startSection('title','充值方式配置'); ?>
<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>充值方式配置
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('rechargeWayTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addRechargeWay()">添加充值方式</span>
        </div>
    </div>
    <div class="table-content">
        <table id="rechargeWayTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>编号ID</th>
                <th>充值类型</th>
                <th>类型值</th>
                <th>状态</th>
                <th width="150">操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/recharge_way.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>