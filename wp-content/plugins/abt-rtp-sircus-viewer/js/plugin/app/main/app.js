/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 4:01 PM
 * To change this template use File | Settings | File Templates.
 */
var SircusFeedViewerApp = angular.module('SircusFeedViewer', ['LocalStorageModule', 'infinite-scroll', 'ngSanitize', 'iso.directives']);

SircusFeedViewerApp.config(['localStorageServiceProvider', function (localStorageServiceProvider) {
    localStorageServiceProvider.setPrefix('sircus-viewer');

    // localStorageServiceProvider.setStorageCookieDomain('rtp.org');
    // localStorageServiceProvider.setStorageType('sessionStorage');
}]);

// set the configuration
SircusFeedViewerApp.run(['$rootScope', 'SircusFeedLocalizedDataService', function ($scope, dataService) {

    var $data = [];

    if (angular.isUndefined(sircus_data) || null === sircus_data )
        $data  = [];
    else
        $data  = sircus_data;

    dataService.init($data);

    $scope.dataService = dataService;


}]);