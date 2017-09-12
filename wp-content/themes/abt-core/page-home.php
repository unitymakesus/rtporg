<?php
/**
 * Template Name: Home Page
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php get_template_part( 'featured','heroes' ); ?>

    <div class="content-container">
    	<div class="wrapper group">

	    	<div class="">
	        	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>

			<?php get_template_part( 'featured','testimonials' ); ?>

			<?php // pull in latest events (featured-events) ?>

			<?php // pull in latest posts (featured-posts) ?>

			<?php get_template_part( 'featured','showcase'); ?>

    	</div>
	</div>

<?php get_footer(); ?>