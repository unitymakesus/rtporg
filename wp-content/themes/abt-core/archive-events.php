<?php
/**
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
						'post_type'   => 'events',
						'post_status' => 'publish',
						'paged'       => $paged,
					) );

					if ( have_posts() ) : ?>

					<ol class="events">

					<?php while ( have_posts() ) : the_post();

					$location          = types_render_field("event_location", array("raw"=>"true"));
					$start_date        = types_render_field("event_start_date", array("format"=>"l, F j, Y", 'style'=>'text'));
					$start_time        = types_render_field("event_start_time", array("raw"=>"true"));
					$end_date          = types_render_field("event_end_date", array("format"=>"l, F j, Y", 'style'=>'text'));
					$end_time          = types_render_field("event_end_time", array("raw"=>"true"));
					$website_address   = types_render_field("event_website_address", array("raw"=>"true"));
				?>

					<li>
					<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	            		<figure class="post-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></figure>
	            	<?php endif; ?>

	            		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	            		<div><strong>Location:</strong> <?php echo $location; ?></div>
	            		<div><strong>Start Date:</strong> <?php echo $start_date; ?></div>
	            		<div><strong>Start Time:</strong> <?php echo $start_time; ?></div>
	            		<div><strong>End Date:</strong> <?php echo $end_date; ?></div>
	            		<div><strong>End Time:</strong> <?php echo $end_time; ?></div>
	            		<div><strong>Website Address:</strong> <a href="<?php echo $website_address; ?>"><?php echo $website_address; ?></a></div>
					</li>

				<?php endwhile; ?>

					</ol>

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