var app = angular.module('rtp', ['ngRoute', 'ngSanitize', 'restangular']);

app.factory('_', function() {
    return window._; // assumes underscore has already been loaded on the page
});
app.config(function(RestangularProvider){
    RestangularProvider.setBaseUrl(RTP_API_CONFIG.domain+'/api/v1/');
//    RestangularProvider.setDefaultHeaders({
//        'X-Restangular': 'true'
//    });
    RestangularProvider.setDefaultRequestParams({'api_token': RTP_API_CONFIG.token});
});