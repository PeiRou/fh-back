<?php $__env->startSection('title','游戏设定'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>游戏设定
        </div>
        
    </div>
    <div class="table-content">
        <table id="gamesTable" class="ui small table" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>游戏ID</th>
                <th>游戏名称</th>
                <th>公休开始时间</th>
                <th>公休结束时间</th>
                <th>排序</th>
                <th>封盘状态</th>
                <th>启用状态</th>
                <th width="160">操作</th>
            </tr>
            </thead>
        </table>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/game_setting.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>