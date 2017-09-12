(function ($) {

    "use strict";
    var theme_dir = "/wp-content/themes/abt-core-custom/";

	/* Equalize person tiles
	------------------------------------------------------------------------ */
	function initEqualizePersonTiles() {
	    var people = $('.vcard'),
	        name = people.find('.fn');

	    if (people.length > 1) {
	        people.removeAttr('style').equalHeights();
	        name.removeAttr('style').equalHeights();
	    }
	}

	$(window).load(function () {
		initEqualizePersonTiles();
	});

	$(window).resize(function () {
		initEqualizePersonTiles();
	});

})(jQuery);