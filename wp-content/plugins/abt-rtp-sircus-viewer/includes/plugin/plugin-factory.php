<?php
/**
 * Created by JetBrains PhpStorm.
 * User: brians
 * Date: 6/4/14
 * Time: 1:06 PM
 * To change this template use File | Settings | File Templates.
 */
class SircusViewerPluginFactory
{
    /**
     * @param array $args
     * @return null|ConfigurableViewerPlugin
     */
    public static function getPlugin( $release = 'beta', $args = array() )
    {
        switch( $release ) {
            case 'alpha':
                return self::_alpha( $args );
                break;
            case 'beta':
                return self::_beta( $args );
                break;
            default:
                return self::_release( $args );
        }

    }

    /**
     * @param array $args
     * @return null|ConfigurableViewerPlugin
     */
    private static function _alpha( $args = array() )
    {
        /*
         * INSTANTIATION BEGINS
         */
        // Reader/Writer Config
        $configReader = new WordPressOptionConfigReader();
        $configWriter = new WordPressOptionConfigWriter();

        // Requests (cache, api)
        $sircusCacheRequest  = new WordPressAbtFeedCacheRequest();
        $sircusMockRequest   = new SircusFeedMockRequest();

        // Localization
        $sircusLocalizableFactory = new WordPressLocalizableFactory();


        // Ajax Handler
        $sircusListAjaxHandler = new SircusFeedAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();


        // Feed
        $sircusListFeed         = new AbtFeedHandler();
        $sircusListFeedParser   = new AbtFeedParser();
        $sircusListFeedRenderer = new AbtFeedRenderer();

        // Plugin
        $sircusMenu   = new WordPressSircusViewerMenu();
        $sircusPlugin = ConfigurableViewerPlugin::get_instance();

        /*
         * SET-UP BEGINS
         *
         */

        // Setup Localization
        $sircusLocalizableFactory->register( 'sircus_data', 'SircusDataLocalizable' );

        // Setup Data Requests
        $sircusCacheRequest->setEnabled( $configReader->get_config( 'sircus_cache_enabled' ) );
        $sircusCacheRequest->setCacheLifetime( $configReader->get_config( 'sircus_cache_lifetime' ) );
        $sircusCacheRequest->setRequest( $sircusMockRequest );
        $sircusListFeed->setRequest( $sircusCacheRequest );

        // Setup Ajaxy stuff
        $sircusListAjaxHandler->setFeed( $sircusListFeed );
        $sircusAjaxResponder->add_handler( 'list', $sircusListAjaxHandler );

        // Setup Shawtcode Handlers
        $sircusMainShortcodeHandler = new WordPressShortCodeHandlerMain();

        // Setup Plugin
        $sircusPlugin->setConfigReader( $configReader );
        $sircusPlugin->setConfigWriter( $configWriter );
        $sircusPlugin->setFeed( $sircusListFeed );
        $sircusPlugin->setAjaxResponder( $sircusAjaxResponder );
        $sircusPlugin->setMenu( $sircusMenu );
        $sircusPlugin->setLocalizableFactory( $sircusLocalizableFactory );
        $sircusPlugin->addShortCodeHandler( 'sircus-viewer', $sircusMainShortcodeHandler );

        return $sircusPlugin;
    }

    /**
     * NOT READY -- AVOID USING UNTIL FINISHED
     *
     * @param array $args
     */
    private static function _beta( $args = array() )
    {
        // TODO: Implement to support beta phase
        /*
        * INSTANTIATION BEGINS
        */
        // Reader/Writer Config
        $configReader = new WordPressOptionConfigReader();
        $configWriter = new WordPressOptionConfigWriter();

        // Requests (cache, api)
        $sircusCacheRequest  = new WordPressAbtFeedCacheRequest();
        //$sircusMockRequest   = new SircusFeedMockRequest();
        $sircusBannerRequest = new WordPressAbtFeedBannerRequest();
        $sircusApiRequest    = new SircusFeedApiRequest();

        // Localization
        $sircusLocalizableFactory = new WordPressLocalizableFactory();


        // Ajax Handler
        $sircusListAjaxHandler           = new SircusFeedAjaxHandler();
        $sircusFeaturedBannerAjaxHandler = new SircusFeaturedBannerAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();


        // Feed
        $sircusListFeed         = new AbtFeedHandler();
        $sircusListFeedParser   = new AbtFeedParser();
        $sircusListFeedRenderer = new AbtFeedRenderer();

        // Plugin
        $sircusMenu   = new WordPressSircusViewerMenu();
        $sircusPlugin = ConfigurableViewerPlugin::get_instance();

        /*
         * SET-UP BEGINS
         *
         */

        // Setup Localization
        $sircusLocalizableFactory->register( 'sircus_data', 'SircusDataLocalizable' );

        // Setup Data Requests
        $sircusApiRequest->setUri( $configReader->get_config( 'sircus_endpoint_list' ) );

        // Inject Banners
        $sircusBannerRequest->setRequest( $sircusApiRequest );
        $sircusBannerRequest->setFeaturedBannerId( $configReader->get_config( 'featured-banner' ) );

        // Inject & setup caching
        $sircusCacheRequest->setEnabled( $configReader->get_config( 'sircus_cache_enabled' ) );
        $sircusCacheRequest->setCacheLifetime( $configReader->get_config( 'sircus_cache_lifetime' ) );
        $sircusCacheRequest->setRequest( $sircusBannerRequest );
        //$sircusCacheRequest->setRequest( $sircusApiRequest  );
        $sircusListFeed->setRequest( $sircusCacheRequest );

        // Setup Ajaxy stuff
        $sircusListAjaxHandler->setFeed( $sircusListFeed );
        $sircusAjaxResponder->add_handler( 'list', $sircusListAjaxHandler );
        $sircusAjaxResponder->add_handler( 'search', $sircusListAjaxHandler );
        $sircusAjaxResponder->add_handler( 'banner', $sircusFeaturedBannerAjaxHandler );
        $sircusFeaturedBannerAjaxHandler->setConfigWriter( $configWriter );

        // Setup Shawtcode Handlers
        $sircusMainShortcodeHandler = new WordPressShortCodeHandlerMain();

        // Setup Plugin
        $sircusPlugin->setConfigReader( $configReader );
        $sircusPlugin->setConfigWriter( $configWriter );
        $sircusPlugin->setFeed( $sircusListFeed );
        $sircusPlugin->setAjaxResponder( $sircusAjaxResponder );
        $sircusPlugin->setMenu( $sircusMenu );
        $sircusPlugin->setLocalizableFactory( $sircusLocalizableFactory );
        $sircusPlugin->addShortCodeHandler( 'sircus-viewer', $sircusMainShortcodeHandler );

        return $sircusPlugin;
    }

    /**
     *  NOT READY -- AVOID USING UNTIL FINISHED
     *
     * @param array $args
     */
    private static function _release( $args = array() )
    {
        // TODO: Implement to support release phase
        /*
        * INSTANTIATION BEGINS
        */
        // Reader/Writer Config
        $configReader = new WordPressOptionConfigReader();
        $configWriter = new WordPressOptionConfigWriter();

        // Requests (cache, api)
        $sircusCacheRequest  = new WordPressAbtFeedCacheRequest();
        $sircusMockRequest   = new SircusFeedMockRequest();

        // Localization
        $sircusLocalizableFactory = new WordPressLocalizableFactory();


        // Ajax Handler
        $sircusListAjaxHandler = new SircusFeedAjaxHandler();

        // Ajax Responder
        $sircusAjaxResponder = new AbtAjaxResponder();


        // Feed
        $sircusListFeed         = new AbtFeedHandler();
        $sircusListFeedParser   = new AbtFeedParser();
        $sircusListFeedRenderer = new AbtFeedRenderer();

        // Plugin
        $sircusMenu   = new WordPressSircusViewerMenu();
        $sircusPlugin = ConfigurableViewerPlugin::get_instance();

        /*
         * SET-UP BEGINS
         *
         */

        // Setup Localization
        $sircusLocalizableFactory->register( 'sircus_data', 'SircusDataLocalizable' );

        // Setup Data Requests
        $sircusCacheRequest->setEnabled( $configReader->get_config( 'sircus_cache_enabled' ) );
        $sircusCacheRequest->setCacheLifetime( $configReader->get_config( 'sircus_cache_lifetime' ) );
        $sircusCacheRequest->setRequest( $sircusMockRequest );
        $sircusListFeed->setRequest( $sircusCacheRequest );

        // Setup Ajaxy stuff
        $sircusListAjaxHandler->setFeed( $sircusListFeed );
        $sircusAjaxResponder->add_handler( 'list', $sircusListAjaxHandler );


        // Setup Shawtcode Handlers
        $sircusMainShortcodeHandler = new WordPressShortCodeHandlerMain();

        // Setup Plugin
        $sircusPlugin->setConfigReader( $configReader );
        $sircusPlugin->setConfigWriter( $configWriter );
        $sircusPlugin->setFeed( $sircusListFeed );
        $sircusPlugin->setAjaxResponder( $sircusAjaxResponder );
        $sircusPlugin->setMenu( $sircusMenu );
        $sircusPlugin->setLocalizableFactory( $sircusLocalizableFactory );
        $sircusPlugin->addShortCodeHandler( 'sircus-viewer', $sircusMainShortcodeHandler );

        return $sircusPlugin;
    }
}