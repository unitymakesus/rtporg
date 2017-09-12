SircusFeedViewerApp.service(
    'SircusFeedService',
    [   '$http', '$q', '$log', 'SircusFeedLocalizedDataService',
        function($http, $q, $log, $dataService) {
            /* PRIVATE PARTS */

            var private = [];

            function init() {
                private = [];

                // Internally maintained cursor (for next page of results)
                private.cursor = false;

                // Items Per Page
                private.limit  = 4;

                // Is this service waiting on a current request?
                private.waiting = false;

                // Is this service exhausted / finished?
                private.finished = false;

                // What field / mechanism to order by?
                private.orderby = 'rank';

                // What order? (asc or desc)
                private.order = 'asc';

                private.tag = false;

                private.promise = null;

                private.requests = 0;

                private.type = 'list';

                private.query = '';

                private.page = 1;

                private.total = 0;
            }

            function isFinished() {
                return private.finished;
            }

            function isWaiting() {
                return private.waiting;
            }

            function resetCursor() {
                return false;
            }

            function getLimit() {
                return private.limit;
            }

            function setLimit(num) {
                private.limit = num;
            }

            function getOrderBy() {
                return private.orderby;
            }

            function setOrderBy(obString) {
                private.orderby = obString;
            }

            function getOrder() {
                return private.order;
            }

            function setOrder(oString) {
                private.order = oString;
            }

            function getTag() {
                return private.tag;
            }

            function setTag(oString) {
                private.tag = oString;
            }

            function getCursor() {
                return private.cursor;
            }

            function setCursor(val) {
                private.cursor = val;
            }

            function getTotal() {
                return private.total;
            }

            function getPageCount() {
                return Math.ceil(getTotal() / getLimit());
            }

            function isCursorMatch(newCursor) {
                return newCursor == private.cursor;
            }

            function setPage(page){
                private.page = page;
            }

            function getPage(){
                return private.page;
            }

            function setType(type){
                private.type = type;
            }

            function getType(){
                return private.type;
            }

            function setQuery(query){
                private.query = query;
            }

            function getQuery(){
                return private.query;
            }

            // Response handling
            function handleError(response) {
                private.waiting = false;
                $log.log(response);
                return( $q.reject( "Something went wrong" ) );
            }

            function getItemsFromResponse(response) {
                try {
                    return response.data.data;
                } catch(e) {
                    return {};
                }
            }

            function getCursorFromResponse(response) {
                try {
                    return response.data.meta.cursor;
                } catch(e) {
                    private.finished = true;
                    return false;
                }
            }

            function handlePaginationState(response) {
                var newCursor = getCursorFromResponse(response);
                if(isCursorMatch(newCursor)) {
                    private.finished = true;
                } else {
                    setCursor(newCursor);
                }

                if (response.data.meta.total !== 'undefined' && response.data.meta.total !== null)
                    private.total = response.data.meta.total;
            }

            function handleSuccess(response) {
                $log.log(response.data);
                handlePaginationState(response);
                private.waiting = false;
                return getItemsFromResponse(response);
            }


            function generatePayload() {
                if (getType() == 'search')
                    return generateSearchPayload();

                return generateListPayload();
            }

            function generateListPayload() {
                // Setup payload
                // This is wordpress specific
                // and would need to be replaced if porting to
                // other platforms
                var payload = {
                    action      : 'sircus_action_get',
                    type        : 'list',
                    format      : 'json',
                    limit       : getLimit(),
                    skip_banner : 0
                };

                // Add cursor to payload if set
                var cursor = getCursor();

                if (cursor) {
                    payload.cursor = cursor;
                } else {
                    payload.banner = 1;
                }

                var tag = getTag();

                if (tag) {
                    payload.tag = getTag();
                }

                return payload;
            }

            function generateSearchPayload() {
                // Setup payload
                // This is wordpress specific
                // and would need to be replaced if porting to
                // other platforms
                var payload = {
                    action      : 'sircus_action_get',
                    type        : 'search',
                    format      : 'json',
                    limit       : getLimit(),
                    start       : ((getPage()-1) * getLimit()),
                    query       : getQuery(),
                    skip_banner : 1
                };

                return payload;
            }

            /* PUBLIC PARTS */

            // Trigger the api call & return results
            // Be sure to call hasMoreItems() if using this
            // inside a loop or other situations where
            // getItems may be called repeatedly (i.e. recursive funcs)
            function getItems(options) {

                if (this.isFinished()) {
                    return false;
                }

                if (this.isWaiting()) {
                    return false;
                }

                private.waiting = true;

                var deferredAbort = $q.defer();

                var request = $http({
                    method : 'POST',
                    url    : $dataService.get('ajax_url'),
                    params : generatePayload()
                });

                // Using http://www.bennadel.com/blog/2616-aborting-ajax-requests-using-http-and-angularjs.htm as
                // guidance
                private.promise  =  request.then(handleSuccess, handleError);

                private.promise.abort = function() {
                    deferredAbort.resolve();
                    return [];
                };

                private.promise.finally(
                    function() {
                        promise.abort = angular.noop;
                        deferredAbort = request = promise = null;
                    }
                );


                return private.promise;
            }

            function abort() {
                return (private.promise && private.promise.abort());
            }


            function ready() {
                var deferred = $.Deferred();
                var id = setInterval(function() {
                    private.requests++;
                    //$log.log('FeedService Requests ' + private.requests);
                    if(!private.waiting) {
                        clearInterval(id);
                        deferred.resolve();
                    }
                }, 1000);
                return deferred.promise();
            }

            init();

            // List/return public parts
            return({
                ready        : ready,
                abort        : abort,
                waiting      : private.waiting,
                finished     : private.finished,
                setPage      : setPage,
                getPage      : getPage,
                setType      : setType,
                getType      : getType,
                setQuery     : setQuery,
                getQuery     : getQuery,
                getItems     : getItems,
                getLimit     : getLimit,
                setLimit     : setLimit,
                getOrderBy   : getOrderBy,
                setOrderBy   : setOrderBy,
                getOrder     : getOrder,
                setOrder     : setOrder,
                getTag       : getTag,
                setTag       : setTag,
                getTotal     : getTotal,
                getPageCount : getPageCount,
                isFinished   : isFinished,
                isWaiting    : isWaiting,
                reset        : init,
                init         : init
            });

        }
    ]
);