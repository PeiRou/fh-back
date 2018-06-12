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
                        <a href="<?php echo e(asset('web/questions')); ?>" title="常见问题" class="selected">常见问题</a>
                    </li>
                    <li class="clear" style="height: 22px;"></li>
                </ul>
            </div>
            <div class="about_right">
                <div class="tit">
                    常见问题 /QUESTIONS
                </div>
                <div class="con">
                    <p class="red">一般常见问题</p>

                    <p class="red">Q1: 如何加入500万？</p>
                    <p>A1: 您可以直接点选 "立即开户"，填写真实资料后，即可成为500万会员。</p>
                    <p class="red">Q2: 我可以直接在网络上存款提款吗？</p>
                    <p>A2: 可以，500万提供多种线上存款选择，详情请参照 "存款提款"</p>
                    <p class="red">Q3: 我在哪里可以找到游戏规则？</p>
                    <p>A3: 在游戏视窗中,右上角有"游戏规则"选项，让您在享受游戏乐趣的同时，清楚告诉您游戏的玩法、规则及派彩方式。</p>
                    <p class="red">Q4: 单注投注额最低是？</p>
                    <p>A4: 我们单注最低投注额为人民币1元.</p>
                    <p class="red">Q5: 最高投注额有限制吗？</p>
                    <p>A5: 任何一家正规博彩和网络博彩公司对客户的帐户投注都有单注和单注限额，没有限额的公司都基本属于没有任何风险控制的私人或骗子公司，今天的控制是为了明天能保证100%提款给您，这点您可以自行分析。每个项目都有不同的限额设定，详细请登陆会员都在「会员资料」页面查看。</p>
                    <p class="red">Q6: 我帐户里面的注单怎麽结算？</p>
                    <p>A6: 登陆会员账号，点击会员中心页面查看，「今天已结」按天显示每天的结算结果，点击进入查看今天所下注每一笔情况。</p>
                    <p class="red">Q7: 如果忘记密码怎麽办？</p>
                    <p>A7: 联系24小时线上客服人员谘询协助提供相应信息给客服。系统将重置一个新密码给您登陆，建议用户登录后立即修改密码。</p>
                    <p class="red">Q8: 当忘记提款密码时怎麽办？</p>
                    <p>A8: 你可通过24小时线上客服人员协助处理。</p>
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