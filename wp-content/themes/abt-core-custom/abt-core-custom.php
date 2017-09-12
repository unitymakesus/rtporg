<?php
	
//  Register the function you want to call when it's time to check for updates
add_action( 'abtcore_check_for_updates', 'abtcore_child_theme_update' );

/**
 * This function triggers an update check for the parent theme
 * Uses the abt self hosted repository
 */
function abtcore_child_theme_update()
{
	//  Check For Updates @ Self Hosted Repository
	do_action(
		'abtcore_check_for_theme_updates', 
		basename( dirname( __FILE__ ) ), 
		__FILE__, 
		false
	);
}