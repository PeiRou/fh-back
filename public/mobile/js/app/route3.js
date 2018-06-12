angular.module('ionicz')

    .config(function($stateProvider, $urlRouterProvider, ToolsProvider, ROUTE_ACCESS) {
        var version = ToolsProvider.getVersion();

        $stateProvider

        // 父级路由，子级路由都会加载父级路由
            .state('bank', {
                url: '/bank',
                abstract: true,
                templateUrl: '/mobile/views/bank/index.html?v=' + version,
                controller: 'BankBaseCtrl',
                data : {access : ROUTE_ACCESS.CHECK_TEST},
                resolve : {
                    deps : [ "$ocLazyLoad", function($ocLazyLoad) {
                        return $ocLazyLoad.load([{
                            name : "ionicz.bank",
                            files : [
                                '/mobile/views/bank/service.js?v=' + version,
                                '/mobile/views/bank/bank.js?v=' + version,
                                ToolsProvider.staticPath() + 'data/paramcfg.js'
                            ]
                        }]);
                    } ]
                }
            })

            .state('bank.bank', {
                url: '/bank',
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/bank.html?v=' + version,
                        controller: 'BankController'
                    }
                }
            })

            .state('bank.deposit', {
                url: '/deposit',
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/deposit.html?v=' + version,
                        controller: 'DepositController'
                    }
                }
            })

            .state('bank.withdraw', {
                url: '/withdraw',
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/withdraw.html?v=' + version,
                        controller: 'WithdrawController'
                    }
                }
            })

            .state('bank.trans', {
                url: '/trans/:type',
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/trans.html?v=' + version,
                        controller:'TransController'
                    }
                }
            })

            .state('bank.redpack', {
                url: '/redpack',
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/redpack.html?v=' + version,
                        controller: 'RedpackController'
                    }
                }
            })

            .state('bank.bankpay', {
                url: '/bankpay',
                data: {rechType: 'bankTransfer'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/bankpay.html?v=' + version,
                        controller:'OfflinePayController'
                    }
                }
            })

            .state('bank.cftpay', {
                url: '/cftpay',
                data: {rechType: 'cft'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/cftpay.html?v=' + version,
                        controller:'OfflinePayController'
                    }
                }
            })

            .state('bank.alipay', {
                url: '/alipay',
                data: {rechType: 'alipay'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/alipay.html?v=' + version,
                        controller:'OfflinePayController'
                    }
                }
            })

            .state('bank.wechatpay', {
                url: '/wechatpay',
                data: {rechType: 'weixin'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/wechatpay.html?v=' + version,
                        controller:'OfflinePayController'
                    }
                }
            })

            .state('bank.alipayauto', {
                url: '/alipayauto',
                data: {rechType: 'alipayAuto'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/alipayauto.html?v=' + version,
                        controller:'OfflinePayController'
                    }
                }
            })

            //以下是在线支付类型，共用onlinepay.html

            .state('bank.onlinepay', {
                url: '/onlinepay',
                data: {
                    rechType: 'WY'
                },
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })

            .state('bank.xykOnlinepay', {
                url: '/xykOnlinepay',
                data: {rechType: 'XYK'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })



            .state('bank.weixinOnline', {
                url: '/weixinOnline',
                data: {rechType: 'WX'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })

            .state('bank.alipayOnline', {
                url: '/alipayOnline',
                data: {rechType: 'ZFB'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })

            .state('bank.qqOnline', {
                url: '/qqOnline',
                data: {rechType: 'QQ'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })
            .state('bank.bdOnline', {
                url: '/bdOnline',
                data: {rechType: 'BD'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })
            .state('bank.ylOnline', {
                url: '/ylOnline',
                data: {rechType: 'YL'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })

            .state('bank.jdOnline', {
                url: '/jdOnline',
                data: {rechType: 'JD'},
                cache: false,
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/onlinepay.html?v=' + version,
                        controller:'OnlinePayController'
                    }
                }
            })

            .state('bank.success', {
                url: '/success/:amount',
                data : {access : ROUTE_ACCESS.PUBLIC},
                views: {
                    'bank-view': {
                        templateUrl: '/mobile/views/bank/pay_success.html?v=' + version,
                        controller: 'PaySuccessController'
                    }
                }
            })

        ;
    });