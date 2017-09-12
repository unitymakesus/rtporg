angular.module('SircusFeedViewer').service('isotopeService', function() {
    return {
        trigger: function(scope) {
            scope.$emit('iso-option', {
                layoutMode: 'masonry',
                itemSelector: 'article.social-tile',
                transitionDuration: 0,
                sortBy: 'original-order'
            });
        }
    }
});
