<?php
/**
 * Entity Update Checker Library 1.1 - Plugin
 * http://atlanticbt.com/
 * 
 * Copyright 2011 AtlanticBT, Jeremy Schwartz
 * Licensed under the GNU GPL license.
 * http://www.gnu.org/licenses/gpl.html
 */

if ( !class_exists('PluginUpdateChecker') ):
	
	require_once('entity-update-checker.php');
	
/**
 * A custom plugin update checker. 
 * 
 * @author Jeremy Schwartz, AtlanticBT, Janis Elsts
 * @copyright 2011, 2010
 * @version 1.1
 * @access public
 */
class PluginUpdateChecker extends EntityUpdateChecker {
	
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
		$this->entityFile = plugin_basename($entityFile);

		parent::__construct($metadataUrl, $entityFile, $slug, $checkPeriod, $optionName);
		
		$this->installHooks();
	}
	
	/**
	 * Install the hooks required to run periodic update checks and inject update info 
	 * into WP data structures. 
	 * 
	 * @return void
	 */
	function installHooks(){
		//Override requests for plugin information
		add_filter('plugins_api', array(&$this, 'injectInfo'), 10, 3);
		
		//Insert our update info into the update array maintained by WP
		add_filter('site_transient_update_plugins', array(&$this,'injectUpdate')); //WP 3.0+
		add_filter('transient_update_plugins', array(&$this,'injectUpdate')); //WP 2.8+
		
		//Set up the periodic update checks
		$cronHook = 'check_plugin_updates-' . $this->slug;
		if ( $this->checkPeriod > 0 ){
			
			//Trigger the check via Cron
			add_filter('cron_schedules', array(&$this, '_addCustomSchedule'));
			if ( !wp_next_scheduled($cronHook) && !defined('WP_INSTALLING') ) {
				$scheduleName = 'every' . $this->checkPeriod . 'hours';
				wp_schedule_event(time(), $scheduleName, $cronHook);
			}
			add_action($cronHook, array(&$this, 'checkForUpdates'));
			
			//In case Cron is disabled or unreliable, we also manually trigger 
			//the periodic checks while the user is browsing the Dashboard. 
			add_action( 'admin_init', array(&$this, 'maybeCheckForUpdates') );
			
		} else {
			//Periodic checks are disabled.
			wp_clear_scheduled_hook($cronHook);
		}		
	}
	

	/**
	 * Get the currently installed version of the plugin.
	 * 
	 * @return string Version number.
	 */
	function getInstalledVersion(){		// "cached"
		if( isset( self::$installedVersions[$this->slug] ) ){
			return self::$installedVersions[$this->slug];
		}
		
		if ( !function_exists('get_plugins') ){
			require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
		}
		$allItems = get_plugins();

		// save "cache"
		self::$installedVersions[$this->slug] = $this->_getInstalledVersion($allItems);
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
    	$relevant = ($action == 'plugin_information') && isset($args->slug) && ($args->slug == $this->slug);
		if ( !$relevant ){
			return $result;
		}
		
		$pluginInfo = $this->requestInfo();
		if ($pluginInfo){
			return $pluginInfo->toWpFormat();
		}
				
		return $result;
	}


}///---	class	PluginUpdateChecker
	
endif;
