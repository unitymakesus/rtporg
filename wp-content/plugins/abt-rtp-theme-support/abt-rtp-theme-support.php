<?php
/*
Plugin Name: ABT RTP Theme Support
Version: 1.14.7.7.15-beta
Description: This plugin provides functionality to support WordPress
theme integration for Rtp.org.
Author: Brian Shirey
Author URI: http://www.atlanticbt.com
Plugin URI:  http://www.atlanticbt.com
Text Domain: abt-rtp-theme-support
Domain Path: /languages
*/

define( 'ABT_RTP_THEME_SUPPORT_BASE',  __FILE__ );

include_once( 'lib/abt-rtp-theme-support.php' );

$abtRtpThemeSupport = new AbtRtpThemeSupport();

// Initialize Plugin, Right Here, Right Now
$abtRtpThemeSupport->initialize();