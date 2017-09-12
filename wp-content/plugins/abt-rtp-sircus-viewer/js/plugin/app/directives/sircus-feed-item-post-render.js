/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/26/14
 * Time: 3:37 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.directive("postRender", ['$log', '$timeout', 'isotopeService', function($log, $timeout, isotopeService) {


    return {
        restrict : 'A',
        link: function(scope, element, attrs) {
            scope.item.open = false;
            if (scope.$last) {
                var imgLoad = imagesLoaded(element.parent());
                imgLoad.on('always', function(instance) {
                    $timeout(function() {
                        SocialFeedLib.init(element.parent(), function(initAspect) {
                            $timeout(function() {
                                isotopeService.trigger(scope);
                            },0);
                        });
                        // hide spinner!
                        $('.preloader').fadeOut();
                    }, 500)

                });
            }
        }
    };
}]);