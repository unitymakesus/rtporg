<?php

/**
 * Echos the main site menu.
 * 
 */
function abtcore_the_mainmenu()
{
	$N = 'menu_walker';
	$walker = abtcore_get_option( $N );
	
	switch( $walker ) {
		case 'custom':
			wp_nav_menu( array(
				'menu_class'     => 'main-nav', 
				'theme_location' => 'primary', 
				'walker'         => new ABT_Custom_Walker_Nav_Menu() 
			) );
			break;
		default:
			wp_nav_menu( array(
				'menu_class'     => 'main-nav', 
				'theme_location' => 'primary'
			) );
			break;
	}
}
