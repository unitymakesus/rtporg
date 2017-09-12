<?php
/*
Plugin Name: RTP SIRCUS Viewer
Version: 1.14.7.2.10-beta
Description: This plugin provides functionality to support WordPress
theme integration for the Rtp.org SIRCUS social curation feed.
Author: Brian Shirey
Author URI: http://www.atlanticbt.com
Plugin URI:  http://www.atlanticbt.com
Text Domain: abt-rtp-sircus-viewer
Domain Path: /languages
*/

// BASE CLASSY STUFF
require_once( 'abt-rtp-sircus-viewer-includes.php' );

// Get Plugin Instance
/* @var $sircusViewerPlugin ConfigurableViewerPlugin $sircusViewerPlugin */
$sircusViewerPlugin = SircusViewerPluginFactory::getPlugin( 'beta', array() );

// Initialize Plugin, Right Here, Right Now
$sircusViewerPlugin->initialize();