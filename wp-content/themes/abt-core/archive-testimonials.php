<?php
/**
 * Template Name: Testimonials (Overview)
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
				<?php
					query_posts( array(
						'post_type'   => 'testimonials',
						'post_status' => 'publish',
						'paged'       => $paged,
					) );
					if ( have_posts() ) : while ( have_posts() ) : the_post();

					$cite              = types_render_field("testimonial_cite", array("raw"=>"true"));
					$job_title         = types_render_field("testimonial_job_title", array("raw"=>"true"));
					$company           = types_render_field("testimonial_company", array("raw"=>"true"));
					$website           = types_render_field("testimonial_website", array("raw"=>"true"));
					$website_target    = types_render_field("testimonial_website_target", array("raw"=>"true"));
				?>

					<blockquote class="testimonial">
						<?php the_content(); ?>
						<footer>
						<?php if ( has_post_thumbnail( $post->ID ) ): ?>
		                	<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
		                <?php endif; ?>

						<?php if ($cite) : ?>
							<h4><a href="<?php the_permalink(); ?>"><?php echo $cite; ?></a></h4>
						<?php endif; ?>

							<p><small>
							<?php if ($job_title) : ?>
								<?php echo $job_title; ?>,
							<?php endif; ?>
							<?php if ($website) : ?>
								<a href="<?php echo $website; ?>" <?php if ($website_target == "2") : ?>target="_blank"<?php endif; ?>><?php echo $company; ?></a>
							<?php endif; ?>
							</small></p>
						</footer>
					</blockquote>

				<?php endwhile; endif;  ?>
				<?php if(function_exists('wp_pagenavi')): ?>
					<?php wp_pagenavi(); ?>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</div>

            <aside class="aside">
				<?php the_submenu(); ?>
				<?php get_sidebar(); ?>
			</aside>

    	</div>
	</div>

<?php get_footer(); ?>