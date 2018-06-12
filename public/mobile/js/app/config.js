angular.module('ionicz.config', [])

.constant('ENV', {
	'moduleName': 'ionicz',
	'version' : '1.0.1',
	'apiServer': ''
})

.constant('PATH', {
	'loginPath' : '/login',
	'regPath' : '/reg',
	'homePath' : '/home'
})

.constant('ROUTE_ACCESS', {
	'PUBLIC' : 'public',
	'CHECK_TEST' : 'check_test'
})

.config(['$logProvider', function($logProvider) {
    $logProvider.debugEnabled(false);
}])

.config(function($ionicConfigProvider) {
	var configProperties = {
		/*views: {
			maxCache: 5,
			forwardCache: true,
			transition: 'ios'
		},*/
		
		navBar: {
			alignTitle: 'center'
		},
		
		backButton: {
			icon: 'ion-chevron-left',
			text: ' ',
			previousTitleText: false
		}
	};
	
	$ionicConfigProvider.setPlatformConfig('android', configProperties);
	$ionicConfigProvider.setPlatformConfig('ios', configProperties);
	
	$ionicConfigProvider.views.transition('no');
})

/*.config(function($ionicNativeTransitionsProvider){
    $ionicNativeTransitionsProvider.setDefaultOptions({
        duration: 100, // in milliseconds (ms), default 400,
        slowdownfactor: 4, // overlap views (higher number is more) or no overlap (1), default 4
        iosdelay: -1, // ms to wait for the iOS webview to update before animation kicks in, default -1
        androiddelay: -1, // same as above but for Android, default -1
        winphonedelay: -1, // same as above but for Windows Phone, default -1,
        fixedPixelsTop: 0, // the number of pixels of your fixed header, default 0 (iOS and Android)
        fixedPixelsBottom: 0, // the number of pixels of your fixed footer (f.i. a tab bar), default 0 (iOS and Android)
        triggerTransitionEvent: '$ionicView.afterEnter', // internal ionic-native-transitions option
        backInOppositeDirection: false // Takes over default back transition and state back transition to use the opposite direction transition to go back
    });
    
    $ionicNativeTransitionsProvider.setDefaultTransition({
        type: 'flip',
        direction: 'up'
    });
})*/

.config([ '$httpProvider', function httpProvider($httpProvider) {
	//$httpProvider.defaults.headers.put['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
	//$httpProvider.defaults.headers.post['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
	
	$httpProvider.defaults.headers.post['Accept'] = '*/*';

	$httpProvider.defaults.transformRequest = [ function(data) {
		var param = function(obj) {
			var query = '';
			var name, value, fullSubName, subName, subValue, innerObj, i;

			for (name in obj) {
				value = obj[name];

				if (value instanceof Array) {
					for (i = 0; i < value.length; ++i) {
						subValue = value[i];
						fullSubName = name + '[' + i + ']';
						innerObj = {};
						innerObj[fullSubName] = subValue;
						query += param(innerObj) + '&';
					}
				} else if (value instanceof Object) {
					for (subName in value) {
						subValue = value[subName];
						fullSubName = name + '[' + subName + ']';
						innerObj = {};
						innerObj[fullSubName] = subValue;
						query += param(innerObj) + '&';
					}
				} else if (value !== undefined && value !== null) {
					query += encodeURIComponent(name) + '=' + encodeURIComponent(value) + '&';
				}
			}

			return query.length ? query.substr(0, query.length - 1) : query;
		};

		return angular.isObject(data) && String(data) !== '[object File]' ? param(data) : data;
	} ];

	$httpProvider.interceptors.push(function($rootScope, $location, $q) {
		return {
			request : function(config) {
				return config || $q.when(config);
			}/*,
			responseError: function(response) {
				console.info('responseError');
				console.info(response);
				if(response.status == 403) {
					var My = $injector.get('My');
					My.clearMsgTimer();
					$location.path(PATH.loginPath);
				}
				if (response.status === 401 || response.status === 403) {
					alert('登录超时，点击确定回到登录页面');
					window.location.href = '/login.html';
				} else if (response.status === 500) {
					//$location.path('/error');
				}
				
				return $q.reject(response);
			}*/
		};
	});
} ]);