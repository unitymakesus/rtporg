angular.module('rtp').controller('ApprovedCtrl', function($scope, Restangular, alert, $timeout, $filter) {
    var MAX_RANK = 500;
    var LOCKABLE_POSITION_COUNT = 20

    var processItemForDisplay = function(item,index) {
        item.fields.rank = parseInt(item.fields.rank);
        item.fields.boost_score = parseInt(item.fields.boost_score);
        if (parseInt(item.fields.locked)) {
            item.lockedRank = item.fields.rank;
        } else {
            item.lockedRank = 0;
        }
        return item;
    }

    var itemOperation = function(item, params, success, fail) {
        Restangular.one('items', item.id).post('', params).then(success, fail);
    }

    $scope.serverRankToDisplayRank = function(serverRank) {
        return serverRank > 0 ? (MAX_RANK - serverRank + 1) : null;
    }

    $scope.unapprove = function(result, index) {
        $scope.operating = true;
        itemOperation(result, {approved:false}, function(response){
            alert.add('Success! Please allow a few moments for the system to update the indexes', {type:'success'});
            $scope.remove(index);
            $scope.operating = false;
        }, function(response){
            $scope.operating = false;
            alert.add('The operation failed');
        });
    }

    $scope.getProcessedItems = function(items) {
        angular.forEach(items, processItemForDisplay);

        return $filter('orderBy')(items, ['fields.rank', 'fields.created_ts'], true);
    }

    $scope.boostScore = function(item, index, updatedBoost) {
        $scope.boosting = true;
        itemOperation(item, {boostScore: updatedBoost}, function(response) {
            $scope.results.splice(index, 1, processItemForDisplay(response.model, index))
            $scope.boosting = false;
        }, function(response) {
            alert.add('Unable to modify boost score for this item');
            $scope.boosting = false;
        })
    }

    $scope.toggleLockStatus = function(item, index) {
        $scope.locking = true;
        var params = item.lockedRank > 0 ? {locked: true, rank: item.lockedRank} : {locked:false};
        itemOperation(item, params, function(response) {
            if (!params.locked) {
                item.fields.rank = 0;
                item.lockedRank = 0;
            }
            var model = processItemForDisplay(response.model, index);
            // find item in regular list with this rank, if there, give it the old rank of the updated item
            if (model.fields.rank) {
                for (var i = 0; i < $scope.results.length; i++) {
                    var o = $scope.results[i];
                    // looking for an object with the new rank
                    if (o.fields.rank == model.fields.rank) {
                        // found an existing model with the new rank, set its rank to the item's old rank
                        o.fields.rank = item.fields.rank;
                        $scope.results.splice(i, 1, processItemForDisplay(o, i));
                        break;
                    }
                }
            }
            if (parseInt(model.fields.locked)) {
                $scope.lockedItems[model.fields.rank] = model;
            } else {
                // now unlocked for the rest
                delete $scope.lockedItems[item.lockedRank];
                alert.add('The item is no longer locked. The item may remain in this position for a few minutes until all feed items are re-scored.', {type:'success'});
            }
            if ($scope.meta.start > MAX_RANK || $scope.hasServiceFilter()) {
                // remove it
                $scope.results.splice(index, 1);
            } else {
                // set it back in place
                $scope.results.splice(index, 1, model);
            }
            $scope.locking = false;
        }, function(response) {
            alert.add('Unable to lock item at this time');
            $scope.locking = false;
        });
    }

    $scope.getAvailableRanks = function(item, lockableRanks) {
        var available = [{'label': '-', 'rank': 0}];
        angular.forEach(lockableRanks, function(rank, label) {
            if (!$scope.lockedItems[rank] || $scope.lockedItems[rank].id == item.id) {
                available.push({'label': label, 'rank': rank});
            }
        });
        return available;
    }

    // generate a hash of server rank values => displayable rank values
    $scope.lockableRanks = {};
    for (var i = MAX_RANK; i > MAX_RANK - LOCKABLE_POSITION_COUNT; i--) {
        $scope.lockableRanks[$scope.serverRankToDisplayRank(i)] = i;
    }
    $scope.lockedItems = {};
    Restangular.all('items').get('', {locked:1, approved:1}).then(function(response) {
        var lockedItems = {};
        angular.forEach(response.data, function(item, index) {
            lockedItems[item.fields.rank] = item;
        });
        $scope.lockedItems = lockedItems;
    }, function(response){

    });

    $scope.setFeatured = function(item) {
        item.fields.featured = 1;
        $scope.operating = true;
        itemOperation(item, {featured:true}, function(response){
            alert.add('Success! Please allow a few moments for the system to update the indexes', {type:'success'});
            $scope.operating = false;
        }, function(response){
            $scope.operating = false;
            alert.add('The operation failed');
        });
    }

    $scope.unsetFeatured = function(item) {
        item.fields.featured = 0;
        $scope.operating = true;
        itemOperation(item, {featured:false}, function(response){
            alert.add('Success! Please allow a few moments for the system to update the indexes', {type:'success'});
            $scope.operating = false;
        }, function(response){
            $scope.operating = false;
            alert.add('The operation failed');
        });
    }

});