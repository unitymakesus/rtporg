var SVG_CACHE = {};
var SVG_LOCK = {};
var SVG_CALLBACK = {};

function inlineSVG() {
    var load = function(src, callback) {
        if (SVG_CACHE[src]) {
            callback(SVG_CACHE[src])
        } else {
            if (SVG_LOCK[src]) {
                if (!SVG_CALLBACK[src]) {
                    SVG_CALLBACK[src] = [];
                }
                SVG_CALLBACK[src].push(callback);
            } else {
                SVG_LOCK[src] = true;
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
            }
        }
    };
    var container = $(arguments.length ? arguments[0] : 'body');
	/*  Replace all SVG images with inline SVG */
	container.find('img.svg').each(function(){
		var $img = $(this);
		var imgID = $img.attr('id');
		var imgClass = $img.attr('class');
		var imgURL = $img.attr('src');
        load(imgURL, function($svg) {
            if (typeof imgID !== 'undefined') {
                $svg = $svg.attr('id', imgID);
            }
            // Add replaced image's classes to the new SVG
            if (typeof imgClass !== 'undefined') {
                $svg = $svg.attr('class', imgClass+' replaced-svg');
            }
            // Remove any invalid XML tags as per http://validator.w3.org
            $svg = $svg.removeAttr('xmlns:a');
            // Replace image with new SVG
            $img.replaceWith($svg);
        })

	});
}