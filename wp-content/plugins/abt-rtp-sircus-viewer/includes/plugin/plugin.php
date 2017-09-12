<?php

/**
 * @author brians
 *
 */
class ConfigurableViewerPlugin extends ConfigurableBaseObject
{
    /**
     *
     */
    const OPTION_KEY =  'sircus-viewer-options';

    const DOMAIN_QUERY_VAR_DEFAULT      = 'd';

    const DOMAIN_PAGE_QUERY_VAR_DEFAULT = 'dp';

    protected $_domain_query_var = self::DOMAIN_QUERY_VAR_DEFAULT;

    protected $_domain_page_query_var = self::DOMAIN_PAGE_QUERY_VAR_DEFAULT;

    /**
     * @var null
     */
    private static $_instance = null;

    /**
     * @var
     */
    protected $_feed;

    /**
     * @var AbtAjaxResponder
     */
    protected $_ajax_responder;

    /**
     * @var
     */
    protected $_menu;

    /**
     * @var WordPressLocalizableFactory
     */
    protected $_localizable_factory;

    /**
     * @param \WordPressLocalizableFactory $localizable_factory
     */
    public function setLocalizableFactory($localizable_factory)
    {
        $this->_localizable_factory = $localizable_factory;
    }

    /**
     * @return \WordPressLocalizableFactory
     */
    public function getLocalizableFactory()
    {
        return $this->_localizable_factory;
    }

    /**
     * @param mixed $menu
     */
    public function setMenu($menu)
    {
        $this->_menu = $menu;
    }

    /**
     * @return mixed
     */
    public function getMenu()
    {
        return $this->_menu;
    }

    /**
     * @param AbtAjaxResponder $ajaxHandler
     */
    public function setAjaxResponder(AbtAjaxResponder $ajaxResponder)
    {
        $this->_ajax_responder = $ajaxResponder;
    }

    /**
     * @return AbtAjaxResponder
     */
    public function getAjaxResponder()
    {
        return $this->_ajax_responder;
    }

    /**
     * @param mixed $feed
     */
    public function setFeed($feed)
    {
        $this->_feed = $feed;
    }

    /**
     * @return mixed
     */
    public function getFeed()
    {
        return $this->_feed;
    }

    /**
     * @return null|ConfigurableViewerPlugin
     */
    public static function get_instance()
    {
        if (!isset(self::$_instance)) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * @param string $domain_page_query_var
     */
    public function setDomainPageQueryVar($domain_page_query_var = self::DOMAIN_PAGE_QUERY_VAR_DEFAULT)
    {
        $this->_domain_page_query_var = $domain_page_query_var;
    }

    /**
     * @return string
     */
    public function getDomainPageQueryVar()
    {
        return $this->_domain_page_query_var;
    }

    /**
     * @param string $domain_query_var
     */
    public function setDomainQueryVar($domain_query_var = self::DOMAIN_QUERY_VAR_DEFAULT)
    {
        $this->_domain_query_var = $domain_query_var;
    }

    /**
     * @return string
     */
    public function getDomainQueryVar()
    {
        return $this->_domain_query_var;
    }

    /**
     *
     */
    public function initialize()
    {
        $menu          = $this->getMenu();
        $ajaxResponder = $this->getAjaxResponder();

        if ( is_admin() ){ // admin actions
            if ( isset( $menu ) ) {
                add_action('admin_menu', array( $menu, 'create_menu' ) );
            }

            if ( isset( $ajaxResponder ) ) {
                add_action( 'wp_ajax_sircus_action_get', array( $ajaxResponder, 'respond' ) );
                add_action( 'wp_ajax_nopriv_sircus_action_get', array( $ajaxResponder, 'respond' ) );
            }

            add_action( 'add_meta_boxes', array( $this, 'featured_banner_meta_box_add' ) );

            add_action( 'admin_enqueue_scripts', array( $this, 'include_scripts_styles_admin' ) );

        } else {

            add_action( 'wp_enqueue_scripts', array( $this, 'include_scripts_styles' ) );

            if ( isset( $ajaxResponder ) ) {
                add_action( 'wp_ajax_sircus_action_get', array( $ajaxResponder, 'respond' ) );
                add_action( 'wp_ajax_nopriv_sircus_action_get', array( $ajaxResponder, 'respond' ) );
            }
        }



        add_filter( 'query_vars', array( $this, 'add_query_vars_filter' ) );
    }


    // NEED THIS TO SPECIFY DOMAIN
    function add_query_vars_filter( $vars ) {
        // example url http://{domain}/?s=sample&d=social&dp=3
        // means page 3 of social items
        $vars[] = $this->getDomainQueryVar(); // Specifies domain
        $vars[] = $this->getDomainPageQueryVar(); // Specifies domain pagination
        return $vars;
    }

    /**
     * Add a button to the banners so that admins can set the featured banner id.
     */
    public function featured_banner_meta_box_add() {
        add_meta_box(
            'set-home-page-banner',
            __( 'Primary Home Page Banner', 'abt-rtp-sircus-viewer' ),
            array( $this, 'featured_banner_meta_box_cb' ),
            'banner',
            'side',
            'low'
        );
    }

    /**
     *
     */
    public function featured_banner_meta_box_cb() {
       echo '<div id="set-featured-banner"><button></button><p></p></div>';
    }

    /**
     * Register & enqueue basic scripts and styles that will be needed for all calculators.
     *
     */
    public function include_scripts_styles_admin()
    {
        wp_register_script(
            'abt-rtp-banner-lib',
            plugins_url( '/js/plugin/libs/wp/banner/banner.lib.js' ,SIRCUS_VIEWER_BASE ),
            array('jquery'),
            '0.1.0',
            false
        );

        wp_enqueue_script( 'abt-rtp-banner-lib' );

        wp_localize_script(
            'abt-rtp-banner-lib',
            'banner',
            array(
                'current'  => get_the_ID(),
                'featured' => $this->getConfigReader()->get_config( 'featured-banner' ),
                'labels'   => array(
                    'button'  => __( 'Set Primary Home Page Banner', 'abt-rtp-sircus-viewer' ),
                    'message' => __( 'This is the current banner.', 'abt-rtp-sircus-viewer' )
                )
            )
        );
    }
	
	/**
	 * Register & enqueue basic scripts and styles that will be needed for all calculators.
	 * 
	 */
	public function include_scripts_styles()
	{
        if (is_home() || is_front_page() || is_search()) {
            wp_register_script(
                'angular-js',
                plugins_url( '/js/plugin/angular/angular.min.js' ,SIRCUS_VIEWER_BASE ),
                null,
                '1.2.16',
                false
            );
            wp_enqueue_script( 'angular-js' );

            wp_enqueue_script('sircus_viewer_plugin_scripts', plugins_url('/js/sircus-viewer.js', SIRCUS_VIEWER_BASE), array('angular-js'), '1.0.0', true);



            // Localize the data, yo
            $sircusDataLocalizable = $this->getLocalizableFactory()->get_instance( 'sircus_data' );
            $sircusDataLocalizable->setConfigReader( $this->getConfigReader() );
            $sircusDataLocalizable->localize( 'sircus_viewer_plugin_scripts', 'sircus_data' );
        }
	}

    /**
     * @param $shortcode
     * @param $handler
     */
    public function addShortCodeHandler( $shortcode, $handler ) {
        add_shortcode( $shortcode, array( $handler, 'handle' ) );
    }

    /**
     *
     */
    private function __construct()
    {
        $this->_init();
    }

    /**
     *
     */
    private function _init()
    {

    }
}