<?php $__env->startSection('title','总代理'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>总代理
        </div>
        <div class="content-top-buttons">
            <span onclick="addGeneralAgent()">添加总代理</span>
        </div>
    </div>
    <div class="table-content">
        <table id="generalAgentTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>在线</th>
                <th>总代理</th>
                <th>代理数</th>
                <th>会员数</th>
                <th>可用余额</th>
                <th>状态</th>
                <th>新增时间</th>
                <th>最后活动时间</th>
                <th width="10%">操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/general_agent.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>