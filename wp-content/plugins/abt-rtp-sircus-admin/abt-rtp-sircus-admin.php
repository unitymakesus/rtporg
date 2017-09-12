<?php
/*
Plugin Name: RTP SIRCUS Admin
Version: 0.1
Description: This plugin allows access to RTP SIRCUS webservices to manage feed items
Author: John Foushee
Author URI: http://www.atlanticbt.com
Plugin URI:  http://www.atlanticbt.com
Text Domain: abt-rtp-sircus-admin
*/


class ABT_RTP_Sircus_Admin {

	const PLUGIN_SLUG = 'sircus-admin';

	public function __construct() {
		// add hooks to only add the ng-app filter if on this plugin's page
		if (is_admin()) {
			add_action('admin_menu', array($this, 'add_wp_admin_menus'));
			register_activation_hook( __FILE__, array( $this, 'activate' ) );
		}
	}

	/**
	 * On a page for this plugin, add this attribute to the HTML tag
	 */
	public function init_for_plugin_request() {
		// adding this filter
		add_filter( 'language_attributes', array($this, 'ng_html') );
	}

	public function activate()
	{

	}

	/**
	 * Adds pages to the wordpress admin.
	 */
	public function add_wp_admin_menus() {
		// generates WP Admin menu/submenus
		$plugin_slug = self::PLUGIN_SLUG;
		$page_hooks = array();
		$page_hooks[] = add_menu_page('SIRCUS Admin', 'SIRCUS Admin', 'manage_options', $plugin_slug, array($this, 'generate_dashboard_page'));
		$page_hooks[] = add_submenu_page($plugin_slug, 'Dashboard', 'Dashboard', 'edit_pages', $plugin_slug, array($this, 'generate_dashboard_page'));
		$page_hooks[] = add_submenu_page($plugin_slug, 'Feed Configuration', 'Feed Configuration', 'edit_pages', $plugin_slug.'/configure', array($this, 'generate_feed_config_page'));
		$page_hooks[] = add_submenu_page($plugin_slug, 'Pending Approval', 'Pending Approval', 'edit_pages', $plugin_slug.'/pending', array($this, 'generate_pending_page'));
		$page_hooks[] = add_submenu_page($plugin_slug, 'Approved', 'Approved', 'edit_pages', $plugin_slug.'/approved', array($this, 'generate_approved_page'));

		$callable = array($this, 'init_for_plugin_request');
		foreach ($page_hooks as $page_hook) {
			add_action('load-'.$page_hook, $callable);
		}
	}

	public function generate_dashboard_page() {
		$this->_include_page('dashboard');
	}

	public function generate_feed_config_page() {
		$this->_include_page('feed-configuration');
	}

	public function generate_pending_page() {
		$this->_include_page('pending-approval');
	}

	public function generate_approved_page() {
		$this->_include_page('approved');
	}

	protected function _add_css() {
		wp_enqueue_style('abt-rtp-sircus-admin-style', plugins_url() . '/abt-rtp-sircus-admin/css/plugin-style.css');
	}

	protected function _add_javascripts() {
		wp_enqueue_script('angularjs', plugins_url() . '/abt-rtp-sircus-admin/js/angular.min.js');
		wp_enqueue_script('angular-resource', plugins_url() . '/abt-rtp-sircus-admin/js/angular-resource.min.js', array('angularjs'));
		wp_enqueue_script('angular-route', plugins_url() . '/abt-rtp-sircus-admin/js/angular-route.min.js', array('angularjs'));
		wp_enqueue_script('angular-sanitize', plugins_url() . '/abt-rtp-sircus-admin/js/angular-sanitize.min.js', array('angularjs'));
		wp_enqueue_script('underscore', plugins_url() . '/abt-rtp-sircus-admin/js/underscore-min.js', array('angularjs'));
		wp_enqueue_script('restangular', plugins_url() . '/abt-rtp-sircus-admin/js/restangular.min.js', array('angularjs', 'underscore'));
		// pass data (admin token)
		/**
		 * @TODO: move to configurable options.
		 */
		wp_localize_script('angularjs', 'RTP_API_CONFIG', array(
			'domain' => ot_get_option('abt_rtp_sircus_admin_domain', 'http://web.rtp.dev'),
			'token' => ot_get_option('abt_rtp_sircus_admin_token', '4caeae73-8a31-4a8e-a0fc-cb04f13bb9c9'),
		));
		wp_enqueue_script('ng-app', plugins_url() . '/abt-rtp-sircus-admin/js/app/app.js', array('angularjs', 'underscore', 'restangular'));
	}

	public function ng_html($output) {
		return $output . ' data-ng-app="rtp"';
	}

	protected function _include_page($page) {
		$this->_add_javascripts();
		$this->_add_css();
		ob_start();
		require 'html/'.$page.'.php';
		$result = ob_get_contents();
		ob_end_clean();
		echo $result;
	}
}

$abt_rtp_sircus_admin = new ABT_RTP_Sircus_Admin();