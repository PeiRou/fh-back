<?php $__env->startSection('page-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('home/css/promotions.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- 安全保障 -->
    <div class="w">
        <!-- 内容 -->
        <div class="content clearfix">
            <div class="about_left">
                <h1></h1>
                <ul>
                    <li>
                        <a href="<?php echo e(asset('web/about')); ?>" title="关于我们">关于我们</a>
                    </li>
                    <li>
                        <a href="<?php echo e(asset('web/contact')); ?>" title="联系我们">联系我们</a>
                    </li>
                    <li>
                        <a href="<?php echo e(asset('web/register')); ?>" title="免费注册">免费注册</a>
                    </li>
                    <li>
                        <a href="<?php echo e(asset('web/deposit')); ?>" title="存款帮助">存款帮助</a>
                    </li>
                    <li>
                        <a href="<?php echo e(asset('web/withdraw')); ?>" title="取款帮助">取款帮助</a>
                    </li>
                    <li>
                        <a href="<?php echo e(asset('web/questions')); ?>" title="常见问题">常见问题</a>
                    </li>
                    <li class="clear" style="height: 22px;"></li>
                </ul>
            </div>
            <div class="about_right">
                <div class="tit">
                    优惠活动 / PROMOTIONS
                </div>
                <div class="con">
                    <a href="javascript:;"><img src="/home/images/promotions_1.png" data-toggle="modal" data-target=".bs-example-modal_1"></a>
                    <div class="modal fade bs-example-modal_1" >
                        <div class="modal-dialog modal-lg" style="width: 822px;">
                            <div class="modal-content">
                                <h4 class="con_tit">优惠活动<a href="#" class="guanbi"></a></h4>
                                <div class="con_info"><img src="/home/images/promotions_info1.png"></div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:;">
                        <img src="/home/images/promotions_2.png"  data-toggle="modal" data-target=".bs-example-modal_2">
                    </a>
                    <div class="modal fade bs-example-modal_2" >
                        <div class="modal-dialog modal-lg" style="width: 822px;">
                            <div class="modal-content">
                                <h4 class="con_tit">优惠活动<a href="#" class="guanbi"></a></h4>
                                <div class="con_info"><img src="/home/images/promotions_info2.png"></div>
                            </div>
                        </div>
                    </div>

                    <a href="javascript:;" >
                        <img src="/home/images/promotions_3.png" data-toggle="modal" data-target=".bs-example-modal_3">
                    </a>
                    <div class="modal fade bs-example-modal_3" >
                        <div class="modal-dialog modal-lg" style="width: 822px;">
                            <div class="modal-content">
                                <h4 class="con_tit">优惠活动<a href="#" class="guanbi"></a></h4>
                                <div class="con_info"><img src="/home/images/promotions_info3.png"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script>
        $(function () {
            /*页面左右广告栏添加样式  */
            $(".fixed_left_box").addClass('active')
            $(".fixed_right_box").addClass('active')
            $(".off").click(function () {
                $(this).parent().hide(200)
            })
            //关闭模态框
            $(".guanbi").click(function(){
                $(".bs-example-modal_1").modal('hide');
                $(".bs-example-modal_2").modal('hide');
                $(".bs-example-modal_3").modal('hide');
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.500_views.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>