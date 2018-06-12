angular.module('ionicz.controllers')

    .controller('ContActivityCtrl', function($scope, $log, $stateParams, $timeout, Tools) {
        $log.debug("ContActivityCtrl...");

        var topActivityId = $stateParams.topActivityId;
        var eggActiId = null;

        eggFuc = {
            init: function() {
                // 数据初始化
                Tools.ajax({
                    url: Tools.staticPath() + 'data/acti.js?t=' + Math.random(),
                    method: 'GET',
                    success: function(data) {
                        var activity;
                        for (var i = 0; i < data.length; i++) {
                            if (data[i].topActivityId == topActivityId) {
                                activity = data[i];
                                break;
                            }
                        }

                        if (!activity) {
                            Tools.alert('活动不存在');
                            return;
                        }

                        $scope.activity = activity;

                        Tools.ajax({
                            url: '/api/mobile/acti/getUserActivityList?topActivityId=' + activity.topActivityId,
                            success: function(data) {
                                if (data.length && data[0].joinStatus != 3) {
                                    if(data[0].joinStatus == 2) {
                                        $scope.openstatus = true;
                                    }
                                    $scope.daycount = data[0].activitySort;
                                    eggActiId = data[0].activityId;
                                    domInit();
                                }
                            }
                        });
                    }
                })

                function domInit() {
                    if($scope.openstatus) {
                        $scope.eggsrc = '/mobile/images/activity/cont/egg_op.png';
                        return;
                    }
                    $scope.ani = 'ani';
                    $scope.eggsrc = '/mobile/images/activity/cont/egg.png';
                }
                function timeOutCheck() {

                }
            },
            ctrl: function() {
                if(!$scope.daycount) {
                    Tools.tip('今日未完成签到任务');
                    return;
                }
                if (!$scope.openstatus) {
                    $scope.openstatus = true;
                    Tools.ajax({
                        url : '/acti/luckDraw.do?activityId=' + eggActiId,
                        success : function(data) {
                            if (data == 'EMPTY') {
                                Tools.alert('很遗憾，没中奖');
                            }else{
                                Tools.tip('恭喜你，中得' + data);
                            }
                        }
                    });
                    $scope.eggsrc = '/mobile/images/activity/cont/egg_op.png';
                    $scope.ani = '';
                } else {
                    Tools.tip('今日已抽奖');
                }
            }
        }

        $scope.eggsrc = '/mobile/images/activity/cont/egg_un.png';
        eggFuc.init();
        $scope.eggOpen = eggFuc.ctrl;
    });