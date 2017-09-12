<?php
/**
 * Template Name: Locations (Overview)
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
						'post_type'   => 'locations',
						'post_status' => 'publish',
						'paged'       => $paged,
					) );
					if ( have_posts() ) : ?>

					<ul class="locations">

					<?php while ( have_posts() ) : the_post();

					$address       = types_render_field("location_address", array("raw"=>"true"));
					$ext_address   = types_render_field("location_ext_address", array("raw"=>"true"));
					$city          = types_render_field("location_city", array("raw"=>"true"));
					$state         = types_render_field("location_state", array("raw"=>"true"));
					$zip_code      = types_render_field("location_zip_code", array("raw"=>"true"));
					$country       = types_render_field("location_country", array("raw"=>"true"));
					$phone         = types_render_field("location_phone", array("raw"=>"true"));
					$fax           = types_render_field("location_fax", array("raw"=>"true"));
				?>

					<li>
					<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	            		<figure class="post-image"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a></figure>
	            	<?php endif; ?>

	            		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php the_excerpt(); ?>

						<div><strong>Address:</strong> <?php echo $address; ?></div>
						<div><strong>Extended Address:</strong> <?php echo $ext_address; ?></div>
						<div><strong>City:</strong> <?php echo $city; ?></div>
						<div><strong>State:</strong> <?php echo $state; ?></div>
						<div><strong>Zip Code:</strong> <?php echo $zip_code; ?></div>
						<div><strong>Country:</strong> <?php echo $country; ?></div>
						<div><strong>Phone:</strong> <?php echo $phone; ?></div>
						<div><strong>Fax:</strong> <?php echo $fax; ?></div>

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