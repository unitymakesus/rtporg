angular.module('SircusFeedViewer').directive('svg', function(svgCache) {
    return {
        template: function(tElement, tAttrs) {
            return '<img src="'+tAttrs.svg+'" />';
        },
        link: function(scope, iElement, iAttrs) {
            var classOnReplace = iAttrs.class ? iAttrs.class : '';
            var swapOut = function(src) {
                if (src) {
                    var onData = function(svg) {
                        try {
                            svg.attr('class', classOnReplace+' '+(iAttrs.svgClass ? iAttrs.svgClass : 'svg'));
                            if (iAttrs.setFill) {
                                svg.children('path').each(function(i, e) {
                                    jQuery(e).attr('fill', iAttrs.setFill);
                                });
                            }
                            iElement.children().remove();
                            iElement.append(svg);
                        } catch (e) {
                            console.error(e);
                        }
                    }
                    svgCache.load(src, onData);
                }
            }
            if (iAttrs.static) {
                swapOut(iAttrs.static);
                return;
            }
            if (iAttrs.evaluated) {
                swapOut(scope.$eval(iAttrs.evaluated));
                return;
            }

            scope.$watch(iAttrs.svg, function(newValue, oldValue) {
                swapOut(newValue);
            }, true);
            swapOut(scope.$eval(iAttrs.svg));
        }
    };
});