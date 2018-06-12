angular.module('ionicz')

.config(function($stateProvider, $urlRouterProvider, ToolsProvider, ROUTE_ACCESS) {
	var version = ToolsProvider.getVersion();
	$stateProvider
	
	// 游戏父级路由，子级路由都会加载父级路由
	.state('lottery', {
		url: '/lottery',
		abstract: true,
		cache: false,
		template: '<ion-nav-view name="lottery-view" class="lottery"></ion-nav-view>',
		controller: 'BaseCtrl',
		resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.lottery",
					files : [
						'/mobile/views/lottery/js/config.js',
					    '/mobile/views/lottery/js/controllers.js',
					    '/mobile/views/lottery/js/services.js',
					    '/mobile/views/lottery/js/filters.js',
					    '/mobile/views/lottery/js/directives.js',
					    '/static/gamedatas.js?v=' + ToolsProvider.getVersion()
					]
				}]);
			} ]
		}
	})
	
	.state('lottery.list', {
    	url: '/list',
    	cache: false,
		views: {
			'lottery-view': {
				templateUrl: '/mobile/views/lottery/list.html',
				controller: 'ListCtrl'
			}
		}
    })
    
    .state('lottery.index', {
    	url: '/index/:gameId',
		cache: true,
		views: {
			'lottery-view': {
				templateUrl: '/mobile/views/lottery/lottery.html?v=2.9.5',
				controller: 'LotteryCtrl'
			}
		}
    })
    
    .state('lottery.history', {
    	url: '/history/:gameId',
		cache: false,
		views: {
			'lottery-view': {
				templateUrl: '/mobile/views/lottery/history.html',
				controller: 'HistoryCtrl'
			}
		}
    })
    
    .state('lottery.notcount', {
    	url: '/notcount',
		views: {
			'lottery-view': {
				templateUrl: '/mobile/views/lottery/notcount.html',
				controller: 'NotcountCtrl'
			}
		}
    })
    
    .state('lottery.detail', {
    	url: '/notcount/detail/:gameId/:gameName',
    	cache: false,
		views: {
			'lottery-view': {
				templateUrl: '/mobile/views/lottery/notcount_detail.html',
				controller: 'NotcountDetailCtrl'
			}
		}
    })
    
    .state('lottery.settled', {
    	url: '/settled',
    	cache: false,
		views: {
			'lottery-view': {
				templateUrl: '/mobile/views/lottery/settled.html',
				controller: 'SettledCtrl'
			}
		}
    })
    
    
    .state('lottery.changLong', {
    	url: '/changLong/:gameId',
    	cache: false,
    	views: {
    		'lottery-view': {
    			templateUrl: '/mobile/views/lottery/changLong.html',
    			controller: 'ChangLongCtrl'
    		}
    	}
    })
    
    .state('lottery.luZhu', {
    	url: '/luZhu/:gameId',
    	cache: false,
    	views: {
    		'lottery-view': {
    			templateUrl: '/mobile/views/lottery/luZhu.html',
    			controller: 'LuZhuCtrl'
    		}
    	}
    })
    
    .state('lottery.week', {
    	url: '/week',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'lottery-view': {
    			templateUrl: '/mobile/views/lottery/week.html',
    			controller: 'WeekRecordCtrl'
    		}
    	}
    })
    
    .state('lottery.day', {
    	url: '/day/:statDate',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'lottery-view': {
    			templateUrl: '/mobile/views/lottery/day.html',
    			controller: 'DayRecordCtrl'
    		}
    	}
    })
    
    .state('lottery.day_detail', {
    	url: '/day_detail/:gameId/:statDate',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'lottery-view': {
    			templateUrl: '/mobile/views/lottery/day_detail.html',
    			controller: 'DayDetailCtrl'
    		}
    	}
    })
    
    ;
});