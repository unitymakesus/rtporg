(function($) {
	$(function() {
		$('div.available-theme h3').each(function() {
			if($(this).html() === 'ABT Core') {
				$(this).parent('div.available-theme').hide();
			}
		});
	});
})(jQuery);