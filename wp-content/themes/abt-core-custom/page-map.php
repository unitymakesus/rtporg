<?php
/**
 * Template Name: Map
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header('abt-mapbox'); ?>	

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<div class="content">
				<?php the_content(); ?>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>