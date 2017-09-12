SircusFeedViewerApp.controller(
    'SircusFeedListController',
    [   '$scope',
        '$sce',
        '$log',
        '$http',
        'SircusFeedScrollService',
        'SircusFeedService',
        'SircusFeedUrlService',
        'SircusFeedLocalizedDataService',
        'SircusFeedI18nService',
        'SircusFeedApiService',
        'SircusFeedTransformItemDataService',
        'SircusFeedLocalizedDataService',
        '$timeout',
        function($scope, $sce, $log, $http,
                 scrollService, feedService, urlService, dataService,
                 i18n, sircusApi, transformItemDataService, localStorageService, $timeout) {
            // Set items, this is the social items + banners
            $scope.sets = [];
            // assume 3 column layout, unless Responder query fires
            $scope.pageColumnCount = 3;
            Responder.query("only screen and (min-width: 1280px)", function () {
                // CSS is set to do 4 columns
                $scope.pageColumnCount = 4;
            }, true);

            // Number of items per page of results
            $scope.limit = dataService.get('page_limit');

            // Feed Service handling all your requests to the API
            $scope.feedService = feedService;

            // Should I wait or should I go now?
            $scope.wait = false;

            // Scroll state (for infinite scroll)
            $scope.scroll = scrollService;

            // Tag management
            $scope.tags     = dataService.get('tags');
            $scope.tag      = false;

            $scope.op = 'list';

           /*           TAGS            */

            /*
             * Reset tag state
             */
            $scope.resetTags = function() {
                // Tag management
                $scope.tags     = dataService.get('tags');
                $scope.tag      = false;
            }

            $scope.notBanners = function(object) {
                return object.type != 'banner';
            }

            /*
             * Handle tag changes
             */
            $scope.changeTag = function(newTag) {
                // Update the internal tag value
                if($scope.tags.indexOf(newTag) >= 0 && $scope.tag != newTag) {
                    $scope.tag = newTag;
                } else {
                    $scope.tag = false;
                }

                $scope.renewItems();
            }

            /*
             * Compare tag
             */
            $scope.isCurrentTag = function(tag) {
                return tag == $scope.tag;
            }


            /*          ITEMS           */

            // Clear out item array
            $scope.resetItems = function() {
                $scope.sets = [];
            }

            $scope.setShowOptions = function(item) {
                item.showOptions = true;
            }

            /*
             * Insert the items into the social feed
             */
            $scope.insertItems = function(items) {
                var resultSet = {items: []};
                // If there are items...
                // Initialize them
                items = sircusApi.initItems(items);
                // Add each item to the items list
                var setItems = [];
                // go through and figure out each of the items
                angular.forEach(items,function(item) {
                    var itemObject = sircusApi.initItem(transformItemDataService.createItem(item,false));
                    if (itemObject) {
                        setItems.push(itemObject);
                    } else {
                        resultSet.banner = item;
                    }
                });
                // counter to keep track of how many columns have been claimed
                var widthCounter = 0;
                var usedItems = {};

                var getDisplaySize = function(item) {
                    return item.featured == 'featured' && $scope.pageColumnCount > 3 ? 2 : 1;
                }

                var fillInLine = function(j, items) {
                    while (widthCounter % $scope.pageColumnCount != 0) {
                        // load from top
                        j = (j + 1) % items.length;
                        var itemObject = items[j];
                        var itemWidth = getDisplaySize(itemObject);
                        if ((widthCounter % $scope.pageColumnCount) + itemWidth <= $scope.pageColumnCount) {
                            resultSet.items.push(angular.copy(setItems[j]));
                            widthCounter += itemWidth;
                            continue;
                        }
                        if (j > items.length * 2) {
                            break;
                        }
                    }
                }

                var lookaheadIndex = null;
                for (var i in setItems) {
                    var itemObject = setItems[i];
                    var itemWidth = getDisplaySize(itemObject);
                    if ((widthCounter % $scope.pageColumnCount) + itemWidth > $scope.pageColumnCount) {
                        fillInLine(i, setItems);
                    }

                    widthCounter += itemWidth;
                    resultSet.items.push(itemObject);
                    if (i == setItems.length - 1) {
                        fillInLine(i, setItems);
                    }

                }

                $scope.sets.push(resultSet);
            }

            /*
             * Get initial social feed items from new stream
             */
            $scope.renewItems = function() {
                // Reset all the things
                // Loader, tag, limit, feedService, etc
                $scope.scroll.reset();
                $scope.feedService.reset();
                $scope.resetItems();

                $scope.feedService.setTag($scope.tag);
                $scope.feedService.setLimit($scope.limit);

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
                        $scope.scroll.incrementPage();
                        $scope.insertItems(items);
                        $scope.wait = false;
                    }
                );
            }

            /*
             * This is used to re-enable infinite load, particularly after
             * it has been disabled from reading the auto-load limit
             */
            $scope.loadMore = function() {
                $scope.scroll.enable();
                $scope.getItems();
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


            /*          BANNERS         */

            /*
             * Returns the image class i.e class="getBannerImageClass()"
             *
             */
            $scope.getBannerImageClass = function(banner) {
                if(banner.thumb_url)
                    return '';
                else
                    return 'placeholder';
            }

            /*
             * Returns the banner image markup
             */
            $scope.getBannerImageStyle = function(banner) {
                if(banner.thumb_url)
                    return 'background-image: url(' + banner.thumb_url + ')';
                else
                    return 'background-image: url(' + banner.theme_dir + '/img/icons/i_about-us.svg'  + ')';
            }

            /*
             * Construct partial URL for banner
             */
            $scope.constructBannerPartialUrl = function(type) {
                return urlService.getPartialUrl('/banners/banner-' + type + '.html');
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
            $scope.constructItemPartialUrl = function(type,status,service) {
                // We can build this out to be more updatable / configurable later if need be
                // i.e. have WP localize template lookup data array
                // #34118 - Make youtube (video) 2x1 (featured) size always
                if (status === 'featured') {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '-featured.html');
                } else {
                    //$log.log(urlService.getPartialUrl('/social-tiles/tile-' + type + '.html'));
                    return urlService.getPartialUrl('/social-tiles/tile-' + type + '.html');
                }
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
                    if (item.showOptions) {
                        itemClasses += 'show-options ';
                    }
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
                $scope.renewItems();
            }
        }
    ]
)
angular.module('SircusFeedViewer').filter('limitTile', function() {
    return function(html, limit) {
        console.log('limit tile', html);
        if (html.length < limit) {
            return html;
        }
        var nextSpace = (''+html).substring(limit).indexOf(' ');
        return html.substring(0,limit + nextSpace);
    }
});