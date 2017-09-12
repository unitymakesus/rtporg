<?php

	/**
	 * @author brians
	 *
	 */
	class ABTCore_Admin_Ui
	{
		const THEME_IDENTIFIER = 'ABT Core';

		private $admin_check;

		function __construct( $admin_check = 'abtcore_current_user_is_super' )
		{
			$this->admin_check = $admin_check;
			$this->_init();
		}

		/**
		 * Is this user an ABT Core Super Admin?
		 *
		 * @return boolean Is this user a ABTCore Super User?
		 */
		private function _user_is_admin()
		{
			$function = $this->admin_check;
			return $this->_check_admin_function() && $function();

		}

		/**
		 * Does the super admin checking function work?
		 *
		 * @param WP_User $user
		 * @return boolean Does the super admin checking function work?
		 */
		private function _check_admin_function()
		{
			return function_exists( $this->admin_check );
		}

		/**
		 * Initialize the object.
		 *
		 */
		private function _init()
		{
			/*  Enable ABTCore parent theme.
			 *
			 */
			//  Add admin js
			add_action( 'admin_enqueue_scripts', array(&$this,'do_abtcore_process') );

			//  Ad option, theme and update filters
			add_filter( 'theme_action_links', array(&$this,'abtcore_filter_theme_actions'), 10, 2 );
			add_filter( 'site_option__site_transient_update_themes', array(&$this,'abtcore_filter_site_options'), 1, 1 );
			add_filter( 'site_transient_update_themes', array(&$this,'abtcore_filter_theme_updates'), 100, 1 );
		}

		/**
		 * Add admin javascript
		 *
		 */
		function do_abtcore_process()
		{
			if ( !$this->_user_is_admin() ) {
				wp_register_script('abtcore-admin', ABTCORE_URL . '/js/core-admin.js');
				wp_enqueue_script('abtcore-admin');
			}
		}

		/**
		 * Filter theme actions (delete, activate, etc)
		 *
		 * @param array $actions
		 * @param string $theme
		 * @return array Filtered theme actions
		 */
		function abtcore_filter_theme_actions( $actions, $theme = null )
		{
			return $this->_user_is_admin() || ( $theme->Name != self::THEME_IDENTIFIER ) ? $actions : array();
		}

		/**
		 * Filter theme options
		 *
		 * @param object $value
		 * @return object Filtered theme actions
		 */
		function abtcore_filter_site_options( $value )
		{
			if ( !$this->_user_is_admin() ) {
				unset( $value->checked['abt-core']);
				unset( $value->response['abt-core']);
			}

			return $value;
		}

		/**
		 * Filter theme updates
		 *
		 * @param array $value
		 * @return array updates
		 */
		function abtcore_filter_theme_updates( $value )
		{
			if ( !$this->_user_is_admin() ) {
				unset( $value->checked['abt-core']);
				unset( $value->response['abt-core']);
			}

			return $value;
		}
	}