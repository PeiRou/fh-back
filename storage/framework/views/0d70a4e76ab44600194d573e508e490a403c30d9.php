<?php $__env->startSection('title','控制台'); ?>

<?php $__env->startSection('content'); ?>
    <div class="content-top">
        <div class="breadcrumb">
            <b>位置：</b>控制台首页
        </div>
        <div class="content-top-buttons">
        </div>
    </div>

    <div class="dash-content">
        <div class="line">
            <span class="icon1"><img src="<?php echo e(asset('back/img/cloud.png')); ?>"> </span>
            <span class="txt1"><b><?php echo e(Session::get('account_name')); ?> 您好，欢迎使用彩票网后台管理系统</b></span>
        </div>
        <div class="line">
            <span class="icon2"><img src="<?php echo e(asset('back/img/time.png')); ?>"></span>
            <span class="txt2">您上次登录时间：，上次登录IP：</span>
        </div>
    </div>

    <div class="dash-tables">
        <div class="ui grid">
            <div class="six wide column">
                <div class="outline">
                    <div class="title">最新公告</div>
                    <div class="content">
                        
                            
                        
                    </div>
                </div>
            </div>
            <div class="six wide column">
                <div class="outline">
                    <div class="title">系统更新日志</div>
                    <div class="content">

                    </div>
                </div>
            </div>
            <div class="four wide column">
                <div class="outline">
                    <div class="title">相关下载</div>
                    <div class="content">

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script src="/back/js/pages/dash.js"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('back.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>