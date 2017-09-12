<?php

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override abtcore_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since ABT Core v0.9.3
 * @uses register_sidebar
 */
function abtcore_widgets_init() {

	$allowed_sidebars = array(
		'pages-widget-area' => array('name'=>'Pages Widget Area', 'description'=>'Pages widget area')
		, 'posts-widget-area' => array('name'=>'Post Widget Area', 'description'=>'Posts/Blog widget area')
	);

	$allowed_sidebars = apply_filters('abtcore-sidebars', $allowed_sidebars);

	foreach($allowed_sidebars as $sidebar_id => $sidebar){
		register_sidebar( array(
			'name' => __( $sidebar['name'], 'abtcore' ),
			'id' => $sidebar_id,
			'description' => __( $sidebar['description'], 'abtcore' ),
			'before_widget' => '<div id="%1$s" class="panel %2$s">',
			'after_widget' => '</div></div>',
			'before_title' => '<div class="panel-heading"><h2 class="panel-title">',
			'after_title' => '</h2></div><div class="panel-content">',
		) );
	}

}
/** Register sidebars by running abtcore_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'abtcore_widgets_init' );

?>