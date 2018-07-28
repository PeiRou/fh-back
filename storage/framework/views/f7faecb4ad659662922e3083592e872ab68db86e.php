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
                        <a href="<?php echo e(asset('web/deposit')); ?>" title="存款帮助" class="selected">存款帮助</a>
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
                    存款帮助 / DEPOSIT
                </div>
                <div class="con">
                    <p>您可以通过以下方式在500万进行充值：</p>
                    <p class="red">※备注：在您第一次入款时，系统会提示绑定您的银行卡信息，为确保您的资金安全，请确实填写，谢谢！</p>
                    <p class="red">一、公司入款（银行卡入款）</p>
                    <p>1、500万"银行卡入款"（包含支付宝转账、网银转账、ATM转账、ATM现金存款、现金到柜台存款或手机银行等方式），最低存款金额为10元人民币，最高存款金额无上限。</p>
                    <p>2、我们支持银联转帐，您可以点击【在线存款】或者联系"在线客服"取得最新入款银行信息。</p>
                    <p>3、目前公司提供中国建设银行、中国工商银行、中国农业银行可选择。建议:选择与您转账的银行同一家，同银行间转账可以立即到帐，若跨行转账请使用跨行快汇也是即时到账。</p>
                    <p>※公司入款操作步骤：</p>
                    <p class="red">一、 银行卡入款</p>
                    <p>登录会员账号-》选择"在线存款"-》点击【银行入款】-》查看正在使用的银行账号-》通过支付宝转账到银行卡或网银转账、跨行转账等进行存款后将存款金额填写完成-》提交申请，我们将于确认到帐后立刻为您游戏帐户充值。</p>
                    <p class="red">二、 在线支付</p>
                    <p>1、会员登入后点选「在线存款」;</p>
                    <p>2、填写欲入款金额，</p>
                    <p>3、选择「支付银行」</p>
                    <p>支持信用卡，中国银行，中国农业银行，中国民生银行，中国建设银行，中国招商银行，中国工商银行，中国交通银行，中国邮政银行，中国兴业银行，华夏银行，浦发银行，BEA东亚银行，北京银行，平安银行，杭州银行，中国光大银行，中信银行，渤海银行，浙商银行，上海银行，广发银行，深圳发展银行，宁波银行，南京银行</p>
                    <p>4、仔细核对填写的数据信息，确认您的支付订单无误，建议将您支付的商家订单号保存记录下来，最后【确认送出】，并耐心等待载入网上银行页面（传输中已将您帐户资料加密）。</p>
                    <p class="red">三、 微信入款</p>
                    <p>1、会员登入后点选「在线存款」;</p>
                    <p>2、选择微信在线入款，</p>
                    <p>3、填写欲入款金额</p>
                    <p>4、点击提交后，出现二维码，直接使用您的微信扫一扫付款。付款成功，立即到账，无需再次提交！</p>
                    <p class="red">四、 支付宝入款</p>
                    <p>1、会员登入后点选「在线存款」;</p>
                    <p>2、选择公司入款支付宝入款，</p>
                    <p>3、填写入款金额、支付宝姓名然后提交！</p>
                    <p>4、生成一张招商银行订单；</p>
                    <p>5、进入支付点击转账</p>
                    <p>6、选择转账到银行卡</p>
                    <p>7、转账到订单上的收款账号即可！</p>
                    <p class="red">★存款须知：</p>
                    <p>1.500万最低存款金额10元，最高存款金额无上限；</p>
                    <p>2.欲使用公司入款的会员，亲切的提醒您，公司入款银行账号会随时变更，请在每次存款之前务必先核对最新入款账号，若入款前未先进行账号确认，款项误入到公司已停用的银行账号，500万一概不予负责！敬请谅解，感谢配合；</p>
                    <p>3.若出现存款成功未到账的情况，请及时与【在线客服】取得联系，客服人员会与您核对存款数据，必要时需要您提供截图，转账数据等相关证明；</p>
                    <p>4.未开通网银的会员，请您亲自到银行柜台办理。</p>
                    <p class="red">如有任何问题，请联系24小时在线客服人员。</p>
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