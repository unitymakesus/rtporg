angular.module('rtp').controller('ConfigCtrl', function($scope, Restangular, alert, $filter) {
    $scope.init = function(config) {
        jQuery.extend($scope, config);
        if ($scope.services && $scope.services.length > 0) {
            $scope.setActiveService($scope.services[0]);
        }
    }

    var normalizeConfig = function(config) {
        angular.forEach(['whitelist', 'blacklist', 'tags'], function(keyName) {
            if (!config[keyName]) {
                config[keyName] = [];
            }
            if (config[keyName].length < 1) {
                config[keyName].push('');
            }
        });
        return config;
    }

    $scope.emptyFilterPredicate = function(value) {
        // return true if non-empty
        return !/^\s*$/.test(value);
    }

    $scope.setActiveService = function(service) {
        if ($scope.loading) {
            return;
        }
        $scope.loading = true;
        Restangular.one('configs',service.key).get().then(function(response) {
            $scope.loading = false;
            $scope.config = normalizeConfig(response.config);
        },function(response) {
            alert.add("Unable to load configuration for "+service.name);
            $scope.loading = false;
        });
    }

    $scope.addToArray = function(arr) {
        arr.push('');
    }

    $scope.removeFromArray = function(arr, index) {
        arr.splice(index, 1);
    }

    $scope.save = function(config, keyName) {
        var params = {};
        params[keyName] = $filter('filter')(config[keyName], $scope.emptyFilterPredicate);
        $scope.loading = true;
        Restangular.one('configs', config.service).post(keyName, params).then(function(response) {
            $scope.loading = false;
            alert.add('Your changes have been saved. Please allow a few moments for your changes to take effect.', {type:'success'});
        }, function(response) {
            $scope.loading = false;
            alert.add('Unable to save changes');
        });
    }

});