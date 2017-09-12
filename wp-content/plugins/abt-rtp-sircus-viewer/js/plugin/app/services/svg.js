angular.module('SircusFeedViewer').service('svgCache', function() {
        var SVG_CACHE = {};
        var SVG_CALLBACK = {};
        var SVG_LOCK = {};

        return {
            has: function(src) {
                return !!SVG_CACHE[src];
            },
            setSrc: function(src, data) {
                SVG_CACHE[src] = data;
            },
            getSrc: function(src) {
                return SVG_CACHE[src];
            },
            load: function(src, callback) {
                // if (SVG_CACHE[src]) {
                //     callback(SVG_CACHE[src])
                // } else {
                //     if (SVG_LOCK[src]) {
                //         if (!SVG_CALLBACK[src]) {
                //             SVG_CALLBACK[src] = [];
                //         }
                //         SVG_CALLBACK[src].push(callback);
                //     } else {
                //         SVG_LOCK[src] = true;
                        $.get(src, function(data) {
                            var result = $(data).find('svg');
                            result.removeAttr('xmlns:a');
                            SVG_CACHE[src] = result.clone();
                            SVG_LOCK[src] = false;
                            callback(result.clone());
                            if (SVG_CALLBACK[src]) {
                                for (i in SVG_CALLBACK[src]) {
                                    SVG_CALLBACK[src][i](result.clone());
                                }
                            }
                        })
                //     }
                // }
            }
        };
    }
);