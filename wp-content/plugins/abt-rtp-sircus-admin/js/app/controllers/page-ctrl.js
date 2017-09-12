angular.module('rtp').controller('PageCtrl', function($scope, Restangular, alert, $filter, $rootScope, $location, $timeout) {

    var setSearchMeta = function(meta) {
        if (!meta || !meta.limit) {
            return;
        }
        if (!meta.start) {
            meta.start = 0;
        }
        meta.currentPage = parseInt(meta.start / meta.limit) + 1;
        $scope.setLocationPage(meta.currentPage, meta.limit);
        if (meta.total > 0) {
            meta.totalPages = Math.ceil(meta.total / meta.limit);
            meta.lastStart = (meta.totalPages - 1) * 50;
            meta.nextStart = Math.min(Math.max(meta.start + meta.limit, 0), meta.lastStart);
            meta.prevStart = Math.min(Math.max(meta.start - meta.limit, 0), meta.lastStart);
            // check if we're in an invalid page
            if (meta.start > meta.lastStart) {
                $scope.loadPage(meta.lastStart);
            } else if (meta.start < 0) {
                $scope.loadPage(0);
            }
        } else {
            // no results
        }
        $scope.meta = meta;
    }

    $scope.init = function(params) {
        $scope.pageParams = jQuery.extend({}, params);
    }

    /**
     * Load a page of data
     * @param start
     */
    $scope.loadPage = function(start) {
        if ($scope.loading) {
            return;
        }
        var force = arguments[1] || false;
        if ($scope.meta) {
            if ($scope.meta.start == start && !force) {
                return;
            } else if (start > 0 && $scope.meta.total <= start) {
                return;
            }
        }
        $scope.loading = true;
        var load = function() {
            $scope.loadPaused = false;
            Restangular.all('items').get('', jQuery.extend({}, $scope.pageParams, {start:start})).then(function(response){
                $scope.loading = false;
                setSearchMeta(response.meta);
                $scope.results = response.data;
            }, function(response){
                $scope.loading = false;
                alert.add('Unable to load items');
            });
        }
        var delay = arguments[2] || 0;
        if (delay) {
            $scope.loadPaused = true;
            $timeout(load, delay * 1000);
        } else {
            load();
        }
    }

    /**
     * Forcibly reload page
     */
    $scope.reload = function() {
        var delay = arguments[0] || false;
        $scope.loadPage($scope.meta.start, true, delay);
    }

    $scope.remove = function(itemIndex) {
        if ($scope.results && $scope.results.length > itemIndex) {
            $scope.results.splice(itemIndex, 1);
        }
        if ($scope.results.length < 1) {
            var delay = arguments[1] || false;
            $scope.reload(delay);
        }
    }

    $scope.setLocationPage = function(page, limit) {
        var search = $location.search();
        if (!search.page || search.page != page) {
            $location.search('page', page);
            $location.search('limit', limit);
        }
    }

    $scope.getAuthor = function(authorJsonString) {
        return angular.fromJson(authorJsonString);
    }

    $scope.getItemMedia = function(item, placeholder) {
        if (!item.fields.item_media) {
            return placeholder;
        }
        if (item.fields.item_template == 'video') {
            try {
                var mediaObj = angular.fromJson(item.fields.item_media);
                if (mediaObj.thumbnail) {
                    return mediaObj.thumbnail;
                }
            } catch (e) {

            }
        }
        return item.fields.item_media;
    }

    $scope.filterByService = function(service, search) {
        if (service) {
            $scope.pageParams['service'] = service;
        } else {
            delete $scope.pageParams['service'];
        }
        if (search) {
            $scope.pageParams['query'] = search;
        } else {
            delete $scope.pageParams['query'];
        }
        // force reload from page 1
        $scope.loadPage(0, true);
    }

    $scope.hasServiceFilter = function() {
        return $scope.pageParams['service'] ? true : false;
    }


    $rootScope.$on('$locationChangeSuccess', function(event, newUrl, oldUrl) {
        var search = $location.search();
        var start = 0;
        if (search.page && search.limit) {
            start = Math.max((search.page - 1) * search.limit, 0);
        }
        $scope.loadPage(start);
    });
    $scope.meta = null;
});