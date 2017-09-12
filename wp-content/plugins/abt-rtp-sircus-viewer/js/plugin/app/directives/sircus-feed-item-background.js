/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/26/14
 * Time: 3:37 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.directive('itemBackground', ['$log', function ($log) {
    var tweetColors = ["#194685", "#799ED2", "#C7202C", "#5C8A3D", "#2EBAA5", "#038798", "#EF4E22"];

    return function (scope, element, attrs) {

        if (scope.item) {
            var backgroundUrl = false;

            if (scope.item.type == 'item') {
                if (scope.item.template == 'video' ) {
                    backgroundUrl = scope.item.media.thumbnail;
                } else {
                    backgroundUrl = scope.item.media;
                }
                if (scope.item.template == 'text') {
                    element.css('background-color', tweetColors[~~(Math.random() * tweetColors.length)])
                }
            }

            if (backgroundUrl) {
                element.css({
                    'background-image': 'url(' + backgroundUrl +')',
                    'background-size' : 'cover'
                });
            }
        }
    };
}]);