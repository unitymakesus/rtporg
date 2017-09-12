<?php
/**
 * Template Name: One Column Page (no sidebar)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

get_header(); ?>

	<div class="content-container">
    	<div class="wrapper group">

	    	<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>

        	<div class="content" id="content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile; ?>
			</div>

		</div>
	</div>

<?php get_footer(); ?>