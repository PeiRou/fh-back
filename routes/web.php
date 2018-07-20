<?php
Route::get('/','Home\IndexController@index')->middleware('mobile-check');

Route::get('/getCaptcha',function(){});

Route::get('/src/agent','Back\SrcViewController@AgentLogin'); // 代理登录页面
Route::get('/back/control','Back\SrcViewController@AdminLogin')->name('back.login')->middleware('domain-check'); // 管理登录页面

Route::group(['prefix' => 'back/control/','middleware' => ['domain-check','add-log-handle']],function (){
    Route::get('dash',['uses'=>'Back\SrcViewController@Dash','as'=>'dash']); // 控制台
});

//用户管理
Route::group(['prefix' => 'back/control/userManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
    Route::get('general_agent','Back\SrcViewController@generalAgent')->name('m.gAgent'); // 总代理
    Route::get('agent','Back\SrcViewController@agent')->name('m.agent'); // 代理
    Route::get('user','Back\SrcViewController@user')->name('m.user'); // 用户
    Route::get('onlineUser','Back\SrcViewController@onlineUser')->name('m.onlineUser'); // 在线会员
    Route::get('sub_account','Back\SrcViewController@subAccount')->name('m.subAccount'); // 子账号
    Route::get('userBetList/{userId}','Back\SrcViewController@userBetList')->name('m.user.viewDetails'); //用户注单明细
});
//财务管理
Route::group(['prefix' => 'back/control/financeManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
    Route::get('rechargeRecord','Back\SrcViewController@rechargeRecord')->name('finance.rechargeRecord'); // 充值记录
    Route::get('drawingRecord','Back\SrcViewController@drawingRecord')->name('finance.drawingRecord'); // 充值记录
    Route::get('capitalDetails','Back\SrcViewController@capitalDetails')->name('finance.capitalDetails'); // 资金明细
    Route::get('memberReconciliation','Back\SrcViewController@memberReconciliation')->name('finance.memberReconciliation'); // 会员对账
    Route::get('agentReconciliation','Back\SrcViewController@agentReconciliation')->name('finance.agentReconciliation'); // 代理对账
});
//报表管理
Route::group(['prefix' => 'back/control/reportManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
    Route::get('gagent','Back\SrcViewController@reportGagent')->name('report.gAgent'); // 总代理报表
    Route::get('agent','Back\SrcViewController@reportAgent')->name('report.agent'); // 代理报表
    Route::get('user','Back\SrcViewController@reportUser')->name('report.user'); // 会员报表
    Route::get('online','Back\SrcViewController@reportOnline')->name('report.online'); // 在线报表
});
//投注记录
Route::group(['prefix' => 'back/control/betManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
    Route::get('today','Back\SrcViewController@betTodaySearch')->name('bet.todaySearch'); // 今日注单搜索
    Route::get('history','Back\SrcViewController@betHistorySearch')->name('bet.historySearch'); // 历史注单搜索
    Route::get('realTime','Back\SrcViewController@betRealTime')->name('bet.betRealTime'); // 实时滚单
});
//公告管理
Route::group(['prefix' => 'back/control/noticeManage','middleware'=>['check-permission','domain-check','add-log-handle']],function (){
    Route::get('setting','Back\SrcViewController@noticeSetting')->name('notice.noticeSetting'); // 公告设置
    Route::get('sendMessage','Back\SrcViewController@messageSend')->name('notice.messageSend'); // 消息推送
});

//游戏管理
Route::group(['prefix' => 'back/control/gameManage','middleware'=>['check-permission','domain-check','add-log-handle']],function () {
    Route::get('gameSetting','Back\SrcViewController@gameSetting')->name('game.gameSetting'); //游戏设定
    Route::get('handicapSetting','Back\SrcViewController@handicapSetting')->name('game.handicapSetting'); //盘口设定
});

//开奖管理
Route::group(['prefix' => 'back/control/openManage','middleware'=>['check-permission','domain-check','add-log-handle']],function () {
    Route::get('cqssc','Back\SrcViewController@openManage_cqssc')->name('historyLottery.cqssc'); //重庆时时彩
    Route::get('bjpk10','Back\SrcViewController@openManage_bjpk10')->name('historyLottery.bjpk10'); //北京pk10
    Route::get('bjkl8','Back\SrcViewController@openManage_bjkl8')->name('historyLottery.bjkl8'); //北京快乐8
    Route::get('lhc','Back\SrcViewController@openManage_xglhc')->name('historyLottery.xglhc'); //六合彩
    Route::get('xylhc','Back\SrcViewController@openManage_xylhc')->name('historyLottery.xylhc'); //幸运六合彩
});

//系统管理
Route::group(['prefix' => 'back/control/systemManage','middleware'=>['check-permission','domain-check','add-log-handle']],function () {
    Route::get('permissions','Back\SrcViewController@Permissions')->name('system.permission'); //权限管理
    Route::get('role','Back\SrcViewController@role')->name('system.role');  //角色管理
    Route::get('systemSetting','Back\SrcViewController@systemSetting')->name('system.systemSetting'); //系统参数配置
    Route::get('articleManage','Back\SrcViewController@articleManage')->name('system.articleManage'); //文章管理
});

//日志管理
Route::group(['prefix' => 'back/control/logManage','middleware'=>['check-permission','domain-check','add-log-handle']],function () {
    Route::get('login','Back\SrcViewController@loginLog')->name('log.login'); //登录日志
    Route::get('handle','Back\SrcViewController@handleLog')->name('log.handle'); //操作日志
    Route::get('abnormal','Back\SrcViewController@abnormalLog')->name('log.abnormal'); //异常日志
});

//代理结算
Route::group(['prefix' => 'back/control/agentSettle','middleware'=>['check-permission','domain-check']],function () {
    Route::get('report','Back\SrcViewController@agentSettleReport')->name('agentSettle.report');    //代理结算报表
    Route::get('review','Back\SrcViewController@agentSettleReview')->name('agentSettle.review');    //代理结算审核
    Route::get('draw','Back\SrcViewController@agentSettleDraw')->name('agentSettle.draw');          //代理提款
    Route::get('setting','Back\SrcViewController@agentSettleSetting')->name('agentSettle.setting'); //代理结算配置
});

//充值配置
Route::group(['prefix' => 'back/control/payManage','middleware'=>['check-permission','domain-check','add-log-handle']],function () {
    Route::get('payOnline','Back\SrcViewController@payOnline')->name('pay.online'); //在线支付配置
    Route::get('payBank','Back\SrcViewController@payBank')->name('pay.bank'); //银行支付配置
    Route::get('payAlipay','Back\SrcViewController@payAlipay')->name('pay.alipay'); //支付宝支付配置
    Route::get('payWechat','Back\SrcViewController@payWechat')->name('pay.wechat'); //微信支付配置
    Route::get('payCft','Back\SrcViewController@payCft')->name('pay.cft'); //财付通支付配置
    Route::get('bindBank','Back\SrcViewController@bindBank')->name('pay.bindBank'); //绑定银行配置
    Route::get('payLayout','Back\SrcViewController@payLayout')->name('pay.payLayout'); //支付层级配置
    Route::get('rechargeWay','Back\SrcViewController@rechargeWay')->name('pay.rechargeWay'); //支付层级配置
});

//下拉菜单
Route::group(['middleware'=>['add-log-handle']],function(){
    Route::get('/today/selectData/playCate/{gameId?}','Back\SrcViewController@playCate')->name('select.playCate'); // 下拉菜单获取玩法分类
    Route::get('/recharge/selectData/payOnline/{rechargeType?}','Back\SrcViewController@payOnlineSelectData')->name('select.payOnlineSelectData'); // 下拉菜单获取在线支付分类
    Route::get('/recharge/selectData/dateChange/{date?}','Back\SrcViewController@payOnlineDateChange')->name('select.payOnlineDateChange'); // 下拉菜单获取今日，昨日，上周
});

Route::get('/back/datatables/subaccount','Back\Data\MembersDataController@subAccounts');
Route::get('/back/datatables/generalAgent','Back\Data\MembersDataController@generalAgent');
Route::get('/back/datatables/agent','Back\Data\MembersDataController@agent');
Route::get('/back/datatables/agentCapital/{id}','Back\Data\MembersDataController@agentCapital');
Route::get('/back/datatables/userCapital/{id}','Back\Data\MembersDataController@userCapital');
Route::get('/back/datatables/user','Back\Data\MembersDataController@user');
Route::get('/back/datatables/premissions','Back\Data\SystemDataController@permissions');
Route::get('/back/datatables/roles','Back\Data\SystemDataController@roles');
Route::get('/back/datatables/bank','Back\Data\PayDataController@bank');
Route::get('/back/datatables/games','Back\Data\GameDataController@games');
Route::get('/back/datatables/onlineUser','Back\Data\MembersDataController@onlineUser');
Route::get('/back/datatables/rechargeRecord','Back\Data\FinanceDataController@rechargeRecord');
Route::get('/back/datatables/drawingRecord','Back\Data\FinanceDataController@drawingRecord');
Route::get('/back/datatables/capitalDetails','Back\Data\FinanceDataController@capitalDetails'); //会员报表
Route::get('/back/datatables/memberReconciliation','Back\Data\FinanceDataController@memberReconciliation');
Route::get('/back/datatables/agentReconciliation','Back\Data\FinanceDataController@agentReconciliation');
Route::get('/back/datatables/reportGagent','Back\Data\ReportDataController@Gagent');
Route::get('/back/datatables/reportAgent','Back\Data\ReportDataController@Agent');
Route::get('/back/datatables/reportUser','Back\Data\ReportDataController@User');
Route::get('/back/datatables/reportTotal','Back\Data\ReportDataController@Total');
Route::get('/back/datatables/betToday','Back\Data\BetDataController@betToday');
Route::get('/back/datatables/betHistory','Back\Data\BetDataController@betHistory');
Route::get('/back/datatables/betRealTime','Back\Data\BetDataController@betRealTime');
Route::get('/back/datatables/notice','Back\Data\NoticeDataController@notice');
Route::get('/back/datatables/level','Back\Data\PayDataController@level');
Route::get('/back/datatables/rechargeWay','Back\Data\PayDataController@rechargeWay');
Route::get('/back/datatables/payOnline','Back\Data\PayDataController@payOnline');
Route::get('/back/datatables/payBank','Back\Data\PayDataController@payBank');
Route::get('/back/datatables/payAlipay','Back\Data\PayDataController@payAlipay');
Route::get('/back/datatables/payWechat','Back\Data\PayDataController@payWechat');
Route::get('/back/datatables/payCft','Back\Data\PayDataController@payCft');
Route::get('/back/datatables/article','Back\Data\ArticleController@article');
Route::get('/back/datatables/userBetSearch','Back\Data\BetDataController@userBetSearch');
Route::get('/back/datatables/log/login','Back\Data\LogDataController@login'); //登录日志
Route::get('/back/datatables/logHandle','Back\Data\LogDataController@logHandle'); //操作日志
Route::get('/back/datatables/openHistory/cqssc','Back\Data\openHistoryController@cqssc'); //历史开奖 - 重庆时时彩
Route::get('/back/datatables/openHistory/bjpk10','Back\Data\openHistoryController@bjpk10'); //历史开奖 - 北京PK10
Route::get('/back/datatables/openHistory/bjkl8','Back\Data\openHistoryController@bjkl8'); //历史开奖 - 北京快乐8
Route::get('/back/datatables/openHistory/lhc','Back\Data\openHistoryController@lhc'); //历史开奖 - 六合彩

//action
Route::post('/action/admin/login','Back\SrcAccountController@login');
Route::post('/action/admin/logout','Back\SrcAccountController@logout');

Route::post('/action/admin/addGeneralAgent','Back\SrcMemberController@addGeneralAgent');//添加总代理
Route::post('/action/admin/editGeneralAgent','Back\SrcMemberController@editGeneralAgent');//修改总代理

Route::post('/action/admin/addSubAccount','Back\SrcMemberController@addSubAccount');//添加子账号
Route::post('/action/admin/editSubAccount','Back\SrcMemberController@editSubAccount');//修改子账号
Route::post('/action/admin/delSubAccount','Back\SrcMemberController@delSubAccount');//删除子账号
Route::post('/action/admin/changeGoogleCode','Back\SrcMemberController@changeGoogleCode');//更换子账号的google验证码

Route::post('/action/admin/addAgent','Back\SrcMemberController@addAgent');//添加代理账号
Route::post('/action/admin/editAgent','Back\SrcMemberController@editAgent');//修改代理账号
Route::post('/action/admin/delAgent/{id}','Back\SrcMemberController@delAgent')->middleware('check-permission')->name('m.agent.del');//删除代理账号
Route::post('/action/admin/changeAgentMoney','Back\SrcMemberController@changeAgentMoney');//修改代理金额

Route::post('/action/admin/addUser','Back\SrcMemberController@addUser');//添加会员
Route::post('/action/admin/userChangeAgent','Back\SrcMemberController@userChangeAgent');//会员更换代理
Route::post('/action/admin/userChangeFullName','Back\SrcMemberController@userChangeFullName');//会员更换真实姓名
Route::post('/action/admin/editUser','Back\SrcMemberController@editUser');//修改会员资料
Route::post('/action/admin/changeUserMoney','Back\SrcMemberController@changeUserMoney');//修改会员余额
Route::post('/action/admin/delUser/{id}','Back\SrcMemberController@delUser')->middleware('check-permission')->name('m.user.delUser');//删除会员账号
Route::post('/action/admin/editUserLevels','Back\SrcMemberController@editUserLevels');//删除会员账号
Route::post('/action/admin/getOutUser','Back\SrcMemberController@getOutUser');//会员踢下线
Route::post('/action/userMoney/totalUserMoney','Back\SrcMemberController@totalUserMoney');//会员总余额统计

Route::post('/action/admin/addPermission','Back\PermissionController@addPermission')->name('addPermission'); //添加权限
Route::post('/action/admin/addNewRole','Back\RoleController@addNewRole');//添加角色
Route::post('/action/admin/systemSetting/edit','Back\SystemSettingController@editSystemSetting');//编辑系统设置
Route::post('/action/admin/addArticle','Back\SystemSettingController@addArticle');//添加文章
Route::post('/action/admin/delArticle','Back\SystemSettingController@delArticle');//删除文章
Route::post('/action/admin/editArticle','Back\SystemSettingController@editArticle');//修改文章

Route::post('/action/admin/addNotice','Back\SrcNoticeController@addNotice'); //添加公告
Route::post('/action/admin/delNoticeSetting','Back\SrcNoticeController@delNoticeSetting'); //添加公告

Route::post('/action/admin/addBank','Back\SrcPayController@addBank');//添加银行
Route::post('/action/admin/addLevel','Back\SrcPayController@addLevel');//添加层级
Route::post('/action/admin/editLevel','Back\SrcPayController@editLevel');//修改层级
Route::post('/action/admin/delLevelCheck','Back\SrcPayController@delLevelCheck');//删除层级检查
Route::post('/action/admin/delLevel','Back\SrcPayController@delLevel');//删除层级
Route::post('/action/admin/allExchangeLevel','Back\SrcPayController@allExchangeLevel');//层级全部转移
Route::post('/action/admin/addRechargeWay','Back\SrcPayController@addRechargeWay');//添加充值方式
Route::post('/action/admin/editRechargeWay','Back\SrcPayController@editRechargeWay');//添加充值方式
Route::post('/action/admin/changeOnlinePayStatus','Back\SrcPayController@changeOnlinePayStatus');//改变充值方式状态
Route::post('/action/admin/delOnlinePay','Back\SrcPayController@delOnlinePay');//删除充值方式
Route::post('/action/admin/delRechargeWay','Back\SrcPayController@delRechargeWay');//删除充值方式
Route::post('/action/admin/addPayOnline','Back\SrcPayController@addPayOnline');//添加在线支付配置
Route::post('/action/admin/editPayOnline','Back\SrcPayController@editPayOnline');//修改在线支付配置
Route::post('/action/admin/addPayBank','Back\SrcPayController@addPayBank');//添加银行支付配置
Route::post('/action/admin/editPayBank','Back\SrcPayController@editPayBank');//修改银行支付配置
Route::post('/action/admin/addPayAlipay','Back\SrcPayController@addPayAlipay');//添加支付宝配置
Route::post('/action/admin/editPayAlipay','Back\SrcPayController@editPayAlipay');//修改支付宝配置
Route::post('/action/admin/addPayWechat','Back\SrcPayController@addPayWechat');//添加微信配置
Route::post('/action/admin/editPayWechat','Back\SrcPayController@editPayWechat');//修改微信配置
Route::post('/action/admin/addPayCft','Back\SrcPayController@addPayCft');//添加财付通配置
Route::post('/action/admin/editPayCft','Back\SrcPayController@editPayCft');//修改财付通配置

Route::post('/action/admin/editGameSetting','Back\SrcGameController@editGameSetting');//修改游戏设定
Route::post('/action/admin/changeGameFengPan','Back\SrcGameController@changeGameFengPan');//修改游戏开封盘状态
Route::post('/action/admin/changeGameStatus','Back\SrcGameController@changeGameStatus');//修改游戏开启和停用状态
Route::post('/action/admin/saveOddsRebate','Back\SrcGameController@saveOddsRebate');//修改游戏开启和停用状态

Route::post('/action/admin/passRecharge','Back\RechargeController@passRecharge'); //通过充值申请
Route::post('/action/admin/passOnlineRecharge','Back\RechargeController@passOnlineRecharge'); //通过在线充值申请
Route::post('/action/admin/addRechargeError','Back\RechargeController@addRechargeError'); //驳回充值申请

Route::post('/action/admin/passDrawing','Back\DrawingController@passDrawing'); //通过提款申请
Route::post('/action/admin/addDrawingError','Back\DrawingController@addDrawingError'); //驳回提款申请

Route::post('/action/recharge/totalRecharge','Back\RechargeController@totalRecharge'); //充值记录的总额统计
Route::post('/action/drawing/totalDrawing','Back\DrawingController@totalDrawing'); //提款记录的总额统计

Route::post('/action/userBetList/total','Back\SrcViewController@userBetListTotal'); //用户注单页面下注统计

Route::post('/action/admin/addLhcNewIssue','Back\OpenHistoryController@addLhcNewIssue');
Route::post('/action/admin/editLhcNewIssue','Back\OpenHistoryController@editLhcNewIssue');

Route::post('/action/admin/openCqssc','Back\OpenHistoryController@addCqsscData');     //添加重庆时时彩开奖数据
Route::post('/action/admin/openBjpk10','Back\OpenHistoryController@addBjpk10Data');     //添加北京PK10开奖数据
Route::post('/action/admin/openBjkl8','Back\OpenHistoryController@addBjkl8Data');     //添加北京快乐8开奖数据
Route::post('/action/admin/openLhc','Back\OpenHistoryController@addLhcData');
Route::post('/action/admin/reOpenLhc','Back\OpenHistoryController@reOpenLhcData');

//Modal
Route::get('/back/modal/addPermission','Back\Ajax\ModalController@addPermission');
Route::get('/back/modal/addRole','Back\Ajax\ModalController@addRole');
Route::get('/back/modal/addSubAccount','Back\Ajax\ModalController@addSubAccount')->middleware('check-permission')->name('m.subAccount.add');
Route::get('/back/modal/editSubAccount/{id}','Back\Ajax\ModalController@editSubAccount')->middleware('check-permission')->name('m.subAccount.edit');
Route::get('/back/modal/googleSubAccount/{id}','Back\Ajax\ModalController@googleSubAccount')->middleware('check-permission')->name('m.subAccount.googleOTP');
Route::get('/back/modal/addGeneralAgent','Back\Ajax\ModalController@addGeneralAgent')->middleware('check-permission')->name('m.gAgent.add');
Route::get('/back/modal/editGeneralAgent/{id}','Back\Ajax\ModalController@editGeneralAgent')->middleware('check-permission')->name('m.gAgent.edit');
Route::get('/back/modal/addAgent','Back\Ajax\ModalController@addAgent')->middleware('check-permission')->name('m.agent.add');
Route::get('/back/modal/editAgent/{id}','Back\Ajax\ModalController@editAgent')->middleware('check-permission')->name('m.agent.edit');
Route::get('/back/modal/agentInfo/{id}','Back\Ajax\ModalController@agentInfo')->middleware('check-permission')->name('m.agent.viewDetails');
Route::get('/back/modal/agentContent/{id}','Back\Ajax\ModalController@agentContent')->middleware('check-permission')->name('m.agent.viewDetails');
Route::get('/back/modal/changeAgentMoney/{id}','Back\Ajax\ModalController@changeAgentMoney')->middleware('check-permission')->name('m.agent.editMoney');
Route::get('/back/modal/agentCapitalHistory/{id}','Back\Ajax\ModalController@agentCapitalHistory')->middleware('check-permission')->name('m.agent.capitalDetails');
Route::get('/back/modal/addBank','Back\Ajax\ModalController@addBank');
Route::get('/back/modal/addUser','Back\Ajax\ModalController@addUser')->middleware('check-permission')->name('m.user.add');
Route::get('/back/modal/userChangeAgent/{id}','Back\Ajax\ModalController@userChangeAgent')->middleware('check-permission')->name('m.user.changeAgent');
Route::get('/back/modal/userChangeFullName/{id}','Back\Ajax\ModalController@userChangeFullName')->middleware('check-permission')->name('m.user.editTrueName');
Route::get('/back/modal/viewUserInfo/{id}','Back\Ajax\ModalController@viewUserInfo')->middleware('check-permission')->name('m.user.viewDetails');
Route::get('/back/modal/editUserInfo/{id}','Back\Ajax\ModalController@editUserInfo')->middleware('check-permission')->name('m.user.edit');
Route::get('/back/modal/viewUserContent/{id}','Back\Ajax\ModalController@viewUserContent')->middleware('check-permission')->name('m.user.viewDetails');
Route::get('/back/modal/changeUserMoney/{id}','Back\Ajax\ModalController@changeUserMoney')->middleware('check-permission')->name('m.user.changeBalance');
Route::get('/back/modal/userCapitalHistory/{id}','Back\Ajax\ModalController@userCapitalHistory')->middleware('check-permission')->name('m.user.viewDetails');
Route::get('/back/modal/addNotice','Back\Ajax\ModalController@addNotice');
Route::get('/back/modal/addLevel','Back\Ajax\ModalController@addLevel');
Route::get('/back/modal/editLevel/{id}','Back\Ajax\ModalController@editLevel');
Route::get('/back/modal/allExchangeLevel/{id}','Back\Ajax\ModalController@allExchangeLevel');
Route::get('/back/modal/addRechargeWay','Back\Ajax\ModalController@addRechargeWay');
Route::get('/back/modal/editRechargeWay/{id}','Back\Ajax\ModalController@editRechargeWay');
Route::get('/back/modal/addPayOnline','Back\Ajax\ModalController@addPayOnline');
Route::get('/back/modal/editPayOnline/{id}','Back\Ajax\ModalController@editPayOnline');
Route::get('/back/modal/addPayBank','Back\Ajax\ModalController@addPayBank');
Route::get('/back/modal/editPayBank/{id}','Back\Ajax\ModalController@editPayBank');
Route::get('/back/modal/addPayAlipay','Back\Ajax\ModalController@addPayAlipay');
Route::get('/back/modal/editPayAlipay/{id}','Back\Ajax\ModalController@editPayAlipay');
Route::get('/back/modal/addPayWechat','Back\Ajax\ModalController@addPayWechat');
Route::get('/back/modal/editPayWechat/{id}','Back\Ajax\ModalController@editPayWechat');
Route::get('/back/modal/addPayCft','Back\Ajax\ModalController@addPayCft');
Route::get('/back/modal/editPayCft/{id}','Back\Ajax\ModalController@editPayCft');
Route::get('/back/modal/addArticle','Back\Ajax\ModalController@addArticle');
Route::get('/back/modal/editArticle/{id}','Back\Ajax\ModalController@editArticle');
Route::get('/back/modal/editUserLevels/{uid}/{nowLevels}','Back\Ajax\ModalController@editUserLevels');
Route::get('/back/modal/rechargeError/{id}','Back\Ajax\ModalController@rechargeError');
Route::get('/back/modal/drawingError/{id}','Back\Ajax\ModalController@drawingError');
Route::get('/back/modal/user48hoursInfo/{uid}','Back\Ajax\ModalController@user48hoursInfo');
Route::get('/back/modal/addLhcNewIssue','Back\Ajax\ModalController@addLhcNewIssue');
Route::get('/back/modal/editLhcNewIssue/{id}','Back\Ajax\ModalController@editLhcNewIssue');
Route::get('/back/modal/openCqssc/{id}','Back\Ajax\ModalController@openCqssc');             //重庆时时彩
Route::get('/back/modal/openBjpk10/{id}','Back\Ajax\ModalController@openBjpk10');           //北京PK10
Route::get('/back/modal/openBjkl8/{id}','Back\Ajax\ModalController@openBjkl8');             //北京快乐8
Route::get('/back/modal/openLhc/{id}','Back\Ajax\ModalController@openLhc');
Route::get('/back/modal/reOpenLhc/{id}','Back\Ajax\ModalController@reOpenLhc');

//游戏MODAL
Route::get('/back/modal/gameSetting/{id}','Back\Ajax\ModalController@gameSetting');

Route::get('/web/api/select2/agents','Back\Api\ApiController@agents');
Route::post('/web/api/check/user/username','Back\Api\ApiController@checkUserUsername');

Route::get('/game/tables/50','Back\GameTableController@gameTable50');
Route::get('/game/tables/1','Back\GameTableController@gameTable1');
Route::get('/game/tables/4','Back\GameTableController@gameTable4');
Route::get('/game/tables/5','Back\GameTableController@gameTable5');
Route::get('/game/tables/60','Back\GameTableController@gameTable60');
Route::get('/game/tables/10','Back\GameTableController@gameTable10');
Route::get('/game/tables/61','Back\GameTableController@gameTable61');
Route::get('/game/tables/65','Back\GameTableController@gameTable65');
Route::get('/game/tables/21','Back\GameTableController@gameTable21'); //广东十一选五
Route::get('/game/tables/66','Back\GameTableController@gameTable66'); //PC蛋蛋
Route::get('/game/tables/30','Back\GameTableController@gameTable30'); //福彩3D
Route::get('/game/tables/80','Back\GameTableController@gameTable80'); //秒速赛车
Route::get('/game/tables/82','Back\GameTableController@gameTable82'); //秒速飞艇
Route::get('/game/tables/81','Back\GameTableController@gameTable81'); //秒速时时彩
Route::get('/game/tables/99','Back\GameTableController@gameTable99'); //跑马
Route::get('/game/tables/70','Back\GameTableController@gameTable70'); //六合彩
Route::get('/game/tables/85','Back\GameTableController@gameTable85'); //幸运六合彩
//保存游戏赔率表格数据
Route::post('/game/table/save/bjpk10','Back\GameTables\SaveGameOddsController@bjpk10');
Route::post('/game/table/save/cqssc','Back\GameTables\SaveGameOddsController@cqssc');
Route::post('/game/table/save/xjssc','Back\GameTables\SaveGameOddsController@xjssc');
Route::post('/game/table/save/tjssc','Back\GameTables\SaveGameOddsController@tjssc');
Route::post('/game/table/save/gdklsf','Back\GameTables\SaveGameOddsController@gdklsf');
Route::post('/game/table/save/jsk3','Back\GameTables\SaveGameOddsController@jsk3');
Route::post('/game/table/save/cqxync','Back\GameTables\SaveGameOddsController@cqxync');
Route::post('/game/table/save/bjkl8','Back\GameTables\SaveGameOddsController@bjkl8');
Route::post('/game/table/save/fc3d','Back\GameTables\SaveGameOddsController@fc3d');
Route::post('/game/table/save/gd11x5','Back\GameTables\SaveGameOddsController@gd11x5');
Route::post('/game/table/save/pcdd','Back\GameTables\SaveGameOddsController@pcdd');
Route::post('/game/table/save/mssc','Back\GameTables\SaveGameOddsController@mssc');
Route::post('/game/table/save/msft','Back\GameTables\SaveGameOddsController@msft');
Route::post('/game/table/save/msssc','Back\GameTables\SaveGameOddsController@msssc');
Route::post('/game/table/save/paoma','Back\GameTables\SaveGameOddsController@paoma');
Route::post('/game/table/save/lhc','Back\GameTables\SaveGameOddsController@lhc');
Route::post('/game/table/save/xylhc','Back\GameTables\SaveGameOddsController@xylhc');

//error
Route::get('/error/403',function (){
    return view('403');
})->name('error.403');

//内部调试
Route::get('/inner/playCate','Inner\innerController@playCate');
Route::get('inner/play','Inner\innerController@play');
//内部测试调试
Route::post('/action/inner/playCate','Inner\innerActionController@playCate');
Route::post('/action/inner/play','Inner\innerActionController@play');
Route::post('/action/inner/getPlayCateItem','Inner\innerActionController@getPlayCateItem');
Route::get('/tttt/test','Inner\TestController@lhc');

//后台状态轮询
Route::get('/back/status','Back\AjaxStatusController@status');
//后台获取六合彩开奖--接口
Route::get('/back/openData/lhc/{date}/{issue}','Back\OpenData\OpenApiGetController@lhc');
//后台获取北京PK10开奖--接口
Route::get('/back/openData/bjpk10/{date}/{issue}','Back\OpenData\OpenApiGetController@bjpk10');
//注单明细获取开奖历史
Route::get('/ajax/openHistory/{gameId}/{issue}','Back\SrcViewController@BetListOpenHistory');