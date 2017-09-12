angular.module('SircusFeedViewer').filter('stripHtml', function() {
        return function(text) {
            return String(text).replace(/<[^>]+>/gm, '');
        }
    }
);