SircusFeedViewerApp.service(
    'SircusFeedTransformRequestService',
    [
        '$log',
        'localStorageService',
        'SircusFeedLocalizedDataService',
        function ($log, localStorageService, dataService) {
            function transformRequest(obj) {
                var str = [];
                for (var key in obj) {
                    if (obj[key] instanceof Array) {
                        for(var idx in obj[key]){
                            var subObj = obj[key][idx];
                            for(var subKey in subObj){
                                str.push(
                                    encodeURIComponent(key) +
                                    "[" +
                                    idx +
                                    "][" +
                                    encodeURIComponent(subKey) +
                                    "]=" +
                                    encodeURIComponent(subObj[subKey])
                                );
                            }
                        }
                    }
                    else {
                        str.push(encodeURIComponent(key) + "=" + encodeURIComponent(obj[key]));
                    }
                }
                return str.join("&");
            }
            return ({
                transformRequest : transformRequest
            });
        }
    ]
);