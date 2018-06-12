<?php $__env->startSection('page-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('home/css/register.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- 注册 -->
    <div class="login_Box">
        <div class="login_tit">
            <div class="login_tit_l">
                <h3>会员注册</h3>
            </div>
            <div class="login_tit_r">
                <span>已有账号 ? </span>
                <a href="<?php echo e(url('web/login')); ?>">立即登录</a>
            </div>
        </div>
            <ul class="login">
                <li>
                    <div class="info_l">
                        <span style="color:#da2c41">*</span>
                        用户名&nbsp;
                        <strong>:</strong>&nbsp;&nbsp;
                    </div>
                    <div class="info_r">
                        <span></span>
                        <input type="text" name="username" class="userName" required >
                    </div>
                    <div class="info_txt">* 格式长度6-15个字符内,请牢记</div>
                    <div class="userNameYz">用户名输入错误</div>
                </li>

                <li>
                    <div class="info_l">
                        <span style="color:#da2c41">*</span>
                        密码&nbsp;
                        <strong>:</strong>&nbsp;&nbsp;
                    </div>
                    <div class="info_r">
                        <span></span>
                        <input type="password" required name="password" class="passWord" >
                    </div>
                    <div class="info_txt">* 格式长度6-15个字符内,请牢记</div>
                    <div class="passWordYz">密码输入错误</div>
                </li>
                <li>
                    <div class="info_l">
                        <span style="color:#da2c41">*</span>
                        真实姓名&nbsp;
                        <strong>:</strong>&nbsp;&nbsp;
                    </div>
                    <div class="info_r">
                        <span></span>
                        <input type="text" name="fullName" class="fullName">
                    </div>
                    <div class="info_txt">* 2 - 4 个汉字</div>
                    <div class="nameYz">真实姓名输入错误</div>
                </li>
                <input type="button" value="立即注册" class="submit" id="register">
            </ul>
    </div>

    <!-- 安全保障 -->
    <div class="w">
        <ul class="aqfoot">
            <li>
                <h4>安全保障</h4>
                <p>多重安全机制全程保护</p>
            </li>
            <li>
                <h4>支付便捷</h4>
                <p>微信、支付宝、网银、信用卡</p>
            </li>
            <li>
                <h4>彩种齐全
                </h4>
                <p>支持多个彩种，任意购买</p>
            </li>
            <li>
                <h4>领奖无忧</h4>
                <p>奖金自动返至购彩账户</p>
            </li>
        </ul>
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
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        // 用户名
        const userName = document.querySelector('.userName');
        const userNameYz = document.querySelector('.userNameYz');
        const userReg = /^[0-9A-Za-z_]{6,15}$/;
        userName.onchange = function () {
            if (!userReg.test(this.value)) {
                alertModal('用户名长度必须在6-15位之间','orange');
            } else {
                userNameYz.style.display = 'none'
            }
        };

        // 密码
        const passWord = document.querySelector('.passWord');
        const passWordYz = document.querySelector('.passWordYz');
        const passReg = /^[0-9A-Za-z_]{6,15}$/;
        passWord.onchange = function () {
            if (!passReg.test(this.value)) {
                alertModal('密码长度必须在6-15位之间','orange');
            } else {
                passWordYz.style.display = 'none'
            }
        };

        // 姓名
        const name = document.querySelector('.fullName');
        const nameYz = document.querySelector('.nameYz');
        const nameReg = /^[\u0391-\uFFE5]{2,4}$/;
        name.onchange = function () {
            if (!nameReg.test(this.value)) {
                alertModal('真实姓名必须为中文汉字','orange');
            } else {
                nameYz.style.display = 'none'
            }
        };

        $('#register').click(function(){
            if(!userReg.test(userName.value)){
                alertModal('请输入用户名','orange');
                return false;
            }
            if(!passReg.test(passWord.value)){
                alertModal('请输入密码','orange');
                return false;
            }
            if(!nameReg.test(name.value)){
                alertModal('请输入真实姓名','orange');
                return false;
            }
            $.ajax({
                url:'/web/register',
                type:'post',
                dataType:'json',
                data:{username:userName.value,password:md5(passWord.value),fullName:name.value},
                success:function (result) {
                    if(result[0]==='success'){
                       // sessionStorage.setItem('name', userName.value);
                        window.location.href = '/web/login';
                    }
                }
            })
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.500_views.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>