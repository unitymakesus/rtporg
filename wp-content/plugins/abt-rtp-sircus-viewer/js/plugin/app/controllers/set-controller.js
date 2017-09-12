angular.module('SircusFeedViewer').controller('SetCtrl', function($scope) {
    $scope.collapseAll = function() {
        angular.forEach($scope.set.items, function(feedItem, index) {
            feedItem.isExpanded = false;
        });
    }

    $scope.setItemExpanded = function(item) {
        angular.forEach($scope.set.items, function(feedItem, index) {
            if (feedItem.id != item.id) {
                feedItem.open = false;
            }
        });
    }
})