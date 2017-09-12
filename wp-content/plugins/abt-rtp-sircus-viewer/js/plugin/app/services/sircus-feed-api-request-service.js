SircusFeedViewerApp.service(
    'SircusFeedApiRequestService',
    [
        '$http',
        '$log',
        'localStorageService',
        'SircusFeedLocalizedDataService',
        'SircusFeedTransformRequestService',
        function ($http, $log, localStorageService, dataService, transformRequestService) {
            function getApiActionUrl(itemId, action) {
                if (angular.isUndefined(itemId) || null === itemId)
                    return false;

                if (angular.isUndefined(action) || null === action)
                    return false;

                return dataService.get('api_url') + '/' + itemId + '/' + action;
            }
            function getApiToken() {
                return dataService.get('api_key');
            }
            function apiItemAction(itemId, action) {
                var actionUrl = getApiActionUrl(itemId, action);

                if (!actionUrl)
                    return false;

                var request = $http({
                    method : 'POST',
                    url    : getApiActionUrl(itemId, action),
                    data   : { api_token : getApiToken() },
                    transformRequest: function(obj) { return transformRequestService.transformRequest(obj); },
                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                });

                return( request.then(handleSuccess, handleError ));
            }
            function likeItem(itemId) {
                apiItemAction(itemId, 'like');
            }
            function unlikeItem(itemId) {
                apiItemAction(itemId, 'unlike');
            }
            function shareItem(itemId) {
                apiItemAction(itemId, 'share');
            }
            function openItem(itemId) {
                apiItemAction(itemId, 'open');
            }
            function handleError(response) {
                $log.log(response);
            }
            function handleSuccess(response) {
                //$log.log(response.data);
            }
            return ({
                likeItem : likeItem,
                unlikeItem : unlikeItem,
                shareItem : shareItem,
                openItem : openItem
            });
        }
    ]
);