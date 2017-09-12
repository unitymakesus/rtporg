<?php
/**
 * Template Name: Showcases (Overview)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<div class="content-container">
    	<div class="wrapper group">

        	<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>

        	<div class="content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	                	<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
	                <?php endif; ?>
	                <h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile; ?>

				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
				<?php query_posts( array(
						'post_type'   => 'showcases',
						'post_status' => 'publish',
						'paged'       => $paged,
					) );

					if ( have_posts() ) : ?>

					<ul class="showcases">

					<?php while ( have_posts() ) : the_post(); ?>

					<li>
						<a href="<?php the_permalink(); ?>">
						<?php if ( has_post_thumbnail( $post->ID ) ): ?>
		            		<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
		            	<?php endif; ?>

		            		<h3><?php the_title(); ?></h3>
						</a>
					</li>

				<?php endwhile; ?>

					</ul>

				<?php if(function_exists('wp_pagenavi')): ?>
					<?php wp_pagenavi(); ?>
				<?php endif; ?>

				<?php endif; wp_reset_query(); ?>
			</div>

            <aside class="aside">
				<?php the_submenu(); ?>
				<?php get_sidebar(); ?>
			</aside>

    	</div>
	</div>

<?php get_footer(); ?>