<?php
/**
 ******************************
 *      CHILD THEME           *
 ******************************
 *
 * ABT Core (child) functions and definitions - customized for abtcorecustom
 * Change/delete/add methods of theme class - must have functions __construct and init
 *
 *
 * This file will COMPLEMENT the parent theme's
 * `functions.php` file -- as in, anything here
 * is basically APPENDED to (does not overwrite)
 * the parent file.
 *
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

// In theory, disables 404 on search if page # doesn't exist
// ex: 3 pages of results, page 4 by default would 404
function my_override_404() {
    // Conditions required for overriding 404
    if ( get_query_var('s') != '') {
        global $wp_query;
        $wp_query->is_404   = false;
        $wp_query->is_paged = false;
    } else {

    }
}
add_action('pre_get_posts', 'my_override_404');
/**
 * Get the filter list for search page.
 *
 * @return array
 */
function get_rtp_search_filter_list()
{
    // Filters as key (class) => Pretty display name key/value pairs in array
    return
        array(
            'domain-local'  => get_bloginfo( 'name' ),
            'domain-social' => __( 'Social Media', 'abt-core-custom' )
        );
}
/**
 * Function to fix problem where next/previous buttons are broken on list
 * of posts in a category when the custom permalink string is:
 * /%category%/%year%/%monthnum%/%postname%/
 * The problem is that with a url like this:
 *
 * /category/2007/10/page/2
 *
 * the 'page' looks like a post name, not the keyword "page"
 */
function remove_page_from_query_string($query_string)
{
	if ( isset( $query_string["name"] ) && $query_string["name"] == 'page' && isset( $query_string["page"] ) ) {
		//$type = $query_string["post_type"];

		//unset($query_string[$type]);
		// 'page' in the query_string looks like '/2', so split it out
		list($delim, $page_index) = split('/', $query_string["page"]);
		$query_string["paged"] = $page_index;

		$query_string["pagename"] = $query_string["post_type"];

		unset( $query_string["page"] );
		unset( $query_string["post_type"] );
		unset( $query_string["name"] );
	}

	return $query_string;
}

add_filter('request', 'remove_page_from_query_string', 10, 1);

//call new overridden post widget
## include_once('includes/widgets.php');

/* Wrapper for Theme Functions
======================================================================================================= */
class abt_core_custom_theme {

	/* Hook Actions - Call Internal Functions, etc
	------------------------------------------------------------------------ */
	public function __construct(){

		add_filter( 'request', array(&$this, 'alter_query_for_portfolio') );	//
		add_filter( 'excerpt_length', array(&$this, 'excerpt_length'), 12 );	// later priority to override snapsite hook
		add_filter( 'excerpt_more', array(&$this, 'excerpt_more'), 11 );		// Override snapsite excerpt more - hook with lower priority, so it runs later

		$this->start();

	}


	/* Main settings and stuff that gets set immediately
	------------------------------------------------------------------------ */
	public function start(){

		// Include eponymous functions, like update check
		require_once( basename( dirname( __FILE__ ) ) . '.php' );

		// Custom Thumbnail Sizes
		set_post_thumbnail_size( 640, 280, true );

		add_image_size('people-thumb', 200, 200, false);
		add_image_size('location-thumb', 280, 210, false);

		add_action('init', array(&$this, 'init'));
		add_action('after_setup_theme', array(&$this, 'after_setup'), 50);
		add_action('wp_enqueue_scripts', array( &$this, 'my_scripts_enqueue' ) );

		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
	}

	public function my_scripts_enqueue() {

		$theme_dir    = get_stylesheet_directory_uri();
		$parent_dir   = get_theme_root();
		$has_https    = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ;

		$timestamp    = date('Ydmhis');
		$core_version = ABTCORE_VERSION;

		// Only for Theme Area
		if( ! is_admin() ) {

			global $wp_styles;
			$time = time();

			// Child Theme Stylesheets
			wp_deregister_style('abtcore-theme');
			wp_deregister_style('abtcore-theme-ancient');
			wp_enqueue_style('abtcore-child-theme', $theme_dir . '/css/style.css', null, $core_version . $time, 'screen');
			wp_enqueue_style('abtcore-child-print', $theme_dir . '/css/print.css', null, $core_version . $time, 'print');

			// Child Theme Scripts
			wp_deregister_script('owl-carousel');

			// Global Scripts
			wp_enqueue_script('site_scripts', $theme_dir . '/js/scripts.min.js', array('jquery'), $core_version, true );

			// Per Page/Template Scripts
			if (is_home() || is_front_page()) {
                wp_deregister_script('site_scripts');
                wp_enqueue_script('tween_max', $theme_dir . '/js/TweenMax.min.js', array('jquery'), '1.19.0', true );
				wp_enqueue_script('scroll_magic', $theme_dir . '/js/ScrollMagic.min.js', array('jquery'), '2.0.5', true );
				wp_enqueue_script('gsap', $theme_dir . '/js/animation.gsap.min.js', array('jquery'), '2.0.5', true );
				wp_enqueue_script('headroom', $theme_dir . '/js/headroom.min.js', array('jquery'), '0.9.3', true );
				wp_enqueue_script('magnific_popup', $theme_dir . '/js/vendors/jquery.magnific-popup.js', array('jquery'), '0.9.9', true );
				wp_enqueue_script('page_home_scripts', $theme_dir . '/js/page-home.min.js', array('jquery'), $core_version, true );
			}
			if (is_page('About Us') || is_page('Our Mission') || is_page('Why RTP') || is_page_template('page-full-background.php') || is_page_template('page-one-column-animation.php')) {
				wp_enqueue_script('page_infographics_scripts', $theme_dir . '/js/page-infographics.min.js', array('jquery'), $core_version, true );
			}
			if (is_page('Board of Directors') || is_page('Staff')) {
				wp_enqueue_script('page_people_scripts', $theme_dir . '/js/page-people.min.js', array('jquery'), $core_version, true );
			}


			if (is_page_template('page-frontier.php') || is_page_template('page-frontier-about.php') || is_page_template('page-frontier-collaborate.php') || is_page_template('page-frontier-innovate.php') || is_page_template('page-frontier-companies.php')) {
			//wp_enqueue_script('page_frontier_scripts', $theme_dir . '/js/page-frontier.js', array('jquery'), $core_version, true );
				wp_enqueue_script('page_frontier_scripts', $theme_dir . '/js/page-frontier.min.js', array('jquery'), $core_version, true );
			}
			if (is_page_template('page-stem.php')) {
			wp_enqueue_script('page_stem_scripts', $theme_dir . '/js/page-stem.js', array('jquery'), $core_version, true );
				// wp_enqueue_script('page_stem_scripts', $theme_dir . '/js/page-stem.min.js', array('jquery'), $core_version, true );
			}
			if (is_page_template('page-thelab.php') || is_page_template('page-thelab-about.php') || is_page_template('page-thelab-companies.php') || is_page_template('page-thelab-space.php')) {
				wp_enqueue_script('page_thelab_scripts', $theme_dir . '/js/page-thelab.min.js', array('jquery'), $core_version, true );
			}
		}

		else {

			wp_deregister_style('abtcore-theme');
			//wp_enqueue_style('admin-theme', $theme_dir . '/css/admin.css', null, $core_version, 'screen');

		}
	}

	//add_action('admin_head', 'abtcore_custom_admin');
	public function abtcore_custom_admin() {

		$theme_dir = get_stylesheet_directory_uri();
		wp_enqueue_style('abtcore-admin', $theme_dir . '/css/admin.css', null, $core_version, 'screen');

	}


	public function init(){

		$theme_dir = get_stylesheet_directory_uri();
		$has_https = isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on" ;

		// Only for Admin Area
		if( is_admin() ) {

            // Stylesheets
            //wp_enqueue_style('child-admin', $theme_dir . '/css/admin.css', null, '.9', 'screen');

        }

        register_nav_menus( array(

            'social-header'    => __( 'Social Header', 'abtcore' ),
            'social-footer'     => __( 'Social Footer', 'abtcore' ),

        ) );
	}


	/* Load stuff after theme is set up
	------------------------------------------------------------------------ */
	public function after_setup(){

		// Include Child Plugins
		$NAME = sprintf( '{%1$s/plugins/*/init.php}', dirname(__FILE__) );
		load_files($NAME);

	}


	/*
	 * Alter the default query to add randomized sorting for specific scenario
	 * NOTE: THIS OCCURS ON ALL PAGES, so make sure the specifying clause is correct
	 * @see http://codex.wordpress.org/Plugin_API/Filter_Reference/request
	 *
	 * @param mixed $request the WP request
	 * @return the adjusted query
	 *
	------------------------------------------------------------------------ */
	function alter_query_for_portfolio($request){

		$dummy_query = new WP_Query();  // the query isn't run if we don't pass any query vars
		$dummy_query->parse_query( $request );

		if( $dummy_query->is_admin ) {
			// do nothing
		}
		// if it's the projects page
		elseif(
			(
				( isset( $dummy_query->query_vars['post_type'] ) && 'portfolio' == $dummy_query->query_vars['post_type'] )
			)
			&&
			( empty( $dummy_query->query_vars['name'] ) )	// not a specific page
		) {

			$request['orderby'] = 'rand';
			$request['tax_query'] = array(
					array('taxonomy'=>'portfolio-categories', 'field'=>'slug', 'terms'=>'current')
				);
		}
		// or a portfolio category page
		elseif( isset( $dummy_query->query_vars['portfolio-categories'] ) ) {
			$request['orderby'] = 'rand';
		}

		return $request;

	}


	/*
	 * Sets the post excerpt length to X words.
	 * Overrides snapsite setting - see abt-core/includes/loop-functions.php method snapsite_excerpt_length
	 *
	 * @since ABT Core v0.9.3
	 * @return int
	 *
	------------------------------------------------------------------------ */
	function excerpt_length( $length ) {

		return 60;

	}


	/*
	 * Override snapsite excerpt more - hook with lower priority, so it runs later
	 * @param $more read more text
	 *
	------------------------------------------------------------------------ */
	function excerpt_more( $more ) {

		// check for presence of ellipses; if so, add to our override
		$before = ( false !== strpos($more, 'hellip') ? '&hellip;</p>' : '' );

		return $before . '<p><a class="button secondary" href="' . get_permalink() . '">Continue Reading</a>';

	}


}




/*
 * Custom Excerpt
 * Added (10/16/2012) from Trunk (10/16/2012)
 * 63276	10/10/12 3:27 PM	2	mattn	added body class and custom_excerpt
 *
======================================================================================================= */
function custom_excerpt(){

	$permalink = get_permalink($post->ID);
	$excerpt = get_the_content();
	$excerpt = preg_replace(" (\[.*?\])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 110);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = $excerpt.'... <a class="read-more" href="'.$permalink.'">Read More</a>';

	return $excerpt;

}




/*
 * List the Slug
 * Added (10/16/2012) from Trunk (10/16/2012)
 * 63276	10/10/12 3:27 PM	2	mattn	added body class and custom_excerpt
 *
======================================================================================================= */
function the_parent_slug() {

	global $post;

	if ( $post->post_parent == 0) return '';
	$post_data = get_post($post->post_parent);

	return $post_data->post_name;

}


new abt_core_custom_theme();	// call OO-wrapper




/*
 * Layout Table
 * Demo shortcode to show how to write one and 'hook' into ABT Core.
 * Adds necessary mark up for an unstyled table
 * Usage: [layout_table class="CSS_CLASS" style="STYLE"] TABLE [/module]
 *
 * @param style = css style rules (optional)
 * @param class = css class name
 *
 * @since ABT Core v0.9.5
 *
======================================================================================================= */
function abtcore_table_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'style' => '',
		'class' => ''
		), $atts ) );

	$style = ($style != '') ? ' style="' . $style . '"' : '';
	$class = ($class != '') ? ' ' . $class . '"' : '';

	$table = '<div class="layout-table' . $class . '"' . $style . '>' . do_shortcode($content) . '</div>';

	return $table;

}


/* Shortcode - Contact List
======================================================================================================= */
function shortcode_contact_list( $atts, $content = null ) {

	extract( shortcode_atts( array(
	), $atts ) );

	$list = '<section class="contact-list"><ul>' . do_shortcode($content) . '</ul></section>';

	return $list;

}

/* Shortcode - Contact Items
======================================================================================================= */
function shortcode_contact_item( $atts, $content = null ) {

	$theme_dir = get_stylesheet_directory_uri();

	extract( shortcode_atts( array(
		'type' => '',
		'title' => '',
		'description' => '',
		'url' => ''
	), $atts ) );

	$type = ($type != '') ? $type : 'page';
	$title = ($title != '') ? '<h4>' . $title . '</h4>' : '';
	$description = ($description != '') ? '<p>' . $description . '</p>' : '';
	$url = ($url != '') ? $url : '';

	if ($type == "page") {
		$item = '<li><a href="' . $url . '">' . $title . $description . '<div><img class="svg" src="' . $theme_dir . '/img/icons/i_search-submit.svg" /> View More</div></a></li>';
	}
	else if ($type == "email") {
		$item = '<li><a href="' . $url . '">' . $title . $description . '<div><img class="svg" src="' . $theme_dir . '/img/icons/i_contact-us.svg" /> Send Message</div></a></li>';
	}

	return $item;

}

/* Shortcode - Button
======================================================================================================= */
function shortcode_button( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'style' => '',
		'label' => '',
		'url' => '',
		'class' => '',
		'target' => ''
	), $atts ) );

	$style = ($style != '') ? $style : 'secondary';
	$url = ($url != '') ? 'href="' . $url .'"' : '';
	$class = ($class != '') ? $class : '';

	$button = '<a class="button ' . $style . ' ' . $class . '"' . $url . ' target="'. $target .'">' . $label . '</a>';

	return $button;

}

/* Shortcode - SVG Images
======================================================================================================= */
function shortcode_svg( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'width' => '50',
    'height' => '50',
    'name' => ''
  ), $atts ) );

  $svg = '<img width="'.$width.'" height="'.$height.'" src="'.get_stylesheet_directory_uri().'/img/icons/' . $name .'">';

  return $svg;

}

/* Shortcode - Card Container
======================================================================================================= */
function shortcode_card_container( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'type' => '',
    'style' => ''
  ), $atts ) );

  $card_container = '<div class="card-container ' . $style . ' ' . $type . '">' . do_shortcode($content) . '</div>';

  return $card_container;

}

/* Shortcode - Card
======================================================================================================= */
function shortcode_card( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'width' => 'full',
    'style' => ''
  ), $atts ) );

  $card = '<div class="card width-'.$width.' '.$style.'">' . do_shortcode($content) . '</div>';

  return $card;

}

/* Shortcode - Social Tile
======================================================================================================= */
function shortcode_social_tile( $atts ) {

  extract( shortcode_atts( array(
    'type' => 'text',
    'size' => 'standard',
    'title' => '',
    'icon' => '',
    'hover' => '',
    'image' => '',
    'link' => '',
    'class' => ''
  ), $atts ) );

  $social_tile = '<div class="social-tile type-' . $type . ' ' . $size .'" style="background-image: url(' . $image . ');">';
  $social_tile .= '<h2 class="entry-title">' . $title . '</h2>';
  $social_tile .= '<span class="published"><img class="svg" width="16px" height="16px" src="' . get_stylesheet_directory_uri() . '/img/icons/i_' . $icon . '.svg" />' . $hover . '</span>';
  $social_tile .= '<a class="expand ' . $class . '" href="' . $link .'"></a>';
  $social_tile .= '</div>';

  return $social_tile;

}

/* Shortcode - Banner
======================================================================================================= */
function shortcode_banner( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'theme' => 'frosty',
    'align' => 'left',
    'image' => ''
  ), $atts ) );

  $banner = '<div class="featured-banner theme-' . $theme . ' align-' . $align .'" style="background-image: url(' . $image . ');"><div class="banner-caption">' . do_shortcode($content) . '</div></div>';

  return $banner;

}

/* Shortcode - Carousel
======================================================================================================= */
function shortcode_carousel( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'theme' => 'frosty',
    'align' => 'left',
    'image' => ''
  ), $atts ) );

  // Get all images and put into array
  preg_match_all("/<img\s[^>]*?src\s*=\s*['\"](?:[^'\"]*?)['\"][^>]*?>/", $content, $imgs);

  // Get all captions and put into array
  preg_match_all("/\[carousel\-caption\](.*?)\[\/carousel\-caption\]/s", $content, $captions);

  if (!empty($imgs)) {
    $carousel = '<div class="owl-carousel owl-theme">';

    $i = 0;
    foreach ($imgs[0] as $img) {
      $carousel .= '<div class="item">';
      $carousel .= $img;
      $carousel .= do_shortcode($captions[0][$i]);
      $carousel .= '</div>';
      $i++;
    }

    $carousel .= '</div>';

    return $carousel;
  }

  return false;

}

/* Shortcode - Carousel Captions
======================================================================================================= */
function shortcode_carousel_caption( $atts, $content = null ) {

  extract( shortcode_atts( array(
  ), $atts ) );

  $caption = '<div class="caption">';
  $caption .= trim($content);
  $caption .= '</div>';

  return $caption;

}

/* Shortcode - STEM Blog Feed
======================================================================================================= */
function shortcode_stem_blogs( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'number' => 3
  ), $atts ) );

  ob_start();

  query_posts(array(
    'posts_per_page' => $number,
    'no_found_rows' => true,      // Disable pagination
    'cat' => 583                  // US2020 / STEM in the Park
  ));

  get_template_part('loop');

  wp_reset_query();

  return ob_get_clean();

}

/* Shortcode - Gradient Container
======================================================================================================= */
function shortcode_gradient_container( $atts, $content = null ) {

  extract( shortcode_atts( array(
    'type' => '',
    'style' => ''
  ), $atts ) );

  $card_container = '<div class="gradient-container ' . $style . ' ' . $type . '">' . do_shortcode($content) . '</div>';

  return $card_container;

}


/* Register Custom Shortcodes
======================================================================================================= */
function abtcore_register_my_shortcodes() {

	add_shortcode( 'layout_table', 'abtcore_table_shortcode' ); // adds module markup
	add_shortcode( 'contact_list', 'shortcode_contact_list' );
	add_shortcode( 'contact_item', 'shortcode_contact_item' );
	add_shortcode( 'button', 'shortcode_button' );
  add_shortcode( 'icon', 'shortcode_svg' );
  add_shortcode( 'card-container', 'shortcode_card_container' );
  add_shortcode( 'card', 'shortcode_card' );
  add_shortcode( 'social-tile', 'shortcode_social_tile' );
  add_shortcode( 'banner', 'shortcode_banner' );
  add_shortcode( 'carousel', 'shortcode_carousel' );
  add_shortcode( 'carousel-caption', 'shortcode_carousel_caption' );
  add_shortcode( 'stem-blogs', 'shortcode_stem_blogs' );
  add_shortcode( 'gradient-container', 'shortcode_gradient_container' );
}
add_action('abtcore_register_shortcodes', 'abtcore_register_my_shortcodes', 100);



/* Custom Shortcodes
======================================================================================================= */
function abtcore_additional_shortcodes_options() {
	?>
		<tr>
			<th id="th-shortcode4" scope="row" headers="th-name">
				<strong>Layout Table</strong>
				<div class="summary">Removes styling from table to be used for layout</div>
			</th>
			<td headers="th-shortcode4 th-shortcode">[layout_table]</td>
			<td headers="th-shortcode4 th-example">[layout_table class="CSS_CLASS" style="STYLE"] TABLE [/layout_table]</td>
			<td headers="th-shortcode4 th-screen">&nbsp;</td>
		</tr>
	<?php

}
add_action( 'ABTCore_shortcodes_options_more', 'abtcore_additional_shortcodes_options', 10, 3 );




/* Enable More Buttons
======================================================================================================= */
function enable_more_buttons($buttons) {
  $buttons[] = 'hr';

  return $buttons;

}
add_filter("mce_buttons", "enable_more_buttons");
add_editor_style();




/* TinyMCE Buttons
======================================================================================================= */
function atg_mce_buttons_2( $buttons ) {

    array_unshift( $buttons, 'styleselect' );
    return $buttons;

}
add_filter( 'mce_buttons_2', 'atg_mce_buttons_2' );


function mce_before_init( $settings ) {

    $style_formats = array(
        array(
        	'title' => 'Cols 1',
        	'block' => 'div',
        	'classes' => 'cols-1',
        	'wrapper' => true
        ),
        array(
        	'title' => 'Cols 2-1',
        	'block' => 'div',
        	'classes' => 'cols-2',
			'wrapper' => true
        ),
        array(
        	'title' => 'Cols 2-2',
        	'block' => 'div',
        	'classes' => 'cols-2-2',
			'wrapper' => true
        ),
        array(
        	'title' => 'Cols 2/3',
        	'block' => 'div',
        	'classes' => 'cols-2thirds',
			'wrapper' => true
        ),
        array(
        	'title' => 'Cols 3-1',
        	'block' => 'div',
        	'classes' => 'cols-3',
			'wrapper' => true,
        ),
        array(
        	'title' => 'Cols 3-2',
        	'block' => 'div',
        	'classes' => 'cols-3-2',
			'wrapper' => true,
        ),
        array(
        	'title' => 'Cols 3-3',
        	'block' => 'div',
        	'classes' => 'cols-3-3',
			'wrapper' => true,
        ),
    	array(
    		'title' => 'Button',
    		'selector' => 'a',
    		'classes' => 'button'
    	),
        array(
        	'title' => 'Bold Red Text',
        	'inline' => 'span',
        	'styles' => array(
        		'color' => '#f00',
        		'fontWeight' => 'bold'
        	)
        )
    );

    $settings['style_formats'] = json_encode( $style_formats );
    return $settings;
}

add_filter( 'tiny_mce_before_init', 'mce_before_init' );


/* Custom Pagination
======================================================================================================= */
function pagination($pages = '', $range = 4)
{
     $showitems = ($range * 2)+1;

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }

     if(1 != $pages)
     {
         echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">Next &rsaquo;</a>";
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>Last &raquo;</a>";
         echo "</div>\n";
     }
}

/* Create a new filtering function that will add our where clause to the query
======================================================================================================= */
function filter_where( $where = '' ) {
	// posts in the last 30 days
	$where .= " AND post_date > '" . date('Y-m-d', strtotime('-30 days')) . "'";
	return $where;
}

/* Exclude a Page from Search Results
======================================================================================================= */
// function mySearchFilter($query) {

//     if ($query->is_search) {
//         $exclude_id = ot_get_option( 'search_remove_posts_pages_from_results' );
//         $query->set('post__not_in', array($excludeId));
//     }
//     return $query;
// }
// add_filter('pre_get_posts','mySearchFilter');

$tutorialCookieKey = 'tutorial';

add_action('init', function() use ($tutorialCookieKey) {
    if (!isset($_COOKIE[$tutorialCookieKey])) {
        setcookie($tutorialCookieKey, true, strtotime('+1 year'));
    }
});

function should_run_tutorial() {
    global $tutorialCookieKey;
    return !isset($_COOKIE[$tutorialCookieKey]);
}

function get_the_program_excerpt(){
	$excerpt = get_the_content();
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$the_str = substr($excerpt, 0, 50);
	return $the_str . '...';
}


/**
 * Adds classes to the array of body classes.
 *
 * @uses body_class() filter
 */
function textdomain_body_classes( $classes ) {
    if (is_home() || is_front_page()) {
    	$classes[] = 'menu-maximized';
    } else {
    	$classes[] = 'menu-minimized';
    }

    return $classes;

}
add_filter( 'body_class', 'textdomain_body_classes' );

function footer_nav_class($classes, $item, $args = null){
    if ( is_home() || is_front_page() ) {
        if ( 'footer' === $args->theme_location ) {
            $classes[] = 'small-menu-item';
        }
     }
     return $classes;
}

add_filter('nav_menu_css_class' , 'footer_nav_class' , 10 , 4);

/**
 * Returns the latest tweet data for N most recent tweets
 * @param int $numTweets
 * @return array
 * http://www.wpreads.com/2013/06/how-to-get-latest-tweets-with-twitter-api-1-1-in-wordpress.html
 */
function getLatestTweetsForRTP($numTweets = 1)
{
    if(class_exists('TwitterAPIExchange')) {
        // Setting our Authentication Variables that we got after creating an application
        $settings = array(
            'oauth_access_token' => "23498831-O8lMypzR3xOeV2CdIRH7j4QaqfAIqXn3HUoW7jrt7",
            'oauth_access_token_secret' => "tLze27MIDnoVXEeYYOd9Al3JjQxRnfQe8EklGkeG3shqE",
            'consumer_key' => "fQUeagPFZ4CCH0smJO60GGDpb",
            'consumer_secret' => "s8RwDhW4MtKkbHGAK5DLcjjtUWQhfjuOwkzf1V8tt84xqnxHWS"
        );

        // We are using GET Method to Fetch the latest tweets.
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';

        // Set your screen_name to your twitter screen name. Also set the count to the number of tweets you want to be fetched.
        $getfield = "?screen_name=thertp&count=$numTweets&tweet_mode=extended";
        $requestMethod = 'GET';

        // Making an object to access our library class
        $twitter = new TwitterAPIExchange($settings);
        $store = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();
        // Since the returned result is in json format, we need to decode it
        $result = json_decode($store);

        // After decoding, we have an standard object array, so we can print each tweet into a list item.
        $multi_array = objectToArray($result);
        return $multi_array;
    } else {
        return [];
    }
}

/**
 * Returns the data for the N most recent Instagram posts
 * @return mixed
 */
function getLatestInstagramForRTP($count = 1)
{
    $access_token = '246146788.2ef1db0.68599a4d261a47168cd0842fc1fdef22';
    $return = rudr_instagram_api_curl_connect("https://api.instagram.com/v1/users/self/media/recent?access_token=$access_token&count=$count");
    return $return->data;
}

/**
 * @param $api_url
 * @return array|mixed|object
 * https://rudrastyh.com/php/instagram-api-recent-photos.html
 */
function rudr_instagram_api_curl_connect( $api_url ){
    $connection_c = curl_init(); // initializing
    curl_setopt( $connection_c, CURLOPT_URL, $api_url ); // API URL to connect
    curl_setopt( $connection_c, CURLOPT_RETURNTRANSFER, 1 ); // return the result, do not print
    curl_setopt( $connection_c, CURLOPT_TIMEOUT, 20 );
    $json_return = curl_exec( $connection_c ); // connect and get json data
    curl_close( $connection_c ); // close connection
    return json_decode( $json_return ); // decode and return
}

/**
 * Returns events based on what category they are in.
 *
 * @param $slug
 * @param int $limit
 * @param string $order
 * @return array
 */
function get_events_by_category($slug, $limit = 1, $order = 'ASC') {
	$args = array(
		'posts_per_page' => $limit,
		'post_type'      => 'event',
		'tax_query'      => array(
			array(
				'taxonomy' => 'event-categories',
				'field'    => 'slug',
				'terms'    => $slug,
			),
		),
		'post_status'    => 'publish',
		'meta_query'	 => array(
			array(
				'key'     => 'wpcf-event-start-date-and-time',
				'compare' => 'EXISTS',
			),
			array(
				'key'     => 'wpcf-event-end-date-and-time',
				'value'   => strtotime('today'),
				'compare' => '>=',
			)
		),
		'orderby'        => array(
			'wpcf-event-start-date-and-time' => $order,
		),
	);
	return get_posts($args);
}



/**
 * Returns the next upcoming foodtruck event, if there is one.
 * @return array|bool
 */
function get_next_food_truck_event() {
	$food_truck_event = get_events_by_category('food-trucks');
	return count($food_truck_event) ? $food_truck_event[0] : false;
}
