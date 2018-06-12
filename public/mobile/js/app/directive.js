angular.module('ionicz.directives', [])

    .directive('validcodeField', function($compile, $timeout, Tools) {
        return {
            restrict: 'C',
            require: 'ngModel',
            scope: true,
            link: function(scope, element, attrs, ngModel) {
                if ('INPUT' !== element[0].nodeName || attrs.type !== 'text') {
                    throw new Error('Invalid input type for resetField: ' + attrs.type);
                }

                var colors = ['#71001d', '#632c00', '#1e0063', '#0c6300', '#001763', '#71001d'];
                var chars = '0123456789';

                function genCode() {
                    var code = Array.apply(null, { length: 4 }).reduce(function(c) {
                        var index = Math.floor(Math.random() * 9);
                        return c += chars.charAt(index);
                    }, '');
                    scope.$emit('newVerifyCode', code.toLowerCase());
                    return code;
                }

                function colorify(code) {
                    return code.split('').reduce(function(p, c) {
                        return p += '<span style="color: ' + colors[Math.floor(Math.random() * 6)] + '">' + c + '</span>';
                    }, '');
                }

                var dom = $compile('<span class="verify-text">' + colorify(genCode()) + '</span>')(scope);
                element.addClass('reset-field');
                element.after(dom);

                dom.bind('click', function() {
                    dom.html(colorify(genCode()));
                });

                scope.$on('validateCodeChange', function() {
                    dom.html(colorify(genCode()));
                    ngModel.$setViewValue(null);
                    ngModel.$render();
                });
            }
        }
    })

    .directive('passwordEye', ['$compile', function($compile) {
        return {
            restrict: 'C',
            scope: true,
            link: function(scope, element, attrs) {
                var types = ['password', 'text'];
                if ('INPUT' === element[0].nodeName && types.indexOf(attrs.type) == -1) {
                    throw new Error('Invalid input type for passwordField: ' + attrs.type);
                }

                scope.enabled = false;
                var i = $compile('<i ng-click="showPwd()" class="icon icon-eye" ng-class="{\'icon-eyes\':enabled,\'icon-eye\':!enabled}"></i>')(scope);
                element.after(i);
                element.parent().addClass('input-icon');

                scope.showPwd = function() {
                    if (scope.enabled) {
                        scope.enabled = false;
                        element.attr('type', 'password');
                    } else {
                        scope.enabled = true;
                        element.attr('type', 'text');
                    }
                }
            }
        }
    }])

    .directive('resetField', ['$compile', '$timeout', function($compile, $timeout) {
        return {
            restrict: 'C',
            require: 'ngModel',
            scope: true,
            link: function(scope, element, attrs, ngModel) {
                var s = /text|search|tel|url|email|password|number/g;
                if ('INPUT' === element[0].nodeName) {
                    if (!s.test(attrs.type)) {
                        throw new Error('Invalid input type for resetField: ' + attrs.type)
                    }
                } else if ('TEXTAREA' !== element[0].nodeName) {
                    throw new Error('resetField is limited to input and textarea elements');
                }
                var dom = $compile('<i ng-show="enabled" ng-click="reset();" class="icon icon-close"></i>')(scope);
                element.addClass('reset-field');
                element.after(dom);

                scope.reset = function() {
                    ngModel.$setViewValue(null);
                    ngModel.$render();
                    scope.enabled = true;
                };

                element.bind('focus keyup', function() {
                    $timeout(function() {
                        scope.enabled = !ngModel.$isEmpty(element.val());
                        scope.$apply()
                    }, 0, false);
                }).bind('blur', function() {
                    $timeout(function() {
                        scope.enabled = false;
                        scope.$apply();
                    }, 0, false);
                });
            }
        }
    }])

    .directive('dateSelect', ['$compile', '$timeout', '$interpolate', function($compile, $timeout, $interpolate) {
        return {
            restrict: 'C',
            require: 'ngModel',
            template: function(element, attrs) {
                var tmp = $interpolate('<option value="{{value}}" label="{{text}}">{{text}}</option>');

                for (var i = 0; i < 7; i++) {
                    var m = moment().subtract(i, 'd');
                    element.append(tmp({ value: m.format('YYYYMMDD'), text: m.format('YYYY-MM-DD') }));
                }
            },
            link: function(scope, element, attrs, ngModel) {
                $timeout(function() {
                    // 如果没有设置默认值，则默认选中当天
                    if (!ngModel.$viewValue) {
                        ngModel.$setViewValue(moment().format('YYYYMMDD'));
                        ngModel.$render();
                    }
                }, 100, false);
            }
        }
    }])

    .directive('datetimeLocal', ['$compile', '$timeout', '$interpolate', function($compile, $timeout, $interpolate) {
        return {
            restrict: 'C',
            require: 'ngModel',
            link: function(scope, element, attrs, ngModel) {
                var nowTime = moment().format('YYYY-MM-DDTHH:mm');
                ngModel.$setViewValue(nowTime);
                element.attr('value', nowTime);
                element.attr('type', 'datetime-local');
            }
        }
    }])

    .directive('zlNotice', function(Tools, $rootScope, My) {
        return {
            restrict: 'EC',
            scope: false,
            template: '<marquee scrollamount="3" style="height:35px" ng-click="showNoticeInfo();">{{title}}</marquee>',
            replace: true,
            link: function(scope, element, attrs) {
                var message = '';
                scope.showNoticeInfo = function() {
                    Tools.modal({
                        title: '公告',
                        template: message,
                        callback: function(scope, popup) {
                            popup.close();
                        }
                    });
                }

                scope.$watch('message', updateNotice);

                $rootScope.$watch('isLogin', updateNotice); //需要用户登录后判断

                function updateNotice() {
                    var userInfo = My.getInfo();
                    if(typeof(MESSAGES) != 'undefined') {
                        var messageList = MESSAGES.type_1 || [];
                        if(MESSAGES.type_4 && MESSAGES.type_4.length) { //全部类型公告
                            messageList = messageList.concat(MESSAGES.type_4);
                        }
                        messageList = messageList.filter(function(msg) {
                            if(msg.rechLevels) {
                                return msg.rechLevels.split(',').indexOf(userInfo.rechLevel) >= 0;
                            } else {
                                return true;
                            }
                        })
                        if (messageList.length > 0) {
                            message = messageList[0].message;
                            scope.title = messageList[0].title;
                        }
                    }
                }
            }
        }
    })

    /**
     * 按钮点击延迟指令，使用示例：<button click-wait="3"></button>或者<a click-wait="3" class="button"></a>
     */
    .directive('clickWait', function($interval) {
        return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                if ('BUTTON' != element[0].nodeName && 'A' != element[0].nodeName) {
                    return;
                }

                var delay = attrs.clickWait || 3;
                var text = element.html();

                element.on('click', function() {
                    element.attr('disabled', 'disabled');
                    var t = delay;
                    element.html(text + '(' + t + 's)');
                    var timer = $interval(function() {
                        t--;
                        element.html(text + '(' + t + 's)');
                        if (t == 0) {
                            element.removeAttr('disabled');
                            element.html(text);
                            $interval.cancel(timer);
                        }
                    }, 1000, false);
                });
            }
        }
    })
    /**
     * ng-repeat 触发
     */
    .directive('repeatEmit', function() {
        return {
            link: function(scope, element, attrs) {
                if (scope.$last) {
                    //执行父控制器方法
                    scope.$emit('repeat-finish');

                }
            }
        }
    });