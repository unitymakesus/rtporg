<?php

/**
 * Placeholder for extension 'plugin' now as core.
 *
 * @since ABT Core v0.9.3
 */

include('custom-menus/init.php'); // Custom Menus which includes Nav Walker, Subheadings, Breadcrumbs, etc.
//include('paging/init.php'); // Better Paging.
include('which-widget/init.php'); // Choose which page(s) and/or post(s) widgets display on.
//include('types/types.php'); // Include Types embedded code base (Custom Post Types, Taxonomies, Custom Fields)

//add_filter( 'ot_show_pages', '__return_false' );
//add_filter( 'ot_theme_mode', '__return_true' );
//include ABTCORE_DIR. "/option-tree/ot-loader.php" ; // Include Option Tree