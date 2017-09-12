angular.module('rtp').controller('PendingCtrl', function($scope, Restangular, alert, $timeout) {

    var getItemIndex = function(itemId, items) {
        var foundIndex = -1;
        angular.forEach(items, function(item, index) {
            if (foundIndex < 0 && itemId == item.id) {
                foundIndex = index;
            }
        });
        return foundIndex;
    }

    var itemOperation = function(item, params) {
        item.operating = true;
        Restangular.one('items', item.id).post('', params).then(function(response){
            alert.add('Success! Please allow a few moments for the system to update the indexes', {type:'success'});
            // look up item
            var index = getItemIndex(item.id, $scope.results);
            if (index >= 0) {
                $scope.remove(index);
            }

        }, function(response){
            item.operating = false;
            alert.add('The operation failed');
        });
    }

    $scope.approve = function(result) {
        itemOperation(result, {approved: true});
    }

    $scope.reject = function(result) {
        itemOperation(result, {rejected: true});
    }

    $scope.selections = {};

    $scope.somethingToApply = function(selections) {
        var something = false;
        angular.forEach(selections, function(selected, itemId) {
            if (selected) {
                something = true;
            }
        });
        return something;
    }

    $scope.doBulkAction = function(selectedAction, selections) {
        $scope.batchInProgress = true;

        var itemIds = [];
        // go through all selections, get the ids that are selected
        angular.forEach(selections, function(selected, itemId) {
            if (!selected) {
                return;
            }
            itemIds.push(itemId);
        });
        Restangular.all('bulk').all(selectedAction).post({itemIds: itemIds}).then(function(response) {
            $scope.batchInProgress = false;
            var success = true;
            angular.forEach(response.results, function(result, index) {
                if (!result.success) {
                    success = false;
                }
            });
            if (success) {
                alert.add('Operation succeeded for '+itemIds.length+' items', {type: 'success'});
                angular.forEach(itemIds, function(itemId, index) {
                    delete $scope.selections[itemId];
                    var i = getItemIndex(itemId, $scope.results);
                    if (i >= 0) {
                        // remove with a 5 second reload delay if all items in page are gone
                        $scope.remove(i, 10);
                    }
                });
            } else {
                alert.add('Operation failed for '+itemIds.length+' items');
                // reload the page to see what the state of things is
                $scope.reload();
            }
            $scope.selectAll = false;
        }, function(response) {
            $scope.batchInProgress = false;
            alert.add('Unable to complete bulk operation');
        });
    }

    $scope.$watch('selectAll', function(newSelectAll, oldSelectAll, s) {
        angular.forEach($scope.results, function(result) {
            $scope.selections[result.id] = newSelectAll;
        });
    })
});