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
                    加盟方案 /COOPERATION
                </div>
                <div class="con">
                    <p>500万</p>
                    <p>作为一名尊贵的500万彩票网联盟合营伙伴，您可以利用您的资源最快赚取高额佣金，由这一秒钟开始，您将可以轻松实现成功与财富的梦想！</p>
                    <p>推荐好友方案：</p>
                    <p>500万彩票网公司拥有多元化的产品，使用最公平、公正、公开的系统，在市场上的众多网站中，我们自豪的提供会员最优惠的回馈，给予合作伙伴最优势的营利回报! 无论 拥有的是网络资源，或是人脉资源，都欢迎您来加入500万彩票网合作伙伴的行列选择500万彩票网，绝对是您最聪明的选择!</p>
                    <p>推荐好友平台：</p>
                    <p>我们为您提供单独的推荐好友功能，您可以在我的推荐中不受限制的开出下线，并且实时了解下线会员输赢，存款，取款情况。推荐好友功能有一个您的专属链接，您可以直接将您的专属链接链接在网站、论坛、博客等等可链接的网络页面，也可在群里面发送您的专属链接，只要通过您的专属链接注册的会员都算是您的下线。推广方式简单方便，推广渠道多种多样。</p>
                    <p>可通过首页点击免费注册成为会员，已是平台会员登陆后点击会员中心点击我的推荐。</p>
                    <p>推荐下线方式：</p>
                    <p>1.可通过以下“添加会员”功能键，帮您的下线注册会员账号</p>
                    <p> 2.可通过以下“快速推广链接”功能键，复制推广链接给您的下线注册会员账号。</p>
                    <p>佣金结算方式：</p>
                    <p>不计输赢，总有效投注金额x0.2%例如：<span class="red">（总有效投注￥1000万x0.2%)=20000元佣金</span></p>
                    <p>佣金派送方式：</p>
                    <p>当局结算退佣到您的会员账号，当日即可提交出款！</p>
                    <p>联系方式：</p>
                    <p>代理QQ：50002018 代理邮箱：50002018@gmail.com</p>
                    <p>注：<span>请谨记任何使用不诚实方法以骗取代理佣金者将取消代理资格并永久冻结账户，佣金一概不予派发！</span></p>
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
        })
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.500_views.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>