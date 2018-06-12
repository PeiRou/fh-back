angular.module('ionicz.bank')

    .controller('BankBaseCtrl', function($rootScope, $scope, $log, Tools, My, $ionicHistory, $location, PATH) {
        $log.debug("BankBaseCtrl...");

        $scope.back = function() {
            var backView = $ionicHistory.viewHistory().backView;
            if(!backView) {
                $location.path('/ucenter/index');
            }
            else {
                $location.path(backView.url);
            }
        };

        $scope.getBank = function(callback) {
            Tools.ajax({
                method: 'GET',
                url: '/api/user/getUserBank',
                success: function(data) {
                    if (data) {
                        My.setBank(data);
                    }
                    if (angular.isFunction(callback)) {
                        callback();
                    }
                }
            });
        };
        $scope.parseIntMoney = function(t) {
            t.target.value = parseInt(t.target.value);
            if ("NaN" == t.target.value) {
                t.target.value="";
            }
            return t.target.value;
        };

        $scope.parseFloatMoneyInDepositPage = function(t) {
            t.target.value = t.target.value.replace(/[^0-9.]/g, "");
            if (!(parseFloat(t.target.value) > 0 &&  (/^\d+\.?\d{0,2}$/.test(t.target.value)) ) ) {
                t.target.value = parseFloat(t.target.value).toFixed(2);
            }
            if ("NaN" == t.target.value) {
                t.target.value="";
            }
        };

        var __moneyLimit = {};
        $scope.setMoneyLimit = function(moneyLimit) {
            __moneyLimit = moneyLimit;
        };

        $scope.checkDepositMoney = function(payData, rechType) {
            var s = payData.depositMoney.charAt(payData.depositMoney.length - 1);
            if (s == ".") {
                payData.depositMoney = payData.depositMoney.substring(0, payData.depositMoney.length - 1);
            }

            if(!/^\d+\.?\d{0,2}$/.test(payData.depositMoney)){
                Tools.tip("请输入正确的金额");
                return false;
            }

            var money = parseFloat(payData.depositMoney);
            var payWay = payData.payWay || payData.bankObj;
            var mixMoney = payWay.minMoney;
            var maxMoney = payWay.maxMoney;

            if (money < mixMoney) {
                Tools.tip("充值金额不能小于" + mixMoney);
                return false;
            }
            if (money > maxMoney) {
                Tools.tip("充值金额不能大于" + maxMoney);
                return false;
            }
            return true;
        };
    })

    .controller('BankController', function($scope, $log, Tools, My, UCenter) {
        $log.debug("银行账号: BankController..." );
        $scope.bankIcon = {
            "工商银行":"ico-icbc",
            "建设银行":"ico-ccb",
            "农业银行":"ico-abc",
            "交通银行":"ico-bcm",
            "中国银行":"ico-boc",
            "光大银行":"ico-ceb",
            "民生银行":"ico-cmbc",
            "邮政银行":"ico-psbc",
            "招商银行":"ico-cmb",
            "兴业银行":"ico-cib",
            "中信银行":"ico-cncb",
            "广发银行":"ico-cgb",
            "浦发银行":"ico-spdb",
            "华夏银行":"ico-hxb",
            "平安银行":"ico-pingan",
            "上海银行":"ico-bos",
            "农商银行":"ico-rcb",
            "农村信用社":"ico-rcb"
        };
        $scope.rechBankArray = [];

        $scope.$on('$ionicView.beforeEnter', function(event, viewData) {
            initRechBank();
            $scope.bankInit();
        });

        var initRechBank = function(){
            var rechBanks = PARAM_CFG["rech_bank"];
            for(var i in rechBanks) {
                var b=rechBanks[i];
                if(b.open==1){
                    continue;
                }
                $scope.rechBankArray.push(b);
            }
        }

        $scope.bankInit = function() {
            if (UCenter.checkFundPwd()) {
                if (My.hasBankMsg()) {
                    $scope.setStep(1); // 可以展示银行卡信息
                    return;
                }
                $scope.getBank($scope.bankPageGetBankCallback);
            }
        };
        $scope.bankPageGetBankCallback = function() {
            if (My.hasBankMsg()) {
                $scope.setStep(1);
            } else {
                $scope.setStep(0);
            }
        };

        $scope.addBank = function() {
            if (!My.getFullName()) {
                UCenter.addRealName('完善个人信息');
                return;
            }
            $scope.setStep(2);
        };
        $scope.mdfBankData = {};
        $scope.bindBank = function() {
            Tools.ajax({
                method: 'POST',
                url: '/api/user/bindBank',
                params: {
                    bankName : $scope.mdfBankData.bankName,
                    cardNo : $scope.mdfBankData.cardNo,
                    subAddress : $scope.mdfBankData.address
                },
                success : function(result) {
                    if(result.status === true){
                        var tip = '成功添加银行信息';
                        if ($scope.step == 3) {
                            tip = '成功修改银行信息';
                        }
                        Tools.tip(tip);
                        My.setBandDesc($scope.mdfBankData.bankName, $scope.mdfBankData.address, $scope.mdfBankData.cardNo);
                        $scope.setStep(1);
                        $scope.mdfBankData = {};
                    } else {
                        var tip = '添加银行信息失败，请联系客服';
                        Tools.tip(tip);
                    }
                }
            });
        };
        $scope.setStep = function(step) {
            $scope.step = step;
            if (step == 3) {
                $scope.mdfBankData.bankName = My.getBank().bankName;
                $scope.mdfBankData.addressTip = My.getBank().subAddress;
//			$scope.mdfBankData.address = My.getBank().subAddress;
                $scope.mdfBankData.cardNoTip = "旧卡"+My.getBank().cardNo;
//			$scope.mdfBankData.cardNo = My.getBank().cardNo;
            }
        };
    })

    .controller('WithdrawController', function($rootScope, $scope, $log, $state, My, Tools, UCenter, md5) {
        $log.debug("WithdrawCtrl...");

        $scope.$on('$ionicView.beforeEnter', function(event, viewData) {
            $scope.withdrawInit();
        });

        $scope.showRealNameModal = function(title, callback) {
            UCenter.addRealName(title, callback);
        };

        $scope.withdrawInit = function() {
            if (UCenter.checkFundPwd()) { // 取款密码
                if (!My.hasBankMsg()) {
                    $scope.getBank($scope.withdrawPageGetBankCallback);
                } else {
                    $scope.withdrawPageGetBankCallback();
                }
            }
        };
        $scope.withdrawPageGetBankCallback = function() {
            if (!My.getFullName()) {
                $scope.withdrawStep = 1; // 需要完善用户信息-真实姓名
            }
            if (My.getFullName() && !My.hasBankMsg()) {
                $scope.withdrawStep = 2; // 需要绑定银行卡
            }
            if (My.getFullName() && My.hasFundPwd() && My.hasBankMsg()) {
                $scope.withdrawStep = 3; // 可以取款，展示取款页面
            }
        }
        $scope.withdrawData = {};
        $scope.isSubmit = true;
        $scope.withDrawBalanceLimit=$rootScope.appConfig["withDrawBalanceLimit"] || 100;
        $scope.withdrawSubmit = function() {
            var amount = $scope.withdrawData.applyMoney;
            if (!amount) {
                Tools.tip("请输入提款金额！");
                return false;
            }
            amount = parseInt(amount);
            if (amount < $scope.withDrawBalanceLimit) {
                Tools.tip('提现金额不能小于'+$scope.withDrawBalanceLimit+'元');
                return false;
            }
            var drawcode = $scope.withdrawData.withdrawPwd;
            if (!drawcode) {
                Tools.tip('请输入提款密码');
                return false;
            }
            if (amount > My.getMoney()) {
                Tools.tip('余额不足');
                return false;
            }
            if(!$scope.isSubmit) {
                Tools.tip('请勿重复提交');
                return false;
            }
            $scope.isSubmit = false;
            Tools.ajax({
                method: 'POST',
                params: {amount : amount, fundPwd: md5.createHash(drawcode), fundPwdText:drawcode},
                url: '/api/bank/withdrawSubmit.do',
                success: function() {
                    Tools.tip('提现成功，请等待客服人员审核');
                    My.addMoney(-amount);
                    $scope.isSubmit = true;
                    $state.go("bank.trans", {type: 2});
                },
                error: function(data, status) {
                    Tools.tip(data.msg || '网络繁忙，请检查网络是否正常或刷新网页重试 [' + status + ']');
                    $scope.isSubmit = true;
                }
            });
        };
        $scope.parseIntMoneyInWithdrawPage = function(t) {
            $scope.withdrawData.applyMoney = $scope.parseIntMoney(t);
        };
    })

    .controller('TransController', function($rootScope, $scope, $stateParams, $timeout, $ionicModal, Tools, My) {
        $scope.type = $stateParams.type;
        $scope.RECH_STATUS = {1 : '处理中', 2 : '充值成功', 3 : '充值失败', 4 : '充值中'};
        $scope.CHECK_STATUS = {1 : '处理中', 2 : '处理中', 3 : '提现成功', 4 : '提现失败', 5 : '撤销'};
        $scope.RECH_TYPE = {"onlinePayment" : '在线充值', "weixin" : '微信转账', "alipay" : '支付宝转账', "cft" : '财付通转账', "bankTransfer" : '银行卡转账'};

        $scope.isMore = true;
        $scope.dataList = null;
        var rows = 10;

        var getPage = function() {
            if(!$scope.dataList) {
                return 1;
            }
            var length = $scope.dataList.length;
            if (length < rows) {
                return 1;
            } else {
                return parseInt(length / rows + 1);
            }
        };

        $scope.queryData = function() {
            if (!$scope.isMore) {
                return;
            }

            $scope.isMore = false;

            var url = $scope.type == 1 ? '/api/mobile/user/getRechList' : '/api/mobile/user/getWithDrawList';
            var page = getPage();

            Tools.ajax({
                method: 'GET',
                params: {page: page, rows: rows},
                url: url,
                success: function(result) {
                    if(result && result.totalCount > 0) {
                        $scope.dataList = $scope.dataList || [];
                        $scope.dataList = $scope.dataList.concat(result.data);
                        if (rows * page < result.totalCount) {
                            $timeout(function(){$scope.isMore = true;}, 1500);
                        }
                    }
                    else {
                        $scope.dataList = [];
                    }
                }
            });
            $scope.$broadcast('scroll.infiniteScrollComplete');
        };

        $scope.rechDescData = {};
        $scope.showDetail = function(item) {
            $scope.item = item;
            var templateUrl = $scope.type == 1 ? 'rech-detail.html' : 'withdraw-detail.html';
            Tools.modal({
                scope: $scope,
                title: '查看详情',
                templateUrl: templateUrl,
                callback: function(scope, popup) {
                    popup.close();
                }
            });
        };
    })

    .controller('RedpackController', function($scope, Tools, $timeout) {
        $scope.isMore = true;
        $scope.dataList = null;
        var rows = 10;

        var getPage = function() {
            if(!$scope.dataList) {
                return 1;
            }
            var length = $scope.dataList.length;
            if (length < rows) {
                return 1;
            } else {
                return parseInt(length / rows + 1);
            }
        };
        $scope.queryData = function() {
            if (!$scope.isMore) {
                return;
            }

            $scope.isMore = false;

            var url = '/api/mobile/user/getPacketList';
            var page = getPage();

            Tools.ajax({
                method: 'GET',
                params: {page: page, rows: rows},
                url: url,
                success: function(result) {
                    if(result && result.totalCount > 0) {
                        $scope.dataList = $scope.dataList || [];
                        $scope.dataList = $scope.dataList.concat(result.data);
                        if (rows * page < result.totalCount) {
                            $timeout(function(){$scope.isMore = true;}, 1500);
                        }
                    }
                    else {
                        $scope.dataList = [];
                    }
                }
            });
            $scope.$broadcast('scroll.infiniteScrollComplete');
        };
    })

    .controller('DepositController', function($scope, $log, $state, $filter, ENV, Tools, UCenter, BankService) {
        $log.debug("DepositController...");
        $scope.rechCategorySorted = []; //充值大类入口列表
        $scope.CategoryInfo = { //充值大类入口介绍文字和图标等
            'WY': {
                href: '#/bank/onlinepay',
                ico: '/mobile/images/online-pay.png',
                desc: '支持多家银行，转账更便捷'
            },
            'XYK': {
                href: '#/bank/xykOnlinepay',
                ico: '/mobile/images/xyk-online-pay.png',
                desc: '支持多家银行，转账更便捷'
            },
            'bankTransfer': {
                href: '#/bank/bankpay',
                ico: '/mobile/images/transfer.png',
                desc: '线下入款，您的首选'
            },
            'ZFB': {
                href: '#/bank/alipayOnline',
                ico: '/mobile/images/zfb-icon.png',
                desc: '支付宝在线支付'
            },
            'WX': {
                href: '#/bank/weixinOnline',
                ico: '/mobile/images/wechatpay-icon.png',
                desc: '微信在线支付'
            },
            'QQ': {
                href: '#/bank/qqOnline',
                ico: '/mobile/images/qq-pay.png',
                desc: 'QQ在线支付'
            },
            'YL': {
                href: '#/bank/ylOnline',
                ico: '/mobile/images/online-pay.png',
                desc: '银联扫码在线支付'
            },
            'JD': {
                href: '#/bank/jdOnline',
                ico: '/mobile/images/jd-pay.png',
                desc: '京东支付'
            },
            'BD': {
                href: '#/bank/bdOnline',
                ico: '/mobile/images/bd-pay.png',
                desc: '百度支付'
            },
            'alipay': {
                href: '#/bank/alipay',
                ico: '/mobile/images/zfb-icon.png',
                desc: '支付宝转账支付'
            },
            'alipayAuto': {
                href: '#/bank/alipayauto',
                ico: '/mobile/images/zfb-icon.png',
                desc: '支付宝转账，自动审核，快速受理'
            },
            'weixin': {
                href: '#/bank/wechatpay',
                ico: '/mobile/images/wechat-icon.png',
                desc: '微信转账支付'
            },
            'cft': {
                href: '#/bank/cftpay',
                ico: '/mobile/images/cft-icon.png',
                desc: '财付通转账支付'
            }
        };

        UCenter.checkFundPwd();
        BankService.getUserRechConfig(function(config) {
            $scope.rechCategorySorted = config.userRechCategorySorted;
        })
    })

    .controller('OnlinePayController', function($scope, $log, $state, Storage, $filter, $ionicModal, ENV, Tools, UCenter, BankService) {
        $scope.xSessionToken = Storage.get('token');
        $scope.stateData = $state.current.data;
        $scope.rechType = $state.current.data.rechType;
        $scope.rechTitle = '在线支付';

        $scope.$on('$ionicView.beforeEnter', function(event, viewData) {
            $scope.onlinepayData = {};
            BankService.getUserRechConfig(function(config) {
                UCenter.checkFundPwd();
                $scope.rechTypeList = config.userRechCategoryMap[$scope.rechType];
                if($scope.rechTypeList.length == 0) {
                    return;
                }
                $scope.onlinepayData.payWay = $scope.rechTypeList[0];
                //从大类获取并设置在线支付标题
                config.userRechCategorySorted.forEach(function(category) {
                    if(category.type == $scope.rechType) {
                        $scope.rechTitle = category.title;
                    }
                })
            });
        });

        $scope.validateFields = function() {
            if ($scope.onlinepayData.payWay.onlineTypeConfig.banks && !$scope.onlinepayData.bank) {
                Tools.tip('请选择支付银行');
            }
        }

        $scope.onlinePay = function() {
            if (!$scope.checkDepositMoney($scope.onlinepayData, $scope.rechType)) {
                return;
            }

            var formUrl = "api/bank/onlinePay.pay";
            if ($scope.onlinepayData && $scope.onlinepayData.payWay && $scope.onlinepayData.payWay.domain) {
                formUrl = $scope.onlinepayData.payWay.domain + "/userrech/onlinePay.do";
            }

            var href = window.location.href;
            $scope.backUrl = href.split('#')[0] + "#/bank/success/" + $scope.onlinepayData.depositMoney;
            document.getElementById("onlinepay-form").setAttribute("action", formUrl);
            document.getElementById("onlinepay-form").submit();
        };
    })

    .controller('OfflinePayController', function($rootScope,$scope, $log, $state, $filter, $ionicModal, ENV, Tools, UCenter, BankService) {
        $scope.rechType = $state.current.data.rechType;
        $scope.minRechMoney = $rootScope.appConfig.minRechMoney;
        $scope.isDoPay = false;

        $scope.$on('$ionicView.beforeEnter', function(event, viewData) {
            $scope.bankStep = 1;
            $scope.depositData = {};
            $scope.lastUserRech = {};
            BankService.getUserRechConfig(function(config) {
                UCenter.checkFundPwd();
                $scope.rechTypeList = config.userRechCategoryMap[$scope.rechType];
                $scope.depositData.bankObj = $scope.rechTypeList[0];
                if($scope.depositData.bankObj.checkType == 1 || $scope.rechType == 'alipay') {
                    $scope.isDoPay = true;
                    $scope.getAuthCode($scope.depositData.bankObj.id,function() {
                        Tools.alert("在 “付款说明” 或 “添加备注” 处填写备注码，提交订单后才能秒到！备注码是4位数，不要填写中文。");
                    });
                }
                var now = new Date();
                $scope.depositData.depositDate = new Date(now.getFullYear(), now.getMonth(), now.getDate(), now.getHours(), now.getMinutes());
            });
        });
        $scope.bankNextStep = function(data) {
            if (!$scope.checkDepositMoney(data, $scope.rechType)) {
                return;
            }
            $scope.setBankStep(3);
            $scope.isDoPay = true;
        };
        $scope.setBankStep = function(step) {
            $scope.bankStep = step;
        };
        $scope.autoNextStep = function(paraData, rechCfgId) {
            if (!$scope.checkDepositMoney(paraData, $scope.rechType)) {
                return;
            }
            if(!rechCfgId) {
                return;
            }
            $scope.isDoPay = true;

            $scope.getAuthCode(rechCfgId, function(){
                $scope.setBankStep(2);
                if (paraData.bankObj.checkType == 1) {
                    Tools.alert("在 “付款说明” 或 “添加备注” 处填写备注码，提交订单后才能秒到！备注码是4位数，不要填写中文。");
                }
            });
        };

        $scope.getAuthCode = function(rechCfgId, callback) {
            if(!rechCfgId) {
                return;
            }
            $scope.lastUserRech = {};
            $scope.authCode = '加载中...';
            Tools.ajax({
                method: 'GET',
                url: '/api/mobile/bank/getAuthCode',
                params: {cfgId: rechCfgId},
                success: function(data) {
                    $scope.authCode = data.result;
                    $scope.lastUserRech.authCode = data.result;
                    if (callback){
                        callback();
                    }
                }
            });
        };

        $scope.doPay = function(data) {
            if (!$scope.isDoPay) {
                return;
            }
            $scope.isDoPay = false;
            var date = $filter('date')(data.depositDate, 'yyyy-MM-dd HH:mm:ss');
            Tools.ajax({
                method: 'POST',
                params: {
                    cfgId: data.bankObj.id,
                    rechMoney: data.depositMoney,
                    realName: data.depositUsername,
                    rechTime: date,
                    authCode: $scope.lastUserRech.authCode,
                    payeeInfo: data.depositPayeeInfo
                },
                url: '/api/mobile/bank/save',
                success: function(result) {
                    Tools.tip("存款信息提交成功，请等待客服审核");
                    $state.go("bank.trans", {type: 1});
                },
                error: function(data, status) {
                    Tools.tip(data.msg || '网络繁忙，请检查网络是否正常或刷新网页重试 [' + status + ']');
                    $scope.isDoPay = true;
                }
            });
        };
        /*
         * 以下 线下支付 整合
         */
        $scope.oneStepDoPay = function(depositData, formObj) {
            if (formObj.$invalid) {
                Tools.tip("请完善存款信息!");
                return false;
            }
            if (!$scope.checkMoney(depositData)) {
                return;
            }

            $scope.doPay(depositData);
        };

        $scope.checkMoney = function(payData, formObj) {
            var s = payData.depositMoney.charAt(payData.depositMoney.length - 1);
            if (s == ".") {
                payData.depositMoney = payData.depositMoney.substring(0, payData.depositMoney.length - 1);
            }
            if(!/^\d+\.?\d{0,2}$/.test(payData.depositMoney)){
                Tools.tip("请输入正确的金额");
                return false;
            }

            var money = parseFloat(payData.depositMoney);
            var mixMoney = $scope.minRechMoney ? $scope.minRechMoney : 10;
            var maxMoney = 5000;
            if(payData && payData.bankObj && payData.bankObj.minMoney) {
                mixMoney = payData.bankObj.minMoney;
            }
            if(payData && payData.bankObj && payData.bankObj.maxMoney) {
                maxMoney = payData.bankObj.maxMoney;
            }

            if (money < mixMoney) {
                Tools.tip("充值金额不能小于" + mixMoney);
                return false;
            }
            if (money > maxMoney) {
                Tools.tip("充值金额不能大于" + maxMoney);
                return false;
            }
            return true;
        };
        $scope.cannelOrder = function() {
            Tools.confirm('您确定取消此订单吗？', function() {
                $scope.back();
            });
        }
    })

    .controller('PaySuccessController', function($scope, $stateParams) {
        $scope.amount = $stateParams.amount;
    })

    .filter('formatPayUrl', function(Tools) {
        return function(url) {
            if(!url) {
                return '';
            }

            if(url.indexOf('http') == 0) {
                return url;
            }
            else {
                return Tools.staticPath() + url;
            }
        };
    });