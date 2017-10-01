<?php
class ABTCore {

	public $_pluginName = __CLASS__;
	const MENU_SLUG = 'abtcore-options';


	public function __construct(){
		if( is_admin() ){
			add_action('admin_menu', array(&$this, 'abtcore_options'));
			add_action('admin_init', array(&$this, 'admin_init'));
			add_action('admin_bar_menu', array(&$this, 'admin_bar_render'), 50 );
		}

		add_action('init',array(&$this, 'init'));
		add_action( 'admin_head', array(&$this, 'admin_head') );


		//register_activation_hook(__FILE__, array(&$this, 'activate_googleanalytics');
		//register_deactivation_hook(__FILE__, array(&$this, 'deactive_googleanalytics');
	}

	public function init(){
		//$this->add_heroes();
	}
	public function admin_init(){
		//$this->add_heroes_boxes();
		$this->add_admin_headers();
	}

	/**
	 * Add stuff to page header, like favicons
	 */
	public function admin_head() {
		echo '<link rel="shortcut" href="' . get_bloginfo('template_directory') . '/favicon.ico" /><link rel="shortcut icon" href="' . get_bloginfo('template_directory') . '/favicon.ico" />';
	}


	public function abtcore_options() {

		//  This hides the old ABT Core Menu .. leaving the rest of the code in place for now in case we need some of it later
		return;

		$icon_path = get_bloginfo('template_url').'/includes/images/i_abt.png';
		add_menu_page('ABT Core Options', 'ABT Core', 'manage_options', self::MENU_SLUG, array(&$this, 'my_abtcore_options'), $icon_path, 62); // below appearance. http://codex.wordpress.org/Function_Reference/register_post_type
		add_submenu_page(self::MENU_SLUG, 'Core Settings', 'Core Settings', 'manage_options', 'my-abtcore-settings', array(&$this, 'my_abtcore_settings'));
		add_submenu_page(self::MENU_SLUG, 'Internet Marketing', 'Internet Marketing', 'manage_options', 'my-abtcore-marketing', array(&$this, 'abtcore_marketing'));
		add_submenu_page(self::MENU_SLUG, 'Shortcodes', 'Shortcodes & Goodies', 'manage_options', 'abtcore-shortcodes-page', array(&$this, 'abtcore_shortcodes'));
	}

	public function my_abtcore_options() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
	}

	public function my_abtcore_settings() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		//include('ui/admin-options.php');
	}

	public function abtcore_shortcodes() {
		if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		//include('ui/shortcodes-options.php');
	}

	public function abtcore_marketing() {
	  	if (!current_user_can('manage_options'))  {
			wp_die( __('You do not have sufficient permissions to access this page.') );
		}
		//include('ui/marketing-options.php');
	}

	#region =============== HEADER/FOOTER -- scripts and styles ===============

	/**
	 * Add admin header stuff
	 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script#Load_scripts_only_on_plugin_pages
	 */
	function add_admin_headers(){

		global $post_type;
		global $pagenow;

		$stylesToAdd = array();

		// show on any page created by this theme (also later look for 'abtcore' in page
		$allowed_pages = array('nav-menus-settings');

		$basename = basename(__FILE__,'.php');

		$stylesToAdd = array(
			$basename => 'ui/plugin.css'	//add a stylesheet with the key matching the filename
		);

		$has_https = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ;

		//wp_register_script('jquery-ui', 'http' . ($has_https ? 's' : '') . '://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js', array('jquery'),'1.9.2', false);
		//wp_enqueue_script('jquery-ui');

		// allow on all pages
		$stylesToAdd[ $basename . '_admin' ] = 'ui/admin.css';	//add a stylesheet with the key matching the filename
		//load global plugin css

		// Have to manually add to in_footer
		// Check if script is done, if not, then add to footer
		foreach($stylesToAdd as $handle => $stylesheet){
			wp_enqueue_style(
				$handle														//id
				, get_bloginfo('template_url').'/includes/'.$stylesheet		//file
				, array()													//dependencies
				, ABTCORE_VERSION											//version
				, 'all'														//media
			);
		}

	}//---	function add_admin_headers

	#endregion =============== HEADER/FOOTER -- scripts and styles ===============

	#region ================== ADMIN BAR ===============

	function admin_bar_render() {
		global $wp_admin_bar;
		// we can remove a menu item, like the Comments link, just by knowing the right $id
		//$wp_admin_bar->remove_menu('comments');

		// Add Core Sub Menu
		if ( !current_user_can('edit_theme_options') ) return; // go away!
		$wp_admin_bar->add_menu( array(
			'id' => 'abtcore_bar',
			'title' => __('ABT Core'),
			'href' => admin_url( 'admin.php?page=my-abtcore-settings' )
		) );
		$wp_admin_bar->add_menu( array(
			'parent' => 'abtcore_bar',
			'id' => 'abtcore_bar_settings',
			'title' => __('Core Settings'),
			'href' => admin_url( 'admin.php?page=my-abtcore-settings' )
		) );
		$wp_admin_bar->add_menu( array(
			'parent' => 'abtcore_bar',
			'id' => 'abtcore_bar_heroes',
			'title' => __('Heroes'),
			'href' => admin_url( 'edit.php?post_type=heroes' )
		) );
		$wp_admin_bar->add_menu( array(
			'parent' => 'abtcore_bar_heroes',
			'id' => 'abtcore_bar_add_hero',
			'title' => __('Add New Hero'),
			'href' => admin_url( 'post-new.php?post_type=heroes' )
		) );
		$wp_admin_bar->add_menu( array(
			'parent' => 'abtcore_bar',
			'id' => 'abtcore_bar_marketing',
			'title' => __('Internet Marketing'),
			'href' => admin_url( 'admin.php?page=my-abtcore-marketing' )
		) );
		$wp_admin_bar->add_menu( array(
			'parent' => 'abtcore_bar',
			'id' => 'abtcore_bar_paging',
			'title' => __('Paging Options'),
			'href' => admin_url( 'admin.php?page=abtcore-page-numbers' )
		) );
		$wp_admin_bar->add_menu( array(
			'parent' => 'abtcore_bar',
			'id' => 'abtcore_bar_menu',
			'title' => __('Menu Settings'),
			'href' => admin_url( 'admin.php?page=nav-menus-settings' )
		) );
	}

	#endregion =============== ADMIN BAR ===============

	/**
	 * Internal helper for singular execution; keeps track of how many times something was run
	 */
	private static $_runcounter;
	/**
	 * Helper function - record whether "key" has happened already, and if so how many times
	 * @return false if never run, otherwise the number of times it's happened
	 */
	static function runonce($key) {
		if( !isset( self::$_runcounter ) ) self::$_runcounter = array();	// first call

		// already run once!
		if( isset( self::$_runcounter[$key] ) ) {
			return ++self::$_runcounter[$key];	//increm
		}

		//otherwise, remember for later
		self::$_runcounter[$key] = 1;
		return false;
	}//--	fn	runonce


}//-- class ABTCore


include_once(ABSPATH . 'settings_helper_functions.inc.php');	// functions like v() or abtcore_get_option()

new ABTCore();



?>
