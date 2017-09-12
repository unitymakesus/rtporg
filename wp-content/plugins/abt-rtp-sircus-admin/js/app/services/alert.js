/**
 * Using angularjs service inheritance
 */
var baseService = function ($timeout, $filter) {
	this.init($timeout, $filter);
};
baseService.$inject = ['$timeout','$filter'];
baseService.prototype.init = function($timeout, $filter) {
	this._alertCount = 1;
	this._alerts = {};
	this._defaultNs = 'default';
	this.$timeout = $timeout;
	this.$filter = $filter;
}
baseService.prototype.getAlerts = function () {
	var self = this;
	var namespace = arguments[0] || this._defaultNs;
	var alerts = [];
	angular.forEach(self._alerts, function(alert, id) {
		if (alert.namespace == namespace) {
			alerts.push(alert);
		}
	});
	return alerts; //this.$filter('filter')(this._alerts, {namespace: namespace}, true);
};
baseService.prototype.add = function (message) {
	// needed because 'this' changes scope reference within angular.forEach
	var self = this;
	// if message is an object, key is the type, value is the array of messages
	if (typeof message == 'object' && !jQuery.isArray(message)) {
		var namespace = arguments[1] || self._defaultNs;
		self.addObject(message, namespace);
		return;
	}
	var options = jQuery.extend({
		type: 'error',
		expires: 5,
		namespace: self._defaultNs
	},arguments[1]||{});
	// if messages are an array, iterate over each one
	if (jQuery.isArray(message)) {
		self.addArray(message, options);
		return;
	}
	// standard case: message is string, options in second parameter
	self.addString(message, options);
};

baseService.prototype.addObject = function (message, namespace) {
	// needed because 'this' changes scope reference within angular.forEach
	var self = this;
	angular.forEach(message, function(messageArray, messageType) {
		self.add(messageArray, {type: messageType, namespace: namespace});
	});
};
baseService.prototype.addArray = function (message, options) {
	// needed because 'this' changes scope reference within angular.forEach
	var self = this;
	angular.forEach(message, function(msg, index) {
		self.add(msg, options);
	});
};
baseService.prototype.addString = function (message, options) {
	var self = this;
	self.$timeout(function(){
		var alertId = self._alertCount++;
		self._alerts[alertId] = self.createAlertObject(alertId, message, options);
		if (options.expires) {
			self.$timeout(function(){
				self.remove(alertId);
			},options.expires * 1000);
		}
	},0);
};
baseService.prototype.createAlertObject = function(alertId, message, options){
	return {
		id: alertId,
		message: message,
		type: options.type,
		namespace: options.namespace
	};
};

baseService.prototype.remove = function () {
	var self = this;
	// if id provided, just remove that alert id
	var alertId = arguments[0] || null;
	self.$timeout(function(){
		if (alertId === null) {
			// clear all alerts
			self._alerts = {};
			self._alertCount = 1;
		} else if (self._alerts[alertId]) {
			delete self._alerts[alertId];
		}
	},0)
};
baseService.prototype.cls = function (type) {
	var cls = '';
	switch (type) {
		case 'success':
			cls = 'updated';
			break;
		case 'error':
		default:
			cls = 'error';
			break;
	}
	return cls;
};

angular.module('rtp').service('alert', baseService);