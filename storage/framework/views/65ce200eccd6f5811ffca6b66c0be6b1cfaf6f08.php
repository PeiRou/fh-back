<?php $__env->startSection('page-css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('home/css/login.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- 登录区域 -->
    <div class="login_Box">
        <div class="login_tit">
            <div class="login_tit_l">
                <h3>用户登录</h3>
            </div>
            <div class="login_tit_r">
                <span>没有账号 ? </span>
                <a href="<?php echo e(url('web/register')); ?>">立即注册</a>
            </div>
        </div>
            <ul class="login">
                <li>
                    <div class="info_l">
                        <span style="color:#da2c41">*</span>
                        用户名&nbsp;<strong>:</strong>&nbsp;&nbsp;
                    </div>
                    <div class="info_r">
                        <span></span>
                        <input type="text" placeholder="请输入用户名" id="username" class="userName">
                    </div>
                    <div class="info_txt"></div>
                </li>
                <div class="userNameYz Yz">用户名输入错误</div>
                <li>
                    <div class="info_l">
                        <span style="color:#da2c41">*</span>
                        密码&nbsp;<strong>:</strong>&nbsp;&nbsp;
                    </div>
                    <div class="info_r">
                        <span></span>
                        <input type="password" placeholder="请输入用户名" id="password">
                    </div>
                    <div class="info_txt"></div>
                </li>
                <div class="passWordYz Yz">密码输入错误</div>
                
                    
                        
                        
                    
                    
                        
                        
                    
                    
                
                
                <input type="button" value="登录" class="submit" onclick="login()" />
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        $(function () {
            /*页面左右广告栏添加样式  */
            $(".fixed_left_box").addClass('active');
            $(".fixed_right_box").addClass('active');

            $(".off").click(function () {
                $(this).parent().hide(200)
            })


        });

        function login() {
            var username = $('#username').val();
            var password = $('#password').val();
            //var captcha = $('#captcha').val();
            if(username===''){
                alertModal('请输入用户名','orange');
                return false;
            }
            if(password===''){
                alertModal('请输入密码','orange');
                return false;
            }
            $.ajax({
                url:'/web/login',
                type:'post',
                dataType:'json',
                //data:{username:username,password:password,captcha:captcha},
                data:{username:username,password:md5(password)},
                success:function (result) {
                    if(result.code==='用户名或密码错误！'){
                        alertModal(result.code,'red');
                    }
                    if(result[0]==='success'){
                        // sessionStorage.setItem('name',username);
                        window.location.href = '/welcome';
                    }
                }
            })
        }

    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.500_views.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>