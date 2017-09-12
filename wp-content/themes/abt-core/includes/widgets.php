<?php

/** NOT YET!
* Initialize posts list widget!
*/

class abtcore_posts_widget extends WP_Widget {
	function abtcore_posts_widget() {
		$widget_ops = array('description' => __('Displays a list of any post-type', 'abtcore') );
		//Create widget
		$this->WP_Widget('abtcore_posts_list', __('Core Posts Widget', 'abtcore'), $widget_ops);
	}

  	function widget($args, $instance) {
	 		extract($args, EXTR_SKIP);
			
			$title = empty($instance['title']) ? __('', 'abtcore') : apply_filters('widget_title', $instance['title']);
			$parameters = array(
			  'title' => $title,
				'limit' => (int) $instance['show-num'],
				'excerpt' => (int) $instance['excerpt-length'],
				'order' => esc_attr($instance['order']),
				'orderby' => esc_attr($instance['orderby']),
				'more_text' => esc_attr($instance['more_text'])
				/* these line up with form variables */
			);
			
			echo $before_widget;
				echo $before_title, $title, $after_title;				
				abtcore_display_posts_list( $parameters );
			echo $after_widget;
			
  } //end of widget
	
	//Update widget options
  function update($new_instance, $old_instance) {

		$instance = $old_instance;
		//get old variables
		$instance['title'] = esc_attr($new_instance['title']);
		$instance['show-num'] = (int) abs($new_instance['show-num']);
		
		$instance['orderby'] = esc_attr($new_instance['orderby']);
		$instance['order'] = esc_attr($new_instance['order']);
		$instance['more_text'] = esc_attr($new_instance['more_text']);
		
		return $instance;
  } //end of update
	
	//Widget options form
  function form($instance) {
		
		$instance = wp_parse_args(
		(array) $instance, 
		array(
			'title' => __('Core Posts','testimonials'), 
			'show-num' => 1, // random
			'order' => "ASC",
			'orderby' => "ID",
			'more_text' => ""
			)
		);
		
		$title = esc_attr($instance['title']);
		$show_num = (int) $instance['show-num'];
		$order = esc_attr($instance['order']);
		$orderby = esc_attr($instance['orderby']);
		$more_text = esc_attr($instance['more_text']);

		/*LIKE:
		## $this->get_field_id('OrderBy')
		## $this->get_field_name('show-num');
		*/
		?>
		
        <div class="field">
		   	<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'abtcore');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
			<em class="summary">(Optional)</em>
		</div>
        
		<div class="field">
		   	<label for="<?php echo $this->get_field_id('show-num'); ?>"><?php _e('Number of posts to show:', 'abtcore');?></label>
		  	<input id="<?php echo $this->get_field_id('show-num'); ?>" name="<?php echo $this->get_field_name('show-num'); ?>" type="text" value="<?php echo $show_num; ?>" size ="3" />
		</div>
        
        <div class="field">
			<label for="<?php echo $this->get_field_id('orderby'); ?>"><?php _e('Order By:  ', 'abtcore');?></label>
            
			<select id="<?php echo $this->get_field_id('orderby'); ?>" name="<?php echo $this->get_field_name('orderby'); ?>">
				<option value="author" <?php if($orderby=="author") echo "selected"; ?>>author</option>
				<option value="category" <?php if($orderby=="category") echo "selected"; ?>>category</option>
				<option value="content" <?php if($orderby=="content") echo "selected"; ?>>content</option>
				<option value="date" <?php if($orderby=="date") echo "selected"; ?>>date</option>
				<option value="ID" <?php if($orderby=="ID") echo "selected"; ?>>ID</option>
				<option value="menu_order" <?php if($orderby=="menu_order") echo "selected"; ?>>menu_order</option>
				<option value="mime_type" <?php if($orderby=="mime_type") echo "selected"; ?>>mime_type</option>
				<option value="modified" <?php if($orderby=="modified") echo "selected"; ?>>modified</option>
				<option value="name" <?php if($orderby=="name") echo "selected"; ?>>name</option>
				<option value="parent" <?php if($orderby=="parent") echo "selected"; ?>>parent</option>
				<option value="password" <?php if($orderby=="password") echo "selected"; ?>>password</option>
				<option value="rand" <?php if($orderby=="rand") echo "selected"; ?>>rand</option>
				<option value="status" <?php if($orderby=="status") echo "selected"; ?>>status</option>
				<option value="title" <?php if($orderby=="title") echo "selected"; ?>>title</option>
				<option value="type" <?php if($orderby=="type") echo "selected"; ?>>type</option>
			</select>
			<em class="summary">If set to 'rand', random posts of selected post-type will be displayed.</em>
		</div>
        
		<div class="field">
			<label for="<?php echo $this->get_field_id('order'); ?>"> <?php _e('Sort Order By:', 'abtcore');?></label>
			<select class="select" id="<?php echo $this->get_field_id('order'); ?>" name="<?php echo $this->get_field_name('order'); ?>">
				<option value="ASC" <?php if($order=="ASC") echo "selected"; ?>>ASCending</option>
				<option value="DESC" <?php if($order=="DESC") echo "selected"; ?>>DESCending</option>
			</select>
		</div>
        
        <div class="field">
		   	<label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('More Button Text:', 'testimonials');?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" type="text" value="<?php echo $more_text; ?>" />
			<em class="summary">What do you want the link to all the posts to say? If left blank, no link will show.</em>
		</div>
        
   <?php
  } //end of form
}

//add_action( 'widgets_init', create_function('', 'return register_widget("abtcore_posts_list_widget");') );
//Register Widget

/**
* Supporting testimonials widget functions
*/

/*function abtcore_display_posts_list($args) {

		
	echo '<div class="posts-list"><ul>';		
		echo abtcore_get_posts_list($args);
	
	$custom_slug = get_option('posts-slug') != '' ? get_option('posts-slug') : 'testimonials';
	echo '</ul>';
	echo ( $args['more_text'] != '' ) ? '<p class="more-link"><a href="/' . $custom_slug . '">' . $args['more_text'] . '</a></p>' : '';
	echo '</div>';

}

function abtcore_get_posts_list($args) {	
	$defaults = array(
		'limit' => 1,
		'order' => "ASC", 
		'orderby' =>'ID',
		'more_text' => ""		
	);
	extract( array_merge($defaults, $args) );
	
	$query = "&post_type=testimonials&posts_per_page=$limit&orderby=$orderby&order=$order";
	
	$posts = get_posts($query); //get posts
	$postlist = '';
	
	foreach ($posts as $post) {
		$post_title = htmlspecialchars(stripslashes($post->post_title));
		//$thumbnailstr = ''; //( has_post_thumbnail( $post->ID ) ) ? '<div class="post-thumb">' . get_the_post_thumbnail( $post->ID, array(60,50) ) . '</div>' : '';
		$postexcerptstr = ( empty($post->post_excerpt) ) ? limit_text(strip_tags($post->post_content), 18) : $post->post_excerpt;
		
		$postlist .= '<li><q>' . $postexcerptstr . '</q><cite><a href="' . get_permalink($post->ID) . '" title="'. $post_title .'" >' . $post_title . '</a></cite></li>';
	}
	
	return $postlist;
	
}*/

?>