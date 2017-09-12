<?php
/**
 * Are breadcrumbs enabled for the current page / post?
 * 
 * @param boolean $strict - Disable breadcrumbs on home page 
 * @return boolean
 */
function abtcore_breadcrumbs_enabled( $strict = true )
{
	$N       = 'display_breadcrumbs';
	$show_bc = abtcore_get_option( $N );
	$enabled = $show_bc === 'yes';
	
	if ( $strict )
		return $enabled && !is_home() && !is_front_page() || is_paged();
	else
		return $enabled;
}

/**
 * Detect if the NavXT display function exists.
 * 
 * @return boolean
 */
function abtcore_navxt_active()
{
	return function_exists( 'bcn_display' ) ? true : false;
}

/**
 * the_breadcrumb()
 * Echoes nested breadcrumbs for any possible content type/page
 * 
 * @param boolean $strict - Disable breadcrumbs on home page
 */
function abtcore_the_breadcrumb( $strict = true )
{
	global $post;
	
	//  Nav XT compability check -- if Nav XT is installed prefer that
	//  This requires that the Nav XT plugin exists
	if( abtcore_navxt_active() ) {
		//  Display breadcrumbs
		bcn_display();
		// Then run away
		return;
	}
	
	$home   = __( 'Home', 'abt-core' );
	$before = '<ul><li>'; // tag before the current crumb
	$after  = '</li></ul>'; // tag after the current crumb
	
	$options = abtcore_get_options();
	
	if ( !$strict || ( !is_home() && !is_front_page() || is_paged() ) ) {
		// this needs to be here for everything to work properly. some types below rely on homeLink
		$homeLink = get_bloginfo('url');
		
		if ( isset( $options['breadcrumb_remove_home'] ) && $options['breadcrumb_remove_home'] ) {
			echo '<nav id="breadcrumbs" class="breadcrumbs reset"><h2 class="access">Breadcrumbs</h2>';			
		} else {
			echo '<nav id="breadcrumbs" class="breadcrumbs reset"><h2 class="access">Breadcrumbs</h2>' . $before;
			echo '<a href="' . $homeLink . '">' . $home . '</a>';
		}
		
		if ( is_category() || is_tax() ) {
		  	global $wp_query;
		  	$cat_obj = $wp_query->get_queried_object();
		  	$thisCat = $cat_obj->term_id;
		  	$thisCat = get_category($thisCat);
		  	$parentCat = get_category($thisCat->parent);
			
			// allow overrides
			$cat_listing_prefix = apply_filters('abtcore_cat_listing_prefix', (is_tax() ? 'Taxonomy: ' : 'Category: ') );
		  	$parents = '';
			if ($thisCat->parent != 0) $parents = explode('|', substr(get_category_parents($cat, TRUE, '|' ), 0, -1)  );
			abtcore_build_breadcrumb_list($parents, $before, $after, $cat_listing_prefix . single_cat_title('', false) );
		
		} elseif ( is_day() ) {
			echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
		  	echo $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>';
		  	echo $before . get_the_time('d') . $after . $after . $after;
		
		} elseif ( is_month() ) {
			echo $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>';
			echo $before . get_the_time('F') . $after . $after;
		
		} elseif ( is_year() ) {
			echo $before . get_the_time('Y') . $after;
		
		} elseif ( is_single() && !is_attachment() ) {
		  	if ( get_post_type() != 'post' ) {
				// Custom Post Type Single
				$post_type = get_post_type_object(get_post_type());
				$slug = $post_type->rewrite;
				
				abtcore_breadcrumbs_build_parents_custom( $post_type, $before, $after, $slug['slug'] );
								
		  	} else {
				$cat = get_the_category();
				$cat = $cat[0];
				$parents = explode('|', substr(get_category_parents($cat, TRUE, '|' ), 0, -1)  );
				abtcore_build_breadcrumb_list($parents, $before, $after );
		  	}
		
		} elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
			// Custom Post Type
			global $wp_query;
			$post_type = get_post_type_object( $wp_query->query_vars['post_type'] /*get_post_type()*/);
			abtcore_breadcrumbs_build_parents_custom( $post_type, $before, $after );
		
		} elseif ( is_attachment() ) {
			$parent = get_post($post->post_parent);
		  	$cat = get_the_category($parent->ID);
			$cat = $cat[0];
		  	
			$parents = explode('|', substr(get_category_parents($cat, TRUE, '|' ), 0, -1)  );
			$parents []= '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
			abtcore_build_breadcrumb_list($parents, $before, $after );
		
		} elseif ( is_page() && !$post->post_parent ) {
			echo $before . get_the_title() . $after;
		
		} elseif ( is_page() && $post->post_parent ) {
			$breadcrumbs = abtcore_build_breadcrumbs_parents($post->post_parent);
			abtcore_build_breadcrumb_list($breadcrumbs, $before, $after );
		
		} elseif ( is_search() ) {
			echo $before . 'Search results for "' . get_search_query() . '"' . $after;
		
		} elseif ( is_tag() ) {
			echo $before . 'Tagged: ' . single_tag_title('', false) . $after;
		
		} elseif ( is_author() ) {
			global $author;
			$userdata = get_userdata($author);
			echo $before . '@' . $userdata->display_name . $after;
		
		} elseif ( is_404() ) {
			echo $before . 'Error 404' . $after;
		}
		
		if ( get_query_var('paged') ) {
			echo $before;
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
		  		echo __('Page') . ' ' . get_query_var('paged');
			if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
			echo $after;
		}
		
		if ( isset( $options['breadcrumb_remove_home'] ) && $options['breadcrumb_remove_home'] ) {
			echo '</nav>';			
		} else {
			echo $after . '</nav>';
		}
	}
}

/**
 * abtcore_build_breadcrumb_list()
 * @param $breadcrumbs the array of parents
 * @param $before the beginning string for nesting
 * @param $after the ending string for nesting
 * @param $current_title OPTIONAL allows to override get_the_title for current page
 */ 
function abtcore_build_breadcrumb_list( $breadcrumbs, $before, $after, $current_title = null ) {
	if (empty($breadcrumbs)) {
		echo $before , ( $current_title ? $current_title : get_the_title() ),  $after;
		return;
	}
	
	foreach ($breadcrumbs as $crumb) echo $before . $crumb; // build beginning of nested list items
	echo $before , ( $current_title ? $current_title : get_the_title() ),  $after; // show current
	foreach ($breadcrumbs as $crumb) echo $after; // close nested list items
	
}

/**
 * abtcore_breadcrumbs_get_parents_from_id()
 * @param $id of parent
 * returns array of parents in order of hierarchy (relies on Pages tree structure)
 */
function abtcore_breadcrumbs_get_parents_from_id( $id ) {
	global $abtcore_breadcrumb_parents;
	if (!empty($id)) $abtcore_breadcrumb_parents []= array( 'name' => $id, 'title' => get_the_title($id), 'permalink' => get_permalink($id) );
	$this_post = get_post( $id );
	if ($this_post->post_parent != '') return $abtcore_breadcrumb_parents []= abtcore_breadcrumbs_get_parents_from_id( $this_post->post_parent );
	return $abtcore_breadcrumb_parents;	
}

function abtcore_breadcrumbs_build_parents_custom( $post_type, $before = '', $after = '', $single_slug = '' ) {
	// Find parent items set in options
	$options = get_option($post_type->name . '_type_options');
	
	global $abtcore_breadcrumb_parents;
	$abtcore_breadcrumb_parents = abtcore_breadcrumbs_get_parents_from_id( $options['parent-page'] );
	
	$parents = '';
	if (!empty($abtcore_breadcrumb_parents)):
		$abtcore_breadcrumb_parents = array_reverse($abtcore_breadcrumb_parents);
		//pbug($abtcore_breadcrumb_parents);
		foreach ($abtcore_breadcrumb_parents as $parent):
			$parents .= $before . '<a href="' . $parent['permalink'] . '">' . $parent['title'] . '</a>';
		endforeach;
		
		// spit out current item
		if ( !empty($single_slug) ):
			// single custom post type
			echo $parents . $before . '<a href="' . get_bloginfo('url') . '/' . $single_slug . '/">' . $options['title'] . '</a>' . $before . get_the_title() . $after . $after;
		else:
			// main custom post type page
			echo $parents . $before . $options['title'] .$after;
		endif;
		
		// close rest of lists
		foreach ($abtcore_breadcrumb_parents as $parent):
			echo $after;
		endforeach;
	endif;
	unset($abtcore_breadcrumb_parents);
}

/**
 * Loop through parents of given page to build a list of breadcrumbs
 * @params int $parent_id the uid of the parent page to start from
 * 
 * @return an array of breadcrumbs
 */
function abtcore_build_breadcrumbs_parents($parent_id) {
	$breadcrumbs = array();
	while ($parent_id) {
		$page = get_page($parent_id);
		$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
		$parent_id  = $page->post_parent;
	}
	return $breadcrumbs = array_reverse($breadcrumbs);
}