<?php $__env->startSection('title','在线会员'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>在线会员
        </div>
        <div class="content-top-buttons">
            <span class="refresh-nav-btn" onclick="refreshTable('onlineUserTable')"><i class="iconfont">&#xe61d;</i></span>
            <span onclick="addSubAccount()">展开所有</span>
        </div>
    </div>
    <div class="table-content">
        <table id="onlineUserTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>账号</th>
                <th>用户类型</th>
                <th>可用余额</th>
                <th>状态</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th>登录IP</th>
                <th>IP信息</th>
                <th>网站入口</th>
                <th>终端</th>
                <th>操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/online_user.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>