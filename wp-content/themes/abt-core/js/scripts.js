/* =======================================================================================================
	Functions
======================================================================================================= */

/* Detect if Apple device
-------------------------------------------------------------*/
function isApple() {
	var deviceAgent = navigator.userAgent.toLowerCase();
    var agentID = deviceAgent.match(/(iphone|ipod|ipad)/);

    if (agentID) {
		return true;	
	}
	else{
		return false;	
	}
}


/* Detect if Android device
-------------------------------------------------------------*/
function isDroid() {
	var ua = navigator.userAgent.toLowerCase();
	var isAndroid = ua.indexOf("android") > -1; //&& ua.indexOf("mobile");

	if(isAndroid) {
		return true;	
	}
	else{
		return false;	
	}
}


/* Hide iOS Address Bar
-------------------------------------------------------------*/
function hideURLbar() {
    setTimeout(scrollTo, 0, 0, 1);
}





	
/* =======================================================================================================
	Document Ready Scripts
======================================================================================================= */
(function ($) {
	
	/* Show/Hide Main Nav Display
	------------------------------------------------------------------------ */
	function showMainNav() {
		$('#menu-main-menu').show();
	}

	function hideMainNav() {
		$('#menu-main-menu').hide();
	}

	/* Desktop Hero Controls
	-------------------------------------------------------------*/
	function desktopHeroController() {
		if ( $('#featured').length > 0 ) {
			$('#featured').find('li').removeClass('active');
		    $('#featured').find('ul.features-nav').show().find('li:first-child').hide();
		    $('#featured').find('.mobile-features-nav').hide();
	    }
	}
	
	/* Cross-Browser Placeholder Attribute
	------------------------------------------------------------------------ */
	function placeholderInit() {
		if(!Modernizr.input.placeholder){
			$('[placeholder]').focus(function() {
			  var input = $(this);
			  if (input.val() == input.attr('placeholder')) {
				input.val('');
				input.removeClass('placeholder');
			  }
			}).blur(function() {
			  var input = $(this);
			  if (input.val() == '' || input.val() == input.attr('placeholder')) {
				input.addClass('placeholder');
				input.val(input.attr('placeholder'));
			  }
			}).blur();
			$('[placeholder]').parents('form').submit(function() {
			  $(this).find('[placeholder]').each(function() {
				var input = $(this);
				if (input.val() == input.attr('placeholder')) {
				  input.val('');
				}
			  })
			});
		}
	}


	/* Init Featured Heroes
	------------------------------------------------------------------------ */
	function featuredHeroes() {
		
		if( $('#heroes').length > 0 ) {
			$('#heroes .flexslider').flexslider({
				animation: "slide"
	    	});
		}
		
	}


	/* Featured Showcase
	------------------------------------------------------------------------ */
	function featuredShowcase() {
		
		if ( $('#featured-showcases ul').length > 0 ) {
			$('#featured-showcases .flexslider').flexslider({
				animation: "slide",
			    itemWidth: 192,
			    controlNav: false,
			    directionNav: false
			});
		}
	}
	
	
	$(document).ready(function () {
	
	    /* GLOBAL - All Devices and Resolutions
	    ======================================================================================================= */
			
		
		placeholderInit();			// Cross-Browser Placeholder Attribute
		featuredHeroes();			// Activate Featured Heroes
		featuredShowcase();			// Activate Featured Showcase
				    
	    
	    /* BASE - Smartphones Only
	    ======================================================================================================= */
	
	    Responder.query("only screen and (max-width: 767px)", function () {
	
	    }, true);
	    
	    
	    /* MOBILE - Tablets & Up
	    ======================================================================================================= */
	    Responder.query("only screen and (min-width: 768px)", function () {
	        	        
	    }, true);
	   
	    
	    Responder.query("only screen and (min-width: 768px)", function () {
	
	    }, false);
	
	    
	    Responder.query("only screen and (max-width: 1163px)", function () {
	        
	    }, false);
	
	
	    /* DESKTOP - Only Desktops
	    ======================================================================================================= */
	    Responder.query("only screen and (min-width: 1164px)", function () {
	        
	    }, true);
	
	    
	    Responder.query("only screen and (min-width: 1164px)", function () {
	        
	    }, false);
	
	
	});
})(jQuery);

/* Hide Address Bar on Mobile
-------------------------------------------------------------*/
var apple = isApple();

if (apple) {
	window.addEventListener("load",function() {
		
		// Set a timeoutÃ¢â‚¬Â¦
	  	setTimeout(function(){
	    	
	    	// Hide the address bar!
	    	window.scrollTo(0, 1);
	  	
	  	}, 0);
	
	});
}