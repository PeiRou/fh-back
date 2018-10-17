<?php
Route::group(['middleware'=>['check-ip']],function () {
    Route::get('/', 'Home\IndexController@index')->middleware('mobile-check');

    Route::get('/getCaptcha',function(){});

    Route::get('/src/agent', 'Back\SrcViewController@AgentLogin'); // 代理登录页面
    Route::get('/back/control', 'Back\SrcViewController@AdminLogin')->name('back.login')->middleware('domain-check'); // 管理登录页面

    Route::group(['prefix' => 'back/control/', 'middleware' => ['domain-check', 'add-log-handle']], function () {
        Route::get('dash', ['uses' => 'Back\SrcViewController@Dash', 'as' => 'dash']); // 控制台
    });

//用户管理
    Route::group(['prefix' => 'back/control/userManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('general_agent', 'Back\SrcViewController@generalAgent')->name('m.gAgent'); // 总代理
        Route::get('agent', 'Back\SrcViewController@agent')->name('m.agent'); // 代理
        Route::get('user', 'Back\SrcViewController@user')->name('m.user'); // 用户
        Route::get('onlineUser', 'Back\SrcViewController@onlineUser')->name('m.onlineUser'); // 在线会员
        Route::get('sub_account', 'Back\SrcViewController@subAccount')->name('m.subAccount'); // 子账号
        Route::get('userBetList/{userId}', 'Back\SrcViewController@userBetList')->name('m.user.viewDetails'); //用户注单明细
    });

//棋牌管理
    Route::group(['prefix' => 'back/control/cardGameManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('up_down', 'Back\SrcViewController@upDownSearch')->name('cardGame.upDownSearch'); // 上下分记录查询
        Route::get('card_bet', 'Back\SrcViewController@cardBetInfo')->name('cardGame.cardBetInfo'); // 棋牌下注查询
    });

//财务管理
    Route::group(['prefix' => 'back/control/financeManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('rechargeRecord', 'Back\SrcViewController@rechargeRecord')->name('finance.rechargeRecord'); // 充值记录
        Route::get('drawingRecord', 'Back\SrcViewController@drawingRecord')->name('finance.drawingRecord'); // 提款记录
        Route::get('capitalDetails', 'Back\SrcViewController@capitalDetails')->name('finance.capitalDetails'); // 资金明细
        Route::get('memberReconciliation', 'Back\SrcViewController@memberReconciliation')->name('finance.memberReconciliation'); // 会员对账
        Route::get('agentReconciliation', 'Back\SrcViewController@agentReconciliation')->name('finance.agentReconciliation'); // 代理对账
    });
//报表管理
    Route::group(['prefix' => 'back/control/reportManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('gagent', 'Back\SrcViewController@reportGagent')->name('report.gAgent'); // 总代理报表
        Route::get('agent', 'Back\SrcViewController@reportAgent')->name('report.agent'); // 代理报表
        Route::get('user', 'Back\SrcViewController@reportUser')->name('report.user'); // 会员报表
        Route::get('statistics', 'Back\SrcViewController@reportStatistics')->name('report.statistics'); // 报表统计
        Route::get('bet', 'Back\SrcViewController@reportBet')->name('report.bet'); // 投注报表
        Route::get('online', 'Back\SrcViewController@reportOnline')->name('report.online'); // 在线报表
    });
//图表统计
    Route::group(['prefix' => 'back/control/chartsManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('gameBunko', 'Back\SrcViewController@chartsGameBunko')->name('charts.gameBunko'); // 盈亏统计
        Route::get('recharges', 'Back\SrcViewController@chartsRecharges')->name('charts.recharges'); // 充值统计
    });
//投注记录
    Route::group(['prefix' => 'back/control/betManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('today', 'Back\SrcViewController@betTodaySearch')->name('bet.todaySearch'); // 今日注单搜索
        Route::get('history', 'Back\SrcViewController@betHistorySearch')->name('bet.historySearch'); // 历史注单搜索
        Route::get('realTime', 'Back\SrcViewController@betRealTime')->name('bet.betRealTime'); // 实时滚单
    });
//公告管理
    Route::group(['prefix' => 'back/control/noticeManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('setting', 'Back\SrcViewController@noticeSetting')->name('notice.noticeSetting'); // 公告设置
        Route::get('sendMessage', 'Back\SrcViewController@messageSend')->name('notice.messageSend'); // 消息推送
    });

//游戏管理
    Route::group(['prefix' => 'back/control/gameManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('gameSetting', 'Back\SrcViewController@gameSetting')->name('game.gameSetting'); //游戏设定
        Route::get('tradeSetting', 'Back\SrcViewController@tradeSetting')->name('game.tradeSetting'); //交易设定
        Route::get('handicapSetting', 'Back\SrcViewController@handicapSetting')->name('game.handicapSetting'); //盘口设定
        Route::get('killSetting', 'Back\SrcViewController@killSetting')->name('game.killSetting'); //杀率设定
    });

//开奖管理
    Route::group(['prefix' => 'back/control/openManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {

        Route::get('cqxync', 'Back\SrcViewController@openManage_cqxync')->name('historyLottery.cqxync'); //重庆幸运农场
        Route::get('gdklsf', 'Back\SrcViewController@openManage_gdklsf')->name('historyLottery.gdklsf'); //广东快乐十分
        Route::get('gd11x5', 'Back\SrcViewController@openManage_gd11x5')->name('historyLottery.gd11x5'); //广东11选5

        Route::get('cqssc', 'Back\SrcViewController@openManage_cqssc')->name('historyLottery.cqssc'); //重庆时时彩
        Route::get('msssc', 'Back\SrcViewController@openManage_msssc')->name('historyLottery.msssc'); //秒速时时彩
        Route::get('bjpk10', 'Back\SrcViewController@openManage_bjpk10')->name('historyLottery.bjpk10'); //北京pk10
        Route::get('bjkl8', 'Back\SrcViewController@openManage_bjkl8')->name('historyLottery.bjkl8'); //北京快乐8
        Route::get('mssc', 'Back\SrcViewController@openManage_mssc')->name('historyLottery.mssc'); //秒速赛车
        Route::get('msft', 'Back\SrcViewController@openManage_msft')->name('historyLottery.msft'); //秒速飞艇
        Route::get('paoma', 'Back\SrcViewController@openManage_paoma')->name('historyLottery.paoma'); //跑马
        Route::get('msjsk3', 'Back\SrcViewController@openManage_msjsk3')->name('historyLottery.msjsk3'); //秒速快3
        Route::get('jsk3', 'Back\SrcViewController@openManage_jsk3')->name('historyLottery.jsk3'); //江苏快3
        Route::get('ahk3', 'Back\SrcViewController@openManage_ahk3')->name('historyLottery.ahk3'); //安徽快3
        Route::get('jlk3', 'Back\SrcViewController@openManage_ljk3')->name('historyLottery.jlk3'); //吉林快3
        Route::get('hbk3', 'Back\SrcViewController@openManage_hbk3')->name('historyLottery.hbk3'); //湖北快3
        Route::get('gxk3', 'Back\SrcViewController@openManage_gxk3')->name('historyLottery.gxk3'); //广西快3
        Route::get('lhc', 'Back\SrcViewController@openManage_xglhc')->name('historyLottery.xglhc'); //六合彩
        Route::get('xylhc', 'Back\SrcViewController@openManage_xylhc')->name('historyLottery.xylhc'); //幸运六合彩
    });

//系统管理
    Route::group(['prefix' => 'back/control/systemManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('PermissionsAuth', 'Back\SrcViewController@PermissionsAuth')->name('system.PermissionsAuth'); //权限控制管理
        Route::get('permissions', 'Back\SrcViewController@Permissions')->name('system.permission'); //权限管理
        Route::get('role', 'Back\SrcViewController@role')->name('system.role');  //角色管理
        Route::get('systemSetting', 'Back\SrcViewController@systemSetting')->name('system.systemSetting'); //系统参数配置
        Route::get('articleManage', 'Back\SrcViewController@articleManage')->name('system.articleManage'); //文章管理
        Route::get('whitelist', 'Back\SrcViewController@whitelist')->name('system.whitelist'); //ip白名单设置
        Route::get('feedback', 'Back\SrcViewController@feedback')->name('system.feedback'); //意见反馈
    });

//日志管理
    Route::group(['prefix' => 'back/control/logManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('login', 'Back\SrcViewController@loginLog')->name('log.login'); //登录日志
        Route::get('handle', 'Back\SrcViewController@handleLog')->name('log.handle'); //操作日志
        Route::get('abnormal', 'Back\SrcViewController@abnormalLog')->name('log.abnormal'); //异常日志
    });

//代理结算
    Route::group(['prefix' => 'back/control/agentSettle', 'middleware' => ['check-permission', 'domain-check']], function () {
        Route::get('report', 'Back\SrcViewController@agentSettleReport')->name('agentSettle.report');    //代理结算报表
        Route::get('review', 'Back\SrcViewController@agentSettleReview')->name('agentSettle.review');    //代理结算审核
        Route::get('draw', 'Back\SrcViewController@agentSettleDraw')->name('agentSettle.draw');          //代理提款
        Route::get('setting', 'Back\SrcViewController@agentSettleSetting')->name('agentSettle.setting'); //代理结算配置
    });

//充值配置
    Route::group(['prefix' => 'back/control/payManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('payOnline', 'Back\SrcViewController@payOnline')->name('pay.online'); //在线支付配置
        Route::get('payBank', 'Back\SrcViewController@payBank')->name('pay.bank'); //银行支付配置
        Route::get('payAlipay', 'Back\SrcViewController@payAlipay')->name('pay.alipay'); //支付宝支付配置
        Route::get('payWechat', 'Back\SrcViewController@payWechat')->name('pay.wechat'); //微信支付配置
        Route::get('payYunShanPay', 'Back\SrcViewController@payYunShanPay')->name('pay.payYunShanPay'); //云闪付配置
        Route::get('payCft', 'Back\SrcViewController@payCft')->name('pay.cft'); //财付通支付配置
        Route::get('bindBank', 'Back\SrcViewController@bindBank')->name('pay.bindBank'); //绑定银行配置
        Route::get('payLayout', 'Back\SrcViewController@payLayout')->name('pay.payLayout'); //支付层级配置
        Route::get('rechargeWay', 'Back\SrcViewController@rechargeWay')->name('pay.rechargeWay'); //支付层级配置
        Route::get('rechType', 'Back\SrcViewController@rechType')->name('pay.rechType'); //支付前端显示
    });

//充值配置新
    Route::group(['prefix' => 'back/control/payNewManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('payOnlineNew', 'Back\SrcViewController@payOnlineNew')->name('payNew.online'); //在线支付配置新
        Route::get('payBankNew', 'Back\SrcViewController@payBankNew')->name('payNew.bank'); //银行支付配置
        Route::get('payAlipayNew', 'Back\SrcViewController@payAlipayNew')->name('payNew.alipay'); //支付宝支付配置
        Route::get('payWechatNew', 'Back\SrcViewController@payWechatNew')->name('payNew.wechat'); //微信支付配置
        Route::get('payYunShanPayNew', 'Back\SrcViewController@payYunShanPayNew')->name('payNew.payYunShanPay'); //云闪付配置
        Route::get('payCftNew', 'Back\SrcViewController@payCftNew')->name('payNew.cft'); //财付通支付配置
        Route::get('bindBank', 'Back\SrcViewController@bindBankNew')->name('payNew.bindBank'); //绑定银行配置
        Route::get('payLayout', 'Back\SrcViewController@payLayoutNew')->name('payNew.payLayout'); //支付层级配置
        Route::get('rechargeWay', 'Back\SrcViewController@rechargeWayNew')->name('payNew.rechargeWay'); //支付层级配置
        Route::get('rechType', 'Back\SrcViewController@rechTypeNew')->name('payNew.rechType'); //支付前端显示
    });

//代理结算
    Route::group(['prefix' => 'back/control/agentManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('agentSettleReport', 'Back\SrcViewController@agentSettleReport')->name('agentSettle.report'); //代理结算报表
        Route::get('agentSettleReview', 'Back\SrcViewController@agentSettleReview')->name('agentSettle.review'); //代理结算审核
        Route::get('agentSettleWithdraw', 'Back\SrcViewController@agentSettleWithdraw')->name('agentSettle.draw'); //代理提现
        Route::get('agentSettleConfig', 'Back\SrcViewController@agentSettleConfig')->name('agentSettle.setting'); //代理结配置
    });

//活动管理
    Route::group(['prefix' => 'back/control/activityManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('activityList', 'Back\SrcViewController@activityList')->name('activity.list'); //活动列表
        Route::get('activityCondition', 'Back\SrcViewController@activityCondition')->name('activity.condition'); //活动条件
        Route::get('activityPrize', 'Back\SrcViewController@activityPrize')->name('activity.gift'); //奖品配置
        Route::get('activityReview', 'Back\SrcViewController@activityReview')->name('activity.review'); //派奖审核
        Route::get('activityDaily', 'Back\SrcViewController@activityDaily')->name('activity.daily'); //每日数据统计
        Route::get('activityData', 'Back\SrcViewController@activityData')->name('activity.data'); //活动数据统计
    });

    //推广结算
    Route::group(['prefix' => 'back/control/promotionManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
        Route::get('promotionReport','Back\SrcViewController@promotionReport')->name('promotion.report'); //推广结算报表
        Route::get('promotionReview','Back\SrcViewController@promotionReview')->name('promotion.review'); //推广结算审核
        Route::get('promotionSetting','Back\SrcViewController@promotionSetting')->name('promotion.setting'); //推广结算配置
    });

    //平台费用
    Route::group(['prefix' => 'back/control/platformManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
        Route::get('platformSettlement','Back\SrcViewController@platformSettlement')->name('platform.settlement'); //平台费用结算
        Route::get('platformRecord','Back\SrcViewController@platformRecord')->name('platform.payRecord'); //付款记录
    });

    //下拉菜单
    Route::group(['middleware'=>['add-log-handle']],function(){
        Route::get('/today/selectData/playCate/{gameId?}','Back\SrcViewController@playCate')->name('select.playCate'); // 下拉菜单获取玩法分类
        Route::get('/recharge/selectData/payOnline/{rechargeType?}','Back\SrcViewController@payOnlineSelectData')->name('select.payOnlineSelectData'); // 下拉菜单获取在线支付分类
        Route::get('/recharge/selectData/dateChange/{date?}','Back\SrcViewController@payOnlineDateChange')->name('select.payOnlineDateChange'); // 下拉菜单获取今日，昨日，上周
    });

    Route::get('getLevel', 'Back\SrcViewController@getLevel'); // ajax 获取分层列表
    Route::get('batchDelSendMessage', 'Back\SrcViewController@batchDelSendMessage'); // 批量删除

    Route::get('/back/datatables/subaccount', 'Back\Data\MembersDataController@subAccounts');
    Route::get('/back/datatables/generalAgent', 'Back\Data\MembersDataController@generalAgent');
    Route::get('/back/datatables/agent', 'Back\Data\MembersDataController@agent');
    Route::get('/back/datatables/agentCapital/{id}', 'Back\Data\MembersDataController@agentCapital');
    Route::get('/back/datatables/userCapital/{id}', 'Back\Data\MembersDataController@userCapital');
    Route::get('/back/datatables/user', 'Back\Data\MembersDataController@user');
    Route::get('/back/datatables/userTotal', 'Back\Data\MembersDataController@userTotal')->middleware('check-permission')->name('m.user.userTotal');//会员统计查看;
    Route::get('/back/datatables/premissions', 'Back\Data\SystemDataController@permissions'); //权限-表格数据
    Route::get('/back/datatables/premissionsAuth', 'Back\Data\SystemDataController@permissionsAuth'); //权限控制-表格数据
    Route::get('/back/datatables/roles', 'Back\Data\SystemDataController@roles'); //角色-表格数据
    Route::get('/back/datatables/whitelist', 'Back\Data\SystemDataController@whitelist'); //ip白名单设置-表格数据
    Route::get('/back/datatables/feedback', 'Back\Data\SystemDataController@feedback'); //建议反馈-表格数据
    Route::get('/back/datatables/bank', 'Back\Data\PayDataController@bank');
    Route::get('/back/datatables/games', 'Back\Data\GameDataController@games');
    Route::get('/back/datatables/gamekillsetting', 'Back\Data\GameDataController@gamekillsetting');
    Route::get('/back/datatables/onlineUser', 'Back\Data\MembersDataController@onlineUser');
    Route::get('/back/datatables/rechargeRecord', 'Back\Data\FinanceDataController@rechargeRecord');
    Route::get('/back/datatables/drawingRecord', 'Back\Data\FinanceDataController@drawingRecord');
    Route::get('/back/datatables/capitalDetails', 'Back\Data\FinanceDataController@capitalDetails'); //资金明细-表格数据
    Route::get('/back/datatables/memberReconciliation', 'Back\Data\FinanceDataController@memberReconciliation');
    Route::get('/back/datatables/agentReconciliation', 'Back\Data\FinanceDataController@agentReconciliation');
    Route::get('/back/datatables/reportGagent', 'Back\Data\ReportDataController@Gagent');   //报表管理-总代
    Route::get('/back/datatables/reportAgent', 'Back\Data\ReportDataController@Agent');     //报表管理-代理
    Route::get('/back/datatables/reportUser', 'Back\Data\ReportDataController@User');       //报表管理-用户
    Route::get('/back/datatables/reportStatistics', 'Back\Data\ReportDataController@Statistics');       //报表管理-操作报表
    Route::get('/back/datatables/reportBet', 'Back\Data\ReportDataController@Bet');
    Route::get('/back/datatables/reportGagentTotal', 'Back\Data\ReportDataController@GagentTotal'); //报表管理-总代总计
    Route::get('/back/datatables/reportAgentTotal', 'Back\Data\ReportDataController@AgentTotal');   //报表管理-代理总计
    Route::get('/back/datatables/reportUserTotal', 'Back\Data\ReportDataController@UserTotal');     //报表管理-用户总计
    Route::get('/back/datatables/betToday', 'Back\Data\BetDataController@betToday');
    Route::get('/back/datatables/betHistory', 'Back\Data\BetDataController@betHistory');
    Route::get('/back/datatables/betRealTime', 'Back\Data\BetDataController@betRealTime');
    Route::get('/back/datatables/notice', 'Back\Data\NoticeDataController@notice');
    Route::get('/back/datatables/sendMessage', 'Back\Data\NoticeDataController@sendMessage');
    Route::get('/back/datatables/level', 'Back\Data\PayDataController@level');
    Route::get('/back/datatables/rechargeWay', 'Back\Data\PayDataController@rechargeWay');
    Route::get('/back/datatables/rechType', 'Back\Data\PayDataController@rechType');
    Route::get('/back/datatables/payOnline', 'Back\Data\PayDataController@payOnline');
    Route::get('/back/datatables/payBank', 'Back\Data\PayDataController@payBank');
    Route::get('/back/datatables/payAlipay', 'Back\Data\PayDataController@payAlipay');
    Route::get('/back/datatables/payWechat', 'Back\Data\PayDataController@payWechat');
    Route::get('/back/datatables/payCft', 'Back\Data\PayDataController@payCft');
    Route::get('/back/datatables/payOnlineNew', 'Back\Data\PayNewDataController@payOnline'); //充值配置新-在线支付
    Route::get('/back/datatables/payBankNew', 'Back\Data\PayNewDataController@payBank');    //充值配置新-银行支付
    Route::get('/back/datatables/payAlipayNew', 'Back\Data\PayNewDataController@payAlipay');  //充值配置新-支付宝
    Route::get('/back/datatables/payWechatNew', 'Back\Data\PayNewDataController@payWechat'); //充值配置新-微信
    Route::get('/back/datatables/payCftNew', 'Back\Data\PayNewDataController@payCft');  //充值配置新-财付通
    Route::get('/back/datatables/article', 'Back\Data\ArticleController@article');
    Route::get('/back/datatables/suggest', 'Back\Data\SuggestController@index');
    Route::get('/back/datatables/userBetSearch', 'Back\Data\BetDataController@userBetSearch');
    Route::get('/back/datatables/log/login', 'Back\Data\LogDataController@login'); //登录日志
    Route::get('/back/datatables/logHandle', 'Back\Data\LogDataController@logHandle'); //操作日志
    Route::get('/back/datatables/logAbnormal', 'Back\Data\LogDataController@logAbnormal'); //异常日志

    Route::get('/back/datatables/openHistory/gdklsf', 'Back\Data\openHistoryController@gdklsf'); //历史开奖 - 广东快乐十分
    Route::get('/back/datatables/openHistory/cqxync', 'Back\Data\openHistoryController@cqxync'); //历史开奖 - 重庆幸运农场
    Route::get('/back/datatables/openHistory/gd11x5', 'Back\Data\openHistoryController@gd11x5'); //历史开奖 - 广东11选5

    Route::get('/back/datatables/openHistory/cqssc', 'Back\Data\openHistoryController@cqssc'); //历史开奖 - 重庆时时彩
    Route::get('/back/datatables/openHistory/msssc', 'Back\Data\openHistoryController@msssc'); //历史开奖 - 秒速时时彩
    Route::get('/back/datatables/openHistory/bjpk10', 'Back\Data\openHistoryController@bjpk10'); //历史开奖 - 北京PK10
    Route::get('/back/datatables/openHistory/bjkl8', 'Back\Data\openHistoryController@bjkl8'); //历史开奖 - 北京快乐8
    Route::get('/back/datatables/openHistory/mssc', 'Back\Data\openHistoryController@mssc'); //历史开奖 - 秒速赛车
    Route::get('/back/datatables/openHistory/msft', 'Back\Data\openHistoryController@msft'); //历史开奖 - 秒速飞艇
    Route::get('/back/datatables/openHistory/paoma', 'Back\Data\openHistoryController@paoma'); //历史开奖 - 跑马
    Route::get('/back/datatables/openHistory/lhc', 'Back\Data\openHistoryController@lhc'); //历史开奖 - 六合彩
    Route::get('/back/datatables/openHistory/xylhc', 'Back\Data\openHistoryController@xylhc'); //历史开奖 - 幸运六合彩
    Route::get('/back/datatables/openHistory/k3', 'Back\Data\openHistoryController@k3'); //历史开奖 - 秒速快三
    Route::get('/back/datatables/agentSettle/report', 'Back\Data\AgentSettleController@report'); //代理结算报表-表格数据
    Route::get('/back/datatables/agentSettle/review', 'Back\Data\AgentSettleController@review'); //代理结算审核-表格数据
    Route::get('/back/datatables/agentSettle/withdraw', 'Back\Data\AgentSettleController@withdraw'); //代理提现-表格数据
    Route::get('/back/datatables/activity/lists', 'Back\Data\ActivityController@lists'); //活动列表-表格数据
    Route::get('/back/datatables/activity/condition', 'Back\Data\ActivityController@condition'); //活动条件-表格数据
    Route::get('/back/datatables/activity/prize', 'Back\Data\ActivityController@prize'); //奖品配置-表格数据
    Route::get('/back/datatables/activity/review', 'Back\Data\ActivityController@review'); //派奖审核-表格数据
    Route::get('/back/datatables/activity/daily', 'Back\Data\ActivityController@daily'); //每日数据统计-表格数据
    Route::get('/back/datatables/activity/data', 'Back\Data\ActivityController@data'); //每日活动统计-表格数据
    Route::get('/back/datatables/promotion/report','Back\Data\PromotionController@report'); //推广结算报表-表格数据
    Route::get('/back/datatables/promotion/review','Back\Data\PromotionController@review'); //推广审核报表-表格数据
    Route::get('/back/datatables/promotion/config','Back\Data\PromotionController@config'); //推广设置-表格数据
    Route::get('/back/datatables/platform/settlement','Back\Data\PlatformController@settlement'); //平台费用结算-表格数据
    Route::get('/back/datatables/platform/record','Back\Data\PlatformController@record'); //付款记录-表格数据

    //图表数据
    Route::post('/back/charts/gameBunko','Back\Charts\ChartsDataController@gameBunko');
    Route::post('/back/charts/recharges','Back\Charts\ChartsDataController@recharges');

//action
    Route::post('/action/admin/login', 'Back\SrcAccountController@login');
    Route::post('/action/admin/logout', 'Back\SrcAccountController@logout');

    Route::post('/action/admin/addPlatformSettlement', 'Back\PlatformController@addPlatformSettlement');//平台费用结算-手动结算

    Route::post('/action/admin/addGeneralAgent', 'Back\SrcMemberController@addGeneralAgent');//添加总代理
    Route::post('/action/admin/editGeneralAgent', 'Back\SrcMemberController@editGeneralAgent');//修改总代理

    Route::post('/action/admin/addSubAccount', 'Back\SrcMemberController@addSubAccount');//添加子账号
    Route::post('/action/admin/editSubAccount', 'Back\SrcMemberController@editSubAccount');//修改子账号
    Route::post('/action/admin/delSubAccount', 'Back\SrcMemberController@delSubAccount');//删除子账号
    Route::post('/action/admin/changeGoogleCode', 'Back\SrcMemberController@changeGoogleCode');//更换子账号的google验证码

    Route::post('/action/admin/addAgent', 'Back\SrcMemberController@addAgent');//添加代理账号
    Route::post('/action/admin/editAgent', 'Back\SrcMemberController@editAgent');//修改代理账号
    Route::post('/action/admin/delAgent/{id}', 'Back\SrcMemberController@delAgent')->middleware('check-permission')->name('m.agent.del');//删除代理账号
    Route::post('/action/admin/changeAgentMoney', 'Back\SrcMemberController@changeAgentMoney');//修改代理金额

    Route::post('/action/admin/addUser', 'Back\SrcMemberController@addUser');//添加会员
    Route::post('/action/admin/userChangeAgent', 'Back\SrcMemberController@userChangeAgent');//会员更换代理
    Route::post('/action/admin/userChangeFullName', 'Back\SrcMemberController@userChangeFullName');//会员更换真实姓名
    Route::post('/action/admin/editUser', 'Back\SrcMemberController@editUser');//修改会员资料
    Route::post('/action/admin/changeUserMoney', 'Back\SrcMemberController@changeUserMoney');//修改会员余额
    Route::post('/action/admin/delUser/{id}', 'Back\SrcMemberController@delUser')->middleware('check-permission')->name('m.user.delUser');//删除会员账号
    Route::post('/action/admin/editUserLevels', 'Back\SrcMemberController@editUserLevels');//删除会员层级
    Route::post('/action/admin/editRechUserLevels', 'Back\SrcMemberController@editRechUserLevels');//修改存款会员层级
    Route::post('/action/admin/editDrawingLevels', 'Back\SrcMemberController@editDrawingLevels');//修改提款会员层级
    Route::post('/action/admin/getOutUser', 'Back\SrcMemberController@getOutUser');//会员踢下线
    Route::post('/action/userMoney/totalUserMoney', 'Back\SrcMemberController@totalUserMoney');//会员总余额统计

    Route::post('/action/admin/addPermission', 'Back\PermissionController@addPermission')->name('addPermission'); //添加权限
    Route::post('/action/admin/editPermission', 'Back\PermissionController@editPermission')->name('system.editPermission'); //修改权限
    Route::post('/action/admin/addPermissionAuth', 'Back\PermissionController@addPermissionAuth')->name('system.addPermissionAuth'); //添加权限控制
    Route::post('/action/admin/editPermissionAuth', 'Back\PermissionController@editPermissionAuth')->name('system.editPermissionAuth'); //修改权限控制
    Route::post('/action/admin/addNewRole', 'Back\RoleController@addNewRole')->name('system.addNewRole'); //添加角色
    Route::post('/action/admin/editNewRole', 'Back\RoleController@editNewRole')->name('system.editNewRole'); //修改角色
    Route::post('/action/admin/systemSetting/edit', 'Back\SystemSettingController@editSystemSetting');//编辑系统设置
    Route::post('/action/admin/addArticle', 'Back\SystemSettingController@addArticle');//添加文章
    Route::post('/action/admin/delArticle', 'Back\SystemSettingController@delArticle');//删除文章
    Route::post('/action/admin/editArticle', 'Back\SystemSettingController@editArticle');//修改文章
    Route::post('/action/admin/addWhitelist', 'Back\SystemSettingController@addWhitelist');//添加ip白名单
    Route::post('/action/admin/delWhitelist', 'Back\SystemSettingController@delWhitelist');//删除ip白名单
    Route::post('/action/admin/editWhitelist', 'Back\SystemSettingController@editWhitelist');//修改ip白名单
    Route::post('/action/admin/replyFeedback', 'Back\SystemSettingController@replyFeedback');//问题回复

    Route::post('/action/admin/agentSettle/settlement', 'Back\AgentSettleController@settlement'); //代理结算报表-手动结算
    Route::post('/action/admin/agentSettle/submitReview', 'Back\AgentSettleController@submitReview'); //代理结算报表-提交审核
    Route::post('/action/admin/agentSettle/submitSettle', 'Back\AgentSettleController@submitSettle'); //代理结算报表-提交结算
    Route::post('/action/admin/agentSettle/submitTurnDown', 'Back\AgentSettleController@submitTurnDown'); //代理结算报表-提交驳回
    Route::post('/action/admin/agentSettle/editReport', 'Back\AgentSettleController@editReport'); //代理结算报表-修改报表
    Route::post('/action/admin/agentSettle/editReview', 'Back\AgentSettleController@editReview'); //代理结算审核-修改审核
    Route::post('/action/admin/agentSettle/editConfig', 'Back\AgentSettleController@editConfig'); //代理结算配置-修改配置

    Route::post('/action/admin/activity/addActivity', 'Back\ActivityController@addActivity'); //活动列表-新增活动
    Route::post('/action/admin/activity/editActivity', 'Back\ActivityController@editActivity'); //活动列表-修改活动
    Route::post('/action/admin/activity/onOffActivity', 'Back\ActivityController@onOffActivity'); //活动列表-开启关闭
    Route::post('/action/admin/activity/addCondition', 'Back\ActivityController@addCondition'); //活动条件-新增条件
    Route::post('/action/admin/activity/editCondition', 'Back\ActivityController@editCondition'); //活动条件-修改条件
    Route::post('/action/admin/activity/delCondition', 'Back\ActivityController@delCondition'); //活动条件-删除条件
    Route::post('/action/admin/activity/addPrize', 'Back\ActivityController@addPrize'); //奖品配置-新增奖品
    Route::post('/action/admin/activity/editPrize', 'Back\ActivityController@editPrize'); //奖品配置-修改奖品
    Route::post('/action/admin/activity/delPrize', 'Back\ActivityController@delPrize'); //奖品配置-删除奖品
    Route::post('/action/admin/activity/reviewAward', 'Back\ActivityController@reviewAward'); //派奖审核-审核奖品
    Route::post('/action/admin/activity/dailyStatistics', 'Back\ActivityController@dailyStatistics'); //活动数据统计-每日统计
    Route::post('/action/admin/activity/dataStatistics', 'Back\ActivityController@dataStatistics'); //每日数据统计-每日统计

    Route::post('/action/admin/promotion/settlement','Back\PromotionController@settlement'); //推广结算报表-手动结算
    Route::post('/action/admin/promotion/editReport','Back\PromotionController@editReport'); //推广结算报表-修改结算
    Route::post('/action/admin/promotion/commitReport','Back\PromotionController@commitReport'); //推广结算报表-提交审核
    Route::post('/action/admin/promotion/submitTurnDown','Back\PromotionController@submitTurnDown'); //推广结算审核-提交驳回
    Route::post('/action/admin/promotion/addConfig','Back\PromotionController@addConfig'); //推广配置-新增配置
    Route::post('/action/admin/promotion/editConfig','Back\PromotionController@editConfig'); //推广配置-修改配置
    Route::post('/action/admin/addNotice', 'Back\SrcNoticeController@addNotice'); //添加公告
    Route::post('/action/admin/editNotice', 'Back\SrcNoticeController@editNotice'); //修改公告
    Route::post('/action/admin/delNoticeSetting', 'Back\SrcNoticeController@delNoticeSetting'); //删除公告
    Route::post('/action/admin/setNoticeOrder', 'Back\SrcNoticeController@setNoticeOrder'); //设置公告顺序
    Route::post('/action/admin/addSendMessage', 'Back\SrcNoticeController@addSendMessage'); //添加消息
    Route::post('/action/admin/delSendMessage', 'Back\SrcNoticeController@delSendMessage'); //删除消息

    Route::post('/action/admin/report/addStatistics', 'Back\SrcReportController@addStatistics')->middleware('check-permission')->name('report.addStatistics'); //添加操作报表

    Route::post('/action/admin/addBank', 'Back\SrcPayController@addBank');//添加银行
    Route::post('/action/admin/addLevel', 'Back\SrcPayController@addLevel');//添加层级
    Route::post('/action/admin/editLevel', 'Back\SrcPayController@editLevel');//修改层级
    Route::post('/action/admin/delLevelCheck', 'Back\SrcPayController@delLevelCheck');//删除层级检查
    Route::post('/action/admin/delLevel', 'Back\SrcPayController@delLevel');//删除层级
    Route::post('/action/admin/allExchangeLevel', 'Back\SrcPayController@allExchangeLevel');//层级全部转移
    Route::post('/action/admin/sectionExchangeLevel','Back\SrcPayController@sectionExchangeLevel');//部分全部转移
    Route::post('/action/admin/sectionDisplayLevel','Back\SrcPayController@sectionDisplayLevel');//部分转移显示
    Route::post('/action/admin/addRechargeWay', 'Back\SrcPayController@addRechargeWay');//添加充值方式
    Route::post('/action/admin/editRechargeWay', 'Back\SrcPayController@editRechargeWay');//添加充值方式
    Route::post('/action/admin/editRechType', 'Back\SrcPayController@editRechType');//修改前端显示
    Route::post('/action/admin/changeOnlinePayStatus', 'Back\SrcPayController@changeOnlinePayStatus');//改变充值方式状态
    Route::post('/action/admin/delOnlinePay', 'Back\SrcPayController@delOnlinePay');//删除充值方式
    Route::post('/action/admin/delRechargeWay', 'Back\SrcPayController@delRechargeWay');//删除充值方式
    Route::post('/action/admin/addPayOnline', 'Back\SrcPayController@addPayOnline');//添加在线支付配置
    Route::post('/action/admin/editPayOnline', 'Back\SrcPayController@editPayOnline');//修改在线支付配置
    Route::post('/action/admin/addPayBank', 'Back\SrcPayController@addPayBank');//添加银行支付配置
    Route::post('/action/admin/editPayBank', 'Back\SrcPayController@editPayBank');//修改银行支付配置
    Route::post('/action/admin/addPayAlipay', 'Back\SrcPayController@addPayAlipay');//添加支付宝配置
    Route::post('/action/admin/editPayAlipay', 'Back\SrcPayController@editPayAlipay');//修改支付宝配置
    Route::post('/action/admin/addPayWechat', 'Back\SrcPayController@addPayWechat');//添加微信配置
    Route::post('/action/admin/editPayWechat', 'Back\SrcPayController@editPayWechat');//修改微信配置
    Route::post('/action/admin/addPayCft', 'Back\SrcPayController@addPayCft');//添加财付通配置
    Route::post('/action/admin/editPayCft', 'Back\SrcPayController@editPayCft');//修改财付通配置
    Route::post('/action/admin/setSort', 'Back\SrcPayController@setSort');//设置排序
    Route::post('/action/admin/rechType/setSort', 'Back\SrcPayController@rechTypeSetSort');//设置排序
    Route::post('/action/admin/rechWay/setSort', 'Back\SrcPayController@rechWaySetSort');//充值方式配置排序

    //充值配置新

    Route::post('/action/admin/new/copyPayOnline', 'Back\SrcPayNewController@copyPayOnline');//复制在线支付配置
    Route::post('/action/admin/new/addPayOnline', 'Back\SrcPayNewController@addPayOnline');//添加在线支付配置
    Route::post('/action/admin/new/editPayOnline', 'Back\SrcPayNewController@editPayOnline');//修改在线支付配置
    Route::post('/action/admin/new/changeOnlinePayStatus', 'Back\SrcPayNewController@changeOnlinePayStatus');//改变充值方式状态新
    Route::post('/action/admin/new/delOnlinePay', 'Back\SrcPayNewController@delOnlinePay');//删除充值方式新
    Route::post('/action/admin/new/setSort', 'Back\SrcPayNewController@setSort');//设置排序新
    Route::post('/action/admin/new/addPayBank', 'Back\SrcPayNewController@addPayBank');//添加银行支付配置
    Route::post('/action/admin/new/editPayBank', 'Back\SrcPayNewController@editPayBank');//修改银行支付配置
    Route::post('/action/admin/new/addPayAlipay', 'Back\SrcPayNewController@addPayAlipay');//添加支付宝配置
    Route::post('/action/admin/new/editPayAlipay', 'Back\SrcPayNewController@editPayAlipay');//修改支付宝配置
    Route::post('/action/admin/new/addPayWechat', 'Back\SrcPayNewController@addPayWechat');//添加微信配置
    Route::post('/action/admin/new/editPayWechat', 'Back\SrcPayNewController@editPayWechat');//修改微信配置
    Route::post('/action/admin/new/addPayCft', 'Back\SrcPayNewController@addPayCft');//添加财付通配置
    Route::post('/action/admin/new/editPayCft', 'Back\SrcPayNewController@editPayCft');//修改财付通配置

    Route::post('/action/admin/editGameSetting', 'Back\SrcGameController@editGameSetting');//修改游戏设定
    Route::post('/action/admin/changeGameFengPan', 'Back\SrcGameController@changeGameFengPan');//修改游戏开封盘状态
    Route::post('/action/admin/changeGameStatus', 'Back\SrcGameController@changeGameStatus');//修改游戏开启和停用状态
    Route::post('/action/admin/saveOddsRebate', 'Back\SrcGameController@saveOddsRebate');//修改游戏开启和停用状态
    Route::post('/action/admin/killStatus', 'Back\SrcGameController@killStatus')->middleware('check-permission')->name('game.killStatus'); //杀率开关
    Route::post('/action/admin/editKillSetting', 'Back\SrcGameController@editKillSetting')->middleware('check-permission')->name('game.editKillSetting'); //修改杀率保留营利比

    Route::post('/action/admin/passRecharge', 'Back\RechargeController@passRecharge'); //通过充值申请
    Route::post('/action/admin/passOnlineRecharge', 'Back\RechargeController@passOnlineRecharge'); //通过在线充值申请
    Route::post('/action/admin/addRechargeError', 'Back\RechargeController@addRechargeError'); //驳回充值申请

    Route::post('/action/admin/passDrawing', 'Back\DrawingController@passDrawing'); //通过提款申请
    Route::post('/action/admin/passDrawingAuto', 'Back\DrawingController@passDrawingAuto'); //自动提款后的提款申请
    Route::post('/action/admin/addDrawingError', 'Back\DrawingController@addDrawingError'); //驳回提款申请
    Route::post('/action/admin/addDrawingErrorAuto', 'Back\DrawingController@addDrawingErrorAuto'); //自动驳回提款申请
    Route::post('/action/admin/dispensingDrawing', 'Back\DrawingController@dispensingDrawing'); //自动出款

    Route::post('/action/recharge/totalRecharge', 'Back\RechargeController@totalRecharge'); //充值记录的总额统计
    Route::post('/action/drawing/totalDrawing', 'Back\DrawingController@totalDrawing'); //提款记录的总额统计

    Route::post('/action/betTodat/total','Back\Data\BetDataController@betNumTotal');

    Route::post('/action/userBetList/total', 'Back\SrcViewController@userBetListTotal'); //用户注单页面下注统计

    Route::post('/action/admin/addLhcNewIssue', 'Back\OpenHistoryController@addLhcNewIssue');
    Route::post('/action/admin/addXylhcNewIssue', 'Back\OpenHistoryController@addXylhcNewIssue');
    Route::post('/action/admin/editLhcNewIssue', 'Back\OpenHistoryController@editLhcNewIssue');
    Route::post('/action/admin/editXylhcNewIssue', 'Back\OpenHistoryController@editXylhcNewIssue');

    Route::post('/action/admin/openCqssc', 'Back\OpenHistoryController@addCqsscData');     //添加重庆时时彩开奖数据
    Route::post('/action/admin/openMsssc', 'Back\OpenHistoryController@addMssscData');     //添加秒速时时彩开奖数据
    Route::post('/action/admin/openBjpk10', 'Back\OpenHistoryController@addBjpk10Data');     //添加北京PK10开奖数据
    Route::post('/action/admin/openBjkl8', 'Back\OpenHistoryController@addBjkl8Data');     //添加北京快乐8开奖数据
    Route::post('/action/admin/openMssc', 'Back\OpenHistoryController@addMsscData');     //添加秒速赛车开奖数据
    Route::post('/action/admin/openMsft', 'Back\OpenHistoryController@addMsftData');     //添加秒速飞艇开奖数据
    Route::post('/action/admin/openPaoma', 'Back\OpenHistoryController@addPaomaData');     //添加跑马开奖数据
    Route::post('/action/admin/openK3', 'Back\OpenHistoryController@addK3Data');     //添加快三开奖数据
    Route::post('/action/admin/openLhc', 'Back\OpenHistoryController@addLhcData');
    Route::post('/action/admin/openXylhc', 'Back\OpenHistoryController@addXylhcData');
    Route::post('/action/admin/reOpenLhc', 'Back\OpenHistoryController@reOpenLhcData');
    Route::post('/action/admin/reOpenXylhc', 'Back\OpenHistoryController@reOpenXylhcData');

    Route::post('/action/admin/cancelBetting/{issue}/{type}', 'Back\OpenHistoryController@cancelBetting'); // 撤单
    Route::post('/action/admin/bet/cancel/{orderId}', 'Back\OpenHistoryController@cancelBetOrder'); // 取消注单

    Route::any('/action/admin/member/returnVisit','Back\MemberController@returnVisit')->middleware('check-permission')->name('member.returnVisit'); //会员-回访用户
    Route::any('/action/admin/member/exportUser','Back\MemberController@exportUser')->middleware('check-permission')->name('member.exportUser'); //会员-导出用户数据
    Route::any('/action/admin/member/exportMember/{id}/{name}', 'Back\MemberController@exportMember')->middleware('check-permission')->name('member.exportMember');;//代理-导出会员
    Route::any('/action/admin/member/exportMemberSuper/{id}/{name}', 'Back\MemberController@exportMemberSuper')->middleware('check-permission')->name('member.exportMemberSuper');;//总代代理-导出会员
    Route::any('/action/admin/member/visitMember/{id}/{name}', 'Back\MemberController@visitMember')->middleware('check-permission')->name('member.visitMember');;//代理-导出会员
    Route::any('/action/admin/member/visitMemberSuper/{id}/{name}', 'Back\MemberController@visitMemberSuper')->middleware('check-permission')->name('member.visitMemberSuper');;//总代代理-导出会员

    Route::get('/action/admin/exportExcel/userRecharges','Back\ExportExcelController@exportExcelForRecharges'); //导出充值数据为Excel文件
    Route::get('/action/admin/exportExcel/userDrawing','Back\ExportExcelController@exportExcelForDrawing'); //导出充值数据为Excel文件

//Modal
    Route::get('/back/modal/addPermission', 'Back\Ajax\ModalController@addPermission'); //添加权限
    Route::get('/back/modal/editPermission/{id}', 'Back\Ajax\ModalController@editPermission'); //修改权限
    Route::get('/back/modal/addPermissionAuth', 'Back\Ajax\ModalController@addPermissionAuth'); //添加权限控制
    Route::get('/back/modal/editPermissionAuth/{id}', 'Back\Ajax\ModalController@editPermissionAuth'); //修改权限控制
    Route::get('/back/modal/addRole', 'Back\Ajax\ModalController@addRole'); //添加角色
    Route::get('/back/modal/editRole/{id}', 'Back\Ajax\ModalController@editRole'); //修改角色
    Route::get('/back/modal/addWhitelist', 'Back\Ajax\ModalController@addWhitelist'); //添加ip白名单
    Route::get('/back/modal/editWhitelist/{id}', 'Back\Ajax\ModalController@editWhitelist'); //修改ip白名单
    Route::get('/back/modal/viewFeedback/{id}', 'Back\Ajax\ModalController@viewFeedback'); //查看意见反馈
    Route::get('/back/modal/addSubAccount', 'Back\Ajax\ModalController@addSubAccount')->middleware('check-permission')->name('m.subAccount.add');
    Route::get('/back/modal/editSubAccount/{id}', 'Back\Ajax\ModalController@editSubAccount')->middleware('check-permission')->name('m.subAccount.edit');
    Route::get('/back/modal/googleSubAccount/{id}', 'Back\Ajax\ModalController@googleSubAccount')->middleware('check-permission')->name('m.subAccount.googleOTP');
    Route::get('/back/modal/addGeneralAgent', 'Back\Ajax\ModalController@addGeneralAgent')->middleware('check-permission')->name('m.gAgent.add');
    Route::get('/back/modal/editGeneralAgent/{id}', 'Back\Ajax\ModalController@editGeneralAgent')->middleware('check-permission')->name('m.gAgent.edit');
    Route::get('/back/modal/addAgent', 'Back\Ajax\ModalController@addAgent')->middleware('check-permission')->name('m.agent.add');
    Route::get('/back/modal/editAgent/{id}', 'Back\Ajax\ModalController@editAgent')->middleware('check-permission')->name('m.agent.edit');
    Route::get('/back/modal/agentInfo/{id}', 'Back\Ajax\ModalController@agentInfo')->middleware('check-permission')->name('m.agent.viewDetails');
    Route::get('/back/modal/agentContent/{id}', 'Back\Ajax\ModalController@agentContent')->middleware('check-permission')->name('m.agent.viewDetails');
    Route::get('/back/modal/changeAgentMoney/{id}', 'Back\Ajax\ModalController@changeAgentMoney')->middleware('check-permission')->name('m.agent.editMoney');
    Route::get('/back/modal/agentCapitalHistory/{id}', 'Back\Ajax\ModalController@agentCapitalHistory')->middleware('check-permission')->name('m.agent.capitalDetails');
    Route::get('/back/modal/addBank', 'Back\Ajax\ModalController@addBank');
    Route::get('/back/modal/addUser', 'Back\Ajax\ModalController@addUser')->middleware('check-permission')->name('m.user.add');
    Route::get('/back/modal/userChangeAgent/{id}', 'Back\Ajax\ModalController@userChangeAgent')->middleware('check-permission')->name('m.user.changeAgent');
    Route::get('/back/modal/userChangeFullName/{id}', 'Back\Ajax\ModalController@userChangeFullName')->middleware('check-permission')->name('m.user.editTrueName');
    Route::get('/back/modal/viewUserInfo/{id}', 'Back\Ajax\ModalController@viewUserInfo')->middleware('check-permission')->name('m.user.viewDetails');
    Route::get('/back/modal/editUserInfo/{id}', 'Back\Ajax\ModalController@editUserInfo')->middleware('check-permission')->name('m.user.edit');         //修改会员资料
    Route::get('/back/modal/viewUserContent/{id}', 'Back\Ajax\ModalController@viewUserContent')->middleware('check-permission')->name('m.user.viewDetails');
    Route::get('/back/modal/changeUserMoney/{id}', 'Back\Ajax\ModalController@changeUserMoney')->middleware('check-permission')->name('m.user.changeBalance');      //修改会员馀额
    Route::get('/back/modal/userCapitalHistory/{id}', 'Back\Ajax\ModalController@userCapitalHistory')->middleware('check-permission')->name('m.user.viewDetails');
    Route::get('/back/modal/addNotice', 'Back\Ajax\ModalController@addNotice');     //公告管理-添加公告
    Route::get('/back/modal/editNotice/{id}', 'Back\Ajax\ModalController@editNotice');     //公告管理-修改公告
    Route::get('/back/modal/addSendMessage', 'Back\Ajax\ModalController@addSendMessage');
    Route::get('/back/modal/addLevel', 'Back\Ajax\ModalController@addLevel');
    Route::get('/back/modal/editLevel/{id}', 'Back\Ajax\ModalController@editLevel');
    Route::get('/back/modal/allExchangeLevel/{id}', 'Back\Ajax\ModalController@allExchangeLevel');
    Route::get('/back/modal/addRechargeWay', 'Back\Ajax\ModalController@addRechargeWay');
    Route::get('/back/modal/rechargeConditionalTransfer/{id}','Back\Ajax\ModalController@rechargeConditionalTransfer'); //条件转移-模板
    Route::get('/back/modal/editRechType/{id}', 'Back\Ajax\ModalController@editRechType');  // 支付前端修改-模板
    Route::get('/back/modal/editRechargeWay/{id}', 'Back\Ajax\ModalController@editRechargeWay');
    Route::get('/back/modal/addPayOnline', 'Back\Ajax\ModalController@addPayOnline');
    Route::get('/back/modal/editPayOnline/{id}', 'Back\Ajax\ModalController@editPayOnline');
    Route::get('/back/modal/addPayBank', 'Back\Ajax\ModalController@addPayBank');
    Route::get('/back/modal/editPayBank/{id}', 'Back\Ajax\ModalController@editPayBank');
    Route::get('/back/modal/addPayAlipay', 'Back\Ajax\ModalController@addPayAlipay');
    Route::get('/back/modal/editPayAlipay/{id}', 'Back\Ajax\ModalController@editPayAlipay');
    Route::get('/back/modal/addPayWechat', 'Back\Ajax\ModalController@addPayWechat');
    Route::get('/back/modal/editPayWechat/{id}', 'Back\Ajax\ModalController@editPayWechat');
    Route::get('/back/modal/addPayCft', 'Back\Ajax\ModalController@addPayCft');
    Route::get('/back/modal/editPayCft/{id}', 'Back\Ajax\ModalController@editPayCft');
    Route::get('/back/modal/addArticle', 'Back\Ajax\ModalController@addArticle');
    Route::get('/back/modal/editArticle/{id}', 'Back\Ajax\ModalController@editArticle');
    Route::get('/back/modal/editUserLevels/{uid}/{nowLevels}', 'Back\Ajax\ModalController@editUserLevels');
    Route::get('/back/modal/editRechUserLevels/{uid}/{nowLevels}/{rid}', 'Back\Ajax\ModalController@editRechUserLevels');
    Route::get('/back/modal/editDrawingLevels/{uid}/{nowLevels}/{rid}', 'Back\Ajax\ModalController@editDrawingLevels');
    Route::get('/back/modal/rechargeError/{id}', 'Back\Ajax\ModalController@rechargeError');
    Route::get('/back/modal/drawingError/{id}', 'Back\Ajax\ModalController@drawingError');
    Route::get('/back/modal/drawingErrorAuto/{id}', 'Back\Ajax\ModalController@drawingErrorAuto'); //自动提款后的驳回
    Route::get('/back/modal/addPayOnlineNew', 'Back\Ajax\ModalController@addPayOnlineNew'); //充值配置新-在线支付-添加
    Route::get('/back/modal/copyPayOnlineNew/{id}', 'Back\Ajax\ModalController@copyPayOnlineNew'); //充值配置新-在线支付-复制
    Route::get('/back/modal/editPayOnlineNew/{id}', 'Back\Ajax\ModalController@editPayOnlineNew'); //充值配置新-在线支付-修改
    Route::get('/back/modal/addPayBankNew', 'Back\Ajax\ModalController@addPayBankNew');  //充值配置新-银行支付-添加
    Route::get('/back/modal/editPayBankNew/{id}', 'Back\Ajax\ModalController@editPayBankNew'); //充值配置新-银行支付-修改
    Route::get('/back/modal/addPayAlipayNew', 'Back\Ajax\ModalController@addPayAlipayNew');  //充值配置新-支付宝-添加
    Route::get('/back/modal/editPayAlipayNew/{id}', 'Back\Ajax\ModalController@editPayAlipayNew');  //充值配置新-支付宝-修改
    Route::get('/back/modal/addPayWechatNew', 'Back\Ajax\ModalController@addPayWechatNew');  //充值配置新-微信-添加
    Route::get('/back/modal/editPayWechatNew/{id}', 'Back\Ajax\ModalController@editPayWechatNew');  //充值配置新-微信-修改
    Route::get('/back/modal/addPayCftNew', 'Back\Ajax\ModalController@addPayCftNew');  //充值配置新-财付通-添加
    Route::get('/back/modal/editPayCftNew/{id}', 'Back\Ajax\ModalController@editPayCftNew');  //充值配置新-财付通-修改
    Route::get('/back/modal/user48hoursInfo/{uid}', 'Back\Ajax\ModalController@user48hoursInfo');
    Route::get('/back/modal/addLhcNewIssue', 'Back\Ajax\ModalController@addLhcNewIssue');
    Route::get('/back/modal/addXylhcNewIssue', 'Back\Ajax\ModalController@addXylhcNewIssue');
    Route::get('/back/modal/editLhcNewIssue/{id}', 'Back\Ajax\ModalController@editLhcNewIssue');
    Route::get('/back/modal/editXylhcNewIssue/{id}', 'Back\Ajax\ModalController@editXylhcNewIssue');
    Route::get('/back/modal/openCqssc/{id}', 'Back\Ajax\ModalController@openCqssc');             //重庆时时彩 - 手动开奖
    Route::get('/back/modal/openMsssc/{id}', 'Back\Ajax\ModalController@openMsssc');             //秒速时时彩 - 手动开奖
    Route::get('/back/modal/openBjpk10/{id}', 'Back\Ajax\ModalController@openBjpk10');           //北京PK10 - 手动开奖
    Route::get('/back/modal/openBjkl8/{id}', 'Back\Ajax\ModalController@openBjkl8');             //北京快乐8 - 手动开奖
    Route::get('/back/modal/openMssc/{id}', 'Back\Ajax\ModalController@openMssc');             //秒速赛车 - 手动开奖
    Route::get('/back/modal/openMsft/{id}', 'Back\Ajax\ModalController@openMsft');             //秒速飞艇 - 手动开奖
    Route::get('/back/modal/openPaoma/{id}', 'Back\Ajax\ModalController@openPaoma');             //跑马 - 手动开奖
    Route::get('/back/modal/openMsjsk3/{id}', 'Back\Ajax\ModalController@openMsjsk3');             //秒速快三 - 手动开奖
    Route::get('/back/modal/openJsk3/{id}', 'Back\Ajax\ModalController@openJsk3');             //江苏快三 - 手动开奖
    Route::get('/back/modal/openAhk3/{id}', 'Back\Ajax\ModalController@openAhk3');             //安徽快三 - 手动开奖
    Route::get('/back/modal/openJlk3/{id}', 'Back\Ajax\ModalController@openJlk3');             //吉林快三 - 手动开奖
    Route::get('/back/modal/openHbk3/{id}', 'Back\Ajax\ModalController@openHbk3');             //湖北快三 - 手动开奖
    Route::get('/back/modal/openGxk3/{id}', 'Back\Ajax\ModalController@openGxk3');             //广西快三 - 手动开奖
    Route::get('/back/modal/openLhc/{id}', 'Back\Ajax\ModalController@openLhc');
    Route::get('/back/modal/openXylhc/{id}', 'Back\Ajax\ModalController@openXylhc');
    Route::get('/back/modal/reOpenLhc/{id}', 'Back\Ajax\ModalController@reOpenLhc');
    Route::get('/back/modal/reOpenXylhc/{id}', 'Back\Ajax\ModalController@reOpenXylhc');
    Route::get('/back/modal/editAgentSettleReport/{id}', 'Back\Ajax\ModalController@editAgentSettleReport'); //修改代理结算报表-模板
    Route::get('/back/modal/editAgentSettleReview/{id}', 'Back\Ajax\ModalController@editAgentSettleReview'); //修改代理结算审核-模板
    Route::get('/back/modal/addActivityList', 'Back\Ajax\ModalController@addActivityList'); //增加活动-模板
    Route::get('/back/modal/editActivityList/{id}', 'Back\Ajax\ModalController@editActivityList'); //修改活动-模板
    Route::get('/back/modal/addActivityCondition', 'Back\Ajax\ModalController@addActivityCondition'); //增加活动条件-模板
    Route::get('/back/modal/editActivityCondition/{id}', 'Back\Ajax\ModalController@editActivityCondition'); //修改活动条件-模板
    Route::get('/back/modal/addActivityPrize', 'Back\Ajax\ModalController@addActivityPrize'); //增加奖品配置-模板
    Route::get('/back/modal/editActivityPrize/{id}', 'Back\Ajax\ModalController@editActivityPrize'); //修改奖品配置-模板
    Route::get('/back/modal/editPromotionReport/{id}','Back\Ajax\ModalController@editPromotionReport'); //修改推广就算报表-模板
    Route::get('/back/modal/addPromotionConfig','Back\Ajax\ModalController@addPromotionConfig'); //增加推广配置-模板
    Route::get('/back/modal/editPromotionConfig/{id}','Back\Ajax\ModalController@editPromotionConfig'); //修改推广配置-模板
    Route::get('/back/modal/returnVisit','Back\Ajax\ModalController@returnVisit')->middleware('check-permission')->name('member.returnVisit.view'); //会员回访用户-模板
    Route::get('/back/modal/exportUser','Back\Ajax\ModalController@exportUser')->middleware('check-permission')->name('member.exportUser.view'); //导出用户数据-模板
    Route::get('/back/modal/addStatistics','Back\Ajax\ModalController@addStatistics')->middleware('check-permission')->name('report.addStatistics.view'); //操作报表添加-模板

//游戏MODAL
    Route::get('/back/modal/gameSetting/{id}', 'Back\Ajax\ModalController@gameSetting');
    Route::get('/back/modal/killSetting/{id}', 'Back\Ajax\ModalController@killSetting');     //杀率设置

    Route::get('/web/api/select2/agents', 'Back\Api\ApiController@agents');
    Route::post('/web/api/check/user/username', 'Back\Api\ApiController@checkUserUsername');

    Route::get('/game/tables/50', 'Back\GameTableController@gameTable50');
    Route::get('/game/tables/1', 'Back\GameTableController@gameTable1');
    Route::get('/game/tables/4', 'Back\GameTableController@gameTable4');
    Route::get('/game/tables/5', 'Back\GameTableController@gameTable5');
    Route::get('/game/tables/60', 'Back\GameTableController@gameTable60');
    Route::get('/game/tables/10', 'Back\GameTableController@gameTable10');
    Route::get('/game/tables/61', 'Back\GameTableController@gameTable61');
    Route::get('/game/tables/65', 'Back\GameTableController@gameTable65');
    Route::get('/game/tables/21', 'Back\GameTableController@gameTable21'); //广东十一选五
    Route::get('/game/tables/66', 'Back\GameTableController@gameTable66'); //PC蛋蛋
    Route::get('/game/tables/30', 'Back\GameTableController@gameTable30'); //福彩3D
    Route::get('/game/tables/80', 'Back\GameTableController@gameTable80'); //秒速赛车
    Route::get('/game/tables/82', 'Back\GameTableController@gameTable82'); //秒速飞艇
    Route::get('/game/tables/81', 'Back\GameTableController@gameTable81'); //秒速时时彩
    Route::get('/game/tables/99', 'Back\GameTableController@gameTable99'); //跑马
    Route::get('/game/tables/70', 'Back\GameTableController@gameTable70'); //六合彩
    Route::get('/game/tables/85', 'Back\GameTableController@gameTable85'); //幸运六合彩
    Route::get('/game/tables/11', 'Back\GameTableController@gameTable11'); //北京快三
    Route::get('/game/tables/12', 'Back\GameTableController@gameTable12'); //广西快三
    Route::get('/game/tables/13', 'Back\GameTableController@gameTable13'); //湖北快三
    Route::get('/game/tables/86', 'Back\GameTableController@gameTable86'); //秒速江苏快三

    //交易设定表格
    Route::get('/game/trade/tables/50','Back\GameTradeTableController@gameTradeTable50'); //北京赛车
    Route::get('/game/trade/tables/1','Back\GameTradeTableController@gameTradeTable1'); //重庆时时彩
    Route::get('/game/trade/tables/4','Back\GameTradeTableController@gameTradeTable4'); //新疆时时彩
    Route::get('/game/trade/tables/5','Back\GameTradeTableController@gameTradeTable5'); //天津时时彩
    Route::get('/game/trade/tables/60','Back\GameTradeTableController@gameTradeTable60'); //广东快乐十分
    Route::get('/game/trade/tables/10','Back\GameTradeTableController@gameTradeTable10'); //江苏快3
    Route::get('/game/trade/tables/11','Back\GameTradeTableController@gameTradeTable11'); //安徽快3
    Route::get('/game/trade/tables/12','Back\GameTradeTableController@gameTradeTable12'); //广西快3
    Route::get('/game/trade/tables/13','Back\GameTradeTableController@gameTradeTable13'); //湖北快3
    Route::get('/game/trade/tables/61','Back\GameTradeTableController@gameTradeTable61'); //重庆幸运农场
    Route::get('/game/trade/tables/65','Back\GameTradeTableController@gameTradeTable65'); //北京快乐8
    Route::get('/game/trade/tables/21','Back\GameTradeTableController@gameTradeTable21'); //广东十一选五
    Route::get('/game/trade/tables/66','Back\GameTradeTableController@gameTradeTable66'); //PC蛋蛋
    Route::get('/game/trade/tables/80','Back\GameTradeTableController@gameTradeTable80'); //秒速赛车
    Route::get('/game/trade/tables/82','Back\GameTradeTableController@gameTradeTable82'); //秒速飞艇
    Route::get('/game/trade/tables/81','Back\GameTradeTableController@gameTradeTable81'); //秒速时时彩
    Route::get('/game/trade/tables/99','Back\GameTradeTableController@gameTradeTable99'); //跑马
    Route::get('/game/trade/tables/86','Back\GameTradeTableController@gameTradeTable86'); //秒速快3
    Route::get('/game/trade/tables/83','Back\GameTradeTableController@gameTradeTable83'); //幸运快乐8
    Route::get('/game/trade/tables/84','Back\GameTradeTableController@gameTradeTable84'); //幸运蛋蛋
    Route::get('/game/trade/tables/85','Back\GameTradeTableController@gameTradeTable85'); //幸运六合彩
    Route::get('/game/trade/tables/30','Back\GameTradeTableController@gameTradeTable30'); //福彩3d
    Route::get('/game/trade/tables/70','Back\GameTradeTableController@gameTradeTable70'); //六合彩

    //保存游戏赔率表格数据
    Route::post('/game/table/save/bjpk10', 'Back\GameTables\SaveGameOddsController@bjpk10');
    Route::post('/game/table/save/cqssc', 'Back\GameTables\SaveGameOddsController@cqssc');
    Route::post('/game/table/save/xjssc', 'Back\GameTables\SaveGameOddsController@xjssc');
    Route::post('/game/table/save/tjssc', 'Back\GameTables\SaveGameOddsController@tjssc');
    Route::post('/game/table/save/gdklsf', 'Back\GameTables\SaveGameOddsController@gdklsf');
    Route::post('/game/table/save/jsk3', 'Back\GameTables\SaveGameOddsController@jsk3');
    Route::post('/game/table/save/ahk3', 'Back\GameTables\SaveGameOddsController@ahk3');
    Route::post('/game/table/save/gxk3', 'Back\GameTables\SaveGameOddsController@gxk3');
    Route::post('/game/table/save/hbk3', 'Back\GameTables\SaveGameOddsController@hbk3');
    Route::post('/game/table/save/cqxync', 'Back\GameTables\SaveGameOddsController@cqxync');
    Route::post('/game/table/save/bjkl8', 'Back\GameTables\SaveGameOddsController@bjkl8');
    Route::post('/game/table/save/fc3d', 'Back\GameTables\SaveGameOddsController@fc3d');
    Route::post('/game/table/save/gd11x5', 'Back\GameTables\SaveGameOddsController@gd11x5');
    Route::post('/game/table/save/pcdd', 'Back\GameTables\SaveGameOddsController@pcdd');
    Route::post('/game/table/save/mssc', 'Back\GameTables\SaveGameOddsController@mssc');
    Route::post('/game/table/save/msft', 'Back\GameTables\SaveGameOddsController@msft');
    Route::post('/game/table/save/msssc', 'Back\GameTables\SaveGameOddsController@msssc');
    Route::post('/game/table/save/paoma', 'Back\GameTables\SaveGameOddsController@paoma');
    Route::post('/game/table/save/lhc', 'Back\GameTables\SaveGameOddsController@lhc');
    Route::post('/game/table/save/xylhc', 'Back\GameTables\SaveGameOddsController@xylhc');
    Route::post('/game/table/save/msjsk3', 'Back\GameTables\SaveGameOddsController@msjsk3');
    //保存交易设定的表格
    Route::post('/game/trade/table/save/bjpk10','Back\GameTradeTables\SaveGameTradeController@bjpk10'); //保存北京PK10
    Route::post('/game/trade/table/save/cqssc','Back\GameTradeTables\SaveGameTradeController@cqssc'); //保存重庆时时彩
    Route::post('/game/trade/table/save/xjssc','Back\GameTradeTables\SaveGameTradeController@xjssc'); //保存新疆时时彩
    Route::post('/game/trade/table/save/tjssc','Back\GameTradeTables\SaveGameTradeController@tjssc'); //保存天津时时彩
    Route::post('/game/trade/table/save/gdklsf','Back\GameTradeTables\SaveGameTradeController@gdklsf'); //保存广东快乐十分
    Route::post('/game/trade/table/save/jsk3','Back\GameTradeTables\SaveGameTradeController@jsk3'); //保存江苏快3
    Route::post('/game/trade/table/save/ahk3','Back\GameTradeTables\SaveGameTradeController@ahk3'); //保存安徽快3
    Route::post('/game/trade/table/save/gxk3','Back\GameTradeTables\SaveGameTradeController@gxk3'); //保存广西快3
    Route::post('/game/trade/table/save/hbk3','Back\GameTradeTables\SaveGameTradeController@hbk3'); //保存湖北快3
    Route::post('/game/trade/table/save/cqxync','Back\GameTradeTables\SaveGameTradeController@cqxync'); //保存重庆幸运农场
    Route::post('/game/trade/table/save/bjkl8','Back\GameTradeTables\SaveGameTradeController@bjkl8'); //保存北京快乐8
    Route::post('/game/trade/table/save/gd11x5','Back\GameTradeTables\SaveGameTradeController@gd11x5'); //保存广东十一选五
    Route::post('/game/trade/table/save/pcdd','Back\GameTradeTables\SaveGameTradeController@pcdd'); //保存PC蛋蛋
    Route::post('/game/trade/table/save/mssc','Back\GameTradeTables\SaveGameTradeController@mssc'); //保存秒速赛车
    Route::post('/game/trade/table/save/msft','Back\GameTradeTables\SaveGameTradeController@msft'); //保存秒速飞艇
    Route::post('/game/trade/table/save/msssc','Back\GameTradeTables\SaveGameTradeController@msssc'); //保存秒速时时彩
    Route::post('/game/trade/table/save/paoma','Back\GameTradeTables\SaveGameTradeController@paoma'); //保存跑马
    Route::post('/game/trade/table/save/msk3','Back\GameTradeTables\SaveGameTradeController@msk3'); //保存秒速快3
    Route::post('/game/trade/table/save/xykl8','Back\GameTradeTables\SaveGameTradeController@xykl8'); //保存幸运快乐8
    Route::post('/game/trade/table/save/xydd','Back\GameTradeTables\SaveGameTradeController@xydd'); //保存幸运蛋蛋
    Route::post('/game/trade/table/save/xylhc','Back\GameTradeTables\SaveGameTradeController@xylhc'); //保存幸运六合彩
    Route::post('/game/trade/table/save/fc3d','Back\GameTradeTables\SaveGameTradeController@fc3d'); //保存福彩3d
    Route::post('/game/trade/table/save/lhc','Back\GameTradeTables\SaveGameTradeController@lhc'); //保存六合彩

//error
    Route::get('/error/403', function () {
        return view('403');
    })->name('error.403');

//代理VIEW部分
    Route::get('/agent', 'Agent\AgentAccountController@login');
    Route::get('/agent/dash', 'Agent\AgentViewController@dash');
    Route::get('/agent/member', 'Agent\AgentViewController@ajaxMember');
//代理Action部分
    Route::post('/agent/action/account/login', 'Agent\AgentAccountController@loginAction');

//内部调试
    Route::get('/inner/playCate', 'Inner\innerController@playCate');
    Route::get('inner/play', 'Inner\innerController@play');
//内部测试调试
    Route::post('/action/inner/playCate', 'Inner\innerActionController@playCate');
    Route::post('/action/inner/play', 'Inner\innerActionController@play');
    Route::post('/action/inner/getPlayCateItem', 'Inner\innerActionController@getPlayCateItem');
    Route::get('/tttt/test', 'Inner\TestController@lhc');

//后台状态轮询
    Route::get('/back/status', 'Back\AjaxStatusController@status');
//后台获取六合彩开奖--接口
    Route::get('/back/openData/lhc/{date}/{issue}', 'Back\OpenData\OpenApiGetController@lhc');
//后台获取北京PK10开奖--接口
    Route::get('/back/openData/bjpk10/{date}/{issue}', 'Back\OpenData\OpenApiGetController@bjpk10');
//注单明细获取开奖历史
    Route::get('/ajax/openHistory/{gameId}/{issue}', 'Back\SrcViewController@BetListOpenHistory');
//自动提款异步回调地址
    Route::post('/pay/withdrawal/callback', 'Back\CallbackController@withdrawal');
});
