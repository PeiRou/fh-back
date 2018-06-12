angular.module('ionicz.controllers')

    .controller('LoginActivityCtrl', function($scope, $log, $timeout, Tools) {
        $log.debug("LoginActivityCtrl...");

        var lObj = {
            light1: [
                '/mobile/images/activity/login/redlights.png',
                '/mobile/images/activity/login/redlights_un.png'
            ],
            light2: [
                '/mobile/images/activity/login/whitelights.png',
                '/mobile/images/activity/login/whitelights_un.png'
            ]
        };

        function bgChange() {
            var l1 = document.getElementById('light1'),
                l2 = document.getElementById('light2');

            function cg(id) {
                if (lObj[id.id][0].indexOf(id.src.split('/')[id.src.split('/').length - 1]) > -1) {
                    id.src = lObj[id.id][1];
                } else {
                    id.src = lObj[id.id][0];
                }
            }
            setInterval(function() {
                cg(l1);
                cg(l2);
            }, 1000)

        }

        bgChange();

        //roll
        var $bg = document.getElementById('rollbar'),
            getPoint = { //奖项点
                1: [
                    225
                ],
                2: [
                    45
                ],
                3: [
                    180
                ],
                4: [
                    0
                ],
                5: [
                    270
                ],
                6:[
                    90
                ],
                7:[
                    135, 315
                ]
            },
            runStatus = 1, //起跑状态
            nowdeg = 0, //起始位置
            time = 14, //旋转间隔时间
            countRound = 0, //计算圈数
            countDeg = 0, //计算度数
            times = 1, //是否有参与次数
            result = null, //结果
            stopPoint; //停靠点

        var roll = {
            run: function() {
                var that = this;
                runStatus = 0;
                Tools.ajax({
                    url : '/acti/loginLuckDraw.do?activityId=' + $scope.activity.id,
                    success : function(data) {
                        if (data) {
                            roll.getResult(data==-1 ? 7 : data);
                            that.boxRun();
                        }
                    }
                });
            },
            speedCtrl: function() {
                //角度归零
                if (nowdeg == 360) {
                    nowdeg = 0;
                }

                //加速阶段
                if (!result && nowdeg % 60 == 0) {
                    if (time > 4) {
                        time -= 4;
                    }
                    return;
                }
                //减速阶段
                if (result && nowdeg % 30 == 0) {
                    time += 2;
                }
                //停止阶段
                if (result) {
                    if (time > 10 && nowdeg == stopPoint) {
                        times = 0;
                        runStatus = 1;
                        clearInterval(rolltimer);
                        // 结果提示
                        var noticeToUserMsg = "真遗憾，竟然没中奖~";
                        if (result != 7) {
                            noticeToUserMsg = "恭喜您获得：" + $scope.activity.details[0].prizeList[result - 1].name;
                        }
                        Tools.tip(noticeToUserMsg, 2000);
                    }
                }

            },
            boxRun: function() {
                var that = this;

                function go() {
                    nowdeg += 1;
                    countDeg++;
                    $bg.style.webkitTransform = 'rotate(' + nowdeg + 'deg)';
                    rolltimer = setTimeout(go, time);
                    that.speedCtrl();
                }
                go();
            },
            getResult: function() {
                var arg = arguments[0];

                setTimeout(function() {
                    result = arg;

                    var pScope = getPoint[arg][Math.floor(Math.random() * getPoint[arg].length)] + 5,
                        random = Math.floor(Math.random() * 36);
                    stopPoint = pScope + random;

                }, 6000)

            }
        };

        $scope.rollRun = function() {
            if (!runStatus) {
                Tools.tip('请耐心等待结果');
                return;
            }

            if ($scope.rollType) {
                roll.run();
                $scope.rollType = false;
            } else {
                Tools.tip('今天的抽奖机会已用完，请明日再来', 3000);
            }
        };

        var initData = function() {
            Tools.ajax({
                url: Tools.staticPath() + 'data/acti.js?t=' + Math.random(),
                method: 'GET',
                success: function(data) {
                    var activity;
                    for(var i=0; i<data.length; i++) {
                        if(data[i].activityType == 3) {
                            activity = data[i];
                            break;
                        }
                    }

                    if(!activity) {
                        Tools.alert('活动不存在');
                        return;
                    }

                    $scope.activity = activity;

                    Tools.ajax({
                        url: '/api/mobile/acti/getTodayUserActivity?topActivityId=' + activity.topActivityId,
                        //url: '/api/mobile/acti/getUserActivityList?topActivityId=' + activity.topActivityId,
                        success: function(data) {
                            if (data.joinStatus == 1) {
                                $scope.rollType = true;
                            }
                        }
                    });
                }
            });
        }

        initData();
    });