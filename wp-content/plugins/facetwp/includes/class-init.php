<?php

class FacetWP_Init
{

    function __construct() {
        add_action( 'init', [ $this, 'init' ] );
    }


    /**
     * Initialize classes and WP hooks
     */
    function init() {

        // i18n
        $this->load_textdomain();

        // is_plugin_active
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        $includes = [
            'api/fetch',
            'api/refresh',
            'class-helper',
            'class-ajax',
            'class-renderer',
            'class-diff',
            'class-indexer',
            'class-display',
            'class-builder',
            'class-overrides',
            'class-settings-admin',
            'class-upgrade',
            'functions'
        ];

        foreach ( $includes as $inc ) {
            include ( FACETWP_DIR . "/includes/$inc.php" );
        }

        new FacetWP_Upgrade();
        new FacetWP_Overrides();
        new FacetWP_API_Fetch();

        FWP()->helper       = new FacetWP_Helper();
        FWP()->facet        = new FacetWP_Renderer();
        FWP()->diff         = new FacetWP_Diff();
        FWP()->indexer      = new FacetWP_Indexer();
        FWP()->display      = new FacetWP_Display();
        FWP()->builder      = new FacetWP_Builder();
        FWP()->ajax         = new FacetWP_Ajax();

        // integrations
        include( FACETWP_DIR . '/includes/integrations/searchwp/searchwp.php' );
        include( FACETWP_DIR . '/includes/integrations/woocommerce/woocommerce.php' );
        include( FACETWP_DIR . '/includes/integrations/edd/edd.php' );
        include( FACETWP_DIR . '/includes/integrations/acf/acf.php' );

        // update checks
        include( FACETWP_DIR . '/includes/class-updater.php' );

        if ( FWP()->helper->is_license_active() ) {
            include( FACETWP_DIR . '/includes/libraries/github-updater.php' );
        }

        // hooks
        add_action( 'admin_menu', [ $this, 'admin_menu' ] );
        add_action( 'wp_enqueue_scripts', [ $this, 'front_scripts' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'admin_scripts' ] );
        add_filter( 'redirect_canonical', [ $this, 'redirect_canonical' ], 10, 2 );
        add_filter( 'plugin_action_links_facetwp/index.php', [ $this, 'plugin_action_links' ] );
    }


    /**
     * i18n support
     */
    function load_textdomain() {

        // admin-facing
        load_plugin_textdomain( 'fwp' );

        // front-facing
        load_plugin_textdomain( 'fwp-front', false, basename( FACETWP_DIR ) . '/languages' );
    }


    /**
     * Register the FacetWP settings page
     */
    function admin_menu() {
        add_options_page( 'FacetWP', 'FacetWP', 'manage_options', 'facetwp', [ $this, 'settings_page' ] );
    }


    /**
     * Enqueue jQuery
     */
    function front_scripts() {
        wp_enqueue_script( 'jquery' );
    }


    /**
     * Enqueue admin tooltips
     */
    function admin_scripts( $hook ) {
        if ( 'settings_page_facetwp' == $hook ) {
            wp_enqueue_style( 'media-views' );
            wp_enqueue_script( 'jquery-powertip', FACETWP_URL . '/assets/vendor/jquery-powertip/jquery.powertip.min.js', [ 'jquery' ], '1.2.0' );
        }
    }


    /**
     * Route to the correct edit screen
     */
    function settings_page() {
        include( FACETWP_DIR . '/templates/page-settings.php' );
    }


    /**
     * Prevent WP from redirecting FWP pager to /page/X
     */
    function redirect_canonical( $redirect_url, $requested_url ) {
        if ( false !== strpos( $redirect_url, FWP()->helper->get_setting( 'prefix' ) . 'paged' ) ) {
            return false;
        }
        return $redirect_url;
    }


    /**
     * Add "Settings" link to plugin listing page
     */
    function plugin_action_links( $links ) {
        $settings_link = admin_url( 'options-general.php?page=facetwp' );
        $settings_link = '<a href=" ' . $settings_link . '">' . __( 'Settings', 'fwp' )  . '</a>';
        array_unshift( $links, $settings_link );
        return $links;
    }
}

$this->init = new FacetWP_Init();
