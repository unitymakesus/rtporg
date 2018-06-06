<?php
/**
 * Plugin Name: RTP Company Directory
 * Description: Adds all kinds of magical things
 * Version: 1.0.0
 * Author: Unity Digital Agency
 * Author URI: https://www.unitymakes.us/
 * Text Domain: rtp-dir
 * Domain Path: /languages/
 *
 * @package RTP_Dir
 * @author Unity Digital Agency
 */


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Returns the main instance of RTP_Dir to prevent the need to use globals.
 *
 * @since  1.0.0
 * @return object RTP_Dir
 */
function RTP_Dir() {
	return RTP_Dir::instance();
} // End RTP_Dir()
add_action( 'plugins_loaded', 'RTP_Dir' );


/**
 * Main RTP_Dir Class
 *
 * @class RTP_Dir
 * @version 1.0.0
 * @since 1.0.0
 * @package RTP_Dir
 */
final class RTP_Dir {
	/**
	 * RTP_Dir The single instance of RTP_Dir.
	 * @var 	object
	 * @access  private
	 * @since 	1.0.0
	 */
	private static $_instance = null;

	/**
	 * Set up variables
	 */
	public $token;
	public $version;
  public $plugin_name;
	public $plugin_url;
	public $plugin_path;
  public $nonce;

	// Admin Objects
	public $admin;
	public $settings;
  public $templates;

	// Custom Post Type/Taxonomy Arrays
	public $post_types = array();
  public $taxonomies = array();

	/**
	 * Constructor function.
	 * @access  public
	 * @since   1.0.0
	 */
	public function __construct () {
		$this->token 			  = 'rtp-dir';
    $this->plugin_name  = 'RTP Company Directory';
		$this->plugin_url 	= plugin_dir_url( __FILE__ );
		$this->plugin_path 	= plugin_dir_path( __FILE__ );
		$this->version 			= '1.0.0';
    $this->nonce        = wp_create_nonce( "{$this->token}_action" );

    // Add page templates
    require_once( 'classes/class-rtp-dir-templates.php' );
    $this->templates = RTP_Dir_Templates::instance();

    register_activation_hook( __FILE__, array( $this, 'install' ) );
    add_action( 'init', array( $this, 'load_plugin_textdomain' ) );
    add_action( 'init', array( $this, 'register_taxonomies' ) );
    add_action( 'admin_notices', array($this, 'require_plugins') );
    add_action( 'wp_enqueue_scripts', array($this, 'load_scripts_styles') );

    // Including functions to get post-type listings for PHP and AJAX
    require_once( 'classes/class-rtp-dir-listing.php' );
    add_action( 'wp_ajax_get_locations', array(new RTP_Dir_Listing, 'get_locations_json') );
    add_action( 'wp_ajax_nopriv_get_locations', array(new RTP_Dir_Listing, 'get_locations_json') );

		// Add custom facet sources
		require_once( 'classes/class-rtp-dir-facets.php' );
		$new_facet = new RTP_Dir_Facets;
		add_filter( 'facetwp_indexer_row_data', array($new_facet, 'index_row_data'), 100 , 2 );
		add_filter( 'facetwp_facet_sources', array($new_facet, 'custom_data_sources') );
		add_filter( 'facetwp_is_main_query', function( $is_main_query, $query ) {
	    if ( '' !== $query->get( 'facetwp' ) ) {
        $is_main_query = (bool) $query->get( 'facetwp' );
	    }
	    return $is_main_query;
		}, 10, 2 );
		add_filter( 'facetwp_render_output', function( $output, $params ) {
	    $output['settings']['post_ids'] = FWP()->facet->query_args['post__in'];
	    return $output;
		}, 10, 2 );

		// Custom Post Types/Taxonomies
		require_once( 'classes/class-rtp-dir-post-type.php' );
		require_once( 'classes/class-rtp-dir-taxonomy.php' );
		$this->post_types['rtp-facility'] = new RTP_Dir_Post_Type(
      'rtp-facility', __( 'Facility', 'rtp-dir' ), __( 'Facilities', 'rtp-dir' ),
      array(
        'menu_icon' => 'dashicons-building',
        'hierarchical' => false,
        'supports' => array(
          'title',
          'editor',
          'author',
          'revisions',
          'page-attributes',
          'thumbnail'
        ),
        'has_archive' => false,
        'show_in_rest' => true,
        'rest_base' => 'facilities',
        'rewrite' => array(
          'slug' => 'facility'
        )
      )
    );
		$this->post_types['rtp-company'] = new RTP_Dir_Post_Type(
      'rtp-company', __( 'Company', 'rtp-dir' ), __( 'Companies', 'rtp-dir' ),
      array(
        'menu_icon' => 'dashicons-store',
        'hierarchical' => false,
        'supports' => array(
          'title',
          'editor',
          'author',
          'revisions',
          'thumbnail'
        ),
        'has_archive' => false,
        'show_in_rest' => true,
        'rest_base' => 'companies',
        'rewrite' => array(
          'slug' => 'company'
        )
      )
    );
		$this->post_types['rtp-site'] = new RTP_Dir_Post_Type(
      'rtp-site', __( 'Site', 'rtp-dir' ), __( 'Sites', 'rtp-dir' ),
      array(
        'menu_icon' => 'dashicons-location-alt',
        'hierarchical' => false,
        'supports' => array(
          'title',
          'editor',
          'author',
          'revisions',
          'page-attributes',
          'thumbnail'
        ),
        'has_archive' => false,
        'show_in_rest' => true,
        'rest_base' => 'sites',
        'rewrite' => array(
          'slug' => 'site'
        ),
				'taxonomies' => array('rtp-availability')
      )
    );
		$this->post_types['rtp-space'] = new RTP_Dir_Post_Type(
      'rtp-space', __( 'Space', 'rtp-dir' ), __( 'Spaces', 'rtp-dir' ),
      array(
        'menu_icon' => 'dashicons-admin-network',
        'hierarchical' => false,
        'supports' => array(
          'title',
          'editor',
          'author',
          'revisions',
          'page-attributes',
          'thumbnail'
        ),
        'has_archive' => false,
        'show_in_rest' => true,
        'rest_base' => 'spaces',
        'rewrite' => array(
          'slug' => 'space'
        ),
				'taxonomies' => array('rtp-availability')
      )
    );
	}

	/**
	 * Main RTP_Dir Instance
	 *
	 * Ensures only one instance of RTP_Dir is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @static
	 * @see RTP_Dir()
	 * @return Main RTP_Dir instance
	 */
	public static function instance () {
		if ( is_null( self::$_instance ) )
			self::$_instance = new self();
		return self::$_instance;
	}

  /**
   * Enqeueue plugin scripts and styles on front end.
   * @access  public
   * @since   1.0.0
   */
  public function load_scripts_styles() {
    if (is_page_template('templates/page-directory.php')) {

      // Enqueue scripts
      wp_enqueue_script( 'mapbox-script', 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js', array(), null, true );
      wp_enqueue_script( 'rtp-dir-script', $this->plugin_url . 'scripts/map-script.js', array('mapbox-script'), '1.0.0', true );

      // Enqueue styles
      wp_enqueue_style( 'mapbox-style', 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css', null, false);
      wp_enqueue_style( 'rtp-dir-style', $this->plugin_url . 'css/style.css', null, '1.0.0');

      // Set up FacetWP API
      wp_localize_script('rtp-dir-script', 'rtp_dir_vars', array(
        'facetapi_uri'  		=> get_home_url() . '/wp-json/facetwp/v1/fetch',
        'ajax_uri'      		=> admin_url('admin-ajax.php'),
        '_ajax_nonce'   		=> $this->nonce,
				'marker_company'		=> $this->plugin_url . 'images/icon-company-3d@2x.png',
				'marker_recreation'	=> $this->plugin_url . 'images/icon-recreation-3d@2x.png',
				'marker_realestate'	=> $this->plugin_url . 'images/icon-realestate-3d@2x.png'
      ));
    }

		if (is_singular('rtp-company')) {

			// Enqueue scripts
			wp_enqueue_script( 'mapbox-script', 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.js', array(), null, true );
			wp_enqueue_script( 'rtp-dir-company-script', $this->plugin_url . 'scripts/company-script.js', array('mapbox-script'), '1.0.0', true );

			// Enqueue styles
			wp_enqueue_style( 'mapbox-style', 'https://api.tiles.mapbox.com/mapbox-gl-js/v0.45.0/mapbox-gl.css', null, false);
			wp_enqueue_style( 'rtp-dir-style', $this->plugin_url . 'css/style.css', null, '1.0.0');

			// Set up FacetWP API
			// wp_localize_script('rtp-dir-script', 'rtp_dir_vars', array(
			// 	'facetapi_uri'  		=> get_home_url() . '/wp-json/facetwp/v1/fetch',
			// 	'ajax_uri'      		=> admin_url('admin-ajax.php'),
			// 	'_ajax_nonce'   		=> $this->nonce,
			// 	'marker_company'		=> $this->plugin_url . 'images/icon-company-3d@2x.png',
			// 	'marker_recreation'	=> $this->plugin_url . 'images/icon-recreation-3d@2x.png',
			// 	'marker_realestate'	=> $this->plugin_url . 'images/icon-realestate-3d@2x.png'
			// ));
		}
  }

	/**
	 * Register the defined custom taxonomies
	 * @access  public
	 * @since   1.0.0
	 */
	public function register_taxonomies() {
    $this->taxonomies['rtp-facility-type'] = new RTP_Dir_Taxonomy(
      'rtp-facility', 'rtp-facility-type', 'Facility Type', 'Facility Types',
      array( 'rewrite' => array('slug' => 'facility-type') )
    );
    $this->taxonomies['rtp-company-type'] = new RTP_Dir_Taxonomy(
      'rtp-company', 'rtp-company-type', 'Company Type', 'Company Types',
      array( 'rewrite' => array('slug' => 'company-type') )
    );
    $this->taxonomies['rtp-availability'] = new RTP_Dir_Taxonomy(
      'rtp-site', 'rtp-availability', 'Availability', 'Availabilities',
      array( 'rewrite' => array('slug' => 'availability') )
    );

		foreach ($this->taxonomies as $tax) {
      $tax->register();
    }
	}

  /**
   * Required plugins
   */
  public function require_plugins() {
    $requireds = array();

  	if ( !is_plugin_active('advanced-custom-fields-pro/acf.php') ) {
      $requireds[] = array(
        'link' => 'https://www.advancedcustomfields.com/pro/',
        'name' => 'Advanced Custom Fields PRO'
      );
    }

    if ( !is_plugin_active('facetwp/index.php') ) {
      $requireds[] = array(
        'link' => 'https://facetwp.com/',
        'name' => 'FacetWP'
      );
    }

    if ( !empty($requireds) ) {
      foreach ($requireds as $req) {
    		?>
    		<div class="notice notice-error"><p>
    			<?php printf(
    				__('<b>%s Plugin</b>: <a target="_blank" href="%s">%s</a> must be installed and activated.', 'rtp-dir'),
    	      $this->plugin_name,
            $req['link'],
            $req['name']
    			); ?>
    		</p></div>
    		<?php
      }
      deactivate_plugins( plugin_basename( __FILE__ ) );
    }
  }

  /**
   * Turn on WP API for FacetWP
   */
   private function api_check_permissions() {
     return current_user_can( 'manage_options' );
   }

	/**
	 * Load the localisation file.
	 * @access  public
	 * @since   1.0.0
	 */
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'rtp-dir', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Cloning is forbidden.
	 * @access public
	 * @since 1.0.0
	 */
	public function __clone () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 * @access public
	 * @since 1.0.0
	 */
	public function __wakeup () {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?' ), '1.0.0' );
	}

	/**
	 * Installation. Runs on activation.
	 * @access  public
	 * @since   1.0.0
	 */
	public function install () {
		$this->_log_version_number();
	}

	/**
	 * Log the plugin version number.
	 * @access  private
	 * @since   1.0.0
	 */
	private function _log_version_number () {
		// Log the version number.
		update_option( $this->token . '-version', $this->version );
	}

}