SircusFeedViewerApp.service(
    'SircusFeedLocalizedDataService',
    [
        '$http',
        '$log',
        function($http, $log) {
            var $data = [];
            return({
                init : init,
                get : get,
                has : has,
                set : set
            });
            function init(data){
                $data = data;
            }
            function set(key, value){
                $data[key] = value;
            }
            function has(key){
                if (angular.isUndefined($data[key]) || null === $data[key])
                    return true;
                else
                    return false;
            }
            function get(key) {
                return $data[key];
            }
        }
    ]
);