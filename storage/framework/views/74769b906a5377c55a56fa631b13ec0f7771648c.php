<?php $__env->startSection('title','绑定银行配置'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>绑定银行配置
        </div>
        <div class="content-top-buttons">
            <span onclick="addBank()">添加银行</span>
        </div>
    </div>
    <div class="table-content">
        <table id="bankTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>银行编号(ID)</th>
                <th>银行标识</th>
                <th>银行名称</th>
                <th>银行缩写标识</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/bind_bank.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>