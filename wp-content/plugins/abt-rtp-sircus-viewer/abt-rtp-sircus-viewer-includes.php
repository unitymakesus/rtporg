<?php

require_once( 'abt-rtp-sircus-viewer-constants.php' );

// BASE CLASSY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/configurable-base-object.php' );

// BASE CLASSY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/configurable-base-object.php' );

// PLUGINNY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/admin/wordpress-sircus-viewer-menu.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/plugin.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/plugin-factory.php' );

// Localization
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/lib/localization/wordpress-localizable.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/lib/localization/wordpress-localizable-factory.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/lib/localization/sircus-data-localizable.php' );

// CONFIGGY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/config/abt-config-object.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/config/reader/abt-config-reader.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/config/reader/wordpress/wordpress-option-config-reader.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/config/writer/abt-config-writer.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/config/writer/wordpress/wordpress-option-config-writer.php' );

// REQUESTY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/request/abt-feed-request.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/request/api/sircus-api-request.php' );

/* WHILE IN DEVELOPMENT, USING THE MOCK REQUEST UNTIL API IS READY */
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/request/api/sircus-mock-request.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/request/cache/wp/wp-sircus-cache-request.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/request/banner/wp/wp-sircus-banner-request.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/request/parser/abt-request-parser.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/request/parser/json/sircus-json-request-parser.php' );

// SIRCUSSY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/feed/abt-feed-handler.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/feed/abt-feed-parser.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/feed/abt-feed-renderer.php' );

// AJAXY STUFF
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/ajax/handler/abt-ajax-handler.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'core/ajax/responder/abt-ajax-responder.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/ajax/handler/sircus-feed-ajax-handler.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/ajax/handler/sircus-featured-banner-ajax-handler.php' );

// Shawtcodes
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/shortcode/wordpress-shortcode-handler.php' );
require_once( SIRCUS_VIEWER_PATH_INCLUDES . 'plugin/shortcode/wordpress-sircus-shortcode-handler-main.php' );

// Get plugin
/* @var $sircusViewerPlugin ConfigurableViewerPlugin $sircusViewerPlugin */
//$sircusViewerPlugin = SircusViewerPluginFactory::getPlugin();

// Initialize Plugin
//$sircusViewerPlugin->initialize();