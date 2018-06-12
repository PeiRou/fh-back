angular.module('ionicz.filters', [])

.filter('money', function() {
	return function(value) {
		if(angular.isUndefined(value)) {
			return;
		}
		var num = new Number(value);
		return num.toFixed(3);
	}
})

.filter('number', [function() {
    return function(input) {
        return parseInt(input, 10);
    };
}])

.filter('stime', [function() {
    return function(text, format) {
    	if(!format) {
    		format = 'MM/DD HH:mm:ss';
    	}
    	return moment(text).format(format);
    };
}]);