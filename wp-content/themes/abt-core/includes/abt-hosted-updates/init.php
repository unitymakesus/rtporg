<?php
/*  This is the starting point for checking the ABT self hosted repository for
 * 1) Theme Updates
 * 2) Plugin Updates
 * 
 * This registers the hooks to make the magic happen
 * 
 * To register and update, start with the action hook...
 *    add_action( 'abtcore_check_for_updates', '{YOUR-CALLABLE-FUNCTION}' );
 * 
 * Then inside YOUR-CALLABLE-FUNCTION ...
 * 
 * do_action( 'abtcore_check_for_theme_updates', {SLUG}, __FILE__, true );
 * 
 * OR 
 * 
 * do_action( 'abtcore_check_for_plugin_updates', {SLUG}, __FILE__, true );
 * 
 */

//  Include the self hosted repo codebase
include_once ('abt-hosted-updates.php');

/* 
 * 
 * 
 * 		ABTCORE SELF HOSTED REPOSITORY - HOOKS 
 * 
 * 
 */

//  Register the theme update hook function
add_action( 'abtcore_check_for_theme_updates', 'abtcore_check_for_theme_updates', 10, 3 );

//  Register the plugin update hook function
add_action( 'abtcore_check_for_plugin_updates', 'abtcore_check_for_plugin_updates', 10, 3 );

//  Register the self hosted repository hook function
add_action( 'admin_init', 'check_abtcore_updates' );


/* 
 * 
 * 
 * 		ABTCORE SELF HOSTED REPOSITORY - UPDATE FUNCTIONS
 * 
 *  
 *  
 */


/**
 * Trigger update checks (check ABT self hosted repo for theme/plugin updates)
 */
function check_abtcore_updates() {
	// Trigger Update Checks
	do_action( 'abtcore_check_for_updates' );
}

/**
 * Check the ABT self hosted repository for updates to the specified theme.
 * 
 * @param string $slug
 * @param string $uri
 * @param boolean $check_now
 */
function abtcore_check_for_theme_updates( $slug, $uri, $check_now = false ) {
	//  Only check for updates when inside the WP admin area
	if ( is_admin() ) {
		$u = abt_hosted_updates::theme( $slug, $uri, $check_now );
	}
}

/**
 * Check the ABT self hosted repository for updates to the specified plugin.
 *
 * @param string $slug
 * @param string $uri
 * @param boolean $check_now
 */
function abtcore_check_for_plugin_updates( $slug, $uri, $check_now = false ) {
	//  Only check for updates when inside the WP admin area
	if ( is_admin() ) {
		$u = abt_hosted_updates::plugin( $slug, $uri, $check_now );
	}
}

/* 
 * 
 * 
 * 	ABTCORE SELF HOSTED REPOSITORY - ADMIN NOTICES & ERRORS 
 * 
 * 
 * 
 */

/**
 * Add a notice box to the admin dashboard.
 * 
 * @param string $title
 * @param string $message
 */
function abtcore_updates_notice( $title = '', $message = '' ) {
	//  Only show notices/errors when inside the WP admin area
	if ( is_admin() ) {
		echo 
			'<div class="notice">' . 
			"<h3>Notice: $title</h3>" . 
			"<p>$message</p>" . 
			'</div>';
	}
}

/**
 * Add an error box to the admin dashboard.
 *
 * @param string $title
 * @param string $message
 */
function abtcore_updates_error( $title = '', $message = '' ) {
	//  Only show notices/errors when inside the WP admin area
	if ( is_admin() ) {
		echo 
			'<div class="error">' . 
			"<h3>Error: $title</h3>" . 
			"<p>$message</p>" . 
			'</div>';
	}
}