<?php
/**
 * Template Name: One Column Page (no sidebar)
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
	    	<div class="content">					
				<?php if ($banner_title) : ?>
					<h2><?php the_title(); ?></h2>
				<?php else : ?>
					<h1><?php the_title(); ?></h1>
				<?php endif; ?>
				<?php the_content(); ?>								
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>