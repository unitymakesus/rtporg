<?php
/*
Plugin Name: ACF Local JSON plugin
Plugin URI:
Description: Put this file in a plugin folder and create an /acf directory inside the plugin, ie: /my-plugin/acf
*/

add_filter('acf/settings/save_json', function ($path) {
    return dirname(__FILE__) . '/acf-json';
});
add_filter('acf/settings/load_json', function ($paths) {
    unset($paths[0]);
    $paths[] = dirname(__FILE__) . '/acf-json';
    return $paths;
});
