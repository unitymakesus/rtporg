/**
 * Created with JetBrains PhpStorm.
 * User: brians
 * Date: 6/26/14
 * Time: 3:37 PM
 * To change this template use File | Settings | File Templates.
 */
SircusFeedViewerApp.directive('whenScrolled', ['$log', function($log) {
    return {
        link:function (scope, element, attrs) {
            // Added this to prevent errors if scroll is undefined
            if(scope.scroll == null || scope.scroll === undefined)
                return;
            // Had to hard code this in because the div.st-content element is not in scope
            // TODO: Refactor this to make it injectable & testable
            var $win = jQuery('div.st-content');

            scope.scroll.reset();
            scope.scroll.setTop($win.scrollTop());

            // Is scroll the best event to bind with?
            $win.scroll(function () {
                // There's no point in loading more if loading is already in progress
                if(scope.wait)
                    return;

                // Do not load if autoloading is disabled
                if(!scope.scroll.isEnabled())
                    return;

                // Feed exhausted? Stop trying so hard.
                if(scope.feedService.isFinished())
                    return;

                // Get properties of the last item in the grid
                var grid = jQuery('section.social-grid');
                var griditems = jQuery('section.social-grid article');
                var lastitem = griditems.last();
                var itemheight = lastitem.height();
                var itempos = lastitem.position();

                // No item position avalaiable, abort
                if (itempos == null || itempos === undefined) {
                    return;
                }

                // Get the top coordinate for the last item in the list
                var itemtop = itempos.top;

                // Resets croll heigh if item height has changed (means there's been some reconjiggering)
                if(scope.scroll.getHeight() > itemheight) {
                    scope.scroll.setTop($win.scrollTop());
                }

                // Scrolling up? No need to get more items
                if(scope.scroll.getTop() > $win.scrollTop()) {
                    return;
                }

                // Set state for next scroll
                scope.scroll.setHeight(itemheight);
                scope.scroll.setTop($win.scrollTop());

                // Test if appropirate to load more, and if so, load more
                if ((scope.scroll.getTop() + $win.height())  > (itemtop - (2 * itemheight))) {
                    scope.getItems();
                }
            });
        }
    };
}]);