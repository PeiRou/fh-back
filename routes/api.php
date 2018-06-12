<?php
use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function () {
    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::post('/init',['uses'=>'AccountController@init']);
        Route::post('/user/getUserMsg',['uses'=>'AccountController@getUserMsg']);
        Route::get('/token_refresh',['uses'=>'AccountController@RefreshToken']);
        //个人中心-消息
        Route::get('/user/getNotices',['uses'=>'NoticeController@getNotices']);
        //资金管理--取款
        Route::get('/user/getUserBank','Mobile\PayController@getUserBank');
        //绑定银行卡
        Route::post('/user/bindBank','Mobile\PayController@bindBank');
        //获取银行列表信息
        Route::get('system/bankList','Mobile\PayController@bankList');
        //下注
        Route::post('/lottery/bet.do','Mobile\BetController@bet');
        //获取用户余额
        Route::post('/user/getMoney','Mobile\MoneyController@getMoney');
        //api获取结算和未结算余额
        Route::post('/lottery/getLotteryData','Mobile\MoneyController@getLotteryData');
        //今日已结算
        Route::get('/mobile/lottery/getSettled','Mobile\MoneyController@getSettled');
        //下注记录
        Route::get('/mobile/user/getStatBets','Mobile\BetController@getStatBets');
        //聊天室取用户Sign
        Route::get('/getSign','Mobile\ChatController@getSign');
        Route::post('/chat/init','Mobile\ChatController@chatInit');
        //mobile在线支付
        Route::post('/bank/onlinePay.pay','Mobile\PayController@onlinePay');
        //即时注单
        Route::get('/mobile/lottery/getNotcount','Mobile\BetController@getNotCount');
        //即时注单详情
        Route::get('/mobile/lottery/getNotcountDetail','Mobile\BetController@getNotcountDetail');
        //修改用户密码
        Route::post('/mobile/user/updateMyPwd','AccountController@updateMyPwd');
        //设置取款密码
        Route::post('/mobile/user/saveFundPwd','AccountController@saveFundPwd');
        //更新取款密码
        Route::post('/mobile/user/updateFundPwd','AccountController@updateFundPwd');
        //消息中心
        Route::get('/mobile/user/getNotices','Mobile\NoticeController@getNotices');
        //存款记录
        Route::get('/mobile/user/getRechList','Mobile\TransController@getRechList');
        //取款记录
        Route::get('/mobile/user/getWithDrawList','Mobile\TransController@getWithDrawList');
        //红包查询
        Route::get('/mobile/user/getPacketList','Mobile\TransController@getPacketList');
        //用户活动信息
        Route::post('/mobile/acti/getUserActivityList','Mobile\ActivityController@getUserActivityList');
        //登录送好礼活动
        Route::post('/mobile/acti/getTodayUserActivity','Mobile\ActivityController@getTodayUserActivity');
        //获取随机付款码
        Route::get('/mobile/bank/getAuthCode','Mobile\PayController@getAuthCode');
        //保存存款付款信息
        Route::post('/mobile/bank/save','Mobile\PayController@bankSave');
        //提款到银行卡
        Route::post('/bank/withdrawSubmit.do','Mobile\PayController@withdrawSubmit');
    });
});

//移动端获取开奖记录
Route::get('/mobile/lotteryHistory/data','Mobile\LotteryHistoryController@lotteryHistory');

Route::get('/webchat/info','Mobile\ChatController@webchatInfo');

Route::post('/login', 'AccountController@login');
Route::post('/guestLogin','AccountController@guestLogin');
Route::post('/reg','AccountController@register');
Route::get('/logout','AccountController@logout');
Route::post('/checkUserNameExist','AccountController@checkUserNameExist');

Route::get('/mobile/activity','Mobile\ActivityController@homeActivity');

Route::post('/lottery/getLotteryData.do','Mobile\LotteryDataController@getLotteryData');
Route::get('/lottery/getAllNextIssue.do','Mobile\LotteryDataController@getAllNextIssue');
Route::post('/lottery/getUserPlayData.do','Mobile\LotteryDataController@getUserPlayData');
Route::get('/lottery/CurIssue/{gameId?}','Mobile\LotteryDataController@CurIssue');

Route::get('/lottery/getNextIssue.do','Mobile\LotteryDataController@getNextIssue');

//充值
Route::get('/mobile/userrech/getOtherRechCfgs','Mobile\PayController@getOtherRechConfig');
Route::get('/mobile/userrech/getUserRechCfgs','Mobile\PayController@getUserRechConfig');


//获取游戏当期数据
Route::get('/lottery/data/CurIssue/{id}','Mobile\LotteryDataController@GameCurIssue');

