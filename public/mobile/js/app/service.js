angular.module('ionicz.services', [])

    .service('My', function($rootScope, $location, $interval, $log, $filter, Storage, Tools, PATH) {
        var self = this;

        this.info = {};
        var bank = {};
        var msgTimer = null;

        var startMsgTimer = function() {
            msgTimer = $interval(function() {
                Tools.ajax({
                    url: '/api/user/getUserMsg',
                    success: function(data) {
                        if (data.balance) {
                            self.info.money = data.balance;
                        }
                        if (data.message && data.message.channel) {
                            if (data.message.channel != 8 && data.message.message) {
                                Tools.tip('你有新消息');
                            } else {
                                Tools.modal({ template: data.message.message });
                            }
                        }
                    },
                    error: function(e) {
                        console.log(e);
                        //self.loginFail();
                    }
                });
            }, 10000);
        };

        var checkUpdatePw = function() {
            // 需要更新密码
            if (self.info.updatePw === 1) {
                $location.path('/ucenter/myfpwd').search({ t: 1 });
            }
        };

        this.getInfo = function() {
            return this.info;
        };
        this.getUserId = function() {
            return this.info.userId;
        };
        this.getToken = function() {
            return self.info.token;
        };

        this.getUserName = function() {
            return self.info.userName;
        };

        this.getFullName = function() {
            return self.info.fullName;
        };
        this.setFullName = function(fullName) {
            self.info.fullName = fullName;
        };
        this.getMoney = function() {
            return $filter('money')(self.info.money);
        };
        this.getOriginalMoney = function() {
            return self.info.money;
        };
        this.addMoney = function(money) {
            self.info.money += money;
        };
        this.getEmail = function() {
            return self.info.email;
        };
        this.setEmail = function(email) {
            self.info.email = email;
        };
        this.setBank = function(data) {
            bank = data;
        };
        this.setBandDesc = function(bankName, subAddress, cardNo) {
            bank.bankName = bankName;
            bank.subAddress = subAddress;
            if (cardNo.length > 4) {
                bank.cardNo = "尾号" + cardNo.substring(cardNo.length - 4, cardNo.length);
            }
        };
        this.getBank = function() {
            return bank;
        };
        this.hasBankMsg = function() {
            if (bank.bankName && bank.cardNo) return true;
            return false;
        };
        this.hasFundPwd = function() {
            return self.info.hasFundPwd;
        };
        this.setHasFundPwd = function(hasFundPwd) {
            self.info.hasFundPwd = hasFundPwd;
        };
        this.init = function() {
            var token = Storage.get('token');
            if (!token) {
                self.loginFail();
                return;
            }

            Tools.ajax({
                url: '/api/init',
                success: function(data) {
                    if (data.token) {
                        self.loginSuccess(data);
                    } else {
                        self.loginFail();
                    }
                    $rootScope.inited = true;
                },
                error:function (e) {
                    self.loginFail();
                }
            });
        };

        this.loginFail = function() {
            if (!Tools.isPublicPage()) {
                $location.path(PATH.loginPath);
            }
            $rootScope.inited = true;
        };

        this.loginSuccess = function(data) {
            Storage.set('token', data.token);
            // 如果是试玩帐号，修改显示的用户名为“游客”
            if (data.testFlag == 1) {
                data['userName'] = '游客';
                $rootScope.isTestAccount = true;
            } else {
                $rootScope.isTestAccount = false;
            }

            self.info = data;
            $rootScope.diffTime = moment(data.serverTime).diff(moment(), 's');
            $rootScope.isLogin = true;
            startMsgTimer();
            checkUpdatePw();
        };

        this.clear = function() {
            Storage.remove('token');
            self.info = {};
            self.clearMsgTimer();
        };

        this.clearMsgTimer = function() {
            $interval.cancel(msgTimer);
        };

        this.refreshMoney = function(backdrop) {
            backdrop = backdrop === false ? false : true;
            Tools.ajax({
                url: '/api/user/getMoney',
                backdrop: backdrop,
                success: function(data) {
                    if (data) {
                        self.info.money = data;
                    }
                }
            });
        };
    })
    .service('Chat', function($rootScope, $ocLazyLoad, $ionicScrollDelegate, $location, $ionicPopup, My, Storage, $ionicLoading, Tools, RedPack, $http, $ionicTabsDelegate) {
        var self = this;

        var chatRunning = false, //是否正在运行,用于重连
            stompClient, //ws插件
            messageSubscribe, //信息监听
            privateSubscribe, //私聊监听
            chatDomain, //服务器地址
            signKey; //聊天室登录信息储存

        //收到消息网址过滤
        var textRe = /(?:(?:https?|ftp|file):\/\/|www\.|ftp\.)(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[-A-Z0-9+&@#\/%=~_|$?!:,.])*(?:\([-A-Z0-9+&@#\/%=~_|$?!:,.]*\)|[A-Z0-9+&@#\/%=~_|$])|\w+(\s??[\.,。]\s?)+([a-zA-Z]\w*)/igm;

        this.userInitData = {}; //缓存init.do的数据
        this.chatMinBetMoney = 0; //最低投注推送,如果为0，不开启是否显示投注记录选项栏
        this.runChat = false; //是否启动chat功能
        this.redPack = { //默认空红包
            state: RedPack.states.DISMISS,
            destroy: function() {}
        }
        this.packStates = RedPack.states

        //查看是否启动聊天室
        //如果是代理用户直接不开启功能
        if (Storage.get('agent') != 1) {
            $rootScope.$watch('appConfig.chatUrl', function(newValue, oldValue, scope) {
                if (newValue != oldValue && newValue) {
                    //chatUrl有值
                    self.runChat = $rootScope.appConfig.chatOpen == 1; //开启chat功能
                    chatDomain = $rootScope.appConfig.chatUrl; //服务器地址设置
                    self.chatMinBetMoney = $rootScope.appConfig.chatMinBetMoney; //最低投注推送设置
                }
            });
        }

        //参数初始化
        function init() {
            chatRunning = false;
            self.isHideBet = false; //是否屏蔽投注信息
            // self.userInitData.pushBet = false; //是否显示我的投注信息
            self.screenLock = true; //屏幕滚动锁
            self.screenLockText = '锁屏';

            //昵称
            // self.nickName = '';

            //text焦点
            self.isFocus = false;
            // 公告
            self.bulletinList = [];
            // 消息
            self.messageList = [];
            //消息框数据
            self.textMsg = {};
            //记录红包, 已弹出的红包不再弹
            self.redPacks = [];

        }

        init();

        //锁屏
        this.changeLock = function() {
            self.screenLock = !self.screenLock;
            if (self.screenLock) {
                $ionicScrollDelegate.$getByHandle('chatMainScroll').scrollBottom();
                self.screenLockText = "锁屏";
            } else {
                self.screenLockText = '滚屏';
            }
        }

        self.toBottom = function() {
            if (self.screenLock) {
                $ionicScrollDelegate.$getByHandle('chatMainScroll').scrollBottom();
            }
        }

        //清屏
        this.clean = function() {
            self.messageList = [];
        }

        //textarea高度变化
        this.textFocus = function() {
            self.isFocus = true;
        }

        this.textBlur = function() {
            self.isFocus = false;
        }

        this.atName = function(nickName) {
            self.textMsg.text += '@' + nickName + ' ';
        }

        //设置昵称
        this.setNick = function() {

            Tools.modal({
                title: '更改昵称',
                template: "<input type='text' style='text-align:center;border:1px solid #ccc;' ng-model='modalData.nickName' />",
                callback: function(scope, popup) {
                    var newNickName = scope.modalData.nickName;

                    if (!newNickName || /[^\u4e00-\u9fa5]/.test(newNickName)) {
                        Tools.tip('限1-6位中文昵称');
                        popup.close();
                        return;
                    }
                    if (newNickName.length < 1 || newNickName.length > 6) {
                        popup.close();
                        Tools.tip('限1-6位中文昵称');
                    } else {
                        var data = {
                            token: Storage.get('ws-token'),
                            nickName: newNickName
                        }
                        Tools.ajax({
                            url: chatDomain + '/chat/updateNickName.do',
                            params: data,
                            success: function(data) {
                                popup.close();
                                Tools.tip('修改成功');
                                self.userInitData.setted = "1";
                            },
                            error: function(err) {
                                popup.close();
                                Tools.tip(err.msg);
                                console.log(err)
                            }
                        });
                    }

                }
            });
        }

        //推送自己的投注
        this.pushBetChange = function() {

            var data = {
                token: Storage.get('ws-token'),
                pushBet: self.userInitData.pushBet ? 1 : 0
            }

            Tools.ajax({
                url: chatDomain + '/chat/updatePushBet.do',
                params: data,
                success: function(data) {

                },
                error: function(err) {
                    console.log(err);
                }
            });
        }

        // 房间tab
        this.nowTab = 0; //当前tab
        this.roomIsActive = function(index) {
            self.nowTab = index;
        }

        //进入聊天
        this.getChatting = function() {
            // 是否已经运行
            if (!chatRunning) {

                self.messageList.push({
                    chatType: 7,
                    content: '聊天室加载中...',
                    bgColor: '#ccc',
                    textColor: 'red'
                });

                //测试是否已经拿到chat服务器地址
                function testChatDomain() {

                    if (chatDomain) {
                        getChatAuth();

                    } else {
                        setTimeout(testChatDomain, 500);
                    }
                }
                testChatDomain();
            }
        }

        //取用户签名
        function getChatAuth() {
            Tools.ajax({
                url: '/api/getSign',
                method: 'GET',
                success: function(data) {
                    // console.log(data);
                    self.messageList.push({
                        chatType: 7,
                        content: '读取用户数据...',
                        bgColor: '#ccc',
                        textColor: 'red'
                    });
                    signKey = data;
                    chatLogin();
                },
                error: function(err) {
                    $ionicLoading.hide();
                    Tools.tip(err.msg);
                    console.log(err);
                }
            });
        }

        //登录聊天系统
        function chatLogin() {
            Tools.ajax({
                url: chatDomain + '/api/chat/init',
                dataType: 'json',
                params: signKey,
                method: 'POST',
                success: function(data) {
                    // console.log(data);

                    self.messageList.push({
                        chatType: 7,
                        content: '用户登录中...',
                        bgColor: '#ccc',
                        textColor: 'red'
                    });

                    chatRunning = true;

                    // 缓存用户数据
                    self.userInitData = data;

                    //取推送自己的投注状态
                    if (data.pushBet - 0) {
                        self.userInitData.pushBet = true;
                    } else {
                        self.userInitData.pushBet = false;
                    }

                    //昵称
                    // self.nickName = ''

                    // 写cookie
                    Storage.set('ws-token', data.token);

                    //无房间
                    if (!self.userInitData.room) {
                        Tools.tip('当前无房间');
                        return;
                    }

                    // 房间操作
                    roomInit();
                },
                error: function(err) {
                    Tools.tip(err.msg);
                    console.log(err)
                    setTimeout(chatLogin, 1000);
                },
                timeout: function() {
                    Tools.tip('连接超时,重连中');
                    console.log('超时');
                    setTimeout(chatLogin, 1000);
                }
            });
        }

        //进房间
        function roomInit() {
            var room = self.userInitData.room;
            Storage.set('ws-roomId', room.id)
            self.userInitData.chatSpeak = self.userInitData.chatSpeak && room.isSpeak == 1
            connect();
        }

        //房间选择
        self.goRoom = function(roomId) {
            // console.log('切换房间');
            //写该房间cookie
            Storage.set('ws-roomId', roomId);
            //清屏
            clean();
            //重启监听
            unsubscribe();
            subscribe();
        }

        //wb连接
        function connect() {
            var socket = new SockJS(chatDomain + "/api/webchat");
            stompClient = Stomp.over(socket);

            //关闭stomp调试
            stompClient.debug = function() {};

            stompClient.connect(getHeaders(), function(frame) {
                console.info('Connected: ' + frame);

                console.log('ws连接成功');

                self.messageList.push({
                    chatType: 7,
                    content: '聊天室连接成功...',
                    bgColor: '#ccc',
                    textColor: 'red'
                });

                //启动监听
                subscribe();

            }, function() {
                console.info("无法连接或断线");

                if (chatRunning) {
                    $ionicLoading.hide();
                    Tools.tip('聊天室恢复连接中...');
                    setTimeout(function() {
                        chatLogin();
                    }, 1000);
                }
            });
        }

        //断开wb
        function closeConnect() {
            console.log('断开ws');
            if (chatRunning) {
                unsubscribe(); //停止监控
                stompClient.disconnect(function() {
                    init(); //重置参数与数据
                    console.log("完成断开");
                });
            } else {
                console.log('未连接');
            }
        }

        function closeChat() {
            closeConnect();
            $ionicTabsDelegate.$getByHandle('tabs').select(0);
        }

        //启动监听
        function subscribe() {
            console.log('启动监听');

            var roomId = Storage.get('ws-roomId');
            var token = Storage.get('ws-token');
            console.info("roomId: " + roomId);
            console.info("token: " + token);

            // 初始化监听
            stompClient.subscribe("/app/init", function(initData) {

                //解析历史消息
                console.info("解析历史消息");
                var msgListData = JSON.parse(initData.body),
                    messageList = msgListData.messageList,
                    bulletinList = msgListData.bulletinList;

                self.messageList = []

                //更新头像
                for (var i = 0; i < messageList.length; i++) {
                    var obj = messageList[i];
                    obj.fromHistory = true; //标识是历史记录
                    showMsg(obj)
                }

                // 公告
                self.bulletinList = bulletinList;

                //无昵称提示
                if (self.userInitData.setted == '0' || self.userInitData.setted == 'null') {
                    if (self.userInitData.role.type != '0') {
                        self.messageList.push({
                            chatType: 7,
                            content: '每位用户可以修改一次昵称',
                            bgColor: '#ccc',
                            textColor: 'red'
                        });
                    } else {
                        self.messageList.push({
                            chatType: 7,
                            content: '试玩用户没有发言权限',
                            bgColor: '#ccc',
                            textColor: 'red'
                        });
                    }

                }

                var room = self.userInitData.room;
                if (signKey.betMoney < room.betMoney || signKey.rechMoney < room.rechMoney) {
                    self.messageList.push({
                        chatType: 7,
                        content: '您暂时无法发言, 当前发言条件: \n 前两天充值不少于' + room.rechMoney + '元；打码量不少于' + room.betMoney + '元',
                        bgColor: '#ccc',
                        textColor: 'red'
                    });
                }

                // console.log(self.messageList);

                //加载完毕
                $ionicLoading.hide();

                // 监听服务端推送的消息
                messageSubscribe = stompClient.subscribe("/server/message/" + roomId, function(chat) {
                    var obj = JSON.parse(chat.body);
                    obj.msgId = obj.id;
                    showMsg(obj);
                });

                // 监听服务端一对一消息

                privateSubscribe = stompClient.subscribe("/user/" + token + "/queue", function(chat) {
                    var obj = JSON.parse(chat.body);
                    obj.msgId = obj.id;
                    showMsg(obj);
                });

            }, getHeaders());
        }

        //停止监听
        function unsubscribe() {
            // 停止所有监听
            messageSubscribe.unsubscribe();
            privateSubscribe.unsubscribe();
        }

        //用户头部
        function getHeaders() {
            return {
                "token": Storage.get('ws-token'),
                "roomId": Storage.get('ws-roomId')
            }
        }

        //清屏
        function clean() {
            // self.bulletinList = null;
            self.messageList = null;
        }

        function newRedPack(obj) {
            var packInfo = JSON.parse(obj.content)
            if (self.redPacks.indexOf(packInfo.id) < 0) {
                self.redPack = new RedPack(obj, chatDomain)
                self.redPacks.push(packInfo.id)
            }

            self.messageList.push({
                chatType: 1,
                nickName: '新红包',
                headPic: 'images/chat/packavatar.jpg',
                bgColor: '#fd5555',
                nickTextColor: '#f50000',
                curTime: obj.curTime,
                textColor: '#FFFFFF',
                content: '点击本消息查看', //'总金额 ' + packInfo.totalMoney + ' 元 \n当前还剩 ' + packInfo.surplusNum + ' 个\n点击本消息查看',
                pack: obj
            })
        }

        self.openPack = function(packObj) {
            if (packObj) {
                self.redPack = new RedPack(packObj, chatDomain)
            }
        }

        //显示消息
        function showMsg(obj) {
            if (obj.roleId) {
                for (var i = 0; i < self.userInitData.roleList.length; i++) {
                    if (self.userInitData.roleList[i].id == obj.roleId) {
                        obj = angular.extend(obj, self.userInitData.roleList[i]);
                        break;
                    }
                }
            } else {
                //公告背景色，字色
                obj.bgColor = "#199ed8";
                obj.textColor = "#fff"
            }


            //headPic
            switch (obj.type - 0) {
                // 0游客
                case 0:
                    obj.headPic = 'images/chat/head-u3.png';
                    obj.levelPic = 'images/chat/icon_testuser.gif';
                    break;
                    // 1会员
                case 1:
                    obj.headPic = obj.iconUrl ? chatDomain + '/' + obj.iconUrl : 'images/chat/head-u1.png';
                    obj.levelPic = 'images/chat/icon_member0' + obj.level + '.gif';
                    break;
                    // 2管理员
                case 2:
                    obj.headPic = obj.iconUrl ? chatDomain + '/' + obj.iconUrl : 'images/chat/head-u2.png';
                    obj.levelPic = 'images/chat/icon_master.gif';
                    break;
                default:
            }

            //总条数限制
            if (self.messageList.length == 300) {
                self.messageList.splice(0, 100);
            }  

            // console.log(obj.chatType)

            //详细发言分类
            switch (obj.chatType - 0) {
                case 1:

                case 11:
                    obj.images = [];
                    obj.content = obj.content.replace(/\[img:(\S+?\.(jpg|png|jpeg|gif))\]/ig, function(_, img_url) {
                        obj.images.push(chatDomain + '/' + img_url)
                        return ''
                    })
                    if (obj.type != 2) {
                        obj.content = obj.content.replace(textRe, "\ud83d\ude04");
                    }
                    self.messageList.push(obj);
                    break;
                case 2:
                    // obj.content = '系统消息：' + obj.nickName + "进入房间";
                    // self.messageList.push(obj);
                    break;
                case 3:
                    // obj.content = '系统消息：' + obj.nickName + "离开房间";
                    //self.messageList.push(obj);
                    break;
                case 4:
                    if (obj.fk == signKey.fk) {
                        //自己被禁言
                        obj.content = "系统消息：" + "您被禁言了";
                        self.userInitData.status = 1;
                    } else {
                        //其他人被禁言
                        obj.content = "系统消息：" + obj.nickName + "被禁言了";
                    }
                    //删除信息
                    var deledNum = 0,
                        totalLen = self.messageList.length;

                    for (var i = 0; i < totalLen; i++) {
                        if (self.messageList[i - deledNum].fk == obj.fk) {
                            self.messageList.splice(i - deledNum, 1);
                            deledNum++;
                        }
                    }

                    self.messageList.push(obj);
                    break;
                case 5:
                    if (obj.fk == signKey.fk) {
                        //自己被禁言
                        obj.content = "系统消息：" + "您的禁言解除了";
                        self.userInitData.status = 0;
                    } else {
                        //其他人被禁言
                        obj.content = "系统消息：" + obj.nickName + "的禁言解除了";
                    }
                    self.messageList.push(obj);
                    break;
                case 6:
                    if (!self.isHideBet) {
                        var betData = JSON.parse(obj.content),
                            betContent = '';

                        for (var i = 0; i < betData.length; i++) {
                            var playsId = betData[i].playId,
                                gameName = gameMap[plays[playsId].gameId].name,
                                cateName = playCates[plays[playsId].playCateId].name,
                                playName = plays[playsId].name;
                            betContent += gameName + '：' + cateName + ' ' + playName + '，金额：￥' + betData[i].money + '\n';
                        }

                        obj.content = betContent;
                        // 背景设置
                        obj.bgColor = obj.betBgColor;
                        obj.textColor = "#fff"

                        self.messageList.push(obj);

                    }

                    break;
                case 7:
                    obj.content = "系统消息：" + obj.content;
                    self.messageList.push(obj);
                    break;
                case 8:
                    if (obj.content - 0) {
                        self.userInitData.chatSpeak = true;
                        obj.content = "系统消息：" + "现在是聊天时段";
                    } else {
                        self.userInitData.chatSpeak = false;
                        obj.content = "系统消息：" + "现在是非聊天时段";
                    }
                    self.messageList.push(obj);
                    break;
                case 9:
                    for (var i = 0; i < self.messageList.length; i++) {
                        if (self.messageList[i].msgId == obj.content) {
                            self.messageList.splice(i, 1);
                            break;
                        }
                    }
                    break;
                case 10:
                    newRedPack(obj);
                    break;
                case 12:
                    obj.headPic = obj.iconUrl ? chatDomain + '/' + obj.iconUrl : 'images/chat/head-u2.png';
                    obj.levelPic = 'images/chat/icon_master.gif';
                    obj.content = obj.content;
                    obj.nickName = '计划发布员';
                    // 背景设置
                    obj.bgColor = '#AB47BC;#5169DE';
                    obj.textColor = "#fff"
                    self.messageList.push(obj);
                    break;
                case 13:
                    closeChat();
                    break;
                default:
            }
        }

        //发消息
        self.textMsg.text = "";

        self.sendMessage = function(msg) {
            msg = msg || self.textMsg.text;
            //空输入
            if (msg.length == 0) {
                return;
            }
            //超过最大字数限制
            if (self.userInitData.role.maxLength != 0 && self.userInitData.role.maxLength < msg.length) {
                Tools.tip('您最多可以输入' + self.userInitData.role.maxLength + '个文字');
                return;
            }
            //被禁言
            if (self.userInitData.status == 1) {
                Tools.alert('您被限制发言');
                return;
            }
            //不能发言的
            if (self.userInitData.role.isSpeak == 0) {
                //如果游客，倒向注册
                if (self.userInitData.role.type == 0) {
                    Tools.modal({
                        template: "<p style='text-align: center'>游客无法发言,请先注册</p>",
                        callback: function(scope, popup) {
                            //聊天室断开
                            closeConnect();
                            $location.path('/reg');
                            popup.close();
                        }
                    });
                } else {
                    Tools.alert('您没有发言权限');
                }
                return;
            }

            //房间限制
            var room = self.userInitData.room;
            if (signKey.betMoney < room.betMoney || signKey.rechMoney < room.rechMoney) {
                Tools.alert('您暂时无法发言, 当前发言条件: 前两天充值不少于' + room.rechMoney + '元；打码量不少于' + room.betMoney + '元');
                return;
            }

            // console.log(self.textMsg.text);

            stompClient.send("/app/send", getHeaders(), msg);
            self.textMsg.text = "";
        }

        self.sendImage = function(file) {
            var IMG_DIMENTION_MAX = 1200;
            var reader = new FileReader()

            reader.addEventListener("load", function(e) {
                var image = new Image();
                image.onload = function() {
                    processImg(image);
                };
                image.title = file.name;
                image.src = e.target.result;
                processImg(image);
            }, false)

            reader.readAsDataURL(file);

            function processImg(img) {
                var width = img.width;
                var height = img.height;
                if (width > IMG_DIMENTION_MAX) {
                    height = IMG_DIMENTION_MAX / width * height
                    width = IMG_DIMENTION_MAX
                }
                if (height > IMG_DIMENTION_MAX) {
                    width = IMG_DIMENTION_MAX / height * width
                    height = IMG_DIMENTION_MAX
                }
                var canvas = document.createElement('canvas')
                canvas.width = width
                canvas.height = height
                const ctx = canvas.getContext('2d')
                ctx.drawImage(img, 0, 0, img.width, img.height, 0, 0, width, height)
                // 缩放尺寸并用jpg压缩
                var fileBlob = dataURItoBlob(canvas.toDataURL('image/jpeg', 0.88))
                if (fileBlob.size) {
                    $ionicLoading.show({
                        template: '图片上传中，请稍候'
                    })
                    var formData = new FormData()
                    formData.append('fileName', fileBlob, 'upload.jpg')
                    formData.append('imgType', '1')
                    formData.append('token', Storage.get('ws-token'))
                    formData.append('platCode', signKey.platCode)
                    $http({
                        url: chatDomain + '/upload/uploadImg.do',
                        method: 'POST',
                        timeout: 10000,
                        headers: {
                            'content-type': undefined //'multipart/form-data; boundary='
                        },
                        data: formData,
                        transformRequest: function() {
                            return formData
                        }
                    }).success(function(data) {
                        $ionicLoading.hide()
                        self.sendMessage('[img:' + data.bigUrl + ']')
                        setTimeout(self.toBottom, 350)
                    }).error(function(data, status, header, config) {
                        $ionicLoading.hide()
                        Tools.tip('网络繁忙, 图片发送失败, 请稍候再次尝试')
                    })
                }
            }
        }

        self.sendAvatar = function(file) {
            var reader = new FileReader()

            reader.addEventListener("load", function(e) {
                processAvatar(e.target.result);
            }, false);

            reader.readAsDataURL(file);

            function processAvatar(src) {
                // 加载裁切组件
                $ocLazyLoad.load({
                    serie: true,
                    files: [
                        '/static/js/crop/transform.js',
                        '/static/js/crop/alloy_finger.js',
                        '/static/js/crop/alloy-crop.js'
                    ]
                }).then(function() {
                    Tools.tip('设置头像展示区域');
                    new AlloyCrop({
                        image_src: src,
                        circle: false, // optional parameters , the default value is false
                        width: 200, // crop width
                        height: 200, // crop height
                        output: 2, // output resolution --> 400*200
                        ok: function(base64, canvas) {
                            var fileBlob = dataURItoBlob(base64)
                            if (fileBlob.size) {
                                $ionicLoading.show({
                                    template: '头像上传中，请稍候'
                                })
                                var formData = new FormData()
                                formData.append('fileName', fileBlob, 'upload.png')
                                formData.append('imgType', '2')
                                formData.append('token', Storage.get('ws-token'))
                                formData.append('platCode', signKey.platCode)
                                $http({
                                    url: chatDomain + '/upload/uploadImg.do',
                                    method: 'POST',
                                    timeout: 10000,
                                    headers: {
                                        'content-type': undefined //'multipart/form-data; boundary='
                                    },
                                    data: formData,
                                    transformRequest: function() {
                                        return formData
                                    }
                                }).success(function(data) {
                                    $ionicLoading.hide()
                                    Tools.tip('头像设置成功');
                                }).error(function(data, status, header, config) {
                                    $ionicLoading.hide()
                                    Tools.tip('网络繁忙, 图片发送失败, 请稍候再次尝试')
                                })
                            }
                        },
                        cancel: function() {},
                        ok_text: "确认",
                        cancel_text: "取消"
                    });
                })
            }
        }

        self.loadTest = function() {
            // 加载裁切组件
            $ocLazyLoad.load({
                serie: true,
                files: [
                    '/static/js/crop/transform.js',
                    '/static/js/crop/alloy_finger.js',
                    '/static/js/crop/alloy-crop.js'
                ]
            }).then(function() {
                Tools.tip('设置头像展示区域');
                new AlloyCrop({
                    image_src: "/mobile/images/chat/packavatar.jpg",
                    circle: false, // optional parameters , the default value is false
                    width: 200, // crop width
                    height: 200, // crop height
                    output: 2, // output resolution --> 400*200
                    ok: function(base64, canvas) {},
                    cancel: function() {},
                    ok_text: "确认",
                    cancel_text: "取消"
                });
            })
        }

    });

function dataURItoBlob(dataURI) {
    'use strict'
    var byteString,
        mimestring

    if (dataURI.split(',')[0].indexOf('base64') !== -1) {
        byteString = atob(dataURI.split(',')[1])
    } else {
        byteString = decodeURI(dataURI.split(',')[1])
    }

    mimestring = dataURI.split(',')[0].split(':')[1].split(';')[0]

    var content = new Array();
    for (var i = 0; i < byteString.length; i++) {
        content[i] = byteString.charCodeAt(i)
    }

    return new Blob([new Uint8Array(content)], { type: mimestring });
}