/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 1:48 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.filter( 'imageuri', ['SircusFeedUrlService', function (urlService) {
    return function(input) {
        return urlService.getPluginUrl('/images/'+input);
    };
}]);