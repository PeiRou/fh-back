<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="maximum-scale=1, user-scalable=no" >
    <meta name="_token" content="<?php echo e(csrf_token()); ?>"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>500万彩票 - 专业提供研究分析总结北京赛车pk10开奖直播，北京赛车pk10开奖视频，北京赛车开奖直播，北京赛车网上秒开户，北京赛车资讯，pk10投注平台等</title>

    <script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="<?php echo e(asset('vendor/jquery-confirm/dist/jquery-confirm.min.js')); ?>"></script>
    <script src="https://cdn.bootcss.com/blueimp-md5/2.10.0/js/md5.min.js"></script>
    <script src="<?php echo e(asset('home/js/msgbox.js')); ?>"></script>
    <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo e(asset('home/css/msgbox.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('home/vendor/Swiper/swiper-3.4.2.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('vendor/jquery-confirm/dist/jquery-confirm.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('home/css/index.css')); ?>" rel="stylesheet">
    <?php echo $__env->yieldContent('page-css'); ?>
</head>
<body>
<div class="mask"></div>
<!-- 两侧广告 -->
<div class="fixed_left_box">
    <a href="http://wpa.qq.com/msgrd?v=3&uin=50002018&site=qq&menu=yes" target="_blank"></a>
    <a href="http://wpa.qq.com/msgrd?v=3&uin=50087654&site=qq&menu=yes" target="_blank"></a>
    <img src="<?php echo e(asset('home/images/float_left.png')); ?>" class="fixed_left">
    <a href="#" class="off"></a>
</div>
<div class="fixed_right_box">
    <a href="https://static.meiqia.com/dist/standalone.html?_=t&eid=53233" target="_blank"></a>
    <a href="<?php echo e(url('/web/deposit')); ?>"></a>
    <img src="<?php echo e(asset('home/images/float_right.png')); ?>" class="fixed_left">
    <a href="#" class="off"></a>
</div>
<header class="top">
    <!-- 顶部通栏 -->
    <div class="top_bar">
        <!-- 版心 -->
        <div class="w ">
            <!-- 顶部通栏左侧 -->
            <div class="top_l f_l">
                <p>hi, 欢迎来到500万</p>
            </div>
            <!-- 顶部通栏右侧 -->
            <ul class="top_r f_r" style="margin-right: 15px;">
                <li>
                    <a href="<?php echo e(url('web/cooperation')); ?>">推荐好友</a>
                </li>
                <li>丨</li>
                <li>
                    <a href="javascript:void(0)" onclick="guestLogin()">免费试玩</a>
                </li>
                <li>丨</li>
                <li>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome#/frame/Grzx">会员中心</a>
                    <?php else: ?>
                        <a href="/web/login">会员中心</a>
                    <?php endif; ?>
                    <em class="down"></em>
                </li>
                <li>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome#/frame/Zxcz">充值</a>
                    <?php else: ?>
                        <a href="/web/login">充值</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome#/frame/tk">提款</a>
                    <?php else: ?>
                        <a href="/web/login">提款</a>
                    <?php endif; ?>
                </li>
            </ul>
        </div>
    </div>

    <!-- 顶部登录栏 -->
    <div class="account w">
        <a href="<?php echo e(url('/')); ?>" class="logo f_l">
        </a>

        <ul class="f_r user_login">
            <li>
                <em class="user_icon">
                </em>
                <input type="text" placeholder="用户名" id="user" required class="username">
            </li>
            <li>
                <em class="pass_icon"></em>
                <input type="password" placeholder="密码" id="pass" required class="password">
            </li>
            
                
                
            
            <li class="dlhh">
                <button type="button"  class="btn btn-danger btn-sm " onclick="log()">登录</button>
            </li>
            <li>
                <a href="<?php echo e(url('web/register')); ?>">
                    <button type="button" class="btn btn-warning btn-sm">免费注册</button>
                </a>
            </li>
        </ul>
    </div>

    <!-- 顶部导航栏 -->
    <div class="top_nav">
        <div class="w">
            <div class="all_cai">
                <h2>全部彩种</h2>
                <a href="#" class="xiajiantou glyphicon glyphicon-menu-down dowm"></a>
            </div>
            <ul>
                <li>
                    <a href="<?php echo e(url('/')); ?>">首页</a>
                </li>
                <li>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome">购彩大厅</a>
                        <?php else: ?>
                        <a href="/web/login">购彩大厅</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome">开奖公告</a>
                    <?php else: ?>
                        <a href="/web/login">开奖公告</a>
                    <?php endif; ?>
                </li>
                <li>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome">玩法规则</a>
                    <?php else: ?>
                        <a href="/web/login">玩法规则</a>
                    <?php endif; ?>
                </li>
                <li>
                    <a href="<?php echo e(url('web/cooperation')); ?>">推荐好友</a>
                </li>
                <li>
                    <a href="<?php echo e(url('web/promotions')); ?>">优惠活动</a>
                </li>
                <li>
                    <a href="/">手机投注
                        <img src="<?php echo e(asset('home/images/gamelobby/hot_01.gif')); ?>"></a>
                </li>
                <li>
                    <a href="https://static.meiqia.com/dist/standalone.html?_=t&eid=53233" target="_blank">在线客服</a>
                </li>
            </ul>
        </div>
    </div>
</header>
<?php echo $__env->yieldContent('content'); ?>
<div class="about_link">
    <p class="about_link">
        <a href="<?php echo e(url('/web/about')); ?>">关于我们</a> 丨
        <a href="<?php echo e(url('/web/withdraw')); ?>">取款帮助</a> 丨
        <a href="<?php echo e(url('/web/deposit')); ?>">存款帮助</a> 丨
        <a href="<?php echo e(url('/web/cooperation')); ?>">推荐好友</a> 丨
        <a href="<?php echo e(url('/web/contact')); ?>">联系我们</a> 丨
        <a href="<?php echo e(url('/web/questions')); ?>">常见问题</a>
    </p>
</div>
<p class="about_mt">提醒：购买彩票有风险，在线投注需谨慎，不向未满18周岁的青少年出售彩票！</p>
<div class="foot_img w">
    <img src="<?php echo e(asset('home/images/wljc.gif')); ?>">
    <img src="<?php echo e(asset('home/images/wangan.gif')); ?>">
    <img src="<?php echo e(asset('home/images/wsjy.gif')); ?>">
    <img src="<?php echo e(asset('home/images/xylh.gif')); ?>">
    <img src="<?php echo e(asset('home/images/kxwz.gif')); ?>">
</div>

<script>
    $(function () {
        jconfirm.defaults = {
            animateFromElement: false,
        }
    });

    function alertModal(content,color) {
        $.alert({
            theme: 'modern',
            title: '错误提示',
            content: content,
            type: color,
            closeIcon: true, // explicitly show the close icon
            buttons: {
                buttonA: {
                    text: '好的',
                    action: function () {
                    }
                }
            }
        });
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $('.captcha').click(function () {
        $.ajax({
            url:'/web/getCaptcha',
            type:'get',
            success:function (result) {
                $('.captcha').attr("src",result);
            }
        })
    });

    function guestLogin() {
        $('.mask').show();
        ZENG.msgbox.show("试玩账号登录中...", 6);
        $.ajax({
            url:'/web/pc/guestLogin',
            type:'post',
            dataType:'json',
            data:{username:'!guest!',password:'!guest!'},
            success:function (result) {
                if(result.status === true){
                    $.ajax({
                        url:'/web/login',
                        type:'post',
                        dataType:'json',
                        data:{username:result.guestAccount,password:'!guest!',isTest:'yes'},
                        success:function (result) {
                            if(result.code==='用户名或密码错误！' || result.code==='验证码错误！'){
                                alert(result.code);
                                return false;
                            }
                            if(result[0]==='success'){
                                // sessionStorage.setItem('name',username);
                                window.location.href = '/welcome';
                            }
                        }
                    })
                    //window.location.href = '/welcome'
                } else {
                    ZENG.msgbox._hide();
                    ZENG.msgbox.show(result.msg, 1, 2200);
                    setTimeout(function () {
                        $('.mask').hide();
                    },2200);
                }
            }
        })
    }

    function log() {
        var username = $('#user').val();
        var password = $('#pass').val();
        //var captcha = $('#cap').val();
        if(username===''){
            alertModal('请输入用户名','orange');
            return false;
        }
        if(password===''){
            alertModal('请输入密码','orange');
            return false;
        }
        // if(captcha===''){
        //     alert('请输入验证码！');
        //     return false;
        // }
        $.ajax({
            url:'/web/login',
            type:'post',
            dataType:'json',
            // data:{username:username,password:password,captcha:captcha},
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
<?php echo $__env->yieldContent('page-js'); ?>
</body>
</html>