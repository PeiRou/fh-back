<?php
Route::get('/test', 'GamesApi\Card\PrivodeController@test');
Route::group(['middleware'=>['check-ip']],function () {
    Route::get('/', 'Back\SrcViewController@index');

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

//第三方游戏管理
    Route::group(['prefix' => 'back/control/cardGameManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('up_down', 'Back\SrcViewController@upDownSearch')->name('cardGame.upDownSearch'); // 上下分记录查询
        Route::get('card_bet', 'Back\SrcViewController@cardBetInfo')->name('cardGame.cardBetInfo'); // 棋牌下注查询
        Route::get('errorBet', 'Back\SrcViewController@errorBet')->name('cardGame.errorBet'); // 第三方投注记录失败列表
    });

//财务管理
    Route::group(['prefix' => 'back/control/financeManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('rechargeRecord', 'Back\SrcViewController@rechargeRecord')->name('finance.rechargeRecord'); // 充值记录
        Route::get('drawingRecord', 'Back\SrcViewController@drawingRecord')->name('finance.drawingRecord'); // 提款记录
        Route::get('capitalDetails', 'Back\SrcViewController@capitalDetails')->name('finance.capitalDetails'); // 资金明细
        Route::get('freezeRecord', 'Back\SrcViewController@freezeRecord')->name('finance.freezeRecord'); // 用户冻结记录
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
        Route::get('browse', 'Back\SrcViewController@reportBrowse')->name('report.browse'); // 访问报表
        Route::get('register', 'Back\SrcViewController@reportRegister')->name('report.register'); // 注册报表
        Route::get('recharge', 'Back\SrcViewController@reportRecharge')->name('report.recharge'); // 充值报表
        Route::get('Card', 'Back\SrcViewController@reportCard')->name('report.Card'); // 棋牌投注报表
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
        Route::get('xjssc', 'Back\SrcViewController@openManage_xjssc')->name('historyLottery.xjssc'); //新疆时时彩
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
        Route::get('jlk3', 'Back\SrcViewController@openManage_jlk3')->name('historyLottery.jlk3'); //吉林快3
        Route::get('gxk3', 'Back\SrcViewController@openManage_gxk3')->name('historyLottery.gxk3'); //广西快3
        Route::get('hbek3', 'Back\SrcViewController@openManage_hebk3')->name('historyLottery.hebk3'); //河北快3
        Route::get('gzk3', 'Back\SrcViewController@openManage_gzk3')->name('historyLottery.gzk3'); //贵州快3
        Route::get('gsk3', 'Back\SrcViewController@openManage_gsk3')->name('historyLottery.gsk3'); //甘肃快3
        Route::get('lhc', 'Back\SrcViewController@openManage_xglhc')->name('historyLottery.xglhc'); //六合彩
        Route::get('xylhc', 'Back\SrcViewController@openManage_xylhc')->name('historyLottery.xylhc'); //幸运六合彩
        Route::get('qqffc', 'Back\SrcViewController@openManage_qqffc')->name('historyLottery.qqffc'); //qq分分彩
        Route::get('ksssc', 'Back\SrcViewController@openManage_ksssc')->name('historyLottery.ksssc'); //快速时时彩
        Route::get('ksft', 'Back\SrcViewController@openManage_ksft')->name('historyLottery.ksft'); //快速飞艇
        Route::get('kssc', 'Back\SrcViewController@openManage_kssc')->name('historyLottery.kssc'); //快速赛车
        Route::get('twxyft', 'Back\SrcViewController@openManage_twxyft')->name('historyLottery.twxyft'); //台湾幸运飞艇
        Route::get('sfsc', 'Back\SrcViewController@openManage_sfsc')->name('historyLottery.sfsc'); //三分赛车
        Route::get('sfssc', 'Back\SrcViewController@openManage_sfssc')->name('historyLottery.sfssc'); //三分时时彩
        Route::get('jslhc', 'Back\SrcViewController@openManage_jslhc')->name('historyLottery.jslhc'); //极速六合彩
        Route::get('sflhc', 'Back\SrcViewController@openManage_sflhc')->name('historyLottery.sflhc'); //三分六合彩
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
        Route::get('advertise', 'Back\SrcViewAdController@advertise')->name('system.advertise'); //广告位
        Route::get('advertiseInfo', 'Back\SrcViewAdController@advertiseInfo')->name('system.advertiseInfo'); //广告位
        Route::get('systemBlacklist', 'Back\SrcViewAdController@systemBlacklist')->name('system.Blacklist'); //黑名单管理

    });

//日志管理
    Route::group(['prefix' => 'back/control/logManage', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('login', 'Back\SrcViewController@loginLog')->name('log.login'); //登录日志
        Route::get('adminLogin', 'Back\SrcViewController@adminLoginLog')->name('log.adminLogin'); //登录日志
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
//平台接口设置
    Route::group(['prefix' => 'back/GamesApi', 'middleware' => ['check-permission', 'domain-check', 'add-log-handle']], function () {
        Route::get('List', 'Back\SrcViewController@GamesApiList')->name('GamesApi.List'); //平台接口列表
    });
    Route::group(['prefix' => 'back/GamesApi', 'middleware' => ['add-log-handle']], function () {
        Route::post('reGetBet/{id}', 'GamesApi\Card\PrivodeController@reGetBet'); // 重新获取第三方投注记录失败列表
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
        Route::get('agentSettleDomain', 'Back\SrcViewController@agentSettleDomain')->name('agentSettle.domain'); //代理专属域名
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
        Route::get('/usermoney/selectData/addmoneytype/{type?}','Back\Ajax\ModalController@userMoneyType')->name('select.userMoneyType'); // 下拉菜单获取加钱类型
    });

    Route::get('getLevel', 'Back\SrcViewController@getLevel'); // ajax 获取分层列表
    Route::get('batchDelSendMessage', 'Back\SrcViewController@batchDelSendMessage'); // 批量删除

    Route::get('/back/datatables/subaccount', 'Back\Data\MembersDataController@subAccounts');
    Route::get('/back/datatables/generalAgent', 'Back\Data\MembersDataController@generalAgent');
    Route::get('/back/datatables/agent', 'Back\Data\MembersDataController@agent');
    Route::get('/back/datatables/agentCapital/{id}', 'Back\Data\MembersDataController@agentCapital');
    Route::get('/back/datatables/agentBackwater/{id}', 'Back\Data\MembersDataController@agentBackwater');
    Route::get('/back/datatables/userCapital/{id}', 'Back\Data\MembersDataController@userCapital');
    Route::get('/back/datatables/user', 'Back\Data\MembersDataController@user');
    Route::get('/back/datatables/userTotal', 'Back\Data\MembersDataController@userTotal')->middleware('check-permission')->name('m.user.userTotal');//会员统计查看;
    Route::get('/back/datatables/premissions', 'Back\Data\SystemDataController@permissions'); //权限-表格数据
    Route::get('/back/datatables/premissionsAuth', 'Back\Data\SystemDataController@permissionsAuth'); //权限控制-表格数据
    Route::get('/back/datatables/roles', 'Back\Data\SystemDataController@roles'); //角色-表格数据
    Route::get('/back/datatables/whitelist', 'Back\Data\SystemDataController@whitelist'); //ip白名单设置-表格数据
    Route::get('/back/datatables/Blacklist', 'Back\Data\SystemDataController@Blacklist'); //黑名单管理-表格数据
    Route::get('/back/datatables/feedback', 'Back\Data\SystemDataController@feedback'); //建议反馈-表格数据
    Route::get('/back/datatables/advertise', 'Back\Data\AdDataController@advertise'); //广告位-表格数据
    Route::get('/back/datatables/advertiseInfo', 'Back\Data\AdDataController@advertiseInfo'); //广告位内容-表格数据
    Route::get('/back/datatables/bank', 'Back\Data\PayDataController@bank');
    Route::get('/back/datatables/games', 'Back\Data\GameDataController@games');
    Route::get('/back/datatables/agentOdds', 'Back\Data\GameDataController@agentOdds'); //代理赔率设定-表格数据
    Route::get('/back/datatables/gamekillsetting', 'Back\Data\GameDataController@gamekillsetting');
    Route::get('/back/datatables/onlineUser', 'Back\Data\MembersDataController@onlineUser');
    Route::get('/back/datatables/rechargeRecord', 'Back\Data\FinanceDataController@rechargeRecord');
    Route::get('/back/datatables/drawingRecord', 'Back\Data\FinanceDataController@drawingRecord');
    Route::get('/back/datatables/freezeRecord', 'Back\Data\FinanceDataController@freezeRecord');  //用户冻结记录-表格数据
    Route::get('/back/datatables/capitalDetails', 'Back\Data\FinanceDataController@capitalDetails'); //资金明细-表格数据
    Route::get('/back/datatables/memberReconciliation', 'Back\Data\FinanceDataController@memberReconciliation')->name('m.user.memberReconciliation');  //会员对账执行
    Route::get('/back/datatables/agentReconciliation', 'Back\Data\FinanceDataController@agentReconciliation');
    Route::get('/back/datatables/reportGagent', 'Back\Data\ReportDataController@Gagent');   //报表管理-总代
    Route::get('/back/datatables/reportAgent', 'Back\Data\ReportDataController@Agent');     //报表管理-代理
    Route::get('/back/datatables/reportUser', 'Back\Data\ReportDataController@User');       //报表管理-用户
    Route::get('/back/datatables/reportStatistics', 'Back\Data\ReportDataController@Statistics');       //报表管理-操作报表
    Route::get('/back/datatables/reportRegister', 'Back\Data\ReportDataController@Register');       //报表管理-注册报表
    Route::get('/back/datatables/reportRegisterTotal', 'Back\Data\ReportDataController@RegisterTotal');       //报表管理-注册报表总计
    Route::get('/back/datatables/reportRecharge', 'Back\Data\ReportDataController@Recharge');                   //报表管理-首充报表
    Route::get('/back/datatables/reportRechargeTotal', 'Back\Data\ReportDataController@RechargeTotal');         //报表管理-首充报表总计
    Route::any('/back/datatables/reportBrowse', 'Back\Data\ReportDataController@Browse');       //报表管理-访问报表
//    Route::get('/back/datatables/reportBrowseTotal', 'Back\Data\ReportDataController@BrowseTotal');       //报表管理-访问报表总计 功能未实现,预留
    Route::get('/back/datatables/reportBet', 'Back\Data\ReportDataController@Bet');
    Route::get('/back/datatables/reportCard', 'Back\Data\ReportDataController@Card');//棋牌投注报表
    Route::get('/back/datatables/getReportCard', 'Back\Data\ReportDataController@getCard');//重新获取棋牌投注报表
    Route::get('/back/datatables/reportGagentTotal', 'Back\Data\ReportDataController@GagentTotal'); //报表管理-总代总计
    Route::get('/back/datatables/reportAgentTotal', 'Back\Data\ReportDataController@AgentTotal');   //报表管理-代理总计
    Route::get('/back/datatables/reportUserTotal', 'Back\Data\ReportDataController@UserTotal');     //报表管理-用户总计
    Route::get('/back/datatables/betToday', 'Back\Data\BetDataController@betToday'); //今日注单搜索
    Route::get('/back/datatables/exportExcelToday', 'Back\Data\BetDataController@exportExcelBetToday'); //今日注单搜索

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
    Route::get('/back/datatables/payYsfNew', 'Back\Data\PayNewDataController@payYsf');  //充值配置新-云闪付
    Route::get('/back/datatables/payWechatNew', 'Back\Data\PayNewDataController@payWechat'); //充值配置新-微信
    Route::get('/back/datatables/payCftNew', 'Back\Data\PayNewDataController@payCft');  //充值配置新-财付通
    Route::get('/back/datatables/article', 'Back\Data\ArticleController@article');
    Route::get('/back/datatables/suggest', 'Back\Data\SuggestController@index');
    Route::get('/back/datatables/userBetSearch', 'Back\Data\BetDataController@userBetSearch');
    Route::get('/back/datatables/log/login', 'Back\Data\LogDataController@login'); //登录日志
    Route::get('/back/datatables/log/adminLogin', 'Back\Data\LogDataController@adminLogin'); //管理员登录日志
    Route::get('/back/datatables/logHandle', 'Back\Data\LogDataController@logHandle'); //操作日志
    Route::get('/back/datatables/logAbnormal', 'Back\Data\LogDataController@logAbnormal'); //异常日志

    Route::get('/back/datatables/openHistory/gdklsf', 'Back\Data\openHistoryController@gdklsf'); //历史开奖 - 广东快乐十分
    Route::get('/back/datatables/openHistory/cqxync', 'Back\Data\openHistoryController@cqxync'); //历史开奖 - 重庆幸运农场
    Route::get('/back/datatables/openHistory/gd11x5', 'Back\Data\openHistoryController@gd11x5'); //历史开奖 - 广东11选5
    Route::get('/back/datatables/openHistory/bjkl8', 'Back\Data\openHistoryController@bjkl8'); //历史开奖 - 北京快乐8
    Route::get('/back/datatables/openHistory/lhc', 'Back\Data\openHistoryController@lhc'); //历史开奖 - 六合彩
    Route::get('/back/datatables/openHistory/xylhc', 'Back\Data\openHistoryController@xylhc'); //历史开奖 - 幸运六合彩
    Route::get('/back/datatables/openHistory/sc', 'Back\Data\openHistoryController@sc'); //历史开奖 - 赛车
    Route::get('/back/datatables/openHistory/k3', 'Back\Data\openHistoryController@k3'); //历史开奖 - 秒速快三
    Route::get('/back/datatables/openHistory/ssc', 'Back\Data\openHistoryController@ssc'); //历史开奖 - 时时彩

    Route::get('/back/datatables/openHistory/card_betInfo', 'Back\Data\openHistoryController@card_betInfo'); //棋牌下注
    Route::get('/back/datatables/openHistory/errorBet', 'Back\Data\openHistoryController@errorBet'); //棋牌下注


    Route::get('/back/datatables/agentSettle/report', 'Back\Data\AgentSettleController@report'); //代理结算报表-表格数据
    Route::get('/back/datatables/agentSettle/review', 'Back\Data\AgentSettleController@review'); //代理结算审核-表格数据
    Route::get('/back/datatables/agentSettle/withdraw', 'Back\Data\AgentSettleController@withdraw'); //代理提现-表格数据
    Route::get('/back/datatables/agentSettle/domain', 'Back\Data\AgentSettleController@domain'); //代理专属域名
    Route::get('/back/datatables/activity/lists', 'Back\Data\ActivityController@lists'); //活动列表-表格数据
    Route::get('/back/datatables/activity/condition', 'Back\Data\ActivityController@condition'); //活动条件-表格数据
    Route::get('/back/datatables/activity/activityHongbaoList', 'Back\Data\ActivityController@activityHongbaoList'); //红包活动-红包数据

    Route::get('/back/datatables/activity/prize', 'Back\Data\ActivityController@prize'); //奖品配置-表格数据
    Route::get('/back/datatables/activity/review', 'Back\Data\ActivityController@review'); //派奖审核-表格数据
    Route::get('/back/datatables/activity/daily', 'Back\Data\ActivityController@daily'); //每日数据统计-表格数据
    Route::get('/back/datatables/activity/data', 'Back\Data\ActivityController@data'); //每日活动统计-表格数据
    Route::get('/back/datatables/promotion/report','Back\Data\PromotionController@report'); //推广结算报表-表格数据
    Route::get('/back/datatables/promotion/review','Back\Data\PromotionController@review'); //推广审核报表-表格数据
    Route::get('/back/datatables/promotion/config','Back\Data\PromotionController@config'); //推广设置-表格数据
    Route::get('/back/datatables/platform/settlement','Back\Data\PlatformController@settlement'); //平台费用结算-表格数据
    Route::get('/back/datatables/platform/record','Back\Data\PlatformController@record'); //付款记录-表格数据
    Route::get('/back/datatables/GameApiList','Back\GamesApiController@GameApiList'); //获取游戏接口列表


    //图表数据
    Route::post('/back/charts/gameBunko','Back\Charts\ChartsDataController@gameBunko');
    Route::post('/back/charts/recharges','Back\Charts\ChartsDataController@recharges');

    //action
    Route::post('/action/admin/login', 'Back\SrcAccountController@login');
    Route::post('/action/admin/logout', 'Back\SrcAccountController@logout');

    Route::post('/action/admin/addPlatformSettlement', 'Back\PlatformController@addPlatformSettlement')->middleware('add-log-handle')->name('ac.ad.addPlatformSettlement');//平台费用结算-手动结算

    Route::post('/action/admin/addGeneralAgent', 'Back\SrcMemberController@addGeneralAgent')->middleware('add-log-handle')->name('ac.ad.addGeneralAgent');//添加总代理
    Route::post('/action/admin/editGeneralAgent', 'Back\SrcMemberController@editGeneralAgent')->middleware('add-log-handle')->name('ac.ad.editGeneralAgent');//修改总代理

    Route::post('/action/admin/addSubAccount', 'Back\SrcMemberController@addSubAccount')->middleware('add-log-handle')->name('ac.ad.addSubAccount');//添加子账号
    Route::post('/action/admin/editSubAccount', 'Back\SrcMemberController@editSubAccount')->middleware('add-log-handle')->name('ac.ad.editSubAccount');//修改子账号
    Route::post('/action/admin/delSubAccount', 'Back\SrcMemberController@delSubAccount')->middleware('add-log-handle')->name('ac.ad.delSubAccount');//删除子账号
    Route::post('/action/admin/changeGoogleCode', 'Back\SrcMemberController@changeGoogleCode')->middleware('add-log-handle')->name('ac.ad.changeGoogleCode');//更换子账号的google验证码

    Route::post('/action/admin/addAgent', 'Back\SrcMemberController@addAgent')->middleware('add-log-handle')->name('ac.ad.addAgent');//添加代理账号
    Route::post('/action/admin/editAgent', 'Back\SrcMemberController@editAgent')->middleware('add-log-handle')->name('ac.ad.editAgent');//修改代理账号
    Route::post('/action/admin/delAgent/{id}', 'Back\SrcMemberController@delAgent')->middleware(['check-permission','add-log-handle'])->name('m.agent.del');//删除代理账号
    Route::post('/action/admin/changeAgentMoney', 'Back\SrcMemberController@changeAgentMoney')->middleware('add-log-handle')->name('ac.ad.changeAgentMoney');//修改代理金额
    Route::post('/action/admin/changeAgentOdds', 'Back\SrcMemberController@changeAgentOdds')->middleware('add-log-handle')->name('ac.ad.changeAgentOdds');//修改代理盘口
    Route::get('/action/admin/passAgent/{id}', 'Back\SrcMemberController@passAgent')->middleware('add-log-handle')->name('ac.ad.checkAgent');//代理审核通过
    Route::get('/action/admin/errorAgent/{id}', 'Back\SrcMemberController@errorAgent')->middleware('add-log-handle')->name('ac.ad.checkAgent');//代理审核驳回
    Route::post('/action/admin/selectAgentOdds', 'Back\SrcMemberController@selectAgentOdds');//根据代理上级获取赔率

    Route::post('/action/admin/addUser', 'Back\SrcMemberController@addUser')->middleware('add-log-handle')->name('ac.ad.addUser');//添加会员
    Route::post('/action/admin/userChangeAgent', 'Back\SrcMemberController@userChangeAgent')->middleware('add-log-handle')->name('ac.ad.userChangeAgent');//会员更换代理
    Route::post('/action/admin/userChangeFullName', 'Back\SrcMemberController@userChangeFullName')->middleware('add-log-handle')->name('ac.ad.userChangeFullName');//会员更换真实姓名
    Route::post('/action/admin/editUser', 'Back\SrcMemberController@editUser')->middleware('add-log-handle')->name('ac.ad.editUser');//修改会员资料
    Route::post('/action/admin/changeUserMoney', 'Back\SrcMemberController@changeUserMoney')->middleware('add-log-handle')->name('ac.ad.changeUserMoney');//修改会员余额
    Route::post('/action/admin/addMoneyAllUser', 'Back\SrcMemberController@addMoneyAllUser')->middleware('add-log-handle')->name('m.user.addMoneyAllUser');//批量修改会员余额
    Route::post('/action/admin/delUser/{id}', 'Back\SrcMemberController@delUser')->middleware(['check-permission','add-log-handle'])->name('m.user.delUser');//删除会员账号
    Route::post('/action/admin/editUserLevels', 'Back\SrcMemberController@editUserLevels')->middleware('add-log-handle')->name('ac.ad.editUserLevels');//删除会员层级
    Route::post('/action/admin/editRechUserLevels', 'Back\SrcMemberController@editRechUserLevels')->middleware('add-log-handle')->name('ac.ad.editRechUserLevels');//修改存款会员层级
    Route::post('/action/admin/editDrawingLevels', 'Back\SrcMemberController@editDrawingLevels')->middleware('add-log-handle')->name('ac.ad.editDrawingLevels');//修改提款会员层级
    Route::post('/action/admin/getOutUser', 'Back\SrcMemberController@getOutUser')->middleware('add-log-handle')->name('ac.ad.getOutUser');//会员踢下线
    Route::post('/action/userMoney/totalUserMoney', 'Back\SrcMemberController@totalUserMoney')->middleware('add-log-handle')->name('ac.ad.totalUserMoney');//会员总余额统计

    Route::post('/action/admin/addPermission', 'Back\PermissionController@addPermission')->middleware('add-log-handle')->name('system.addPermission'); //添加权限
    Route::post('/action/admin/editPermission', 'Back\PermissionController@editPermission')->middleware('add-log-handle')->name('system.editPermission'); //修改权限
    Route::post('/action/admin/addPermissionAuth', 'Back\PermissionController@addPermissionAuth')->middleware('add-log-handle')->name('system.addPermissionAuth'); //添加权限控制
    Route::post('/action/admin/editPermissionAuth', 'Back\PermissionController@editPermissionAuth')->middleware('add-log-handle')->name('system.editPermissionAuth'); //修改权限控制
    Route::post('/action/admin/addNewRole', 'Back\RoleController@addNewRole')->middleware('add-log-handle')->name('system.addNewRole'); //添加角色
    Route::post('/action/admin/editNewRole', 'Back\RoleController@editNewRole')->middleware('add-log-handle')->name('system.editNewRole'); //修改角色
    Route::post('/action/admin/systemSetting/edit', 'Back\SystemSettingController@editSystemSetting')->middleware('add-log-handle')->name('system.systemSetting.edit');//编辑系统设置
    Route::post('/action/admin/addArticle', 'Back\SystemSettingController@addArticle')->middleware('add-log-handle')->name('ac.ad.addArticle');//添加文章
    Route::post('/action/admin/delArticle', 'Back\SystemSettingController@delArticle')->middleware('add-log-handle')->name('ac.ad.delArticle');//删除文章
    Route::post('/action/admin/editArticle', 'Back\SystemSettingController@editArticle')->middleware('add-log-handle')->name('ac.ad.editArticle');//修改文章
    Route::post('/action/admin/addWhitelist', 'Back\SystemSettingController@addWhitelist')->middleware('add-log-handle')->name('ac.ad.addWhitelist');//添加ip白名单
    Route::post('/action/admin/delWhitelist', 'Back\SystemSettingController@delWhitelist')->middleware('add-log-handle')->name('ac.ad.delWhitelist');//删除ip白名单
    Route::post('/action/admin/editWhitelist', 'Back\SystemSettingController@editWhitelist')->middleware('add-log-handle')->name('ac.ad.editWhitelist');//修改ip白名单
    Route::post('/action/admin/editBlacklist', 'Back\SystemSettingController@editBlacklist')->middleware('add-log-handle')->name('ac.ad.editBlacklist');//黑名单管理
    Route::post('/action/admin/delBlacklist', 'Back\SystemSettingController@delBlacklist')->middleware('add-log-handle')->name('ac.ad.Blacklist');//删除黑名单
    Route::post('/action/admin/replyFeedback', 'Back\SystemSettingController@replyFeedback')->middleware('add-log-handle')->name('ac.ad.replyFeedback');//问题回复
    Route::post('/action/admin/addAdvertise', 'Back\AdSystemSettingController@addAdvertise')->middleware('add-log-handle')->name('ac.ad.addAdvertise');//添加广告位
    Route::post('/action/admin/editAdvertise', 'Back\AdSystemSettingController@editAdvertise')->middleware('add-log-handle')->name('ac.ad.editAdvertise');//修改广告位
    Route::post('/action/admin/delAdvertise', 'Back\AdSystemSettingController@delAdvertise')->middleware('add-log-handle')->name('ac.ad.delAdvertise');//删除广告位
    Route::post('/action/admin/getAdvertiseKey', 'Back\AdSystemSettingController@getAdvertiseKey')->middleware('add-log-handle')->name('ac.ad.getAdvertiseKey');//获取广告位栏位
    Route::post('/action/admin/addAdvertiseInfo', 'Back\AdSystemSettingController@addAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.addAdvertiseInfo');//添加广告位内容
    Route::post('/action/admin/closeAdvertiseInfo', 'Back\AdSystemSettingController@closeAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.editAdvertiseInfo');//修改广告位内容-关闭
    Route::post('/action/admin/openAdvertiseInfo', 'Back\AdSystemSettingController@openAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.editAdvertiseInfo');//修改广告位内容-开启
    Route::post('/action/admin/editAdvertiseInfo', 'Back\AdSystemSettingController@editAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.editAdvertiseInfo');//修改广告位内容
    Route::post('/action/admin/sortAdvertiseInfo', 'Back\AdSystemSettingController@sortAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.sortAdvertiseInfo');//排序广告位内容
    Route::post('/action/admin/delAdvertiseInfo', 'Back\AdSystemSettingController@delAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.delAdvertiseInfo');//删除广告位内容
    Route::post('/action/admin/generateAdvertiseInfo', 'Back\AdSystemSettingController@generateAdvertiseInfo')->middleware('add-log-handle')->name('ac.ad.generateAdvertiseInfo');//生成广告位内容

    Route::post('/action/admin/agentSettle/settlement', 'Back\AgentSettleController@settlement')->middleware('add-log-handle')->name('ac.ad.agentSettle.settlement'); //代理结算报表-手动结算
    Route::post('/action/admin/agentSettle/submitReview', 'Back\AgentSettleController@submitReview')->middleware('add-log-handle')->name('ac.ad.agentSettle.submitReview'); //代理结算报表-提交审核
    Route::post('/action/admin/agentSettle/submitSettle', 'Back\AgentSettleController@submitSettle')->middleware('add-log-handle')->name('ac.ad.agentSettle.submitSettle'); //代理结算报表-提交结算
    Route::post('/action/admin/agentSettle/submitTurnDown', 'Back\AgentSettleController@submitTurnDown')->middleware('add-log-handle')->name('ac.ad.agentSettle.submitTurnDown'); //代理结算报表-提交驳回
    Route::post('/action/admin/agentSettle/editReport', 'Back\AgentSettleController@editReport')->middleware('add-log-handle')->name('ac.ad.agentSettle.editReport'); //代理结算报表-修改报表
    Route::post('/action/admin/agentSettle/editReview', 'Back\AgentSettleController@editReview')->middleware('add-log-handle')->name('ac.ad.agentSettle.editReview'); //代理结算审核-修改审核
    Route::post('/action/admin/agentSettle/editConfig', 'Back\AgentSettleController@editConfig')->middleware('add-log-handle')->name('ac.ad.agentSettle.editConfig'); //代理结算配置-修改配置
    Route::post('/action/admin/agentSettle/addAgentSettleDomain', 'Back\AgentSettleController@addAgentSettleDomain')->middleware('add-log-handle')->name('ac.ad.agentSettle.addAgentSettleDomain'); //代理专属域名-添加
    Route::post('/action/admin/agentSettle/editAgentSettleDomain', 'Back\AgentSettleController@editAgentSettleDomain')->middleware('add-log-handle')->name('ac.ad.agentSettle.editAgentSettleDomain'); //代理专属域名-修改
    Route::post('/action/admin/agentSettle/delAgentSettleDomain', 'Back\AgentSettleController@delAgentSettleDomain')->middleware('add-log-handle')->name('ac.ad.agentSettle.delAgentSettleDomain'); //代理专属域名-删除


    Route::post('/action/admin/activity/addActivity', 'Back\ActivityController@addActivity')->middleware('add-log-handle')->name('ac.ad.activity.addActivity'); //活动列表-新增活动
    Route::post('/action/admin/activity/editActivity', 'Back\ActivityController@editActivity')->middleware('add-log-handle')->name('ac.ad.activity.editActivity'); //活动列表-修改活动
    Route::post('/action/admin/activity/onOffActivity', 'Back\ActivityController@onOffActivity')->middleware('add-log-handle')->name('ac.ad.activity.onOffActivity'); //活动列表-开启关闭
    Route::post('/action/admin/activity/addCondition', 'Back\ActivityController@addCondition')->middleware('add-log-handle')->name('ac.ad.activity.addCondition'); //活动条件-新增条件
    Route::post('/action/admin/activity/addActivityCondition', 'Back\ActivityController@addActivityCondition')->middleware('add-log-handle'); //活动红包-新增红包
    Route::post('/action/admin/activity/delActivityCondition', 'Back\ActivityController@delActivityCondition')->middleware('add-log-handle'); //活动红包-删除红包
    Route::post('/action/admin/activity/addConditionMoney', 'Back\ActivityController@addConditionMoney')->middleware('add-log-handle'); //活动条件-添加红包金额
    Route::post('/action/admin/activity/editCondition', 'Back\ActivityController@editCondition')->middleware('add-log-handle')->name('ac.ad.activity.editCondition'); //活动条件-修改条件
    Route::post('/action/admin/activity/delCondition', 'Back\ActivityController@delCondition')->middleware('add-log-handle')->name('ac.ad.activity.delCondition'); //活动条件-删除条件
    Route::post('/action/admin/activity/addPrize', 'Back\ActivityController@addPrize')->middleware('add-log-handle')->name('ac.ad.activity.addPrize'); //奖品配置-新增奖品
    Route::post('/action/admin/activity/editPrize', 'Back\ActivityController@editPrize')->middleware('add-log-handle')->name('ac.ad.activity.editPrize'); //奖品配置-修改奖品
    Route::post('/action/admin/activity/delPrize', 'Back\ActivityController@delPrize')->middleware('add-log-handle')->name('ac.ad.activity.delPrize'); //奖品配置-删除奖品
    Route::post('/action/admin/activity/reviewAward', 'Back\ActivityController@reviewAward')->middleware('add-log-handle')->name('ac.ad.activity.reviewAward'); //派奖审核-审核奖品
    Route::post('/action/admin/activity/dailyStatistics', 'Back\ActivityController@dailyStatistics')->middleware('add-log-handle')->name('ac.ad.activity.dailyStatistics'); //活动数据统计-每日统计
    Route::post('/action/admin/activity/dataStatistics', 'Back\ActivityController@dataStatistics')->middleware('add-log-handle')->name('ac.ad.activity.dataStatistics'); //每日数据统计-每日统计

    Route::post('/action/admin/promotion/settlement','Back\PromotionController@settlement')->middleware('add-log-handle')->name('ac.ad.promotion.settlement'); //推广结算报表-手动结算
    Route::post('/action/admin/promotion/editReport','Back\PromotionController@editReport')->middleware('add-log-handle')->name('ac.ad.promotion.editReport'); //推广结算报表-修改结算
    Route::post('/action/admin/promotion/commitReport','Back\PromotionController@commitReport')->middleware('add-log-handle')->name('ac.ad.promotion.commitReport'); //推广结算报表-提交审核
    Route::post('/action/admin/promotion/submitTurnDown','Back\PromotionController@submitTurnDown')->middleware('add-log-handle')->name('ac.ad.promotion.submitTurnDown'); //推广结算审核-提交驳回
    Route::post('/action/admin/promotion/addConfig','Back\PromotionController@addConfig')->middleware('add-log-handle')->name('ac.ad.promotion.addConfig'); //推广配置-新增配置
    Route::post('/action/admin/promotion/editConfig','Back\PromotionController@editConfig')->middleware('add-log-handle')->name('ac.ad.promotion.editConfig'); //推广配置-修改配置
    Route::post('/action/admin/addNotice', 'Back\SrcNoticeController@addNotice')->middleware('add-log-handle')->name('ac.ad.addNotice'); //添加公告
    Route::post('/action/admin/editNotice', 'Back\SrcNoticeController@editNotice')->middleware('add-log-handle')->name('ac.ad.editNotice'); //修改公告
    Route::post('/action/admin/delNoticeSetting', 'Back\SrcNoticeController@delNoticeSetting')->middleware('add-log-handle')->name('ac.ad.delNoticeSetting'); //删除公告
    Route::post('/action/admin/setNoticeOrder', 'Back\SrcNoticeController@setNoticeOrder')->middleware('add-log-handle')->name('ac.ad.setNoticeOrder'); //设置公告顺序
    Route::post('/action/admin/addSendMessage', 'Back\SrcNoticeController@addSendMessage')->middleware('add-log-handle')->name('ac.ad.addSendMessage'); //添加消息
    Route::post('/action/admin/delSendMessage', 'Back\SrcNoticeController@delSendMessage')->middleware('add-log-handle')->name('ac.ad.delSendMessage'); //删除消息

    Route::post('/action/admin/report/addStatistics', 'Back\SrcReportController@addStatistics')->middleware(['check-permission','add-log-handle'])->name('report.addStatistics'); //添加操作报表
    Route::post('/action/admin/report/addReportCard', 'Back\SrcReportController@addReportCard'); // 手动生成棋牌报表

    Route::post('/action/admin/addBank', 'Back\SrcPayController@addBank')->middleware('add-log-handle')->name('ac.ad.addBank');//添加银行
    Route::post('/action/admin/addLevel', 'Back\SrcPayController@addLevel')->middleware('add-log-handle')->name('ac.ad.addLevel');//添加层级
    Route::post('/action/admin/editLevel', 'Back\SrcPayController@editLevel')->middleware('add-log-handle')->name('ac.ad.editLevel');//修改层级
    Route::post('/action/admin/delLevelCheck', 'Back\SrcPayController@delLevelCheck')->middleware('add-log-handle')->name('ac.ad.delLevelCheck');//删除层级检查
    Route::post('/action/admin/delLevel', 'Back\SrcPayController@delLevel')->middleware('add-log-handle')->name('ac.ad.delLevel');//删除层级
    Route::post('/action/admin/allExchangeLevel', 'Back\SrcPayController@allExchangeLevel')->middleware('add-log-handle')->name('ac.ad.allExchangeLevel');//层级全部转移
    Route::post('/action/admin/sectionExchangeLevel','Back\SrcPayController@sectionExchangeLevel')->middleware('add-log-handle')->name('ac.ad.sectionExchangeLevel');//部分全部转移
    Route::post('/action/admin/sectionDisplayLevel','Back\SrcPayController@sectionDisplayLevel')->middleware('add-log-handle')->name('ac.ad.sectionDisplayLevel');//部分转移显示
    Route::post('/action/admin/addRechargeWay', 'Back\SrcPayController@addRechargeWay')->middleware('add-log-handle')->name('ac.ad.addRechargeWay');//添加充值方式
    Route::post('/action/admin/editRechargeWay', 'Back\SrcPayController@editRechargeWay')->middleware('add-log-handle')->name('ac.ad.editRechargeWay');//添加充值方式
    Route::post('/action/admin/editRechType', 'Back\SrcPayController@editRechType')->middleware('add-log-handle')->name('ac.ad.editRechType');//修改前端显示
    Route::post('/action/admin/changeOnlinePayStatus', 'Back\SrcPayController@changeOnlinePayStatus')->middleware('add-log-handle')->name('ac.ad.changeOnlinePayStatus');//改变充值方式状态
    Route::post('/action/admin/delOnlinePay', 'Back\SrcPayController@delOnlinePay')->middleware('add-log-handle')->name('ac.ad.delOnlinePay');//删除充值方式
    Route::post('/action/admin/delRechargeWay', 'Back\SrcPayController@delRechargeWay')->middleware('add-log-handle')->name('ac.ad.delRechargeWay');//删除充值方式
    Route::post('/action/admin/addPayOnline', 'Back\SrcPayController@addPayOnline')->middleware('add-log-handle')->name('ac.ad.addPayOnline');//添加在线支付配置
    Route::post('/action/admin/editPayOnline', 'Back\SrcPayController@editPayOnline')->middleware('add-log-handle')->name('ac.ad.editPayOnline');//修改在线支付配置
    Route::post('/action/admin/addPayBank', 'Back\SrcPayController@addPayBank')->middleware('add-log-handle')->name('ac.ad.addPayBank');//添加银行支付配置
    Route::post('/action/admin/editPayBank', 'Back\SrcPayController@editPayBank')->middleware('add-log-handle')->name('ac.ad.editPayBank');//修改银行支付配置
    Route::post('/action/admin/addPayAlipay', 'Back\SrcPayController@addPayAlipay')->middleware('add-log-handle')->name('ac.ad.addPayAlipay');//添加支付宝配置
    Route::post('/action/admin/editPayAlipay', 'Back\SrcPayController@editPayAlipay')->middleware('add-log-handle')->name('ac.ad.editPayAlipay');//修改支付宝配置
    Route::post('/action/admin/addPayWechat', 'Back\SrcPayController@addPayWechat')->middleware('add-log-handle')->name('ac.ad.addPayWechat');//添加微信配置
    Route::post('/action/admin/editPayWechat', 'Back\SrcPayController@editPayWechat')->middleware('add-log-handle')->name('ac.ad.editPayWechat');//修改微信配置
    Route::post('/action/admin/addPayCft', 'Back\SrcPayController@addPayCft')->middleware('add-log-handle')->name('ac.ad.addPayCft');//添加财付通配置
    Route::post('/action/admin/editPayCft', 'Back\SrcPayController@editPayCft')->middleware('add-log-handle')->name('ac.ad.editPayCft');//修改财付通配置
    Route::post('/action/admin/setSort', 'Back\SrcPayController@setSort')->middleware('add-log-handle')->name('ac.ad.setSort');//设置排序
    Route::post('/action/admin/rechType/setSort', 'Back\SrcPayController@rechTypeSetSort')->middleware('add-log-handle')->name('ac.ad.rechType.setSort');//设置排序
    Route::post('/action/admin/rechWay/setSort', 'Back\SrcPayController@rechWaySetSort')->middleware('add-log-handle')->name('ac.ad.rechWay.setSort');//充值方式配置排序

    //充值配置新

    Route::post('/action/admin/new/copyPayOnline', 'Back\SrcPayNewController@copyPayOnline')->middleware('add-log-handle')->name('ac.ad.new.copyPayOnline');//复制在线支付配置
    Route::post('/action/admin/new/addPayOnline', 'Back\SrcPayNewController@addPayOnline')->middleware('add-log-handle')->name('ac.ad.new.addPayOnline');//添加在线支付配置
    Route::post('/action/admin/new/editPayOnline', 'Back\SrcPayNewController@editPayOnline')->middleware('add-log-handle')->name('ac.ad.new.editPayOnline');//修改在线支付配置
    Route::post('/action/admin/new/changeOnlinePayStatus', 'Back\SrcPayNewController@changeOnlinePayStatus')->middleware('add-log-handle')->name('ac.ad.new.changeOnlinePayStatus');//改变充值方式状态新
    Route::post('/action/admin/new/delOnlinePay', 'Back\SrcPayNewController@delOnlinePay')->middleware('add-log-handle')->name('ac.ad.new.delOnlinePay');//删除充值方式新
    Route::post('/action/admin/new/setSort', 'Back\SrcPayNewController@setSort')->middleware('add-log-handle')->name('ac.ad.new.setSort');//设置排序新
    Route::post('/action/admin/new/addPayBank', 'Back\SrcPayNewController@addPayBank')->middleware('add-log-handle')->name('ac.ad.new.addPayBank');//添加银行支付配置
    Route::post('/action/admin/new/editPayBank', 'Back\SrcPayNewController@editPayBank')->middleware('add-log-handle')->name('ac.ad.new.editPayBank');//修改银行支付配置
    Route::post('/action/admin/new/addPayAlipay', 'Back\SrcPayNewController@addPayAlipay')->middleware('add-log-handle')->name('ac.ad.new.addPayAlipay');//添加支付宝配置
    Route::post('/action/admin/new/editPayAlipay', 'Back\SrcPayNewController@editPayAlipay')->middleware('add-log-handle')->name('ac.ad.new.editPayAlipay');//修改支付宝配置
    Route::post('/action/admin/new/addPayYsf', 'Back\SrcPayNewController@addPayYsf')->middleware('add-log-handle')->name('ac.ad.new.addPayYsf');//添加云闪付配置
    Route::post('/action/admin/new/editPayYsf', 'Back\SrcPayNewController@editPayYsf')->middleware('add-log-handle')->name('ac.ad.new.editPayYsf');//修改云闪付配置
    Route::post('/action/admin/new/addPayWechat', 'Back\SrcPayNewController@addPayWechat')->middleware('add-log-handle')->name('ac.ad.new.addPayWechat');//添加微信配置
    Route::post('/action/admin/new/editPayWechat', 'Back\SrcPayNewController@editPayWechat')->middleware('add-log-handle')->name('ac.ad.new.editPayWechat');//修改微信配置
    Route::post('/action/admin/new/addPayCft', 'Back\SrcPayNewController@addPayCft')->middleware('add-log-handle')->name('ac.ad.new.addPayCft');//添加财付通配置
    Route::post('/action/admin/new/editPayCft', 'Back\SrcPayNewController@editPayCft')->middleware('add-log-handle')->name('ac.ad.new.editPayCft');//修改财付通配置

    Route::post('/action/admin/editGameSetting', 'Back\SrcGameController@editGameSetting')->middleware('add-log-handle')->name('ac.ad.editGameSetting');//修改游戏设定
    Route::post('/action/admin/changeGameFengPan', 'Back\SrcGameController@changeGameFengPan')->middleware('add-log-handle')->name('ac.ad.changeGameFengPan');//修改游戏开封盘状态
    Route::post('/action/admin/changeGameStatus', 'Back\SrcGameController@changeGameStatus')->middleware('add-log-handle')->name('ac.ad.changeGameStatus');//修改游戏开启和停用状态
    Route::post('/action/admin/saveOddsRebate', 'Back\SrcGameController@saveOddsRebate')->middleware('add-log-handle')->name('ac.ad.saveOddsRebate');//修改游戏开启和停用状态
    Route::post('/action/admin/killStatus', 'Back\SrcGameController@killStatus')->middleware(['check-permission','add-log-handle'])->name('game.killStatus'); //杀率开关
    Route::post('/action/admin/editKillSetting', 'Back\SrcGameController@editKillSetting')->middleware(['check-permission','add-log-handle'])->name('game.editKillSetting'); //修改杀率保留营利比
    Route::post('/action/admin/addAgentOdds', 'Back\SrcGameController@addAgentOdds');//添加代理赔率
    Route::post('/action/admin/editAgentOdds', 'Back\SrcGameController@editAgentOdds');//修改代理赔率

    Route::post('/action/admin/passRecharge', 'Back\RechargeController@passRecharge')->middleware('add-log-handle')->name('ac.ad.passRecharge'); //通过充值申请
    Route::post('/action/admin/passOnlineRecharge', 'Back\RechargeController@passOnlineRecharge')->middleware('add-log-handle')->name('ac.ad.passOnlineRecharge'); //通过在线充值申请
    Route::post('/action/admin/addRechargeError', 'Back\RechargeController@addRechargeError')->middleware('add-log-handle')->name('ac.ad.addRechargeError'); //驳回充值申请

    Route::post('/action/admin/passDrawing', 'Back\DrawingController@passDrawing')->middleware('add-log-handle')->name('ac.ad.passDrawing'); //通过提款申请
    Route::post('/action/admin/passDrawingAuto', 'Back\DrawingController@passDrawingAuto')->middleware('add-log-handle')->name('ac.ad.passDrawingAuto'); //自动提款后的提款申请
    Route::post('/action/admin/addDrawingError', 'Back\DrawingController@addDrawingError')->middleware('add-log-handle')->name('ac.ad.addDrawingError'); //驳回提款申请
    Route::post('/action/admin/addDrawingErrorAuto', 'Back\DrawingController@addDrawingErrorAuto')->middleware('add-log-handle')->name('ac.ad.addDrawingErrorAuto'); //自动驳回提款申请
    Route::post('/action/admin/dispensingDrawing', 'Back\DrawingController@dispensingDrawing')->middleware('add-log-handle')->name('ac.ad.dispensingDrawing'); //自动出款
    Route::post('/action/admin/drawingThaw', 'Back\DrawingController@drawingThaw')->middleware('add-log-handle')->name('ac.ad.drawingThaw'); //提现解冻
    Route::post('/action/admin/refreshIp', 'Back\DrawingController@refreshIp')->middleware('add-log-handle')->name('ac.ad.refreshIp'); //刷新ip

    Route::post('/action/recharge/totalRecharge', 'Back\RechargeController@totalRecharge')->name('ac.ad.recharge.totalRecharge'); //充值记录的总额统计
    Route::post('/action/drawing/totalDrawing', 'Back\DrawingController@totalDrawing')->name('ac.ad.drawing.totalDrawing'); //提款记录的总额统计

    Route::post('/action/betTodat/total','Back\Data\BetDataController@betNumTotal')->name('ac.ad.betTodat.total');

    Route::post('/action/userBetList/total', 'Back\SrcViewController@userBetListTotal')->name('ac.ad.userBetList.total'); //用户注单页面下注统计

    Route::post('/action/admin/addLhcNewIssue', 'Back\OpenHistoryController@addLhcNewIssue')->name('ac.ad.addLhcNewIssue');
    Route::post('/action/admin/addXylhcNewIssue', 'Back\OpenHistoryController@addXylhcNewIssue')->name('ac.ad.addXylhcNewIssue');
    Route::post('/action/admin/editLhcNewIssue', 'Back\OpenHistoryController@editLhcNewIssue')->name('ac.ad.editLhcNewIssue');
    Route::post('/action/admin/editXylhcNewIssue', 'Back\OpenHistoryController@editXylhcNewIssue')->name('ac.ad.editXylhcNewIssue');

    Route::post('/action/admin/openssc', 'Back\OpenHistoryController@addsscData')->middleware('add-log-handle')->name('ac.ad.openssc');     //添加时时彩开奖数据
    Route::post('/action/admin/opensc', 'Back\OpenHistoryController@addscData')->middleware('add-log-handle')->name('ac.ad.opensc');     //添加赛车开奖数据
    Route::post('/action/admin/openK3', 'Back\OpenHistoryController@addK3Data')->middleware('add-log-handle')->name('ac.ad.openK3');     //添加快三开奖数据
    Route::post('/action/admin/openBjkl8', 'Back\OpenHistoryController@addBjkl8Data')->middleware('add-log-handle')->name('ac.ad.openBjkl8');     //添加北京快乐8开奖数据
    Route::post('/action/admin/openxync', 'Back\OpenHistoryController@addXyncData');     //添加幸运农场 广东快乐十分开奖数据
    Route::post('/action/admin/opengd11x5', 'Back\OpenHistoryController@addGd11x5Data');     //添加广东11选5开奖数据

    Route::post('/action/admin/openLhc', 'Back\OpenHistoryController@addLhcData')->middleware('add-log-handle')->name('ac.ad.openLhc');
    Route::post('/action/admin/openXylhc', 'Back\OpenHistoryController@addXylhcData')->middleware('add-log-handle')->name('ac.ad.openXylhc');
    Route::post('/action/admin/reOpenLhc', 'Back\OpenHistoryController@reOpenLhcData')->middleware('add-log-handle')->name('ac.ad.reOpenLhc');
    Route::post('/action/admin/reOpenXylhc', 'Back\OpenHistoryController@reOpenXylhcData')->middleware('add-log-handle')->name('ac.ad.reOpenXylhc');

    Route::post('/action/admin/freeze/{issue}/{type}', 'Back\OpenHistoryController@freeze')->middleware('add-log-handle')->name('ac.ad.freeze');     //冻结彩种
    Route::post('/action/admin/renewLottery/{issue}/{type}', 'Back\OpenHistoryController@renewLottery')->middleware('add-log-handle')->name('ac.ad.renewLottery');     //重新开奖
    Route::post('/action/admin/cancelBetting/{issue}/{type}', 'Back\OpenHistoryController@cancelBetting')->middleware('add-log-handle')->name('ac.ad.cancelBetting'); // 撤单
    Route::post('/action/admin/Bet/canceled/{issue}/{type}', 'Back\OpenHistoryController@canceledBetIssue')->middleware('add-log-handle')->name('ac.ad.bet.canceled'); // 撤单2
    Route::post('/action/admin/bet/cancel/{orderId}', 'Back\OpenHistoryController@cancelBetOrder')->middleware('add-log-handle')->name('ac.ad.bet.cancel'); // 取消注单

    Route::any('/action/admin/member/returnVisit','Back\MemberController@returnVisit')->middleware(['check-permission','add-log-handle'])->name('member.returnVisit'); //会员-回访用户
    Route::any('/action/admin/member/exportUser','Back\MemberController@exportUser')->middleware(['check-permission','add-log-handle'])->name('member.exportUser'); //会员-导出用户数据
    Route::any('/action/admin/member/exportMember/{id}/{name}', 'Back\MemberController@exportMember')->middleware(['check-permission','add-log-handle'])->name('member.exportMember');;//代理-导出会员
    Route::any('/action/admin/member/exportGAgentMember/{id}/{name}', 'Back\MemberController@exportGAgentMember')->middleware(['check-permission','add-log-handle'])->name('member.exportGAgentMember');;//总代理-导出会员
    Route::any('/action/admin/member/exportMemberSuper/{id}/{name}', 'Back\MemberController@exportMemberSuper')->middleware(['check-permission','add-log-handle'])->name('member.exportMemberSuper');;//总代代理-导出会员
    Route::any('/action/admin/member/visitMember/{id}/{name}', 'Back\MemberController@visitMember')->middleware(['check-permission','add-log-handle'])->name('member.visitMember');;//代理-导出会员
    Route::any('/action/admin/member/visitMemberSuper/{id}/{name}', 'Back\MemberController@visitMemberSuper')->middleware(['check-permission','add-log-handle'])->name('member.visitMemberSuper');;//总代代理-导出会员

    Route::get('/action/admin/exportExcel/userRecharges','Back\ExportExcelController@exportExcelForRecharges')->name('ac.ad.exportExcel.userRecharges'); //导出充值数据为Excel文件
    Route::get('/action/admin/exportExcel/userDrawing','Back\ExportExcelController@exportExcelForDrawing')->name('ac.ad.exportExcel.userDrawing'); //导出充值数据为Excel文件
    Route::get('/action/admin/exportExcel/Card','Back\ExportExcelController@exportExcelForCard')->name('ac.ad.exportExcel.userDrawing'); //导出充值数据为Excel文件
    Route::post('/action/admin/gamesApi/edit','Back\GamesApiController@edit')->name('ac.ad.GamesApi.edit'); //平台接口编辑
    Route::post('/action/admin/gamesApi/del','Back\GamesApiController@del')->name('ac.ad.GamesApi.del'); //平台接口删除
    Route::get('/action/admin/gamesApi/sort','Back\GamesApiController@sort'); //平台接口排序
    Route::post('/action/admin/gamesApi/editParameter','Back\GamesApiController@editParameter')->name('ac.ad.GamesApi.editParameter'); //平台接口参数修改
    Route::get('/action/admin/gamesApi/allDown','Back\GamesApiController@allDown'); //下掉一个用户的所有分

    Route::post('/action/admin/platform/pay', 'Back\PlatformController@pay')->middleware('add-log-handle')->name('ac.ad.platform.pay');//平台费用支付

//Modal
    Route::get('/back/modal/alert', 'Back\Ajax\ModalController@alert'); //添加权限
    Route::get('/back/modal/addPermission', 'Back\Ajax\ModalController@addPermission'); //添加权限
    Route::get('/back/modal/editPermission/{id}', 'Back\Ajax\ModalController@editPermission'); //修改权限
    Route::get('/back/modal/addPermissionAuth', 'Back\Ajax\ModalController@addPermissionAuth'); //添加权限控制
    Route::get('/back/modal/editPermissionAuth/{id}', 'Back\Ajax\ModalController@editPermissionAuth'); //修改权限控制
    Route::get('/back/modal/addRole', 'Back\Ajax\ModalController@addRole'); //添加角色
    Route::get('/back/modal/editRole/{id}', 'Back\Ajax\ModalController@editRole'); //修改角色
    Route::get('/back/modal/addBlacklist', 'Back\Ajax\ModalController@addBlacklist'); //添加黑名单
    Route::get('/back/modal/addWhitelist', 'Back\Ajax\ModalController@addWhitelist'); //添加ip白名单
    Route::get('/back/modal/editWhitelist/{id}', 'Back\Ajax\ModalController@editWhitelist'); //修改ip白名单
    Route::get('/back/modal/viewFeedback/{id}', 'Back\Ajax\ModalController@viewFeedback'); //查看意见反馈
    Route::get('/back/modal/addAdvertise', 'Back\Ajax\AdModalController@addAdvertise'); //添加广告位
    Route::get('/back/modal/editAdvertise/{id}', 'Back\Ajax\AdModalController@editAdvertise'); //修改广告位
    Route::get('/back/modal/addAdvertiseInfo', 'Back\Ajax\AdModalController@addAdvertiseInfo'); //添加广告位内容
    Route::get('/back/modal/editAdvertiseInfo/{id}', 'Back\Ajax\AdModalController@editAdvertiseInfo'); //添加广告位内容
    Route::get('/back/modal/addSubAccount', 'Back\Ajax\ModalController@addSubAccount')->middleware('check-permission')->name('m.subAccount.add');
    Route::get('/back/modal/editSubAccount/{id}', 'Back\Ajax\ModalController@editSubAccount')->middleware('check-permission')->name('m.subAccount.edit');
    Route::get('/back/modal/googleSubAccount/{id}', 'Back\Ajax\ModalController@googleSubAccount')->middleware('check-permission')->name('m.subAccount.googleOTP');
    Route::get('/back/modal/reconciliationInfo/{id}', 'Back\Ajax\ModalController@reconciliationInfo')->name('m.member.reconciliation');  //会员对帐详情
    Route::get('/back/modal/addGeneralAgent', 'Back\Ajax\ModalController@addGeneralAgent')->middleware('check-permission')->name('m.gAgent.add');
    Route::get('/back/modal/editGeneralAgent/{id}', 'Back\Ajax\ModalController@editGeneralAgent')->middleware('check-permission')->name('m.gAgent.edit');
    Route::get('/back/modal/addAgent/{agentId}', 'Back\Ajax\ModalController@addAgent')->middleware('check-permission')->name('m.agent.add');  //添加代理
    Route::get('/back/modal/changeAgentOdds/{agentId}', 'Back\Ajax\ModalController@changeAgentOdds')->middleware('check-permission')->name('m.agent.changeAgentOdds');  //修改代理赔率
    Route::get('/back/modal/editAgent/{id}', 'Back\Ajax\ModalController@editAgent')->middleware('check-permission')->name('m.agent.edit');
    Route::get('/back/modal/agentInfo/{id}', 'Back\Ajax\ModalController@agentInfo')->middleware('check-permission')->name('m.agent.viewDetails');
    Route::get('/back/modal/agentContent/{id}', 'Back\Ajax\ModalController@agentContent')->middleware('check-permission')->name('m.agent.viewDetails');
    Route::get('/back/modal/changeAgentMoney/{id}', 'Back\Ajax\ModalController@changeAgentMoney')->middleware('check-permission')->name('m.agent.editMoney');
    Route::get('/back/modal/agentCapitalHistory/{id}', 'Back\Ajax\ModalController@agentCapitalHistory')->middleware('check-permission')->name('m.agent.capitalDetails');
    Route::get('/back/modal/agentBackwater/{id}', 'Back\Ajax\ModalController@agentBackwater')->middleware('check-permission')->name('m.agent.agentBackwater'); //查看代理返水
    Route::get('/back/modal/addBank', 'Back\Ajax\ModalController@addBank');
    Route::get('/back/modal/addUser', 'Back\Ajax\ModalController@addUser')->middleware('check-permission')->name('m.user.add');
    Route::get('/back/modal/userChangeAgent/{id}', 'Back\Ajax\ModalController@userChangeAgent')->middleware('check-permission')->name('m.user.changeAgent');
    Route::get('/back/modal/userChangeFullName/{id}', 'Back\Ajax\ModalController@userChangeFullName')->middleware('check-permission')->name('m.user.editTrueName');
    Route::get('/back/modal/viewUserInfo/{id}', 'Back\Ajax\ModalController@viewUserInfo')->middleware('check-permission')->name('m.user.viewUserInfo');
    Route::get('/back/modal/editUserInfo/{id}', 'Back\Ajax\ModalController@editUserInfo')->middleware('check-permission')->name('m.user.edit');         //修改会员资料
    Route::get('/back/modal/viewUserContent/{id}', 'Back\Ajax\ModalController@viewUserContent')->middleware('check-permission')->name('m.user.viewDetails');
    Route::get('/back/modal/changeUserMoney/{id}', 'Back\Ajax\ModalController@changeUserMoney')->middleware('check-permission')->name('m.user.changeBalance');      //修改会员馀额
    Route::get('/back/modal/addMoneyAllUser', 'Back\Ajax\ModalController@addMoneyAllUser')->middleware('check-permission')->name('m.user.addMoneyAllUser');      //批量修改会员馀额
    Route::get('/back/modal/userCapitalHistory/{id}', 'Back\Ajax\ModalController@userCapitalHistory')->middleware('check-permission')->name('m.user.CapitalHistory');
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
    Route::get('/back/modal/addPayYsfNew', 'Back\Ajax\ModalController@addPayYsfNew');  //充值配置新-云闪付-添加
    Route::get('/back/modal/editPayYsfNew/{id}', 'Back\Ajax\ModalController@editPayYsfNew');  //充值配置新-云闪付-修改
    Route::get('/back/modal/addPayWechatNew', 'Back\Ajax\ModalController@addPayWechatNew');  //充值配置新-微信-添加
    Route::get('/back/modal/editPayWechatNew/{id}', 'Back\Ajax\ModalController@editPayWechatNew');  //充值配置新-微信-修改
    Route::get('/back/modal/addPayCftNew', 'Back\Ajax\ModalController@addPayCftNew');  //充值配置新-财付通-添加
    Route::get('/back/modal/editPayCftNew/{id}', 'Back\Ajax\ModalController@editPayCftNew');  //充值配置新-财付通-修改
    Route::get('/back/modal/user48hoursInfo/{uid}', 'Back\Ajax\ModalController@user48hoursInfo');
    Route::get('/back/modal/addLhcNewIssue', 'Back\Ajax\ModalController@addLhcNewIssue');
//    Route::get('/back/modal/addXylhcNewIssue', 'Back\Ajax\ModalController@addXylhcNewIssue');  //幸运六合彩 - 新增期数
    Route::get('/back/modal/editLhcNewIssue/{id}', 'Back\Ajax\ModalController@editLhcNewIssue');
    Route::get('/back/modal/editXylhcNewIssue/{id}', 'Back\Ajax\ModalController@editXylhcNewIssue');  //幸运六合彩 - 修改期数

    Route::get('/back/modal/openBjpk10/{id}', 'Back\Ajax\ModalController@openBjpk10');           //北京PK10 - 手动开奖
    Route::get('/back/modal/openBjkl8/{id}', 'Back\Ajax\ModalController@openBjkl8');             //北京快乐8 - 手动开奖
    Route::get('/back/modal/open/{id}/{gameType}/{cat}/{issue}/{type}', 'Back\Ajax\ModalController@open');       //手动开奖 id/游戏名/类型

    Route::get('/back/modal/openLhc/{id}', 'Back\Ajax\ModalController@openLhc');
    Route::get('/back/modal/openXylhc/{id}/{gameType}', 'Back\Ajax\ModalController@openXylhc');      //幸运六合彩 - 手动开奖
    Route::get('/back/modal/reOpenLhc/{id}', 'Back\Ajax\ModalController@reOpenLhc');
    Route::get('/back/modal/reOpenXylhc/{id}/{gameType}', 'Back\Ajax\ModalController@reOpenXylhc');  //幸运六合彩 - 重新开奖
    Route::get('/back/modal/editAgentSettleReport/{id}', 'Back\Ajax\ModalController@editAgentSettleReport'); //修改代理结算报表-模板
    Route::get('/back/modal/editAgentSettleReview/{id}', 'Back\Ajax\ModalController@editAgentSettleReview'); //修改代理结算审核-模板
    Route::get('/back/modal/addActivityList', 'Back\Ajax\ModalController@addActivityList'); //增加活动-模板
    Route::get('/back/modal/editActivityList/{id}', 'Back\Ajax\ModalController@editActivityList'); //修改活动-模板
    Route::get('/back/modal/addActivityCondition', 'Back\Ajax\ModalController@addActivityCondition'); //增加活动条件-模板
    Route::get('/back/modal/addActivityHongbaoProbability', 'Back\Ajax\ModalController@addActivityHongbaoProbability'); //增加活动红包-模板
    Route::get('/back/modal/editActivityHongbaoProbability/{id}', 'Back\Ajax\ModalController@editActivityHongbaoProbability'); //修改活动红包-模板
    Route::get('/back/modal/activityHongbaoProbability/{id}', 'Back\Ajax\ModalController@activityHongbaoProbability')->where([ 'id' => '[\d]+','activity_id' => '[\d]+']); //编辑红包-单页面
    Route::get('/back/modal/editActivityCondition/{id}/{activity_id}', 'Back\Ajax\ModalController@editActivityCondition'); //修改活动条件-模板
    Route::get('/back/modal/addActivityPrize', 'Back\Ajax\ModalController@addActivityPrize'); //增加奖品配置-模板
    Route::get('/back/modal/editActivityPrize/{id}', 'Back\Ajax\ModalController@editActivityPrize'); //修改奖品配置-模板
    Route::get('/back/modal/editPromotionReport/{id}','Back\Ajax\ModalController@editPromotionReport'); //修改推广就算报表-模板
    Route::get('/back/modal/addPromotionConfig','Back\Ajax\ModalController@addPromotionConfig'); //增加推广配置-模板
    Route::get('/back/modal/editPromotionConfig/{id}','Back\Ajax\ModalController@editPromotionConfig'); //修改推广配置-模板
    Route::get('/back/modal/returnVisit','Back\Ajax\ModalController@returnVisit')->middleware('check-permission')->name('member.returnVisit.view'); //会员回访用户-模板
    Route::get('/back/modal/exportUser','Back\Ajax\ModalController@exportUser')->middleware('check-permission')->name('member.exportUser.view'); //导出用户数据-模板
    Route::get('/back/modal/addStatistics','Back\Ajax\ModalController@addStatistics')->middleware('check-permission')->name('report.addStatistics.view'); //操作报表添加-模板
    Route::get('/back/modal/addReportCard','Back\Ajax\ModalController@addReportCard'); //操作报表添加-模板
    Route::get('/back/modal/addAgentSettleDomain', 'Back\Ajax\ModalController@addAgentSettleDomain'); //添加代理专属域名
    Route::get('/back/modal/editAgentSettleDomain/{id}', 'Back\Ajax\ModalController@editAgentSettleDomain'); //修改代理专属域名
    Route::get('/back/modal/gameAgentOddsAdd', 'Back\Ajax\ModalController@gameAgentOddsAdd'); //添加代理赔率-模板
    Route::get('/back/modal/gameAgentOddsEdit/{id}', 'Back\Ajax\ModalController@gameAgentOddsEdit'); //修改代理赔率-模板
    Route::get('/back/modal/gameAgentOddsLook/{level}', 'Back\Ajax\ModalController@gameAgentOddsLook')->middleware('check-permission')->name('ac.ad.gameAgentOddsLook'); //代理赔率查看-模板
    Route::get('/back/modal/gameAgentOddsSet/{agentId}', 'Back\Ajax\ModalController@gameAgentOddsSet'); //代理赔率设置-模板
    Route::get('/back/modal/editGameApi', 'Back\Ajax\ModalController@editGameApi'); //添加编辑平台接口页面
    Route::get('/back/modal/payPlatformSettleOffer/{id}', 'Back\Ajax\ModalController@payPlatformSettleOffer')->middleware('check-permission')->name('ac.ad.payPlatformSettleOffer'); //后台支付页面



//游戏MODAL
    Route::get('/back/modal/gameSetting/{id}', 'Back\Ajax\ModalController@gameSetting');
    Route::get('/back/modal/killSetting/{id}', 'Back\Ajax\ModalController@killSetting');     //杀率设置

    Route::get('/web/api/select2/agents', 'Back\Api\ApiController@agents');
    Route::get('/web/api/select2/defaultAgents', 'Back\Api\ApiController@defaultAgents');
    Route::post('/web/api/check/user/username', 'Back\Api\ApiController@checkUserUsername');

    Route::get('/game/tables/50', 'Back\GameTableController@gameTable50');
    Route::get('/game/tables/1', 'Back\GameTableController@gameTable1');
    Route::get('/game/tables/4', 'Back\GameTableController@gameTable4'); //新疆时时彩
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
    Route::get('/game/tables/15', 'Back\GameTableController@gameTable15'); //河北快3
    Route::get('/game/tables/16', 'Back\GameTableController@gameTable16'); //甘肃快3
    Route::get('/game/tables/18', 'Back\GameTableController@gameTable18'); //贵州快3
    Route::get('/game/tables/112', 'Back\GameTableController@gameTable112'); //腾讯分分彩
    Route::get('/game/tables/113', 'Back\GameTableController@gameTable113'); //QQ分分彩
    Route::get('/game/tables/114', 'Back\GameTableController@gameTable114'); //秒速七星彩
    Route::get('/game/tables/801', 'Back\GameTableController@gameTable801'); //快速赛车
    Route::get('/game/tables/802', 'Back\GameTableController@gameTable802'); //快速飞艇
    Route::get('/game/tables/803', 'Back\GameTableController@gameTable803'); //快速时时彩
    Route::get('/game/tables/55', 'Back\GameTableController@gameTable55'); //幸运飞艇
    Route::get('/game/tables/804', 'Back\GameTableController@gameTable804'); //台灣幸運飛艇
    Route::get('/game/tables/901', 'Back\GameTableController@gameTable901'); //三分赛车
    Route::get('/game/tables/902', 'Back\GameTableController@gameTable902'); //三分时时彩
    Route::get('/game/tables/903', 'Back\GameTableController@gameTable903'); //极速六合彩
    Route::get('/game/tables/904', 'Back\GameTableController@gameTable904'); //三分六合彩

    //不同层级的代理赔率
    Route::get('/game/agent/tables/{gameId}/{agentId}', 'Back\GameAgentTableController@gameTable');
    Route::get('/game/agent/tables/set/{gameId}/{agentId}', 'Back\GameAgentTableController@gameTableSet');

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
    Route::get('/game/trade/tables/113','Back\GameTradeTableController@gameTradeTable113'); //QQ分分彩
    Route::get('/game/trade/tables/55','Back\GameTradeTableController@gameTradeTable55'); //幸运飞艇
    Route::get('/game/trade/tables/801', 'Back\GameTradeTableController@gameTradeTable801'); //快速赛车
    Route::get('/game/trade/tables/802', 'Back\GameTradeTableController@gameTradeTable802'); //快速飞艇
    Route::get('/game/trade/tables/803', 'Back\GameTradeTableController@gameTradeTable803'); //快速时时彩
    Route::get('/game/trade/tables/804', 'Back\GameTradeTableController@gameTradeTable804'); //台湾幸运飞艇
    Route::get('/game/trade/tables/901', 'Back\GameTradeTableController@gameTradeTable901'); //三分赛车
    Route::get('/game/trade/tables/902', 'Back\GameTradeTableController@gameTradeTable902'); //三分时时彩
    Route::get('/game/trade/tables/903', 'Back\GameTradeTableController@gameTradeTable903'); //极速六合彩
    Route::get('/game/trade/tables/904', 'Back\GameTradeTableController@gameTradeTable904'); //三分六合彩

    //保存游戏赔率表格数据
    Route::post('/game/table/save/bjpk10', 'Back\GameTables\SaveGameOddsController@bjpk10');
    Route::post('/game/table/save/cqssc', 'Back\GameTables\SaveGameOddsController@cqssc');
    Route::post('/game/table/save/xjssc', 'Back\GameTables\SaveGameOddsController@xjssc');
    Route::post('/game/table/save//**/tjssc', 'Back\GameTables\SaveGameOddsController@tjssc');
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
    Route::post('/game/table/save/hebeik3', 'Back\GameTables\SaveGameOddsController@hebeik3'); //河北快3
    Route::post('/game/table/save/gsk3', 'Back\GameTables\SaveGameOddsController@gsk3'); // 甘肃快3
    Route::post('/game/table/save/gzk3', 'Back\GameTables\SaveGameOddsController@gzk3'); // 贵州快3
    Route::post('/game/table/save/txffc', 'Back\GameTables\SaveGameOddsController@txffc'); // 腾讯分分彩
    Route::post('/game/table/save/qqffc', 'Back\GameTables\SaveGameOddsController@qqffc'); // QQ分分彩
    Route::post('/game/table/save/msqxc', 'Back\GameTables\SaveGameOddsController@msqxc'); // 秒速七星彩
    Route::post('/game/table/save/kssc', 'Back\GameTables\SaveGameOddsController@kssc'); // 快速赛车
    Route::post('/game/table/save/ksft', 'Back\GameTables\SaveGameOddsController@ksft'); // 快速飞艇
    Route::post('/game/table/save/ksssc', 'Back\GameTables\SaveGameOddsController@ksssc'); // 快速时时彩
    Route::post('/game/table/save/xyft', 'Back\GameTables\SaveGameOddsController@xyft'); // 幸运飞艇
    Route::post('/game/table/save/twxyft', 'Back\GameTables\SaveGameOddsController@twxyft'); // 台灣幸運飛艇
    Route::post('/game/table/save/sfsc', 'Back\GameTables\SaveGameOddsController@sfsc'); // 三分赛车
    Route::post('/game/table/save/sfssc', 'Back\GameTables\SaveGameOddsController@sfssc'); // 三分时时彩
    Route::post('/game/table/save/jslhc', 'Back\GameTables\SaveGameOddsController@jslhc'); // 极速六合彩
    Route::post('/game/table/save/sflhc', 'Back\GameTables\SaveGameOddsController@sflhc'); // 三分六合彩


    //保存设置的代理赔率表
    Route::post('/game/table/agent/odds/save/{gameId}/{agentId}', 'Back\GameTables\SaveGameOddsController@agentOddsAgent')->middleware(['check-permission','add-log-handle'])->name('game.agent.agentOddsAgent');
    //重置设置的代理赔率表
    Route::post('/game/table/agent/odds/restore/{gameId}/{agentId}', 'Back\GameTables\SaveGameOddsController@agentOddsRestore')->middleware(['check-permission','add-log-handle'])->name('game.agent.agentOddsRestore');

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
    Route::post('/game/trade/table/save/qqffc','Back\GameTradeTables\SaveGameTradeController@qqffc'); //保存QQ分分彩
    Route::post('/game/trade/table/save/xyft','Back\GameTradeTables\SaveGameTradeController@xyft'); //保存幸运飞艇
    Route::post('/game/trade/table/save/kssc','Back\GameTradeTables\SaveGameTradeController@kssc'); //保存快速赛车
    Route::post('/game/trade/table/save/ksft','Back\GameTradeTables\SaveGameTradeController@ksft'); //保存快速飞艇
    Route::post('/game/trade/table/save/ksssc','Back\GameTradeTables\SaveGameTradeController@ksssc'); //保存快速时时彩
    Route::post('/game/trade/table/save/twxyft','Back\GameTradeTables\SaveGameTradeController@twxyft'); //保存台湾幸运飞艇
    Route::post('/game/trade/table/save/sfsc','Back\GameTradeTables\SaveGameTradeController@sfsc'); //保存三分赛车
    Route::post('/game/trade/table/save/sfssc','Back\GameTradeTables\SaveGameTradeController@sfssc'); //保存三分时时彩
    Route::post('/game/trade/table/save/jslhc','Back\GameTradeTables\SaveGameTradeController@jslhc'); //保存极速六合彩
    Route::post('/game/trade/table/save/sflhc','Back\GameTradeTables\SaveGameTradeController@sflhc'); //保存三分六合彩

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

//二维码显示
    Route::get('/QrCode/show', 'Common\QrCodeController@show');
//后台状态轮询
    Route::get('/back/status', 'Back\AjaxStatusController@status');
//后台获取开奖--接口
    Route::get('/back/openData/{type}/{date}/{issue}', 'Back\OpenData\OpenApiGetController@open');
//后台获取北京PK10开奖--接口
//    Route::get('/back/openData/bjpk10/{date}/{issue}', 'Back\OpenData\OpenApiGetController@bjpk10');
//注单明细获取开奖历史
    Route::get('/ajax/openHistory/{gameId}/{issue}/{gameName}', 'Back\SrcViewController@BetListOpenHistory');
//自动提款异步回调地址
    Route::post('/pay/withdrawal/callback', 'Back\CallbackController@withdrawal');
//总后台每日接受参数
    Route::post('/obtain/base/callback/{action}', 'Obtain\BaseController@callback');
//admin账号登录
    Route::post('/obtain/login/doAction', 'Obtain\LoginController@doAction');
});
