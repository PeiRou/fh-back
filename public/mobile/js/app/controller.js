angular.module('ionicz.controllers', [])

    .controller('AppCtrl', function($scope, $rootScope, $location, $interval, $ionicHistory, $ionicModal, $log, Tools, PATH, My, Chat, md5, Storage, $cookies) {
        $scope.My = My;
        $scope.agentFlag = $cookies.get("agent");


        var recoUser = $location.search().intr || $location.search().user;
        if (recoUser) {
            Storage.set('recoUser', recoUser);
        }

        var loginSrc = $location.search().loginSrc;
        if (loginSrc) {
            Storage.set('loginSrc', loginSrc);
        }
        
        My.init();
    	
        $scope.back = function() {
            $ionicHistory.backView() ? $rootScope.$ionicGoBack() : $location.path(PATH.homePath);
        };

        $scope.logout = function() {
            Tools.confirm('确认要退出该帐号？', function() {
                var token = My.getToken();
                if (!token) {
                    $location.path(PATH.loginPath);
                    return;
                }

                Tools.ajax({
                    method: 'GET',
                    url: '/api/logout',
                    params: { token: token },
                    success: function(data) {
                        $location.path(PATH.homePath);
                        $rootScope.isLogin = false;

                        //聊天室断开
                        //Chat.closeConnect();
                    }
                });

                My.clear();
            });
        };

        $scope.guestLogin = function() {
            Tools.ajax({
                method: 'POST',
                url: '/api/guestLogin',
                backdrop: true,
                params: {
                    account: '!guest!',
                    password: '!guest!'
                },
                success: function(data) {
                    if (data && data.token) {
                        Tools.tip('登陆成功');
                        My.loginSuccess(data);
                        $location.path(PATH.homePath);
                    } else {
                        Tools.alert('登录失败');
                    }
                },
                error: function(data) {
                    Tools.alert(data.msg || '登录失败');
                }
            });
        };

        $scope.refreshMoney = function() {
            My.refreshMoney();
        };

        $scope.windowOpen = function(url) {
            window.open(url);
        };

        $scope.openZxkfWindow = function() {
        	//var serverUrl = $scope.agentFlag == 1 && agentZxkfUrl ? agentZxkfUrl : $rootScope.appConfig.zxkfUrl;
            var serverUrl = "https://static.meiqia.com/dist/standalone.html?_=t&eid=53233";
            window.open(serverUrl);
            //Tools.tip('此功能暂未开放')
        };
    })

    .controller('LoginCtrl', function($scope, $location, $log, Tools, PATH, Storage, My, md5, $ionicPopup) {
        $scope.$on('$ionicView.beforeEnter', function(event, viewData) {
            $scope.$broadcast('validateCodeChange');
            $scope.loginData.userName = Storage.get('userName');
        });
        $scope.$on('newVerifyCode', function(e, code) {
            $scope.verifyCode = code;
        });

        $scope.loginData = {};
        $scope.recoUser = Storage.get('recoUser');

        $scope.login = function() {
            $scope.msg = '';
            if ($scope.loginData.valiCode.toLowerCase() != $scope.verifyCode) {
                $scope.msg = '验证码错误，请重新输入';
                $scope.loginData.valiCode = '';
                $scope.$broadcast('validateCodeChange');
                return;
            }

            Tools.ajax({
                method: 'POST',
                url: '/api/login',
                backdrop: true,
                params: {
                    username: $scope.loginData.userName,
                    password: md5.createHash($scope.loginData.userPwd),
                    loginSrc: Storage.get('loginSrc') || 1
                },
                success: function(data) {
                    Storage.set('userName', $scope.loginData.userName, 30 * 24 * 3600); // 设置保存30天

                    $location.path(PATH.homePath);
                    My.loginSuccess(data);
                    Tools.tip('登录成功');

                    var msgs = MESSAGES.type_2 || [];
                    var msg5 = MESSAGES.type_5 || []; //代理专属公告
                    if ($scope.agentFlag == 1 && msg5 && msg5.length > 0) { //代理专属域名需要加上代理的公告
                        msgs = msgs.concat(msg5);
                    }

                    if(MESSAGES.type_4 && MESSAGES.type_4.length) { //全部类型公告
                        msgs = msgs.concat(MESSAGES.type_4);
                    }

                    var userRechLevel = data.rechLevel;
                    msgs = msgs.filter(function(msg) {
                        if(msg.rechLevels) {
                            return msg.rechLevels.split(',').indexOf(userRechLevel) >= 0;
                        } else {
                            return true;
                        }
                    });

                    if (msgs.length > 0) {
                        var length = msgs.length;
                        var index = 0;

                        function showMsg(bt) {
                            var alertPopup = $ionicPopup.alert({
                                title: msgs[index].title,
                                template: msgs[index].message,
                                okText: bt
                            });
                            alertPopup.then(function(res) {
                                index++;
                                if (index >= (length - 1)) {
                                    bt = "确定";
                                }
                                if (index < length) {
                                    showMsg(bt);
                                }
                            });
                        }
                        showMsg("下一条");
                    }
                },
                error: function(data) {
                    Tools.tip(data.message);
                    $scope.msg = data.msg;
                    // 发送广播消息，刷新验证码
                    $scope.$broadcast('validateCodeChange');
                }
            });
        };

        $scope.checkUserName = function() {
            // 处理苹果手机中文输入状态下输入用户名可能带有空格而造成登录按钮禁用的问题
            $scope.loginData.userName = $scope.loginData.userName.replace(/\s+/g, "");
        };
    })


    .controller('RegCtrl', function($scope, $location, $log, $timeout, Tools, My, PATH, Storage, md5, $ionicScrollDelegate) {
        $scope.recoUser = Storage.get('recoUser');

        $scope.$on('$ionicView.beforeEnter', function(event, viewData) {
            $scope.$broadcast('validateCodeChange');
            $scope.regData = { recoUser: $scope.recoUser };
            $scope.qqIsOk = true;
            $scope.phoneIsOk = true;
            $scope.setStep(1);
        });
        $scope.$on('newVerifyCode', function(e, code) {
            $scope.verifyCode = code;
        });

        $scope.checkUserName = function(userName) {
            if (!userName) {
                return;
            }
            Tools.ajax({
                method: 'POST',
                url: '/api/checkUserNameExist',
                params: { userName: userName },
                success: function(data) {
                    $scope.userNameExist = !data.success;
                },
                error: function(data) {
                    $scope.userNameExist = true;
                }
            });
        };

        $scope.resetCheck = function() {
            $scope.userNameExist = false;
        };

        $scope.checkFullName = function(fullName) {
            if (!fullName) {
                $scope.fullNameIsOk = false;
                return false;
            }
            //		$scope.fullNameIsOk = /^[a-zA-Z ]{1,20}$/.test(fullName) || /^[\u4e00-\u9fa5]{1,10}$/.test(fullName);
            $scope.fullNameIsOk = /^[\u4e00-\u9fa5]{2,5}$/.test(fullName);
            return $scope.fullNameIsOk;
        };
        $scope.checkQq = function(qq) {
            if (!qq) {
                $scope.qqIsOk = false;
                return false;
            }
            $scope.qqIsOk = /^[0-9]{5,12}$/.test(qq);
            return $scope.qqIsOk;
        };
        $scope.checkPhone = function(phone) {
            if (!phone) {
                $scope.phoneIsOk = false;
                return false;
            }
            $scope.phoneIsOk = /^[0-9]{11}$/.test(phone);
            return $scope.phoneIsOk;
        };

        $scope.setStep = function(step) {
            $ionicScrollDelegate.$getByHandle('regScroll').scrollTop();
            $scope.step = step;
            if (step == 2) {
                $scope.regData.fundPwd1 = "0";
                $scope.regData.fundPwd2 = "0";
                $scope.regData.fundPwd3 = "0";
                $scope.regData.fundPwd4 = "0";
            }
        };

        $scope.reg = function() {
            var fundPwd = $scope.regData.fundPwd1 + '' + $scope.regData.fundPwd2 + $scope.regData.fundPwd3 + $scope.regData.fundPwd4;

            if ($scope.regData.valiCode.toLowerCase() != $scope.verifyCode) {
                Tools.alert('验证码错误，请重新输入');
                $scope.regData.valiCode = '';
                $scope.$broadcast('validateCodeChange');
                return;
            }

            if ($scope.regData.valiCode.toLowerCase() != $scope.verifyCode) {
                Tools.alert('验证码错误，请重新输入');
                $scope.regData.valiCode = '';
                $scope.$broadcast('validateCodeChange');
                return;
            }


            Tools.ajax({
                method: 'POST',
                url: '/api/reg',
                params: {
                    userName: $scope.regData.userName,
                    //password: md5.createHash($scope.regData.userPwd),
                    password: md5.createHash($scope.regData.userPwd),
                    email: $scope.regData.email,
                    qq: $scope.regData.qq,
                    phone: $scope.regData.phone,
                    // fundPwd: fundPwd,
                    //fundPwd: null,
                    fullName: $scope.regData.fullName,
                    superUserName: $scope.regData.recoUser
                },
                success: function(data) {
                    if(data.response == 'error')
                    {
                        Tools.tip(data.message, 2000);
                        $scope.$broadcast('validateCodeChange');
                    } else {
                        Tools.tip('注册成功', 2000);
                        Storage.set('token', data.result.token);
                        Storage.set('userName', $scope.regData.userName, 30 * 24 * 3600);
                        My.init();
                        $timeout(function() {
                            $location.path(PATH.homePath);
                        }, 2000);
                    }
                },
                error: function(data) {
                    Tools.alert(data.msg);
                    $scope.step = 1;
                    $scope.$broadcast('validateCodeChange');
                }
            });
        };
    });