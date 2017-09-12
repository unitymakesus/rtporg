<?php

/**
 * abtcore functions and definitions
 *
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */


/* Definitions
======================================================================================================= */
define( 'ABTCORE_VERSION', '1.3.1' );
define( 'ABTCORE_URL', get_bloginfo('template_url') );
define( 'ABTCORE_DIR', dirname(__FILE__) );


/* Requirement Files
======================================================================================================= */

	/* Inlude Self Hosted Repo
	------------------------------------------------------------------------ */
	require_once( 'includes/abt-hosted-updates/init.php' );


	/* Include eponymous functions, like update check
	------------------------------------------------------------------------ */
	require_once( basename( dirname( __FILE__ ) ) . '.php' );


	/* Include Admin UI
	------------------------------------------------------------------------ */
	require_once( 'includes/ui/abtcore-admin-ui.php' );




/* Get Theme Functions
======================================================================================================= */
add_filter( 'abtcore_theme_data_Version', 'abtcore_filter_version', 1, 1 );
add_filter( 'abtcore_theme_data_version', 'abtcore_filter_version', 1, 1 );

	/* Filter Version
	------------------------------------------------------------------------ */
	function abtcore_filter_version( $value = ABTCORE_VERSION ) {

		return ABTCORE_VERSION;

	}


	/* Theme Slug
	------------------------------------------------------------------------ */
	function abtcore_get_theme_slug() {

		return basename( ABTCORE_DIR );

	}


	/* Theme Object
	------------------------------------------------------------------------ */
	function abtcore_get_theme_object() {

		$theme_root = get_theme_root();
		$theme_slug = abtcore_get_theme_slug();
		$theme_file = $theme_root . '/' . $theme_slug . '/' . 'style.css';
		$theme_data = null;

		if ( function_exists( 'wp_get_theme' ) ) {

			$theme_data = wp_get_theme( $theme_slug,  $theme_root );

		} else {

			$theme_data = get_theme_data( $theme_file );

		}

		return $theme_data;

	}


	/* Theme Data
	------------------------------------------------------------------------ */
	function abtcore_get_theme_data( $key, $enable_filters = true) {

		$theme_object = abtcore_get_theme_object();
		$theme_data   = null;

		if ( isset( $theme_object[$key] ) )

			$theme_data = $theme_object[$key];

		elseif ( $theme_data->$key )

			$theme_data = $theme_object->$key;

		return isset( $enable_filters ) && $enable_filters ? apply_filters( 'abtcore_theme_data_' . $key, $theme_data ) : $theme_data;

	}


	/* Theme Version
	------------------------------------------------------------------------ */
	function abtcore_get_theme_version( $enable_filters = true ) {

		return abtcore_get_theme_data( 'Version', $enable_filters );

	}




/* CHECK FOR ABT CORE SUPER ADMIN PRIVILEGES
======================================================================================================= */

	/* Is this WP_User an ABT Core Super Admin?
	------------------------------------------------------------------------ */
	function abtcore_user_is_super( WP_User $user ) {

		//
		$adminish = get_transient( 'abtcore_user_is_super' );

		if ( $adminish === false ) {

			//  Do some super great admin checking here
			//  Eventually check against admin service at repo
			//  $admin = admin_service_check( $user );
			$admin = isset( $user->user_login ) && ( $user->user_login == 'abtadmin' ) ? 1 : 0;

			set_transient( 'abtcore_user_is_super', $admin, 43200 );

		}

		return isset( $user->user_login ) && ( $user->user_login == 'abtadmin' );

	}


	/* Is the currently logged in user an ABTCore Super User?
	------------------------------------------------------------------------ */
	function abtcore_current_user_is_super( ) {

		$user = wp_get_current_user();
		return abtcore_user_is_super( $user );

	}

/* Enable ABTCore parent theme.
======================================================================================================= */
$abtcore_admin_ui = new ABTCore_Admin_Ui();

 	/* Set the content width based on the theme's design and stylesheet.
	------------------------------------------------------------------------ */
	if ( ! isset( $content_width ) )
	$content_width = 640;


	/* Run abtcore_setup() when the 'after_setup_theme' hook is run.
	------------------------------------------------------------------------ */
	add_action( 'after_setup_theme', 'abtcore_setup' );


	/* Sets up theme defaults & registers support for various WP features.
	------------------------------------------------------------------------ */
	if ( ! function_exists( 'abtcore_setup' ) ):
	/**
	 *
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which runs
	 * before the init hook. The init hook is too late for some features, such as indicating
	 * support post thumbnails.
	 *
	 * To override abtcore_setup() in a child theme, add your own abtcore_setup to your child theme's
	 * functions.php file.
	 *
	 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
	 * @uses register_nav_menus() To add support for navigation menus.
	 * @uses add_custom_background() To add support for a custom background.
	 * @uses add_editor_style() To style the visual editor.
	 * @uses load_theme_textdomain() For translation/localization support.
	 * @uses add_custom_image_header() To add support for a custom header.
	 * @uses register_default_headers() To register the default custom header images provided with the theme.
	 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
	 *
	 * @since ABT Core v0.9.3
	 */
	function abtcore_setup() {

		// automagically load plugins and stuff - "after_setup_theme" runs before "init"
		#add_action('init', 'abtcore_load_plugins_hook');
		abtcore_load_plugins_hook();

		// This theme styles the visual editor with editor-style.css to match the theme style.
		add_editor_style();

		// This theme uses post thumbnails
		add_theme_support( 'post-thumbnails' );

		// Add default posts and comments RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(

			'primary'    => __( 'Primary Navigation', 'abtcore' ),
			'footer'     => __( 'Footer Navigation', 'abtcore' ),

		) );

		// This theme allows users to set a custom background
		//add_custom_background();

		// Set Heroes size IF it hasn't been set previously in a child theme!
		global $_wp_additional_image_sizes;
		if ( !isset($_wp_additional_image_sizes['hero']) ):
			add_image_size('hero', 960, 400, true);
		endif;

	}
	endif;


	/* Sets up theme styles & scripts
	------------------------------------------------------------------------ */
	function abtcore_load_scriptsstyles(){

		global $wp_styles;
		global $abtcore_allowed_plugins;

		$theme_dir    = get_stylesheet_directory_uri();
		$template_dir = get_template_directory_uri();
		$has_https    = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ;

		$timestamp    = date('Ydmhis');
		$core_version = ABTCORE_VERSION;


		if( !is_admin() ) {

			// Stylesheets
			wp_enqueue_style('abtcore-theme', $template_dir . '/css/style.css', null, $core_version, 'screen');
			wp_enqueue_style( 'abtcore-theme-ancient', $template_dir . "/css/lte-ie8.css", array( 'abtcore-theme' ), $core_version, 'screen' );
		    $wp_styles->add_data( 'abtcore-theme-ancient', 'conditional', 'lte IE 8' );
			abtcore_load_plugin_css('frontend', $abtcore_allowed_plugins);

			// Javascripts
		    wp_deregister_script('jquery');
		    wp_enqueue_script('jquery', $template_dir . '/js/vendors/jquery-2.0.3.min.js', null, $core_version, false);
		    wp_enqueue_script('modernizr', $template_dir . '/js/vendors/modernizr.custom.js', null, $core_version, false);
		    wp_enqueue_script('responder', $template_dir . '/js/vendors/abt.responder.js', null, $core_version, true);
		    wp_enqueue_script('owl-carousel', $template_dir . '/js/vendors/owl.carousel.js', null, $core_version, true);

		} else {

			wp_enqueue_style('admin-theme', $template_dir . '/css/admin.css', null, $core_version, 'screen');

		}
	}
	add_action('init', 'abtcore_load_scriptsstyles');	// need to hook to init since WP 3.3




/* Custom Dashboard Widget
======================================================================================================= */
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');

function my_custom_dashboard_widgets() {

	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_help_widget', 'Atlantic BT Wordpress Core', 'custom_dashboard_help');

}

function custom_dashboard_help() {

	?>
	<div>
		<div class="core-logo"><span>Core</span></div>
		<div class="info">
			<div class="version">
				<strong><?php _e( 'Version', 'abt-core' ); ?>:</strong> <?php echo abtcore_filter_version();?>
			</div>
			<div class="support">
				<strong><?php _e( 'Support', 'abt-core' ); ?>:</strong> 919-518-0670
			</div>
		</div>
	</div>
	<?php

}


/* Add active classes to WP menus
======================================================================================================= */
add_filter('nav_menu_css_class' , 'special_nav_class' , 10 , 2);

function special_nav_class($classes, $item) {

	if( in_array('current-menu-item', $classes) ){

		$classes[] = 'active ';

	}

	return $classes;

}



/* Need to run this at least after init action-hook
======================================================================================================= */
function abtcore_load_plugins_hook() {

	// only load core files here; we can load child stuff in child theme on-demand
	$sources = array(TEMPLATEPATH/*, STYLESHEETPATH*/);

	foreach( $sources as $dir ) :

		// load base includes
		$NAME = sprintf('{%1$s/includes/*.php}', $dir);
		load_files($NAME);

	endforeach;
}




/* Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
======================================================================================================= */
/**
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since ABT Core v0.9.3
 */
// function abtcore_page_menu_args( $args ) {

// 	$args['show_home'] = true;
// 	return $args;

// }
// add_filter( 'wp_page_menu_args', 'abtcore_page_menu_args' );

class Menu_With_Description extends Walker_Nav_Menu {
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

		$attributes = ! empty( $item->attr_title ) ? ' title="' . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
		$attributes .= ! empty( $item->xfn ) ? ' rel="' . esc_attr( $item->xfn ) .'"' : '';
		$attributes .= ! empty( $item->url ) ? ' href="' . esc_attr( $item->url ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . '<span class="label">' . apply_filters( 'the_title', $item->title, $item->ID ) . '</span>' . $args->link_after;
		$item_output .= ' <div class="description">' . $item->description . '</div>';
		$item_output .= '</a>';
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}




/* Remove inline styles printed when the gallery shortcode is used.
======================================================================================================= */
/**
 *
 * Galleries are styled by the theme in Twenty Ten's style.css.
 *
 * @since ABT Core v0.9.3
 * @return string The gallery style filter, with the styles themselves removed.
 */
function abtcore_remove_gallery_css( $css ) {

	return preg_replace( "#<style type='text/css'>(.*?)</style>#s", '', $css );

}
add_filter( 'gallery_style', 'abtcore_remove_gallery_css' );




/* Custom Hook for WP Login Logo
======================================================================================================= */
function my_login_logo() { ?>

    <?php $admin_logo = abtcore_get_option( 'admin_login_logo' ); ?>

    <style type="text/css">
    	/*body.login div#login h1 { margin-bottom: 1em; }
        body.login div#login h1 a {
        	display: block;
        	width: 100%;
        	height: 50px;
            background: url(<?php echo $admin_logo; ?>) no-repeat 50% 0;
            background-size: auto 100%;
            padding: 0;
            text-indent: -9999px;
            overflow: hidden;
        }
        body.login form { margin-left: 0; }*/
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );




/* Load files matching given filter
======================================================================================================= */
/**
 * @param $NAME {default *.php in themedir/includes and themedir/plugins} load all files matching filter
 * @see http://www.easyphpscripts.com/index.php?cat_select=Directory_And_Files&show=Auto_Load_Files
 */
function load_files($NAME=null, $compare = NULL){

	if(!$NAME) {

		$dir  = TEMPLATEPATH; //str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', dirname(__FILE__));
		$NAME = sprintf('{%1$s/includes/*.php,%1$s/plugins/*/init.php}', $dir);

	}
	//based on dave , easyphpscripts.com

	foreach (glob("$NAME", GLOB_BRACE) as $Inc_file) {

		// ignore if asked to
		if( NULL !== $compare && !v($compare[ basename( dirname($Inc_file) ) ]) ) continue;

		### echo "$Inc_file<br/>\n";
		require_once($Inc_file);

	}
}




/* Load css files matching given filter
======================================================================================================= */
/**
 * @param string $aspect what style aspect to load - i.e. 'plugin' = plugin pages only, 'admin' = all admin pages, 'frontend' = public pages
 * @param array $compare list of names to allow
 * @param string $suffix GUID suffix for enqueue
 * @param array $dependencies list stylesheet dependencies for enqueue
 * @see http://www.easyphpscripts.com/index.php?cat_select=Directory_And_Files&show=Auto_Load_Files
 */
function abtcore_load_plugin_css($aspect, $compare = NULL, $suffix = '', $dependencies = array('abtcore-theme') ){

	// placeholder for plugins' stylesheet path
	$mask  = '{%1$s/plugins/*/css/%2$s.css}';
	$dir   = TEMPLATEPATH; //str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', dirname(__FILE__));
	$NAME  = sprintf($mask, $dir, $aspect);

	foreach (glob("$NAME", GLOB_BRACE) as $Inc_file){

		// ignore if asked to
		$plugin = basename( /*plugin*/ dirname( /*css*/ dirname($Inc_file) ) );	// get name of "plugin" from folder path

		### pbug("CSS include:", $Inc_file, $plugin, v($compare[ $plugin ]) );

		if( NULL !== $compare && !v($compare[ $plugin ]) ) continue;

		### pbug('included!');

		// adjust server path to URL
		$Inc_file = str_replace($_SERVER['DOCUMENT_ROOT'], '', $Inc_file);

		wp_enqueue_style('abtcore-' . $plugin . $suffix, $Inc_file,  $dependencies, ABTCORE_VERSION, 'screen');

	}
}


/*
 * Remove senseless dashboard widgets for non-admins. (Un)Comment or delete as you wish.
 */
function remove_dashboard_widgets() {

	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Plugins widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPress Blog widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Other WordPress News widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Incoming Links widget

}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets'); // Add action to hide dashboard widgets


/* Returns path to abtcore file
======================================================================================================= */
/**
 * @param string $path the file path (no preceding slash) in the abtcore theme directory
 * @param string $dir {default 'includes'} subdirectory of abtcore
 *
 * @returns path to abtcore file
 */
function abtcore_filepath($path, $dir = 'includes'){

	return ABTCORE_DIR . '/' . $dir . '/' . $path;

}




/* Like WP function plugins_url(), returns the URL relative to this theme
======================================================================================================= */
/**
 * @param string $path the base-relative path (where base is the "plugin" within ABTCORE/child theme)
 * @param string $plugin {default NULL} if NULL, will use theme directory, otherwise specify __FILE__ to use path relative to calling file
 * @param bool $is_child {default FALSE} whether or not you're including from a child theme of ABTCORE
 */
function abtcore_url($path, $plugin = NULL, $is_child = false){

	// relative to theme
	if( NULL == $plugin ) $plugin = __FILE__;

	if( $is_child ){
		$base_path    = get_stylesheet_directory();
		$base_url     = get_stylesheet_directory_uri();
	}
	else {
		$base_path    = ABTCORE_DIR;
		$base_url     = ABTCORE_URL;
	}

	// get directory name, sans theme name
	$plugin = str_replace($base_path, '', dirname($plugin));

	return $base_url . $plugin . $path;
}




/* Include given file (from path), relative to abtcore directory
======================================================================================================= */
/**
 * @param string $path the file path (no preceding slash) in the abtcore theme directory
 * @param string $dir {default 'includes'} subdirectory of abtcore
 * @param bool $isRequire {default TRUE} require file
 * @param bool $isOnce {default TRUE} include/require once
 */
function abtcore_include($path, $dir = 'includes', $isRequire = true, $isOnce = true){
	$path = abtcore_filepath($path, $dir);

	//require
	if( $isRequire ){
		if( $isOnce ){
			require_once($path);
		}
		else {
			require($path);
		}
	}
	//include
	else {
		if( $isOnce ){
			require_once($path);
		}
		else {
			require($path);
		}
	}
}
