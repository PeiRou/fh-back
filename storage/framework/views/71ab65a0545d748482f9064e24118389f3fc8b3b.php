<?php $__env->startSection('title','角色管理'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>角色管理
        </div>
        <div class="content-top-buttons">
            <span onclick="addRole()">添加角色</span>
        </div>
    </div>
    <div class="table-content">
        <table id="roleTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>角色编号(ID)</th>
                <th>角色名称</th>
                <th>类型</th>
                <th>添加时间</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/role.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>