<?php

	add_action( 'admin_init', 'abtcore_submenu_init' );
	add_action( 'save_post', 'abtcore_submenu_save' );

	/**
	 * Wrapper for the_submenu that fits with standard naming convention.
	 *
	 * @param string $menu_name
	 */
	function abtcore_the_submenu( $menu_name = false )
	{
		the_submenu( $menu_name );
	}

	// Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
	// This code based on wp_nav_menu's code to get Menu ID from menu slug
	function the_submenu( $menu_name = false ) {

		if ( !$menu_name ) {
			// no specific menu sent in params
			global $post;

			//  Get sub-menu or inherit
			$meta['menu'] = abtcore_get_parent_submenu_recursive( $post );

			// double check and return no-menu if still empty
			if ( empty($meta) || $meta['menu'] == '-1' || $meta['menu'] === '' )
				return false;

			// ok, not empty and has menu set!
			$menu_name = $meta['menu'];
		}

		$menu = wp_get_nav_menu_object( $menu_name );

		if ( $menu_items = wp_get_nav_menu_items( $menu->term_id ) ) {

    		apply_filters('abtcore_the_submenu', '', $menu_name, $menu_items);

    		$options = abtcore_get_option();
    		$header  = isset( $options['sub_menu_heading'] ) ? $options['sub_menu_heading'] : false;
    		$walker  = isset( $options['menu_walker']) ? $options['menu_walker'] : false;

    		switch ( $header ) {
    			case 'replace':
    				$first_item = array_shift( $menu_items );
    				$menu_title = '<h3><a href="' . $first_item->url . '">' . $first_item->title . '</a></h3>';
    				// exclude first item if link_submenu_header is set to 'replace'
    				add_filter( 'wp_get_nav_menu_items', 'remove_first_menu_item' ); //$sorted_menu_items
    				break;
    			case 'no-header':
    				$menu_title = '';
    			 	break;
    			default:
    				$menu_title = '<h3>' . $menu->name . '</h3>';
    				break;
    		}

    		echo '<nav id="menu-' . $menu_name . '" class="secondary">' . $menu_title;

    		// use walker if requested
    		// @see http://codex.wordpress.org/Function_Reference/wp_nav_menu
    		if( 'custom' == $walker ) :
    			wp_nav_menu( array(
    				'menu'       => $menu_name,
    				'menu_class' => 'abt-walker',
    				'walker'     => new ABT_Custom_Walker_Nav_Menu(),
    				'container' => 'nav', 'container_class' => 'secondary-menu'
    			) );
    		else:
    			wp_nav_menu( array(
					'menu'       => $menu_name,
					'menu_class' => '',
					'container'  => false
    			) );
    		endif;

    		echo  "</nav>";
		} else {
            return false;
		}
	}

	function remove_first_menu_item( $items ) {
		array_shift( $items );
		return $items;
	}

	function abtcore_submenu_init() {
		add_meta_box('abtcore_submenu',__('Sub Menu','abtcore'),'abtcore_add_submenu_box','page','side','default');
	}

	function abtcore_add_submenu_box() {
		global $post;
		$N = 'abtcore_submenu';
		//get the values
		$meta = get_post_meta($post->ID, $N, true);
		$menu_list = wp_get_nav_menus();

		//pbug($menu_list);

		?>
		<input type="hidden" name="<?php echo $N; ?>-nonce" id="<?php echo $N; ?>-nonce" value="<?php echo wp_create_nonce("$N-nonce")?>" />

        <div class="field">
        	<label for="<?php echo $N; ?>-menu">Attach Sub Menu:</label>
        	<select id="<?php echo $N; ?>-menu" name="<?php echo $N; ?>[menu]">
            	<option value="">--Inherit--</option>
				<option value="-1" <?php if ($meta['menu'] === '-1'): ?> selected<?php endif; ?>>--None--</option>
				<?php foreach ($menu_list as $item): ?>
                	<option value="<?php echo $item->term_id; ?>"<?php if ($meta['menu'] == $item->term_id): ?> selected<?php endif; ?>><?php echo $item->name; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

		<?php
	}

	function abtcore_submenu_save($id) {

		$N = 'abtcore_submenu';

		if(!isset($_POST[$N])){
			return $id;
		}

		$meta = $_POST[$N];

		if (!wp_verify_nonce($_POST["$N-nonce"],"$N-nonce")) return $id; //nonce

		update_post_meta($id, $N, $meta);
	}

	/*
	 * Returns the parent's submenu selection. If none, it looks upward until it finds one. Returns null if it reaches the root unsuccessfully.
	 *
	 * @param $post is a post object.
	 * @since ABT Core v0.9.5
	 *
	**/
	function abtcore_get_parent_submenu_recursive( $post ) {
		$N = 'abtcore_submenu';
		//get the values
		$meta = get_post_meta( $post->ID, $N, true );
		// if has parent AND empty or not set, then get parent's
		if ( ( $post->post_parent != '' ) && ( empty( $meta ) || $meta['menu'] === '' ) )
			return abtcore_get_parent_submenu_recursive( get_post( $post->post_parent ) );
		// return value (null if root and not set)
		return isset( $meta['menu'] ) ? $meta['menu'] : '';
	}