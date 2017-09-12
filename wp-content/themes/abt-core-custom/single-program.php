<?php
/**
 * Program (Single Entry)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<?php
			$theme_dir = get_stylesheet_directory_uri();
		?>
		<div class="content-container">
			<?php get_template_part('featured', 'banners'); ?>
			<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>			
	    	<div class="content-wrapper">
		    	<div class="content">					
					<h2>About the Program</h2>
					<?php the_content(); ?>											
				</div>
			</div>
		</div>
	<?php endwhile; ?>

<?php get_footer(); ?>