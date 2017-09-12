/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/5/14
 * Time: 1:48 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.filter( 'i18n', ['SircusFeedI18nService', function (i18n) {
    return function(input) {
        if (i18n.has(input))
            return i18n.get(input);
        else
            return input;
    };
}]);