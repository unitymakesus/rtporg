<?php
/**
 * The template for displaying all pages.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */

get_header(); ?>

	<?php
		$additional_code = types_render_field("additional_code", array("raw"=>"true"));
		if($additional_code !='') {
			echo $additional_code;
		}
	?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="content-container">
			<?php get_template_part('featured', 'banners'); ?>
			<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>			
	    	<div class="content-wrapper">
		    	<div class="content">					
					<?php if ($banner_title) : ?>
						<h2><?php the_title(); ?></h2>
					<?php else : ?>
						<h1><?php the_title(); ?></h1>
					<?php endif; ?>
					<?php the_content(); ?>								
				</div>

		        <aside class="aside">
					<?php get_sidebar(); ?>
				</aside>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>