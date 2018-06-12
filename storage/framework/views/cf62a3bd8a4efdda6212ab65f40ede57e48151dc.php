<?php $__env->startSection('page-css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- 页面主体区域 -->
    <div class="main_box w">
        <div class=main_l>
            <ul>
                <li class="game">
                    <img src="<?php echo e(asset('home/images/EFC.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">秒速赛车</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>

                <li class="game">
                    <img src="<?php echo e(asset('home/images/BJSC.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">北京赛车</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>
                <li class="game">
                    <img src="<?php echo e(asset('home/images/XYFT.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">幸运飞艇</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>

                <li class="game">
                    <img src="<?php echo e(asset('home/images/FFC.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">秒速时时彩</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>

                <li class="game">
                    <img src="<?php echo e(asset('home/images/CQSSC.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">重庆时时彩</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>

                <li class="game">
                    <img src="<?php echo e(asset('home/images/LHC.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">六合彩</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>

                <li class="game">
                    <img src="<?php echo e(asset('home/images/PCEGG.png')); ?>" class="img_icon">
                    <a href="#" class="text_a">PC蛋蛋</a>
                    <?php if(Session::get('isLoginPc') == 1): ?>
                        <a href="/welcome" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php else: ?>
                        <a href="/web/login" class="bet">
                            <span class="label label-warning">立即投注</span>
                        </a>
                    <?php endif; ?>
                </li>
                <li class="hot_box">
                    <div class="hot">热门</div>
                    <div class="game_list">
                        <?php if(Session::get('isLoginPc') == 1): ?>
                            <a href="/welcome">重庆时时彩</a>
                            <a href="/welcome">北京赛车</a>
                            <a href="/welcome">PC蛋蛋</a>
                        <?php else: ?>
                            <a href="/web/login">重庆时时彩</a>
                            <a href="/web/login">北京赛车</a>
                            <a href="/web/login">PC蛋蛋</a>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="hot_box">
                    <div class="hot">最新</div>
                    <div class="game_list">
                        <?php if(Session::get('isLoginPc') == 1): ?>
                            <a href="/welcome">幸运飞艇</a>
                            <a href="/welcome">幸运飞艇</a>
                            <a href="/welcome">北京快乐8</a>
                        <?php else: ?>
                            <a href="/web/login">幸运飞艇</a>
                            <a href="/web/login">秒速飞艇</a>
                            <a href="/web/login">北京快乐8</a>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="hot_box">
                    <div class="hot">推荐</div>
                    <div class="game_list">
                        <?php if(Session::get('isLoginPc') == 1): ?>
                            <a href="/welcome">江苏快3</a>
                            <a href="/welcome">广东11选5</a>
                            <a href="/welcome">广东快乐十</a>
                        <?php else: ?>
                            <a href="/web/login">江苏快3</a>
                            <a href="/web/login">广东11选5</a>
                            <a href="/web/login">广东快乐十</a>
                        <?php endif; ?>
                    </div>
                </li>
            </ul>
        </div>
        <div class="main_c">
            <!-- 轮播图 -->
            <div class="slide">
                <!-- Swiper -->
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="<?php echo e(asset('home/images/slider/1.jpg')); ?>">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="<?php echo e(asset('home/images/slider/2.jpg')); ?>">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="<?php echo e(asset('home/images/slider/3.jpg')); ?>">
                            </a>
                        </div>
                        <div class="swiper-slide">
                            <a href="#">
                                <img src="<?php echo e(asset('home/images/slider/4.jpg')); ?>">
                            </a>
                        </div>
                    </div>
                    <!-- Add Pagination -->
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <!-- 最新公告 -->
            <div class="new_notice clearfix">
                <i></i>
                <b>最新公告:</b>
                <div class="swipe_p">
                    <span title="欢迎阁下莅临—500万彩票，我们恪守“客户至上”的宗旨，保障客户资金出入安全，提供全网最高赔率，推荐好友到500万彩票，当局结算佣金，您无需支付任何费用，就可以开始无上限的收入！">欢迎阁下莅临—500万彩票，我们恪守“客户至上”的宗旨，保障客户资金出入安全，提供全网最高赔率，推荐好友到500万彩票，当局结算佣金，您无需支付任何费用，就可以开始无上限的收入！ </span>
                </div>
            </div>

            <ul class="quick-tab-list">
                <a href="#" id="type_ball_1" class="active">六合彩</a>
                <a href="#" id="type_ball_2">重庆时时彩</a>
                <a href="#" id="type_ball_3">北京赛车</a>
                <a href="#" id="type_ball_4">PC蛋蛋</a>
            </ul>

            <div class="lotteryBox" style="display:block">
                <p class="endTime">第
                    <span>2018004</span>期 截止:
                    <span>2018-01-14 21:35:00</span>
                </p>
                <div class="qb-selectnumber">
                    <ul class="qb-selectnum">
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                    </ul>
                </div>
            </div>

            <div class="lotteryBox">
                <p class="endTime">第
                    <span>2018004</span>期 截止:
                    <span>2018-01-14 21:35:00</span>
                </p>
                <div class="qb-selectnumber">
                    <ul class="qb-selectnum">
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                    </ul>
                </div>
            </div>

            <div class="lotteryBox">
                <p class="endTime">第
                    <span>2018004</span>期 截止:
                    <span>2018-01-14 21:35:00</span>
                </p>
                <div class="qb-selectnumber">
                    <ul class="qb-selectnum">
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                    </ul>
                </div>
            </div>

            <div class="lotteryBox">
                <p class="endTime">第
                    <span>2018004</span>期 截止:
                    <span>2018-01-14 21:35:00</span>
                </p>
                <div class="qb-selectnumber">
                    <ul class="qb-selectnum">
                        <li class="tmp_ball">35</li>
                        <li class="tmp_ball">35</li>
                    </ul>
                </div>
            </div>
            <!-- 立即投注 -->
            <div>
                <a href="#" class="ljtz">
                    <button type="button" class="btn btn-danger">立即投注</button>
                </a>
            </div>
        </div>

        <!-- 右侧广告 -->
        <div class="main_r">
            <p class="welcome">Hi，欢迎来到500万</p>
            <!-- 登录区域 -->
            <div class="login">
                <a href="<?php echo e(url('web/login')); ?>" class="btn btn-danger btn-sm">登录</a>
                <a href="<?php echo e(url('web/register')); ?>" class="btn btn-warning btn-sm">免费注册</a>
                <a href="javascript:void(0)" onclick="guestLogin()">免费试玩</a>
            </div>
            <!-- 购买帮助 -->
            <div class="buy_help_box">
                <p class="buy_help">购买帮助</p>
            </div>
            <div class="help_text">
                <a href="<?php echo e(url('web/questions')); ?>">如何注册500万会员？</a>
                <a href="<?php echo e(url('web/questions')); ?>">我可以直接在网络上存款提款吗？</a>
                <a href="<?php echo e(url('web/questions')); ?>">单注投注额最低是？</a>
            </div>
            <span class="phone_gc">手机购彩，轻轻松松变土豪！</span>

            <img class="QRcode">
        </div>
    </div>

    <!-- 新闻公告 -->

    <div class="news_box w">
        <div class="news_box_l">
            <div class="l_title">
                <i class="trophy"></i>
                <p>开奖公告</p>
            </div>
            <ul class="news_list">
                <li class="news_list_li">
                    <a href="#" class="text_a">北京赛车(PK10)</a>
                    <span class="term">669445期</span>
                    <ul class="redballBox">
                        <li class="redball">07</li>
                        <li class="redball">09</li>
                        <li class="redball">01</li>
                        <li class="redball">06</li>
                        <li class="redball">08</li>
                        <li class="redball">10</li>
                        <li class="redball">04</li>
                        <li class="redball">05</li>
                        <li class="redball">03</li>
                        <li class="redball">02</li>
                    </ul>
                    <div class="new_r">2018-01-12 11:32:41</div>
                </li>

                <li class="news_list_li">
                    <a href="#" class="text_a">重庆时时彩</a>
                    <span class="term">20180306026期</span>
                    <ul class="redballBox">
                        <li class="redball">02</li>
                        <li class="redball">06</li>
                        <li class="redball">01</li>
                        <li class="redball">08</li>
                        <li class="redball">06</li>
                    </ul>
                    <div class="new_r">2018-01-12 11:32:41</div>
                </li>

                <li class="news_list_li">
                    <a href="#" class="text_a">香港六合彩</a>
                    <span class="term">2018022期</span>
                    <ul class="redballBox">
                        <li class="redball">28</li>
                        <li class="redball">11</li>
                        <li class="redball">06</li>
                        <li class="redball">10</li>
                        <li class="redball">43</li>
                        <li class="redball">23</li>
                        <li class="redball">21</li>
                    </ul>
                    <div class="new_r">2018-01-12 11:32:41</div>
                </li>

                <li class="news_list_li">
                    <a href="#" class="text_a">幸运飞艇</a>
                    <span class="term">661222期</span>
                    <ul class="redballBox">
                        <li class="redball">02</li>
                        <li class="redball">04</li>
                        <li class="redball">08</li>
                        <li class="redball">03</li>
                        <li class="redball">01</li>
                        <li class="redball">05</li>
                    </ul>
                    <div class="new_r">2018-01-12 11:32:41</div>
                </li>

                <li class="news_list_li">
                    <a href="#" class="text_a">江苏骰宝(快3)</a>
                    <span class="term">2018030506期</span>
                    <ul class="redballBox">
                        <li class="redball">03</li>
                        <li class="redball">06</li>
                        <li class="redball">03</li>
                    </ul>
                    <div class="new_r">2018-01-12 11:32:41</div>
                </li>
            </ul>
        </div>
        <div class="news_box_c">
            <div class="lottery_top">
                <h4 class="lott_text">彩票资讯</h4>
            </div>

            <h3 class="news_bar_tit">
                <span>今日热点</span>
                <a href="./view/msg.html" title="三人同时中600多万 故事一个比一个精彩">三人同时中600多万 故事一个比一个精彩</a>
                <a href="./view/msg.html" title="贵州福彩最高奖开出 铜仁">贵州福彩最高奖开出 铜仁</a>
            </h3>

            <ul class="news_bar_list">
                <li class="news_s">
                    <a href="./view/msg.html" class="news_text">[新闻]</a>
                    <a href="./view/msg.html" class="news_text_list" title="均10天再中一个大奖 南阳再中双">均10天再中一个大奖 南阳再中双</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>

                <li class="news_s">
                    <a href="#" class="news_text">[新闻]</a>
                    <a href="#" class="news_text_list" title="河南彩民连创佳绩 三期五注双色球头奖">河南彩民连创佳绩 三期五注双色球头奖</a>
                </li>
            </ul>
            <img src="<?php echo e(asset('home/images/SrlmH1iof.png')); ?>">
        </div>

        <div class="news_box_r">
            <div class="zxzj">最新中奖</div>
            <div class="news_slide_Box">
                <ul class="news_slide">
                    <!-- TODO -->
                </ul>
            </div>
            <div class="win_tit">中奖排行</div>
            <ul class="win_list">
                <li class="win_list_li">
                    <span class="win_top_icon">1</span>
                    <div class="win_top_use">as**** </div>
                    <div class="win_top_y">215685.70 元</div>
                </li>
                <li class="win_list_li">
                    <span class="win_top_icon">2</span>
                    <div class="win_top_use">fe**** </div>
                    <div class="win_top_y">198210.70 元</div>
                </li>
                <li class="win_list_li">
                    <span class="win_top_icon">3</span>
                    <div class="win_top_use">w1**** </div>
                    <div class="win_top_y">125421.40 元</div>
                </li>
                <li class="win_list_li">
                    <span class="win_top_icon">4</span>
                    <div class="win_top_use">88***** </div>
                    <div class="win_top_y">84512.50 元</div>
                </li>
                <li class="win_list_li">
                    <span class="win_top_icon">5</span>
                    <div class="win_top_use">ds**** </div>
                    <div class="win_top_y">50757.28 元</div>
                </li>
                <li class="win_list_li">
                    <span class="win_top_icon">6</span>
                    <div class="win_top_use">fw**** </div>
                    <div class="win_top_y">35920.80 元</div>
                </li>
            </ul>
        </div>
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
    <script src="<?php echo e(asset('home/vendor/Swiper/swiper-3.4.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('home/js/index.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('home.500_views.layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>