window.onerror = function(errorMessage, scriptURI, lineNumber) {
    if(errorMessage.indexOf('srcEvent') > -1 || errorMessage == 'Script error.') {
    	return true;
    }
};

function randomString(len) {
	len = len || 32;
	var $chars = 'ABCDEFGHJKMNPQRSTWXYZabcdefhijkmnprstwxyz2345678';    /** **默认去掉了容易混淆的字符oOLl,9gq,Vv,Uu,I1*** */
	var maxPos = $chars.length;
	var pwd = '';
	for (i = 0; i < len; i++) {
		pwd += $chars.charAt(Math.floor(Math.random() * maxPos));
	}
	return pwd;
}

var ioniczApp = angular.module('ionicz', [ 
    'ionic',
    'oc.lazyLoad',
    'ngSanitize',
    'ionicz.config', 
    'ionicz.providers', 
    'ionicz.filters', 
    'ionicz.directives', 
    'ionicz.controllers',  
    'ionicz.services', 
    'ionicz.lottery', 
    'ionicz.bank', 
    'angular-md5',
    'ngCookies'
])

.run(function($ionicPlatform, $rootScope, $log, $state, $location, PATH, ROUTE_ACCESS, Tools, AppInit) {
	$ionicPlatform.ready(function() {
		if (window.cordova && window.cordova.plugins.Keyboard) {
			cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
			cordova.plugins.Keyboard.disableScroll(true);
		}
		if (window.StatusBar) {
			StatusBar.styleDefault();
		}
	});
	
	AppInit.loadConfig().then(function(appConfig) {
		// 设置到全局变量，其他很多地方有用到webAppConfig
		webAppConfig = appConfig;
		
		$rootScope.appConfig = appConfig;
		// 各平台扩展代码，如引入统计代码
    	if(typeof(appConfig.extendJs) != 'undefined') {
    		eval(appConfig.extendJs);
    	}
    	
    	// 因为相同的地址刷新会无效，所以这里随机设置一个参数，保证和当前地址不一致即可触发刷新
		$location.search({_r: randomString(6)}).replace();;
	});

	// 路由切换监听，如果路由必须登陆才可以访问，则判断登陆状态，如果未登录则跳转到登陆页面
	$rootScope.$on('$stateChangeStart', function(event, toState, toParams, fromState, fromParams) {
		if(!$rootScope.inited) {
			return;
		}
		
		//Backdrop.show();
		
		var data = toState.data || {};
		if(data.access !== ROUTE_ACCESS.PUBLIC) {
			if(!$rootScope.isLogin) {
				window.location.href = '#' + PATH.loginPath;
			}
			
			// 不允许访客访问的路由需要验证是否是访客
			if(data.access == ROUTE_ACCESS.CHECK_TEST) {
				if($rootScope.isTestAccount) {
					Tools.tip('试玩帐号无权访问，请先注册');
					event.preventDefault();
				}
			}
		}
		else {
			
		}
	});
	
	/*
	$rootScope.$on('$stateChangeSuccess', function(event, toState, toParams, fromState, fromParams) {
		if($rootScope.inited) {
			Backdrop.hide(500);
		}
	});
	*/
	
	Backdrop.hide(500);
});

angular.module('ionicz.lottery', []);
angular.module('ionicz.bank', []);