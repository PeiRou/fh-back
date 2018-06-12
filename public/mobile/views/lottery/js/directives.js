angular.module('ionicz.lottery')

    .directive('myPopover', function(ENV) {
        return {
            restrict: 'C',
            scope: true,
            link: function(scope, element, attrs) {
                element.find('a').bind('click', function() {
                    scope.popover.hide();
                });
            }
        }
    })

    .directive('scrollbarX', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                if (element.attr('scrollbar-x') == 'false') {
                    element.removeClass('scroll-x');
                }
            }
        }
    })

    /**
     * 下注项指令
     * 该指令实现以下功能：
     * 1：根据元素上填写的data-id填充该玩法的赔率显示在页面；
     * 2：记忆选中状态，如果之前是选中状态，切换回来默认选中；
     * 3：点击事件，点击切换选中和未选中
     */
    .directive('bet', function(Lottery) {
        return {
            restrict: 'C',
            scope: true,
            link: function(scope, element, attrs) {
                var dataId = element.attr('data-id');
                var oddsElement = angular.element(element[0].querySelector('.bet-item'));

                function init() {
                    var play = Lottery.getPlay(dataId);
                    if (!play) {
                        oddsElement.html('--');
                    } else {
                        if (scope.isExist(dataId)) {
                            element.addClass('bet-choose');
                        }

                        oddsElement.html(play.odds);

                        element.bind('click', function() {
                            if (scope.shareData.lotteryState != 1) {
                                return;
                            }
                            var selected = element.hasClass('bet-choose');
                            // 如果已经是选中状态，移除
                            if (selected) {
                                scope.removeDataId(dataId);
                            } else {
                                scope.addDataId(dataId);
                            }

                            element.toggleClass('bet-choose');
                        });
                    }
                }

                if (Lottery.isInit()) {
                    init();
                } else {
                    scope.$on('lotteryPlayInited', function($scope) {
                        init();
                    });
                }
            }
        }
    })

    .directive('subBet', function(Lottery) {
        return {
            restrict: 'C',
            scope: false,
            link: function(scope, element, attrs) {
                var dataId = element.attr('data-id');

                function init() {
                    var play = Lottery.getPlay(dataId);
                    if (play) {
                        var oddsElement = angular.element(element[0].querySelector('.bet-item'));
                        oddsElement.html(play.odds);
                    }

                    element.bind('click', function() {
                        if (scope.shareData.lotteryState != 1) {
                            return;
                        }
                        var selected = element.hasClass('bet-choose');
                        var flag = false;
                        // 如果已经是选中状态，移除
                        if (selected) {
                            flag = scope.removeNum(dataId);
                        } else {
                            flag = scope.addNum(dataId);
                        }

                        if (flag) {
                            element.toggleClass('bet-choose');
                        }
                    });
                }

                if (Lottery.isInit()) {
                    init();
                } else {
                    scope.$on('lotteryPlayInited', function($scope) {
                        init();
                    });
                }
            }
        }
    })

    .directive('perio', function($rootScope, $filter, $timeout, $interval, $log, Tools, Lottery, My, $location) {
        var __scope = null;
        var diffTime  = $rootScope.diffTime; //客户端与服务器的时间差
        var tpl = {};
        var gameId = null;
        var childRuned = null;
        var openData = false; // 结束标志
        var endDiffSecond  = 0; //封盘倒计时初始化
        var lotteryDiffSecond = 0; //开奖倒计时初始化
        var timerNum = 0;

        //到时间出现封盘字样
        var filterEndHtml = function (endDiffSecond) {
            if(endDiffSecond < 0) {
                endDiffSecond = 0;
            }
            __scope.endTimeHtml = $filter('tick')(endDiffSecond, '已封盘');
        };

        //开奖时显示开奖中
        var filterLotteryHtml = function (lotteryDiffSecond) {
            if(lotteryDiffSecond < 0) {
                lotteryDiffSecond = 0;
            }
            __scope.lotteryTimeHtml = $filter('tick')(lotteryDiffSecond, '获取下一期');
            //console.log(lotteryDiffSecond);
        };

        //序列开奖号码
        var processCode = function (nums) {
            if(!nums){
                return;
            }
            if (!angular.isArray(nums)) {
                nums = nums.split(',');
            }
            if (nums.length < 3) {
                return;
            }
            __scope.codeHtml = $filter('codeHtml')(nums, gameId, 'lottery');
            //console.log('正在呈现的号码：'+nums)
        };

        //停止
        var stop = function () {
            __scope.shareData.lotteryState = 0;
            __scope.reset();
        };

        //获取下一期的开奖数据
        var getNextIssueData = function () {
            var url = '/api/lottery/getNextIssue.do?gameId='+ gameId + '&t=' + new Date().getTime();
            Tools.ajax({
                url: url,
                dataType: 'json',
                method: 'GET',
                success:function (data) {
                    if(gameId == data.gameId){
                        //console.log('游戏ID匹配');
                        if(__scope.curIssue != data.issue){
                            //console.log('当前期数：'+__scope.curIssue);
                            //console.log('服务返回的当前期数：'+ data.issue);

                            var pre_change = __scope.preIssue != data.preIssue;
                            __scope.shareData.curIssue = data.issue; // 指定当前期数
                            __scope.curIssue = data.issue;
                            __scope.preIssue = data.preIssue;
                            //console.log('已定义当前期数：'+__scope.curIssue+'，上一期期数：'+__scope.preIssue);

                            if(data.issue - data.preIssue == 1){
                                curRuned = false;
                                //console.log('期数已矫正完毕，curRuned：'+curRuned);
                            } else {
                                curRuned = true;
                            }
                            //console.log('游戏是否已封盘：'+Lottery.isBan(gameId));
                            if (Lottery.isBan(gameId)) {
                                __scope.endTimeHtml = '未开盘';
                                __scope.lotteryTimeHtml = '未开盘';
                                __scope.shareData.lotteryState = -1;
                                return;
                            }

                            var nowTime = moment().add(diffTime, 's');
                            var lotteryTime = moment(data.lotteryTime);
                            var endTime = moment(data.endTime);
                            //console.log('服务器获取开奖时间：'+lotteryTime+",封盘时间："+endTime);

                            endDiffSecond = endTime.diff(nowTime, 's'); // 封盘倒计时
                            lotteryDiffSecond = lotteryTime.diff(nowTime, 's'); // 开奖倒计时
                            //console.log('封盘倒计时：'+endDiffSecond);
                            //console.log('开奖倒计时：'+lotteryDiffSecond);

                            if(data.preIsOpen && (pre_change)){
                                //console.log('开始呈现上一期开奖号码');
                                processCode(data.preNum);
                            }

                            //判断时间状态
                            // 如果当前时间距离封盘时间大于10分钟且不是六合彩，则当作封盘处理
                            if(endDiffSecond > 60 * 10 && gameId != 70){
                                __scope.shareData.lotteryState = 0;
                            } else if (endDiffSecond <= 0) {
                                stop();
                            } else {
                                __scope.shareData.lotteryState = 1;
                            }
                            //console.log('当前彩种状态：'+__scope.shareData.lotteryState);
                            filterEndHtml(endDiffSecond);
                            filterLotteryHtml(lotteryDiffSecond);
                            childRuned = true;
                        } else {
                            if(__scope.preIssue != data.preIssue){
                                __scope.preIssue = data.preIssue;
                                processCode(data.preNum);
                                curRuned = false;
                            }
                        }
                    } else {
                        // if($rootScope.isLogin){
                        //     curRuned = false;
                        //     childRuned = false;
                        //     My.clear();
                        //     $rootScope.isLogin = false;
                        //     Tools.confirm('登陆已超时',function() {
                        //         $location.path('/login');
                        //     });
                        // }
                    }
                }
            });
        };

        var getCurIssueData = function() {
            $log.debug('获取下一期的开奖数据');
            var url = '/api/lottery/CurIssue/' + gameId + '?_=' + Math.random();
            Tools.ajax({
                url: url,
                method: 'GET',
                success: function(curIssueData) {
                    if (!curIssueData) {
                        return;
                    }

                    processCode(curIssueData.nums, curIssueData.opentime);
                    if (__scope.curIssue == null || __scope.curIssue - curIssueData.issue <= 1) {
                        //$log.debug('获取到开奖数据，停止定时器');
                        __scope.preIssue = curIssueData.issue;
                        curRuned = false;
                    }
                },
                error:function () {
                    Tools.tip("网络异常，请稍后重试或请联系客服");
                }
            })
        };

        var curIssueTimer = $interval(function() {
            if (!curRuned) {
                return;
            }
            console.log('获取下一期开奖数据');
            //getNextIssueData();
            getCurIssueData();
        }, 2000);

        var childTimer = $interval(function() {
            if (!childRuned) {
                return;
            }
            timerNum++;

            if (timerNum % 10 == 0) {
                getNextIssueData();
                timerNum = 0;
            }

            lotteryDiffSecond--;
            if (endDiffSecond <= 0) {
                stop();
            } else {
                endDiffSecond--;
                filterEndHtml(endDiffSecond);
            }
            filterLotteryHtml(lotteryDiffSecond);
            if (lotteryDiffSecond == 0) {
                //curRuned = true;
                getNextIssueData();
            }
        },1000);

        //返回填充数据
        return {
            restrict: 'C',
            scope: true,
            template: '<div>' +
            '<div class="pre-perio">' +
            '<div class="col item" ng-show="codeHtml.length > 0">' +
            '<span class="preissue">{{ preIssue }}期</span>' +
            '<div class="lottery-nums" ng-bind-html="codeHtml"></div>' +
            '</div>' +
            '</div>' +

            '<div class="cur-perio" ng-show="curIssue">' +
            '<div class="col item">' +
            '<span>{{curIssue}}期 封盘:</span><span class="time">{{ endTimeHtml }}</span><span>开奖:</span> <span class="time">{{ lotteryTimeHtml }}</span>' +
            '</div>' +
            '</div>' +
            '</div>',
            replace: true,
            link:function (scope, element, attrs) {
                __scope = scope;
                gameId = scope.gameId;

                scope.curIssue = null;
                scope.preIssue = null;

                scope.$watch('curIssue', function(newValue) {
                    if (!newValue) {
                        return;
                    }
                    //console.log('$watch curIssue, newValue: ' + newValue + ', scope.preIssue: ' + scope.preIssue);
                    if (newValue - scope.preIssue  >= 2) {
                        $log.debug(newValue+'下一期数据已经生成，2秒后开启定时器获取这期的开奖数据'+scope.preIssue);
                        $timeout(function() {
                            curRuned = true;
                        }, 30000, false);
                    }
                });

                scope.$on('lotteryInited', function($scope) {
                    numStyle = Lottery.getNumStyle(gameId, 'lottery');
                    tpl = Lottery.getTpl(gameId);
                    element.parent().addClass(tpl.group);
                    scope.shareData.lotteryState = 1;
                });

                scope.$on('lotteryEnter', function($scope) {
                    __scope = scope;
                    gameId = scope.gameId;
                    childRuned = false;
                    curRuned = false;
                    getNextIssueData();
                    getCurIssueData();
                });

                scope.$on('lotteryLeave', function($scope) {
                    stop();
                    __scope.curIssue=0;
                    if (scope.gameId == gameId) {
                        childRuned = false;
                    }
                });
            }
        }
    })

    .directive('lotteryTimer', function($rootScope, $filter, $interval, $log, Tools) {
        return {
            restrict: 'EC',
            scope: false,
            template: '<div class="item" ng-repeat="game in gameList track by game.id"><a href="#/lottery/index/{{game.id}}"><h3>{{game.name}}</h3><span>{{texts[game.id]}}<ion-spinner ng-show="!texts[game.id]" class="spinner spinner-ios"></ion-spinner></span></a></div>',
            replace: true,
            link: function(scope, element, attrs) {
                var diffTime = $rootScope.diffTime;
                var mainTimer = null;
                var allIssueTimer = null;
                var timeMap = {};

                scope.texts = {};

                var startTimer = function() {
                    $interval.cancel(allIssueTimer);

                    Tools.ajax({
                        //					url: Tools.staticPath() + 'data/' + 'allNextIssue.json?_' + Math.random(),
                        url: '/api/lottery/getAllNextIssue.do?_' + new Date().getTime(),
                        method: 'GET',
                        success: function(allNextIssueData) {
                            if (!allNextIssueData) {
                                return;
                            }

                            for (var gameId in allNextIssueData) {
                                var issueDate = allNextIssueData[gameId];
                                var nowTime = moment().add(diffTime, 's');
                                var lotteryTime = moment(issueDate.lotteryTime);
                                var lotteryDiffSecond = lotteryTime.diff(nowTime, 's'); // 开奖倒计时
                                timeMap[gameId] = lotteryDiffSecond;
                            }

                            allIssueTimer = $interval(function() {
                                var isRestart = false;
                                for (var gameId in timeMap) {
                                    var lotteryDiffSecond = timeMap[gameId];
                                    if (lotteryDiffSecond < -60 * 30) {
                                        scope.texts[gameId] = '未开盘';
                                    } else {
                                        scope.texts[gameId] = $filter('tick')(lotteryDiffSecond, '获取下一期');
                                    }
                                    lotteryDiffSecond--;
                                    timeMap[gameId] = lotteryDiffSecond;
                                    if (lotteryDiffSecond == 0) {
                                        isRestart = true;
                                    }
                                }
                                if (isRestart) {
                                    startTimer();
                                }
                            }, 1000);
                        }
                    });
                };

                var startMainTimer = function() {
                    $interval.cancel(mainTimer);
                    mainTimer = $interval(function() {
                        startTimer();
                    }, 10000);
                };

                scope.$on('lotteryListEnter', function($scope) {
                    $log.debug('------------lotteryListEnter------------');
                    startTimer();
                    startMainTimer();
                });

                scope.$on('lotteryListLeave', function($scope) {
                    $log.debug('------------lotteryListLeave------------');
                    $interval.cancel(mainTimer);
                    $interval.cancel(allIssueTimer);
                });
            }
        }
    })

    .directive('zodiac', function($interpolate) {
        // 所有生肖集合
        var zodiacs = ['鼠', '牛', '虎', '兔', '龙', '蛇', '马', '羊', '猴', '鸡', '狗', '猪'];
        // 取gamedatas.js里的animalsYear属性
        // var animalsYear = '鸡';

        return {
            restrict: 'A',
            scope: true,
            link: function(scope, element, attrs) {
                var text = attrs['zodiac'];
                var max = attrs['max'] || 49;
                var zodiacIndex = zodiacs.indexOf(animalsYear);
                var index = zodiacs.indexOf(text);
                if (zodiacIndex < index) {
                    zodiacIndex += 12;
                }

                var tmp = $interpolate('<span class="round-3 {{num|lhcColor}}">{{num}}</span>');
                var html = '';
                var m = (zodiacIndex - index) + 1;
                var num = m;
                while (num <= max) {
                    html += tmp({ num: num });;
                    num += 12;
                }
                element.append(html);
            }
        }
    })

    //文件上传change事件支持
    .directive('fileUpLoad', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                   var onChangeHandler = scope.$eval(attrs.fileUpLoad);
                   element.bind('change', onChangeHandler);
             }
        };
    })
    //聊天图片加载成功指令
    .directive('imageonload', function() {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                element.bind('load', function() {
                    //call the function that was passed
                    scope.$apply(attrs.imageonload);
                });
            }
        };
    })

    .directive('zoomView', function($compile, $ionicModal, $ionicPlatform) {
        return {

            restrict: "A",

            link: function link(scope, elem, attr) {

                $ionicPlatform.ready(function () {

                    elem.attr("ng-click", "showZoomView()");
                    elem.removeAttr("zoom-view");
                    $compile(elem)(scope);

                    var zoomViewTemplate = "\n          <style>\n          .zoom-view .scroll { height:100%; }\n          </style>\n          <ion-modal-view class=\"zoom-view\">\n          <ion-header-bar>\n          <h1 class=\"title\"></h1>\n          <button ng-click=\"closeZoomView()\" class=\"button button-clear button-dark\">完成</button>\n          </ion-header-bar>\n          <ion-content>\n          <ion-scroll zooming=\"true\" direction=\"xy\" style=\"width: 100%; height: 100%; position: absolute; top: 0; bottom: 0; left: 0; right: 0; \">\n          <img ng-src=\"{{ngSrc}}\" style=\"width: 100%!important; display:block;   width: 100%; height: auto; max-width: 400px; max-height: 700px; margin: auto; padding: 10px; \"></img>\n          </ion-scroll>\n          </ion-content>\n          </ion-modal-view>\n          ";

                    scope.zoomViewModal = $ionicModal.fromTemplate(zoomViewTemplate, {
                    scope: scope,
                    animation: "slide-in-up" });

                    scope.showZoomView = function () {
                        scope.zoomViewModal.show();
                        scope.ngSrc = attr.zoomSrc;
                    };

                    scope.closeZoomView = function () {
                        scope.zoomViewModal.hide();
                    };
                });
            }
        };
    })