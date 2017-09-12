<?php
/*
Plugin Name: Which Widget
Plugin URI: http://www.atlanticbt.com
Description: Adds checkboxes to each widget to show or hide on site pages.
Author: Brian Shirey & Mark C
Version: 1
Modified and improved from Stephanie Well's Display Widgets (http://strategy11.com)
*/

//load_plugin_textdomain( 'display-widgets', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

add_filter('widget_display_callback', 'abtcore_show_ww_widget');
add_action('in_widget_form', 'abtcore_ww_show_hide_widget_options', 10, 3);
add_filter('widget_update_callback', 'abtcore_ww_update_widget_options', 10, 3);

function abtcore_show_ww_widget($instance)
{
    global $wp_query;
    $post_id = $wp_query->get_queried_object_id();
    
    if (is_home()){
        $show = isset($instance['page-home']) ? ($instance['page-home']) : false;
    }else if (is_front_page()){
        $show = isset($instance['page-front']) ? ($instance['page-front']) : false;
    }else if (is_category()){
        $show = isset($instance['cat-'.get_query_var('cat')]) ? ($instance['cat-'.get_query_var('cat')]) : false;
    }else if(is_tax()){
        $term = get_queried_object();
        $show = isset($instance['tax-'.$term->taxonomy]) ? ($instance['tax-'.$term->taxonomy]) : false;
        unset($term);
    }else if (is_archive()){
        $show = isset($instance['page-archive']) ? ($instance['page-archive']) : false;
    }else if (is_single()){
        if(function_exists('get_post_type')){
            $type = get_post_type();
            if($type != 'page' and $type != 'post')
                $show = isset($instance['type-'.$type]) ? ($instance['type-'.$type]) : false;
        }
        
        if(!isset($show))
            $show = isset($instance['page-single']) ? ($instance['page-single']) : false;
            
        if (!$show){
            $cats = get_the_category();
            foreach($cats as $cat){ 
                if ($show) continue;
                if (isset($instance['cat-'.$cat->cat_ID]))
                    $show = $instance['cat-'.$cat->cat_ID];
            } 
        }
    }else if (is_404()){ 
        $show = isset($instance['page-404']) ? ($instance['page-404']) : false;
    }else if (is_search()){
        $show = isset($instance['page-search']) ? ($instance['page-search']) : false;
    }else if($post_id){
        $show = isset($instance['page-'.$post_id]) ? ($instance['page-'.$post_id]) : false;
    } else {
    	$show = false;
    }
    
    
    if ($post_id and !$show and isset($instance['other_ids']) and !empty($instance['other_ids'])){
        $other_ids = explode(',', $instance['other_ids']);
        foreach($other_ids as $other_id){
            if($post_id == (int)$other_id)
                $show = true;
        }
    }

    
    if (isset($instance['include']) && (($instance['include'] and $show == false) or ($instance['include'] == 0 and $show))){
        return false;
    }else{
        global $user_ID;
        if( (isset($instance['logout']) and $instance['logout'] and $user_ID) or 
            (isset($instance['login']) and $instance['login'] and !$user_ID)) 
            return false;
            
    }
	return $instance;
}

function abtcore_ww_show_hide_widget_options($widget, $return, $instance){
    abtcore_ww_register_globals();
    
    global $abtcore_ww_pages, $abtcore_ww_cats, $abtcore_ww_taxes, $abtcore_ww_cposts, $abtcore_ww_checked, $abtcore_ww_loaded;

    $wp_page_types = array(
        'front' => __('Front', 'display-widgets'), 
        'home' => __('Blog', 'display-widgets'),
        'archive' => __('Archives', 'display-widgets'),
        'single' => __('Single Post', 'display-widgets'),
        '404' => '404', 'search' => __('Search', 'display-widgets')
    );
            
    $instance['include'] = isset($instance['include']) ? $instance['include'] : 0;
    $instance['logout'] = isset($instance['logout']) ? $instance['logout'] : 0;
    $instance['login'] = isset($instance['login']) ? $instance['login'] : 0;
    $instance['other_ids'] = isset($instance['other_ids']) ? $instance['other_ids'] : '';
?>
	 <div class="field">
    	<label for="<?php echo $widget->get_field_id('include'); ?>"><?php _e('Show/Hide Widget', 'display-widgets') ?></label>
    	<select name="<?php echo $widget->get_field_name('include'); ?>" id="<?php echo $widget->get_field_id('include'); ?>" class="widefat">
            <option value="0" <?php echo selected( $instance['include'], 0 ) ?>><?php _e('Hide on checked', 'display-widgets') ?></option> 
            <option value="1" <?php echo selected( $instance['include'], 1 ) ?>><?php _e('Show on checked', 'display-widgets') ?></option>
        </select>
    </div>    

<div class="which-widget-wrap">
    <ul class="abtcore_ww_options">
		<li><input class="checkbox" type="checkbox" <?php checked($instance['logout'], true) ?> id="<?php echo $widget->get_field_id('logout'); ?>" name="<?php echo $widget->get_field_name('logout'); ?>" value="1" />
    <label for="<?php echo $widget->get_field_id('logout'); ?>"><?php _e('Show only for Logged-out users', 'display-widgets') ?></label></li>
    	<li><input class="checkbox" type="checkbox" <?php checked($instance['login'], true) ?> id="<?php echo $widget->get_field_id('login'); ?>" name="<?php echo $widget->get_field_name('login'); ?>" value="1" />
    <label for="<?php echo $widget->get_field_id('login'); ?>"><?php _e('Show only for Logged-in users', 'display-widgets') ?></label></li>
	</ul>
    
    <h4 class="abtcore_ww_handle"><?php _e('Miscellaneous', 'display-widgets') ?> <span>&ndash;</span></h4>
    <div class="abtcore_ww_box">
        <ul class="abtcore_ww_options">
    <?php foreach ($wp_page_types as $key => $label){ 
        $instance['page-'. $key] = isset($instance['page-'. $key]) ? $instance['page-'. $key] : false;
    ?>
			<li><input class="checkbox" type="checkbox" <?php checked($instance['page-'. $key], true) ?> id="<?php echo $widget->get_field_id('page-'. $key); ?>" name="<?php echo $widget->get_field_name('page-'. $key); ?>" />
        <label for="<?php echo $widget->get_field_id('page-'. $key); ?>"><?php echo $label .' '. __('Page', 'display-widgets') ?></label></li>
    <?php } ?>
		</ul>
    </div>
    
    <h4 class="abtcore_ww_handle"><?php _e('Pages', 'display-widgets') ?> <span>&ndash;</span></h4>
    <div class="abtcore_ww_box">
        <ul class="abtcore_ww_options">
    <?php foreach ($abtcore_ww_pages as $page){ 
        $instance['page-'.$page->ID] = isset($instance['page-'.$page->ID]) ? $instance['page-'.$page->ID] : false;   
    ?>
			<li><input class="checkbox" type="checkbox" <?php checked($instance['page-'.$page->ID], true) ?> id="<?php echo $widget->get_field_id('page-'.$page->ID); ?>" name="<?php echo $widget->get_field_name('page-'.$page->ID); ?>" />
        <label for="<?php echo $widget->get_field_id('page-'.$page->ID); ?>"><?php echo $page->post_title . " <span class=\"id-num\" title=\"ID #\">[" . $page->ID . "]</span> "; ?></label></li>
    <?php	}  ?>
		</ul>
    </div>
    
    <?php if(isset($abtcore_ww_cposts) and !empty($abtcore_ww_cposts)){ ?>
    <h4 class="abtcore_ww_handle"><?php _e('Custom Post Types', 'display-widgets') ?> <span>&ndash;</span></h4>
    <div class="abtcore_ww_box">
        <ul class="abtcore_ww_options">
    <?php foreach ($abtcore_ww_cposts as $post_key => $custom_post){ 
        $instance['type-'. $post_key] = isset($instance['type-'. $post_key]) ? $instance['type-'. $post_key] : false;
    ?>
			<li><input class="checkbox" type="checkbox" <?php checked($instance['type-'. $post_key], true) ?> id="<?php echo $widget->get_field_id('type-'. $post_key); ?>" name="<?php echo $widget->get_field_name('type-'. $post_key); ?>" />
        <label for="<?php echo $widget->get_field_id('type-'. $post_key); ?>"><?php echo stripslashes($custom_post->labels->name) ?></label></li>
    <?php	}  ?>
		</ul>
    </div>
    <?php } ?>
    
    <h4 class="abtcore_ww_handle"><?php _e('Categories', 'display-widgets') ?> <span>&ndash;</span></h4>
    <div class="abtcore_ww_box">
        <ul class="abtcore_ww_options">
    <?php foreach ($abtcore_ww_cats as $cat){ 
        $instance['cat-'.$cat->cat_ID] = isset($instance['cat-'.$cat->cat_ID]) ? $instance['cat-'.$cat->cat_ID] : false;   
    ?>
			<li><input class="checkbox" type="checkbox" <?php checked($instance['cat-'.$cat->cat_ID], true) ?> id="<?php echo $widget->get_field_id('cat-'.$cat->cat_ID); ?>" name="<?php echo $widget->get_field_name('cat-'.$cat->cat_ID); ?>" />
        <label for="<?php echo $widget->get_field_id('cat-'.$cat->cat_ID); ?>"><?php echo $cat->cat_name ?></label></li>
    <?php
        unset($cat);
        } 
    ?>
		</ul>
    </div>
    
    <?php if(isset($abtcore_ww_taxes) and !empty($abtcore_ww_taxes)){ ?>
    <h4 class="abtcore_ww_handle"><?php _e('Taxonomies', 'display-widgets') ?> <span>&ndash;</span></h4>
    <div class="abtcore_ww_box">
        <ul class="abtcore_ww_options">
    <?php foreach ($abtcore_ww_taxes as $tax){ 
        $instance['tax-'.$tax] = isset($instance['tax-'.$tax]) ? $instance['tax-'.$tax] : false;   
    ?>
			<li><input class="checkbox" type="checkbox" <?php checked($instance['tax-'.$tax], true) ?> id="<?php echo $widget->get_field_id('tax-'.$tax); ?>" name="<?php echo $widget->get_field_name('tax-'.$tax); ?>" />
        <label for="<?php echo $widget->get_field_id('tax-'.$tax); ?>"><?php echo str_replace(array('_','-'), ' ', ucfirst($tax)) ?></label></li>
    <?php
        unset($tax);
        } 
    ?>
		</ul>
    </div>
    <?php } ?>
    <h4>Other</h4>
    	<div class="field"><label for="<?php echo $widget->get_field_id('other_ids'); ?>"><?php _e('IDs of Posts', 'display-widgets') ?>:</label>
    						<input type="text" value="<?php echo $instance['other_ids'] ?>" name="<?php echo $widget->get_field_name('other_ids'); ?>" id="<?php echo $widget->get_field_id('other_ids'); ?>" />
							<em class="summary">Comma Separated list of IDs of posts not listed above</em>
    	</div>
    </div>
<?php if(!$abtcore_ww_loaded){ ?>
<script type="text/javascript">
	(function($) {
		$(document).ready(function() {
			$('.abtcore_ww_handle').click(function() {
				$(this).toggleClass('closed').next('.abtcore_ww_box').toggleClass('closed').toggle();
				if ($(this).hasClass('closed')) {
					$(this).find('span').html('+');
				} else {
					$(this).find('span').html('&ndash;');
				}
			});
		});
	})(jQuery);
</script>
<?php
        $abtcore_ww_loaded = true;
    }
}

function abtcore_ww_update_widget_options($instance, $new_instance, $old_instance){
    abtcore_ww_register_globals();
    
    global $abtcore_ww_pages, $abtcore_ww_cats, $abtcore_ww_taxes, $abtcore_ww_cposts, $abtcore_ww_checked;
    
    if($abtcore_ww_pages){
        foreach ($abtcore_ww_pages as $page){
            $instance['page-'.$page->ID] = isset($new_instance['page-'.$page->ID]) ? 1 : 0;
            unset($page);
        }
    }
    
    foreach ($abtcore_ww_cats as $cat){
        $instance['cat-'.$cat->cat_ID] = isset($new_instance['cat-'.$cat->cat_ID]) ? 1 : 0;
        unset($cat);
    }
    
    if($abtcore_ww_cposts){
        foreach ($abtcore_ww_cposts as $post_key => $custom_post){
            $instance['type-'.$post_key] = isset($new_instance['type-'.$post_key]) ? 1 : 0;
            unset($custom_post);
        }
    }
    
    if($abtcore_ww_taxes){
        foreach ($abtcore_ww_taxes as $tax){
            $instance['tax-'.$tax] = isset($new_instance['tax-'.$tax]) ? 1 : 0;
            unset($tax);
        }
    }
           
    $instance['include'] = $new_instance['include'] ? 1 : 0;
    $instance['logout'] = $new_instance['logout'] ? 1 : 0;
    $instance['login'] = $new_instance['login'] ? 1 : 0;
    $instance['other_ids'] = $new_instance['other_ids'] ? $new_instance['other_ids'] : '';
    
    foreach(array('front', 'home', 'archive', 'single', '404', 'search') as $page)
        $instance['page-'. $page] = isset($new_instance['page-'. $page]) ? 1 : 0;

    return $instance;
}

function abtcore_ww_register_globals(){
    global $abtcore_ww_pages, $abtcore_ww_cats, $abtcore_ww_taxes, $abtcore_ww_cposts, $abtcore_ww_checked;
    
    if(!$abtcore_ww_checked){
        if(!$abtcore_ww_pages)
            $abtcore_ww_pages = get_posts( array(
                'post_type' => 'page', 'post_status' => 'publish', 
                'numberposts' => 999, 'orderby' => 'title', 'order' => 'ASC'
            ));
        
        if(!$abtcore_ww_cats)
            $abtcore_ww_cats = get_categories(array('hide_empty' => false));    
            
        if(!$abtcore_ww_cposts and function_exists('get_post_types')){
            $abtcore_ww_cposts = get_post_types(array(), 'object');
            foreach(array('revision','post','page','attachment','nav_menu_item') as $unset)
                unset($abtcore_ww_cposts[$unset]);
                
            foreach($abtcore_ww_cposts as $c => $type){
                $post_taxes = get_object_taxonomies($c);
                foreach($post_taxes as $tax => $post_tax)
                    $abtcore_ww_taxes[$tax] = $post_tax;
            }
        }
        
        $abtcore_ww_checked = true;
    }

}


//TODO: Add text field that accepts full urls that will be checked under 'else'