//彩38图标
// var iconCfg = {
// 	"cqssc": {"icon": "/mobile/images/games/cqssc.png"},
// 	"xjssc": {"icon": "/mobile/images/g-xjssc.png"},
// 	"tjssc": {"icon": "/mobile/images/g-tjssc.png"},
// 	"jsk3": {"icon": "/mobile/images/games/g-beijing.png", "alias": "江苏快三"},
// 	"gd11x5": {"icon": "/mobile/images/games/g-beijing.png", "alias": "广东11选5"},
// 	"fc3d": {"icon": "/mobile/images/games/g-beijing.png"},
// 	"pk10": {"icon": "/mobile/images/games/bjsc.png", "alias": "北京赛车"},
// 	"xyft": {"icon": "/mobile/images/g-xyft.png"},
// 	"gdkl10": {"icon": "/mobile/images/g-klsf.png", "alias": "快乐十分"},
// 	"xync": {"icon": "/mobile/images/games/g-beijing.png", "alias": "幸运农场"},
// 	"bjkl8": {"icon": "/mobile/images/games/g-beijing.png"},
// 	"xykl8": {"icon": "/mobile/images/games/g-beijing.png"},
// 	"pcdd": {"icon": "/mobile/images/games/pcdd.png"},
// 	"xydd": {"icon": "/mobile/images/games/g-xydd.png"},
// 	"lhc": {"icon": "/mobile/images/games/xglhc.png"},
// 	"jspk10": {"icon": "/mobile/images/games/jssc.png"},
// 	"jsssc": {"icon": "/mobile/images/games/jsssc.png"},
// 	"jsft": {"icon": "/mobile/images/games/jsft.png"},
// 	"xykl8": {"icon": "/mobile/images/games/g-xykl8.png"},
// 	"xydd": {"icon": "/mobile/images/games/g-xydd.png"},
// 	"xylhc": {"icon": "/mobile/images/games/jslhc.png"}
// };

//爱彩图标
var iconCfg = {
    "cqssc": {"icon": "/mobile/images/aicai_games/g-ssc.png"},
    "xjssc": {"icon": "/mobile/images/g-xjssc.png"},
    "tjssc": {"icon": "/mobile/images/g-tjssc.png"},
    "jsk3": {"icon": "/mobile/images/games/g-beijing.png", "alias": "江苏快三"},
    "gd11x5": {"icon": "/mobile/images/games/g-beijing.png", "alias": "广东11选5"},
    "fc3d": {"icon": "/mobile/images/games/g-beijing.png"},
    "pk10": {"icon": "/mobile/images/aicai_games/g-bjpk10.png", "alias": "北京赛车"},
    "xyft": {"icon": "/mobile/images/g-xyft.png"},
    "gdkl10": {"icon": "/mobile/images/g-klsf.png", "alias": "快乐十分"},
    "xync": {"icon": "/mobile/images/aicai_games/g-beijing.png", "alias": "幸运农场"},
    "bjkl8": {"icon": "/mobile/images/games/g-beijing.png"},
    "xykl8": {"icon": "/mobile/images/games/g-beijing.png"},
    "pcdd": {"icon": "/mobile/images/aicai_games/g-pcdd.png"},
    "xydd": {"icon": "/mobile/images/games/g-xydd.png"},
    "lhc": {"icon": "/mobile/images/aicai_games/g-hkc.png"},
    "jspk10": {"icon": "/mobile/images/aicai_games/g_mssc.png"},
    "jsssc": {"icon": "/mobile/images/aicai_games/g-msssc.png"},
    "jsft": {"icon": "/mobile/images/aicai_games/g-msft.png"},
    "xykl8": {"icon": "/mobile/images/games/g-xykl8.png"},
    "xydd": {"icon": "/mobile/images/games/g-xydd.png"},
    "xylhc": {"icon": "/mobile/images/games/jslhc.png"}
};

angular.module('ionicz.controllers')
.controller('HomeCtrl', function($rootScope, $scope, $log, $timeout, Tools, Storage) {
    $scope.recoUser = Storage.get('recoUser');
    
    $scope.gameList = [];

    var gameList = [];
	for(var i in games) {
		var game = gameMap[games[i]];
		if (game.open !== 1) {
			continue;
		}
		
		if (gameList.length >= 10) {
			break;
		}
		
		var gameCfg = iconCfg[game.code] || {};
		gameList.push({id : game.id, text : gameCfg.alias || game.name, icon : gameCfg.icon});
	}

	//console.log(gameList);
	
	$scope.gameList = gameList;

    function initActi() {
        Tools.ajax({
            //url: Tools.staticPath() + 'data/acti.js?t=' + Math.random(),
            url: '/api/mobile/activity',
            method: 'GET',
            success: function(data) {
                var actiMap = {};
                for (var i = 0; i < data.length; i++) {
                    actiMap[data[i].activityType] = data[i];
                }
                $scope.actiMap = actiMap;
            }
        });
    }

    initActi();

    $scope.showActiInfo = function(acti) {
        Tools.modal({
            title: acti.name,
            template: acti.activityDesc,
            callback: function(scope, popup) {
                popup.close();
            }
        });
    }

    $scope.downApp = function(url) {
        Tools.confirm('确认要下载APP吗？', function() {
            window.open(url);
        });
    }
});