angular.module('ionicz.bank')
    .service('BankService', ['$log', 'Tools', '$ionicLoading', function($log, Tools, $ionicLoading) {
        var self = this;

        var config_min_rech_money = 10;
        var rechMoneyLimit = { //大类充值类型的默认最大最小金额
            WY:{min:config_min_rech_money,max:100000},
            XYK:{min:config_min_rech_money,max:100000},
            bankTransfer:{min:config_min_rech_money,max:9999999},
            alipay:{min:config_min_rech_money,max:9999999},
            cft:{min:config_min_rech_money,max:9999999},
            weixin:{min:config_min_rech_money,max:5000},
            ZFB:{min:config_min_rech_money,max:5000},
            WX:{min:config_min_rech_money,max:5000},
            QQ:{min:config_min_rech_money,max:5000},
            defaultMoney:{min:config_min_rech_money,max:9999999}
        }

        this.baseConfigLoaded = false; //是否已经加载基础充值配置
        this.baseConfig = {
            onlineTypesMap: {}, //用户充值配置的rechType为'onlinePayment'时， onlineType对应的在线支付的详细配置信息映射
            rechTypeSortList: [] //已经排序好的充值大类，最终针对某用户的充值大类将依据这个顺序排序
        };

        //加载基础充值配置信息（第一次进入充值页面调用）
        this.loadBaseConfig = function(callback) {
            $ionicLoading.show({
                template: '正在加载充值信息'
            });
            Tools.ajax({
                method: 'GET',
                url: 'api/mobile/userrech/getOtherRechCfgs?_' + Math.random(),
                success: function(result) {
                    self.baseConfig.rechTypeSortList = result.rechTypeSortList;

                    //服务端返回了数组形式的全部的在线支付的详细配置信息，这里先转换成由onlineType id 到onlineType本身的映射类型
                    self.baseConfig.onlineTypesMap = result.onlineTypes.reduce(function(map, onlineTypeConfig) {
                        /*
                        * 在线支付类型在用户充值配置里的rechType都是为'onlinePayment'
                        * 但是在线支付类型本身有分为N个大类，由该接口的otherRechTypeMap定义，如【支付宝在线(ZFB)】【微信在线(WX)】
                        * 这些大类将与用户充值配置的其他类别同一等级，作为充值的一级入口（如【支付宝转账(alipay)】，注意与【支付宝在线(ZFB)】存在差别，一个是线上充值，一个是用户转账）
                        * 在这里先给每个onlineTypeConfig定义一个categoryType字段，赋予该在线支付配置type所对应的大类
                        */
                        onlineTypeConfig.categoryType = result.otherRechTypeMap[onlineTypeConfig.type]

                        // 该在线支付配置所支持的银行列表由该接口的bankMap定义，如果存在，给该配置定义一个banks字段
                        if(onlineTypeConfig.bankId && result.bankMap[onlineTypeConfig.bankId]) {
                            onlineTypeConfig.banks = result.bankMap[onlineTypeConfig.bankId];
                        }
                        map[onlineTypeConfig.id] = onlineTypeConfig;
                        return map;
                    }, {});

                    self.baseConfigLoaded = true;
                    $ionicLoading.hide();
                    callback();
                },
                error: function() {
                    $ionicLoading.hide();
                    Tools.tip('无法加载充值配置，请刷新重试');
                }
            });
        };


        //获取用户的充值配置数据
        this.getUserRechConfig = function(callback) {

            if(!self.baseConfigLoaded) {
                self.loadBaseConfig(doGetUserCfg);
            } else {
                doGetUserCfg();
            }

            function doGetUserCfg() {
                Tools.ajax({
                    method: 'GET',
                    url: 'api/mobile/userrech/getUserRechCfgs?_' + Math.random(),
                    success: function(result) {
                        var userRechCategoryMap = { //按充值大类分类的用户充值配置信息
                            /*
                            * alipay: [<config>, <config>],
                            * WX: [<config>, <config>]
                            */
                        };
                        var userRechCategorySorted = []; //用户支持的充值大类列表

                        result.rechCfgs.sort(function(a, b) {
                            return a.sort - b.sort; //用户充值配置排序
                        }).forEach(function(rechCfg) {
                            var categoryType = rechCfg.rechType;
                            //如果该用户充值配置为'onlinePayment'，则取对应的在线充值配置信息里的categoryType作为大类
                            //同时给该rechCfg附上对应的在线充值配置信息以便最终展示在线充值类型的页面时候读取使用
                            if(categoryType == 'onlinePayment') {
                                rechCfg.onlineTypeConfig = self.baseConfig.onlineTypesMap[rechCfg.onlineType];

                                // 在线支付要过滤掉非手机平台的类型 pcMobile: 0 都支持, 1 电脑版, 2 只支持手机版
                                if(rechCfg.onlineTypeConfig.pcMobile != 0 && rechCfg.onlineTypeConfig.pcMobile != 2){
                                    return;
                                }
                                categoryType = rechCfg.onlineTypeConfig.categoryType;
                            }

                            if(categoryType == 'alipay' && rechCfg.checkType == 1) { //支付宝线下转账checkType标识为1 的时候表示支持备注码自动入款，有独立的交互界面，这里前端单独设置一个大类'alipayAuto'
                                categoryType = 'alipayAuto';
                            }

                            //如果配置不包含最大or最小充值金额，设置默认值
                            var moneyLimitFallback = rechMoneyLimit[categoryType] || rechMoneyLimit['defaultMoney'];

                            if(!rechCfg.minMoney) {
                                rechCfg.minMoney = moneyLimitFallback.min;
                            }

                            if(!rechCfg.maxMoney) {
                                rechCfg.maxMoney = moneyLimitFallback.max;
                            }

                            var categoryTypeConfigs = userRechCategoryMap[categoryType];
                            if(!categoryTypeConfigs) {
                                categoryTypeConfigs = userRechCategoryMap[categoryType] = [];
                            }
                            categoryTypeConfigs.push(rechCfg);
                        });

                        self.baseConfig.rechTypeSortList.forEach(function(type) {
                            // 用户可以支付的类型里面有这个类型才显示这个充值类型
                            if(userRechCategoryMap[type.rechType]) {
                                userRechCategorySorted.push({
                                    type: type.rechType,
                                    title: type.name
                                })
                            }
                            if(type.rechType == 'alipay' && userRechCategoryMap['alipayAuto']) {
                                userRechCategorySorted.push({
                                    type: 'alipayAuto',
                                    title: '支付宝自动支付'
                                });
                            }
                        });

                        callback({
                            userRechCategoryMap: userRechCategoryMap,
                            userRechCategorySorted: userRechCategorySorted
                        })
                    }
                })
            }

        };

    }]);