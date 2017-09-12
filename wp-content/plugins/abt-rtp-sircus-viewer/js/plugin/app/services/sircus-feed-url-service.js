SircusFeedViewerApp.service(
    'SircusFeedUrlService',
    [
        '$log',
        'SircusFeedLocalizedDataService',
        function ($log, dataService) {
            return({
                getSiteUrl     : getSiteUrl,
                getThemeUrl    : getThemeUrl,
                getPluginUrl   : getPluginUrl,
                getPartialUrl  : getPartialUrl,
                getAjaxUrl     : getAjaxUrl,
                getItemsApiUrl : getItemsApiUrl
            });
            function getItemsApiUrl(asset) {
                return getUrl('api_url', asset);
            }
            function getSiteUrl(asset){
                return getUrl('site_url', asset);
            }
            function getThemeUrl(asset) {
                return getUrl('theme_url', asset);
            }
            function getPluginUrl(asset) {
                return getUrl('plugin_url', asset);
            }
            function getPartialUrl(asset) {
                return getUrl('partials_url', asset);
            }
            function getAjaxUrl(asset) {
                return getUrl('ajax_url', asset);
            }
            function getUrl(key,asset){
                return dataService.get(key) + asset;
            }
        }
    ]
);