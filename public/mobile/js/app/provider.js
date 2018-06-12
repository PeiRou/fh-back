angular.module('ionicz.providers', [])

.provider('Storage', function() {
	return {
		$get: function($cookies) {
			return {
				set : function(key, data, minute) {
					var opts = {};
					if(minute) {
						var expireDate = new Date();
						expireDate.setTime(expireDate.getTime() + minute * 1000);//设置cookie保存分钟数
						opts.expires = expireDate;
					}
					return $cookies.put(key, data, opts);
				},
				get : function(key) {
					return $cookies.get(key);
				},
				remove : function(key) {
					$cookies.remove(key);
				}/*,
				
				session: {
					set : function(key, data) {
						return window.sessionStorage.setItem(key, window.JSON.stringify(data));
					},
					get : function(key) {
						return window.JSON.parse(window.sessionStorage.getItem(key));
					},
					remove : function(key) {
						return window.sessionStorage.removeItem(key);
					}
				}*/
			};
		}
	}	
})

.provider('AppInit', function($stateProvider) {
	this.$get = function ($http, $q, Tools) {
		return {
			loadConfig: function () {
				var defered = $q.defer();
				// 加载平台配置文件
				$http.get('/mobile/conf/app_config.json').success(function(appConfig) {
					// 平台配置文件加载成功后，加载系统配置文件、公告文件、路由文件
                	Tools.lazyLoad([
                		appConfig.staticPath + "data/configjs.js?v=" + Tools.getVersion(),
                		"/static/messages.js?_" + Math.random(),
                		"/mobile/js/app/route.js",
                		"/mobile/js/app/route2.js",
                		"/mobile/js/app/route3.js"
                	], function() {
                		var __appConfig = angular.extend(appConfig, CONFIG_MAP);
                        defered.resolve(__appConfig);
                    });
				});
				
				return defered.promise;
			}
		}
	};
})

.provider('Tools', function() {
	// 3分钟更新一次版本号
	var version = parseInt(new Date().getTime() / 1000 / 60 / 3);
	
	var staticPath = function() {
		return webAppConfig['staticPath'] || '/static/';
	};
	
	var apiPath = function() {
		return '';
	};
	
	var getVersion = function() {
		return version;
	};
	
	return {
		staticPath: staticPath,
		apiPath: apiPath,
		getVersion: getVersion,
		
		$get: function(ENV, $rootScope, $http, $state, $injector, $location, $log, $ionicPopup, $ocLazyLoad, $ionicLoading, PATH, Storage, $q) {
			var self = this;
			
			var ajax = function(opts) {
				var params = opts.params || {};
				var method = opts.method || 'POST';
				var req = {method: method, timeout: 10000, url: apiPath() + opts.url, headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'}};
				var timeout = opts.timeout || null;

				var token = Storage.get('token');

				if(token) {
					params['token'] = token;
				}
				
				if(method.toLocaleUpperCase() == 'POST') {
					req['data'] = params;
				}
				else {
					req['params'] = params;
				}
				
				if(opts.backdrop === true) {
					Backdrop.show();
				}
				
				$http(req).success(function(data) {
					var result = null;
					if(opts.backdrop === true) {
						Backdrop.hide();
					}
					if(opts.dataType == 'json') {
						try {
							result = angular.fromJson(data);
						}
						catch(e) {
							if(!data){
								alert("暂无数据返回，请联系技术支持！");
							} else {
								alert(data);
							}
						}
					}
					else {
						result = data;
					}
					opts.success(result);
				}).error(function(data, status, header, config) {
					if(angular.isFunction(opts.error)) {
						opts.error(data, status);
					}
					else if(status == -1) {
						if(timeout){
							timeout();
						}else{
							$ionicLoading.show({template: '请求超时，请检查网络是否正常 [' + status + ']', duration: 2000});
						}
					}
					else if(status == 504) {
						$ionicLoading.show({template: '网络繁忙，请检查网络是否正常或刷新网页重试 [' + status + ']', duration: 2000});
					}
					else if(status == 403) {
						var My = $injector.get('My');
						My.clearMsgTimer();
						$location.path(PATH.loginPath);
					}
					else {
//						$ionicLoading.show({template: data.msg || '系统错误，请联系客服 [' + status + ']', duration: 2000});
						$ionicLoading.show({template: data.msg || '网络繁忙，请检查网络是否正常或刷新网页重试 [' + status + ']', duration: 1500});
					}
					
					if(opts.backdrop === true) {
						Backdrop.hide(500);
					}
				});
			};
			
			var tip = function(content, duration) {
				$ionicLoading.show({
					template: content,
					duration: duration || 1500
				});
			};
			
			var alert = function(msg, callback) {
				var alertPopup = $ionicPopup.alert({title: msg});
				
				if(angular.isFunction(callback)) {
					alertPopup.then(function(res) {
						callback();
					});
				}
			};
			
			var confirm = function(msg, callback) {
				var confirmPopup = $ionicPopup.confirm({
					title: msg,
					cancelText: '取消',
					okText: '确认'
				});
				
				var submitFlag = false;
				confirmPopup.then(function(res) {
					// 防止重复提交
                	if(submitFlag) {
    					return;
    				}
    				submitFlag = true;
					if(res) {
						callback();
					}
				});
			};
			
			var modal = function(opts) {

				if(!opts.templateUrl && !opts.template) {
					return;
				}
				
				var scope = opts.scope;
				if(!scope) {
					scope = $rootScope.$new();
				}
				
				scope.modalData = {};
				var submitFlag = false;
				
				// 自定义弹窗
		        var popup = $ionicPopup.show({
		        	templateUrl: opts.templateUrl,
		        	template: opts.template,
		        	title: opts.title || '消息',
		        	scope: scope,
		        	cssClass: opts.css || "info-mdf",
		        	buttons: [
		        	    {text: '取消'}, 
		                {text: '确定', type: 'button-positive', onTap: function(e) {
		                	// 防止重复提交
		                	if(submitFlag) {
		    					return;
		    				}
		    				submitFlag = true;
		                	if(angular.isFunction(opts.callback)) {
		                		opts.callback(scope, popup);
		                		e.preventDefault();
		                	}
		                }}
		        	]
		        });
			};
			
			var lazyLoad = function(files, callback) {
				$ocLazyLoad.load({
					name : ENV.moduleName,
					files : files
				}).then(function() {
					if(angular.isFunction(callback)) {
						callback();
					}
				});
			};
			
			var isPublicPage =  function() {
				if($state.current.name === "") {
					return true;
				}
				else if(!$state.current.data || $state.current.data.access != 'public') {
					return false;
				}
				else {
					return true;
				}
			};
			
			var isHomePage =  function() {
				if($location.path() == PATH.homePath) {
					return true;
				}
				else {
					return false;
				}
			};
			
			/*
			var getVersion = function() {
				return $rootScope.appConfig.version;
			};
			*/
			
			return {
				ajax: ajax,
				tip: tip,
				alert: alert,
				confirm: confirm,
				modal: modal,
				lazyLoad: lazyLoad,
				isPublicPage: isPublicPage,
				isHomePage: isHomePage,
				staticPath: staticPath,
				apiPath: apiPath,
				rootDomain: getRootDomain,
				getVersion: getVersion
			};
		}
	}
})

.factory('RedPack', function(Tools, Storage, $timeout, My) {
	var states = {
		INITIAL: 'initial',
		OPENING: 'opening',
		AWARD: 'award',
		MISSED: 'missed',
		CONDITION: 'condition',
		DISMISS: 'dismiss',
		TIMEOUT: 'timeout'
	}
	function RedPack(msg, chat_domain) {
		var pack_info = this.pack_info = JSON.parse(msg.content)
		this.id = pack_info.id
		this.state = states.INITIAL
		this.award = 0 //抢到红包金额
		this.chat_domain = chat_domain
		this.setTimer()
	}
	RedPack.prototype = {
		setTimer: function() {
			var self = this
			this.timer = $timeout(function() {
				if(self.state == states.INITIAL) {
					self.state = states.DISMISS
				}
			}, 30 * 1000)
		},
		open: function() {
			this.state = states.OPENING
			var self = this
			Tools.ajax({
                url: this.chat_domain + '/chat/luckyBag.do',
                params: {
					token: Storage.get('ws-token'),
					packetId: this.id
				},
                success: function(data) {
					var result = data.result
					var money = data.money
					switch(result) {
						case 0:
							this.award = money
							this.state = states.AWARD
							My.refreshMoney()
							break
						case 1:
							this.state = states.CONDITION
							break
						case 2:
							this.state = states.MISSED
							break
						case 3:
							return this.reject({
								message: '该轮抢红包已经结束'
							})
							break
						case 4:
							return this.reject({
								message: '您已抢过本红包,请勿重复尝试'
							})
					}
                }.bind(this),
                error: function(err) {
					self.reject(err)
				},
				timeout: function() {
					self.reject({
						message: '请求超时, 点击红包再次尝试'
					})
				}
            });
		},
		reject: function(err) {
			this.state = states.DISMISS
			Tools.alert(err.message || err.msg || '无法查询红包状态, 请确保网络状态正常')
		},
		destroy: function() {
			$timeout.cancel(this.timer)
			this.close()
		},
		close: function() {
			this.state = states.DISMISS
		}
	}
	RedPack.states = states
	return RedPack
})
;