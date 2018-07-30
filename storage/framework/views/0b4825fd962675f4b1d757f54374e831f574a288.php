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
                        <a href="<?php echo e(asset('web/withdraw')); ?>" title="取款帮助" class="selected">取款帮助</a>
                    </li>
                    <li>
                        <a href="<?php echo e(asset('web/questions')); ?>" title="常见问题">常见问题</a>
                    </li>
                    <li class="clear" style="height: 22px;"></li>
                </ul>
            </div>
            <div class="about_right">
                <div class="tit">
                    取款帮助 / WITHDRAW
                </div>
                <div class="con">
                    <p class="red">◆ 您可以通过以下方式取款：</p>
                    <p>1.会员登入后点选"在线取款"。</p>
                    <p>2.输入选择“取款密码”，并确认提款人姓名与您银行帐号持有人相符。</p>
                    <p>3,输入"取款额度"</p>
                    <p>4.确认提款银行帐号正确。</p>
                    <p>5.可以选择以下方式取款：</p>
                    <p>绑定中国工商银行、交通银行、中国农业银行、中国建设银行、招商银行、中国民生银行、深圳发展银行、上海浦东发展银行、北京银行、兴业银行、中信银行、中国光大银行、华夏银行、广东发展银行、深圳平安银行、中国邮政、中国银行、农村合作信用社，会员单笔取款500万RMB以内﹐可随时提出申请﹐并享受3分钟内到帐。</p>
                    <p class="red">◆【取款注意事项】</p>
                    <p>1、500万最低取款金额为100元人民币，单笔最高取款上限为500万人民币，当日最高取款金额上限为5000万人民币。(在线支付每日最高取款总额上限为5000万人民币,公司入款每日最高取款总额上限为5000万人民币)。</p>
                    <p>2、500万保留权利审核会员账户，若由最后一次入款起，有效下注金额需达到入款金额的一倍打码，未达到而申请出款者，公司将收取入款金额的1%行政费用。</p>
                    <p>【例1】若充值3000元，有效投注未达到3000则会扣除行政费用3000×1% = 须被扣除30元
                        <span class="red">**如有任何问题，请联系24小时在线客服！</span>
                    </p>
                    <p>**请注意**各游戏未接受/取消注单，不纳入有效投注计算。</p>
                    <p>**500万相关优惠，请详见\'<span>优惠活动</span>\'</p>
                    <p class="red">如有任何问题，请联系24小时在线客服，谢谢！</p>
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