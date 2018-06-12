angular.module('ionicz.controllers')

    .controller('ActivityCtrl', function($scope, $log, $timeout, Tools) {
        function initActi() {
            Tools.ajax({
                url: '/api/mobile/activity?t=' + Math.random(),
                method: 'GET',
                success: function(data) {
                    var actiMap = {};
                    for(var i=0; i<data.length; i++) {
                        actiMap[data[i].activityType] = data[i];
                    }
                    $scope.actiMap = actiMap;
                }
            });
        }

        initActi();

        $scope.showActiInfo=function(acti){
            Tools.modal({
                title: acti.name,
                template: acti.activityDesc,
                callback: function(scope, popup) {
                    popup.close();
                }
            });
        }
    });