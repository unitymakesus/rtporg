<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/3/14
 * Time: 10:45 AM
 * To change this template use File | Settings | File Templates.
 */
class WordPressSircusViewerMenu
{
    /**
     * This is the option group we'll use
     */
    const OPTION_GROUP       = 'sircus-viewer-option-group';
    const OPTION_GROUP_CACHE = 'sircus-viewer-option-group-cache';
    const OPTION_GROUP_API   = 'sircus-viewer-option-group-api';
    const OPTION_GROUP_TAG   = 'sircus-viewer-option-group-tag';

    /**
     * This handles adding the menu to wordpress
     */
    public function create_menu()
    {
        //create new top-level menu
        add_menu_page(
            __( 'SIRCUS Viewer', SIRCUS_VIEWER_TEXT_DOMAIN),
            __( 'SIRCUS Viewer', SIRCUS_VIEWER_TEXT_DOMAIN),
            'administrator',
            'abt-sircus-viewer',
            array( $this, 'tags_page' ),
            plugins_url( '/images/icon.png', SIRCUS_VIEWER_BASE )
        );

        add_submenu_page(
            'abt-sircus-viewer',
            __( 'Cache', SIRCUS_VIEWER_TEXT_DOMAIN),
            __( 'Cache', SIRCUS_VIEWER_TEXT_DOMAIN),
            'administrator',
            'abt-sircus-viewer-cache',
            array($this, 'cache_page')
        );

        add_submenu_page(
            'abt-sircus-viewer',
            __( 'Configuration', SIRCUS_VIEWER_TEXT_DOMAIN),
            __( 'Configuration', SIRCUS_VIEWER_TEXT_DOMAIN),
            'administrator',
            'abt-sircus-viewer-configuration',
            array($this, 'configuration_page')
        );

        //call register settings function
        add_action( 'admin_init', array( $this, 'register_settings' ) );
    }

    /**
     * Registers settings and value validation handlers
     */
    public function register_settings()
    { // whitelist options
        register_setting( self::OPTION_GROUP_CACHE, 'sircus_cache_enabled', 'intval' );
        register_setting( self::OPTION_GROUP_CACHE, 'sircus_cache_lifetime', 'intval' );
        register_setting( self::OPTION_GROUP_API, 'sircus_endpoint_list' );
        register_setting( self::OPTION_GROUP_API, 'sircus_endpoint_items' );
        register_setting( self::OPTION_GROUP_API, 'sircus_api_key' );
        register_setting( self::OPTION_GROUP_TAG, 'sircus_tag_list' );
    }

    /**
     * Renders the settings template
     */
    public function settings_page()
    {
        include_once(SIRCUS_VIEWER_PATH_TEMPLATE . 'plugin/admin/settings.php');
    }

    /**
     * Renders the settings template
     */
    public function tags_page()
    {
        include_once(SIRCUS_VIEWER_PATH_TEMPLATE . 'plugin/admin/tags.php');
    }

    /**
     * Renders the settings template
     */
    public function cache_page()
    {
        include_once(SIRCUS_VIEWER_PATH_TEMPLATE . 'plugin/admin/cache.php');
    }

    /**
     * Renders the settings template
     */
    public function configuration_page()
    {
        include_once(SIRCUS_VIEWER_PATH_TEMPLATE . 'plugin/admin/configuration.php');
    }
}