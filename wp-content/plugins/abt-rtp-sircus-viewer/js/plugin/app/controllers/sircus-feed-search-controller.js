SircusFeedViewerApp.controller(
    'SircusFeedSearchController',
    [   '$scope',
        '$sce',
        '$log',
        '$http',
        'SircusFeedService',
        'SircusFeedUrlService',
        'SircusFeedLocalizedDataService',
        'SircusFeedI18nService',
        'SircusFeedApiService',
        'SircusFeedTransformItemDataService',
        'SircusFeedLocalizedDataService',
        function($scope, $sce, $log, $http,feedService, urlService, dataService,
                 i18n, sircusApi, transformItemDataService, localStorageService) {
            // Set items, this is the social items + banners
            $scope.items = [];

            // Arguments
            $scope.args = [];

            // Number of items per page of results
            $scope.limit = dataService.get('page_limit');

            // Feed Service handling all your requests to the API
            $scope.feedService = feedService;

            $scope.urlService = urlService;

            $scope.dataService = dataService;


            // Should I wait or should I go now?
            $scope.wait = false;

            $scope.op = 'search';

            /*          ITEMS           */

            // Clear out item array
            $scope.resetItems = function() {
                $scope.items = [];
            }

            $scope.hasNoItems = function() {
                return $scope.items.length < 1 && $scope.wait == false;
            }

            $scope.getPagesArray = function() {
                var pages = [];
                for(var i = 1; i <= $scope.feedService.getPageCount(); i++) {
                    pages.push(i);
                }
                return pages;
            }

            $scope.getPaginationUrl = function(page) {
                // TODO: Refactor so that query params are not hard coded ... they are subject to change
                var url =
                    dataService.get('site_url') +
                    '?' + dataService.get('search_query_var') + '=' + $scope.query +
                    '&' + dataService.get('domain_query_var') + '=social' +
                    '&' + dataService.get('domain_page_query_var') + '=' + page;
                return url;
            }

            /*
             * Insert the items into the social feed
             */
            $scope.insertItems = function(items) {
                // If there are items...
                // Initialize them
                items = sircusApi.initItems(items);
                // Add each item to the items list
                angular.forEach(items,function(item) {
                    var itemObject = sircusApi.initItem(transformItemDataService.createItem(item,false));
                    if (itemObject)
                        $scope.items.push(itemObject);
                });
            }

            /*
             * Get initial social feed items from new stream
             */
            $scope.renewItems = function() {
                // Reset all the things
                // Loader, tag, limit, feedService, etc
                $scope.feedService.reset();
                $scope.resetItems();

                $scope.feedService.setLimit($scope.limit);
                $scope.feedService.setType('search');
                $scope.feedService.setPage($scope.page);
                $scope.feedService.setQuery($scope.query);

                $scope.wait = true;

                $scope.loadItemsFromFeed();
            }


            /*
             * Get social feed items, insert into the social feed
             */
            $scope.getItems = function() {
                $scope.wait = true;
                $scope.feedService.ready().then( function() {
                    if($scope.feedService.isFinished()) {
                        return;
                    }

                    $scope.feedService.setLimit($scope.limit);

                    $scope.loadItemsFromFeed();
                });
            }

            /*          FEED            */

            /*
             * Get items from the feed, update app
             */
            $scope.loadItemsFromFeed = function() {
                // TODO: Can we abort all feedservice promises to
                // ensure this request executes immediately???
                $scope.feedService.getItems().then(
                    function( items ) {
                        $scope.insertItems(items);
                        $scope.wait = false;
                    }
                );
            }

            /*
             * Is
             $scope.feedIsWaiting = function() {
             return $scope.feedService.isWaiting();
             }

             /*
             * Has the feed been exhausted
             */
            $scope.feedIsFinished = function() {
                return $scope.feedService.isFinished();
            }

            /* Based on http://stackoverflow.com/questions/16155542/dynamically-displaying-template-in-ng-repeat-directive-in-angularjs
             * Determine which partial to use for the given item.
             */
            $scope.getItemPartial = function(item) {
                if ( item.type == 'banner' ) {
                    return $scope.constructBannerPartialUrl(item.display_type);
                }

                return $scope.constructItemPartialUrl(item.template, item.featured);
            }


            /*
             * Construct partial URL for social item
             */
            $scope.constructItemPartialUrl = function(type,status) {
                // We can build this out to be more updatable / configurable later if need be
                // i.e. have WP localize template lookup data array
                if (status === 'featured') {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html');
                } else {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '.html');
                }
            }

            $scope.getPaginationPartial = function() {
                return urlService.getPartialUrl('/pagination/links.html');
            }

            /*
             * Returns the class for item articles
             */
            $scope.getClass = function(item) {
                // TODO: Refactoring
                // TODO: itemClasses should be array, classes pushed to array
                // TODO: Return array.join(' ')
                // TODO: allow another function argument so that item classes can be passed in / appended
                var itemClasses = ' source-sircus ';

                if (item.type == 'item') {
                    var template = 'type-' + item.template;
                    var featured = item.featured;
                    var service  = 'service-' + item.service;
                    // This is a workaround. Design provides styling for type-hybrid, but not type-video
                    if (item.template == 'video' ) {
                        template = 'type-hybrid type-video';
                    }

                    itemClasses += ' source-sircus social-tile hentry ' + template + ' ' +  featured  + ' ' + service;
                } else {
                    // For now it's safe to assume this is a banner
                    itemClasses += ' featured-banner-item ';
                }

                return itemClasses;
            }

            /*
             * Given HTML from the feed? Render it.
             */
            $scope.renderHtml = function(html_code) {
                try {
                    return $sce.trustAsHtml(html_code);
                } catch (e) {
                    $log.log('renderHtml is unable to parse html code');
                    return html_code;
                }
            }

            /*
             * Social Item Interaction -- Trigger action
             */
            $scope.triggerAction = function(action,item) {
                sircusApi.doAction(action,item);
            }

            /*
             * Initialize the controller
             */
            $scope.init = function(args) {
                $scope.args = args;

                // TODO: Ugly for now, cleanup later
                // Number of items per page of results
                if (angular.isObject(args) && args.limit > 0) {
                    $scope.limit = args.limit;
                } else {
                    $scope.limit = dataService.get('limit');
                }

                if (angular.isObject(args) && args.page > 0) {
                    $scope.page  = args.page;
                } else {
                    $scope.page = dataService.get('page');
                }

                if (angular.isObject(args) && args.query) {
                    $scope.query = args.query;
                } else {
                    $scope.query = dataService.get('query');
                }

                $scope.renewItems();
            }
        }
    ]
);