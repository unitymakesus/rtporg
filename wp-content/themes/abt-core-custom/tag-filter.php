<?php
	$theme_dir = get_stylesheet_directory_uri();
?>
<div id="tag-filter" class="tag-filter">
	<h3 class="toggle"><img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_eye.svg" /> <?php _e( 'Discover', 'abt-core-custom' ); ?></h3>
	<ul class="options">
		<?php if (is_home()) : ?>
			<li class="active"><a href="#">Trending</a></li>
			<li><a href="#">Recent</a></li>
			<li><a href="#">#Education</a></li>
			<li><a href="#">#Jobs</a></li>
			<li><a href="#">#Food</a></li>
		<?php elseif (is_search()) : ?>
            <li class="<?php echo get_query_var( 'd' ) != 'social' ? 'active' : ''; ?>">
                <a href="<?php echo home_url( '/' ) . '?s=' . get_query_var( 's' ) ; ?>" class="tag"><?php echo __( 'RTP', 'abt-core-custom' ); ?></a>
            </li>
            <li class="<?php echo get_query_var( 'd' ) == 'social' ? 'active' : ''; ?>">
                <a href="<?php echo home_url( '/' ) . '?s=' . get_query_var( 's' ) . '&d=social'; ?>" class="tag"><?php echo __( 'Social Media', 'abt-core-custom' ); ?></a>
            </li>
		<?php elseif (is_page('events') || is_tax('event-categories')) : ?>
			<?php if (is_tax('event-categories')) : ?>
				<li><a href="/events">Clear Filter</a></li>
			<?php endif; ?>
			<?php $args = array(
				'taxonomy' => 'event-categories',
				'title_li' => false
			); ?>
			<?php wp_list_categories( $args ); ?>
		<?php elseif (is_page('blog') || is_category()) : ?>			
			<?php if (is_category()) : ?>
				<li><a href="/blog">Clear Filter</a></li>
			<?php endif; ?>
			<?php $args = array(				
				'title_li' => false
			); ?>
			<?php wp_list_categories( $args ); ?>
		<?php endif; ?>	
	</ul>
</div>