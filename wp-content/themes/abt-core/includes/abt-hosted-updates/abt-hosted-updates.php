<?php
/*
Plugin Name: ABT Hosted Updates
Plugin URI: http://atlanticbt.com/
Description: Plugin and Theme Autoupdate helper functions - points to ABT repository.  <em>Not necessary to activate if theme/plugin includes properly.</em>
Version: 2.0
Requires: WP-Dev Library (?)
Author: atlanticbt
Author URI: http://atlanticbt.com
License: private
*/


/**
 * Helper for common update checking
 */
class abt_hosted_updates {

	const ABT_REPOSITORY_LOCATION = 'http://repo.core.atlanticbt.com/repo/browse/';
	
	static function get_repository_location() {
		return abt_hosted_updates::ABT_REPOSITORY_LOCATION;
	}
	
	/**
	 * Wrapper for PluginUpdateChecker with default options
	 *
	 * Simplifies inclusion of w-shadow's PluginUpdateChecker instantiation,
	 * since we're going to fire it off to the same place every time
	 *
	 * @code
	 * 	require 'abt_autoupdate.php';
	 * 	abt_autoupdate(__FILE__);
	 * @endcode
	 *
	 * @param string $calling_file pass __FILE__, it'll do the rest (assumes that the $slug is from the calling filename)
	 * @param bool $checknow {false} force check immediately
	 */
	static function plugin($calling_file, $checknow = false){
		$slug = basename($calling_file, '.php');
		
		// include the plugin autoupdate class
		require_once('plugin-update-checker.php');
		
		$MyUpdateChecker = new PluginUpdateChecker(
			abt_hosted_updates::get_repository_location() . '?act=metadata&type=plugins&q='.$slug
			, $calling_file
		);
		
		// immediate
		if( $checknow ){
			$MyUpdateChecker->checkForUpdates();
		} else {
			$MyUpdateChecker->maybeCheckForUpdates();
		}
	}//--	fn	plugin
	
	
	/**
	 * Wrapper for {Entity}UpdateChecker with default options
	 *
	 * Simplifies inclusion of w-shadow's {Entity}UpdateChecker instantiation,
	 * since we're going to fire it off to the same place every time
	 *
	 * @code
	 * 	require 'abt_autoupdate.php';
	 * 	abt_autoupdate(__FILE__);
	 * @endcode
	 *
	 * @param string $theme_name the theme name to use
	 * @param string $calling_file pass __FILE__, it'll do the rest (assumes that the $slug is from the calling filename)
	 * @param bool $checknow {false} force check immediately
	 */
	static function theme($theme_name, $calling_file, $checknow = false){
		
		$slug = basename( dirname( $calling_file ) );
		//if( $slug == 'YOUR-SITE' ) return;
		// include the plugin autoupdate class
		require_once('theme-update-checker.php');
		
		$MyUpdateChecker = new ThemeUpdateChecker(
			abt_hosted_updates::get_repository_location() . '?act=metadata&type=themes&q='.$slug
			, $theme_name
			, $slug
		);
		
		// immediate
		if( $checknow ) {
			$MyUpdateChecker->checkForUpdates();
		} else {
			$MyUpdateChecker->maybeCheckForUpdates();
		}
	}//--	fn	theme
	
}///---	class	abt_hosted_updates