<?php
/**
 * Template Name: STEM in the Park
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
		  <?php get_template_part('stem', 'header'); ?>
    	<div class="content">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>
