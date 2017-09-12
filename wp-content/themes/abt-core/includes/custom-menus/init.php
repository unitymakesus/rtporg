<?php
/**
Plugin Name: ABT Custom Menus
Plugin URI: http://www.atlanticbt.com
Description: Provides ABT Core with multiple levels of custom menu options--extending WP's menus. Use 'walker' => new ABT_Custom_Walker_Nav_Menu() in wp_nav_menu call.
Version: 0.9
Author: Mark Caron and JRS
Author URI: http://www.atlanticbt.com

    Copyright 2011 Atlantic BT

*/


//add_action( 'wp_print_styles', 'custom_menus_wp_head'  );

//function custom_menus_wp_head() {
//	wp_enqueue_style('abtcore-custom-menus', abtcore_url('/css/plugin.custom-menus.css', __FILE__), null, '.9', 'screen');
//}

include('extends/nav-menus-properties.php'); // provides has-children class to wp_nav_menu and subheadings in navigation, e.g., Services/What We Do.
include('extends/breadcrumbs.php');	// adds abtcore_the_breadcrumb() function for use in templates.
include('extends/sub-menus.php');	// adds sub menu control utilizing WP's menus. Gets rid of clumsy heirarchy-type nav.
include('extends/main-menus.php');	// adds sub menu control utilizing WP's menus. Gets rid of clumsy heirarchy-type nav.
?>