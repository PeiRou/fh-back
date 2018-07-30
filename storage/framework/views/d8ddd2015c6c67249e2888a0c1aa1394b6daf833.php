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
                        <a href="<?php echo e(asset('web/about')); ?>" title="关于我们" class="selected">关于我们</a>
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
                    关于我们 / CONTACT US
                </div>
                <div class="con">
                    <p>
                        <span class="red">500万</span>于2011年成立，专业经营彩票业务，现已推出高频彩票现金投注网，主营北京赛车PK10、幸运飞艇、PC蛋蛋、重庆时时彩、天津时时彩、新疆时时彩、广东快乐十分、江苏快三、香港六合彩等项目，完全自助注册开户，现金开户， 现金投注。我们拥有稳定的平台，成熟的玩法，简单的下注流程、以及优质的客户服务。</p>
                    <p class="red">选择500万，十大放心理由</p>
                    <p class="red">一、平台足够权威</p>
                    <p>500万获得GEOTRUST国际认证，确保网站公平、公正、公开。</p>

                    <p class="red">二、排名足够靠前</p>
                    <p>500万为最具公信力彩票投注品牌，信誉驰名亚洲，在全球海量彩票公司中独占前茅的购彩投注经营商。</p>

                    <p class="red">三、资金足够安全</p>
                    <p>500万雄厚的资金链信誉良好，大额存款无忧，资金安全有保障，免去您一切后顾之忧</p>

                    <p class="red">四、取款足够自由</p>
                    <p>500万全天自由存取款，取款3-5分钟火速到帐，且终身免手续费。</p>

                    <p class="red">五、活动足够给力</p>
                    <p>500万时时推出各项给力活动，优惠送不停，让您真正赚翻天。</p>

                    <p class="red">六、安全足够给力</p>
                    <p>500万采用128位SSL加密技术和严格的安全管理体系，确保客户资料安全得到最完善的保障。</p>

                    <p class="red">七、服务足够贴心</p>
                    <p>500万 7X24小时客服贴心的服务，温馨的呵护每一位玩家。</p>

                    <p class="red">八、营业足够合法</p>
                    <p>500万是首家获得国家政府发出彩票经营权的企业，国内首家上市的持牌彩票投注经营商。</p>

                    <p class="red">九、操作足够简单</p>
                    <p>500万秉承以客户为中心的宗旨，在开发之初就设计了诸多人性化的功能和特性，省去繁琐的麻烦，让您轻松操作。</p>

                    <p class="red">十、VIP足够优势</p>
                    <p>500万VIP尊享贵宾级的专属服务让您享有宾至如归般的帝王享受。</p>
                    <p class="red">选择500万，等于为自己选择一份线上品牌信誉的保障！！！</p>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>
    <script>
        $(function(){
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