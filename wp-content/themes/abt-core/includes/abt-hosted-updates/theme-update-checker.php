<?php
/**
 * Theme Update Checker
 * http://atlanticbt.com/
 * 
 * Copyright 2011 AtlanticBT, Jeremy Schwartz
 * Licensed under the GNU GPL license.
 * http://www.gnu.org/licenses/gpl.html
 * 
 * Based on source from
 * http://clark-technet.com/2010/12/wordpress-self-hosted-plugin-update-api
 * http://konstruktors.com/blog/wordpress/2538-automatic-updates-for-plugins-and-themes-hosted-outside-wordpress-extend/
 * http://nazieb.com/797/how-to-make-your-own-plugins-themes-updating-service
 */

if ( !class_exists('ThemeUpdateChecker') ):
	
	require_once('entity-update-checker.php');
	

/**
 * A custom plugin update checker. 
 * 
 * @author Jeremy Schwartz, AtlanticBT, Janis Elsts
 * @copyright 2011, 2010
 * @version 1.1
 * @access public
 */
class ThemeUpdateChecker extends EntityUpdateChecker {
	
	/**
	 * Class constructor.
	 * 
	 * @param string $metadataUrl The URL of the plugin's metadata file.
	 * @param string $entityFile Fully qualified path to the main plugin file.
	 * @param string $slug The plugin's 'slug'. If not specified, the filename part of $entityFile sans '.php' will be used as the slug.
	 * @param integer $checkPeriod How often to check for updates (in hours). Defaults to checking every 12 hours. Set to 0 to disable automatic update checks.
	 * @param string $optionName Where to store book-keeping info about update checks. Defaults to 'external_updates-$slug'. 
	 * @return void
	 */
	function __construct($metadataUrl, $entityFile, $slug = '', $checkPeriod = 12, $optionName = ''){
		
		// specific for themes
		$this->entityFile = $entityFile;//substr($entityFile, strpos($entityFile, 'themes/')+7); //plugin_basename($entityFile);
		
		parent::__construct($metadataUrl, $entityFile, $slug, $checkPeriod, $optionName);
		
		$this->installHooks();
		
		### $this->pbug( $this );
	}
	
	/**
	 * Install the hooks required to run periodic update checks and inject update info 
	 * into WP data structures. 
	 * 
	 * @return void
	 */
	function installHooks(){
		//Override requests for plugin information
		add_filter('themes_api', array(&$this, 'injectInfo'), 10, 3);	//? does this work
		
		//Insert our update info into the update array maintained by WP
		add_filter('site_transient_update_themes', array(&$this,'injectUpdate')); //WP 3.0+
		add_filter('pre_set_site_transient_update_themes', array(&$this,'injectUpdate')); //WP 3.0+ ?
		add_filter('site_transient_update_themes', array(&$this,'injectUpdate')); //WP 3.0+
		##add_filter('transient_update_plugins', array(&$this,'injectUpdate')); //WP 2.8+
		#add_filter('transient_update_themes', array(&$this,'injectUpdate')); //WP 2.8+ ?
		
		
	}
	

	/**
	 * Get the currently installed version of the plugin.
	 * 
	 * @return string Version number.
	 */
	function getInstalledVersion(){
		// "cached"
		if( isset( self::$installedVersions[$this->slug] ) ){
			return self::$installedVersions[$this->slug];
		}
		
		if ( !function_exists('wp_get_themes') ){
			require_once( ABSPATH . '/wp-include/theme.php' );
		}
		$allItems = wp_get_themes();
		
		// save "cache"
		self::$installedVersions[$this->slug] = $this->_getInstalledVersion($allItems);
		
		#$this->pbug($this->slug, $this->entityFile, $allItems, self::$installedVersions[$this->slug]);
		return self::$installedVersions[$this->slug];	//$this->_getInstalledVersion($allItems);
	}

	/**
	 * Intercept plugins_api() calls that request information about our plugin and 
	 * use the configured API endpoint to satisfy them. 
	 * 
	 * @see plugins_api()
	 * 
	 * @param mixed $result
	 * @param string $action
	 * @param array|object $args
	 * @return mixed
	 */
	function injectInfo($result, $action = null, $args = null){
    	$relevant = ($action == 'theme_information') && isset($args->slug) && ($args->slug == $this->slug);
		### $this->pbug('not relevant!', $action, $args, $result);
		
		if ( !$relevant ){
			return $result;
		}
		
		$entityInfo = $this->requestInfo();
		
		### $this->pbug($entityInfo, $result);
		
		if ($entityInfo){
			return $entityInfo->toWpFormat();
		}
				
		return $result;
	}

	/**
	 * Insert the latest update (if any) into the update list maintained by WP.
	 * NOTE: only difference with parent is that it's indexed by slug instead of entityFile, due to naming differences
	 * 	and returned as an array, instead of a class
	 * 
	 * @param array $updates Update list.
	 * @return array Modified update list.
	 */
	function injectUpdate($updates){
		$state = get_option($this->optionName);
		
		//Is there an update to insert?
		if ( !empty($state) && isset($state->update) && !empty($state->update) ){
			//Only insert updates that are actually newer than the currently installed version.
			if ( 1 === version_compare($state->update->version, $this->getInstalledVersion() ) ){
				$updates->response[$this->slug] = (array) $state->update->toWpFormat();
			}
			else {
				// added this because it was, for some reason, still thinking it needs an update?
				unset( $updates->response[$this->slug] );
			}
			
		}
		
		return $updates;
	}


}///---	class	ThemeUpdateChecker


endif;
