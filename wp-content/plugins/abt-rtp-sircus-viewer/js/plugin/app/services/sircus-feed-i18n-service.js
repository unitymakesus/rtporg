SircusFeedViewerApp.service(
    'SircusFeedI18nService',
    [   '$rootScope', '$http', '$log', 'SircusFeedLocalizedDataService',
        function ($scope, $http, $log, $dataService) {
            // This doesn't use Angular's translation service
            // We're letting WordPress handle all the translation
            // This is just a connector for that
            return({
                get : get,
                has : has
            });
            function get(key) {
                $i18n = $dataService.get('i18n');
                return $i18n[key];
            }
            function has(key) {
                var $data = $dataService.get('i18n');

                if (angular.isUndefined($data) || null === $data)
                    return false;

                if (angular.isUndefined($data[key]) || null === $data[key])
                    return true;
                else
                    return false;
            }
        }
    ]
);