angular.module('ionicz')

.config(function($stateProvider, $urlRouterProvider, ToolsProvider, ROUTE_ACCESS) {
	var version = ToolsProvider.getVersion();
	
	$stateProvider
	
	.state('login', {
    	url: '/login',
    	data : {access : ROUTE_ACCESS.PUBLIC},
    	templateUrl: '/mobile/views/login/login.html',
    	controller: 'LoginCtrl'
    })
    
    .state('reg', {
    	url: '/reg',
    	data : {access : ROUTE_ACCESS.PUBLIC},
    	templateUrl: '/mobile/views/login/reg.html',
    	controller: 'RegCtrl'
    })
	
	.state('home', {
		url: '/home',
    	data : {access : ROUTE_ACCESS.PUBLIC},
    	templateUrl: '/mobile/views/home/index.html',
		controller: 'HomeCtrl',
		resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.controllers",
					files : [
                        '/static/gamedatas.js?v=' + ToolsProvider.getVersion()
					]
				}]);
			} ]
		}
	})
	
	.state('ucenter', {
    	url: '/ucenter',
    	abstract: true,
    	template: '<ion-nav-view name="ucenter-view"></ion-nav-view>'
    })
    
    .state('ucenter.index', {
    	url: '/index',
    	cache: false,
		views: {
    		'ucenter-view': {
    			templateUrl: '/mobile/views/ucenter/index.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('ucenter.myinfo', {
    	url: '/myinfo',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'ucenter-view': {
    			templateUrl: '/mobile/views/ucenter/myinfo.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('ucenter.myfpwd', {
    	url: '/myfpwd',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'ucenter-view': {
    			templateUrl: '/mobile/views/ucenter/mymdfpwd.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('ucenter.notice', {
    	url: '/notice',
    	views: {
    		'ucenter-view': {
    			templateUrl: '/mobile/views/ucenter/notice.html',
    			controller: 'NoticeCtroller'
    		}
    	}
    })
    
    .state('ucenter.fundpwd', {
    	url: '/fundpwd',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	views: {
    		'ucenter-view': {
    			templateUrl: '/mobile/views/ucenter/fundpwd.html',
    			controller: 'UCenterCtrl'
    		}
    	}
    })
    
    .state('activity', {
    	url: '/activity',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	templateUrl: '/mobile/views/activity/index.html',
		controller: 'ActivityCtrl',
		resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.controllers",
					files : [
					    '/mobile/views/activity/js/activity.js'
					]
				}]);
			} ]
		}
    })
    
    .state('login_activity', {
    	url: '/login_activity/:topActivityId',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	templateUrl: '/mobile/views/activity/login_activity.html',
    	controller: 'LoginActivityCtrl',
    	resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.controllers",
					files : [
						'/mobile/css/activity.css',
					    '/mobile/views/activity/js/login_activity.js'
					]
				}]);
			} ]
		}
    })
    
    .state('cont_activity', {
    	url: '/cont_activity/:topActivityId',
    	data : {access : ROUTE_ACCESS.CHECK_TEST},
    	templateUrl: '/mobile/views/activity/cont_activity.html',
    	controller: 'ContActivityCtrl',
    	resolve : {
			deps : [ "$ocLazyLoad", function($ocLazyLoad) {
				return $ocLazyLoad.load([{
					name : "ionicz.controllers",
					files : [
						'/mobile/css/activity.css',
					    '/mobile/views/activity/js/cont_activity.js'
					]
				}]);
			} ]
		}
    });
    
	$urlRouterProvider.otherwise('/home');
});