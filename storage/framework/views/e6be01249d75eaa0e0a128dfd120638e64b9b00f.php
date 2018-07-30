<?php $__env->startSection('page-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('home/css/contact.css')); ?>">
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
                        <a href="<?php echo e(asset('web/contact')); ?>" title="联系我们" class="selected">联系我们</a>
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
                    联系我们 / CONTACT US
                </div>
                <div class="con">
                    <p>
                        <span class="red">500万</span>的客服中心全年无休，提供1周7天、每天24小时的优质服务。</p>
                    <p>如果您对本网站的使用有任何疑问，可以通过下列任一方式与客服人员联系，享受最实时的服务 点击在线客服链接，即可进入在线客服系统与客服人员联系。 您亦可使用Email与客服人员取得联系！</p>
                    <p>客服QQ：<span class="red">50002018</span></p>
                    <p>投诉建议：<span class="red">50087654</span></p>
                    <p>微信客服：<span class="red">ss500com</span></p>
                    <p>我们也能收到您宝贵的意见（务必填写真实的Email、QQ）以便我们能及时与您取得联系！ 500万真诚欢迎大家，并以公平、公正、公开、诚信经营的理念服务大家！
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script>
        $(function () {
            /*页面左右广告栏添加样式  */
            $(".fixed_left_box").addClass('active');
            $(".fixed_right_box").addClass('active');

            $(".off").click(function () {
                $(this).parent().hide(200)
            })
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.500_views.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>