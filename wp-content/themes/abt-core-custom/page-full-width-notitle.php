<?php
/**
 * Template Name: Full Width Page (no title)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<?php get_template_part('featured', 'banners'); ?>
			<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>
	    	<div class="content no-padding">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
