<?php
/*
Plugin Name: ABT MapBox Integration Plugin
Version: 2.0.0
Description: This plugin allows integration of MapBox locations with location post type
Author: John Foushee
Author URI: http://www.atlanticbt.com
Plugin URI:  http://www.atlanticbt.com
Text Domain: abt-mapbox
*/

// Deregister Post Type
// If mapbox data cpt exists, remove it from db
if ( ! function_exists( 'mapbox-data' ) ) :
// function unregister_post_type( $post_type ) {
//     global $wp_post_types;
//     if ( isset( $wp_post_types[ $post_type ] ) ) {
//         unset( $wp_post_types[ $post_type ] );
//         return true;
//     }
//     return false;
// }
endif;


// Shortcode for ABT Mapbox
// @usage: [abt-mapbox]
function shortcode_abt_mapbox() {
    require_once 'view/abt-mapbox.php';
}
add_shortcode( 'abt-mapbox', 'shortcode_abt_mapbox' );
