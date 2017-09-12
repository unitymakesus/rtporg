<?php
/**
 * Template Name: Blog
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */

get_header(); ?>

	<div class="content-container">
		<?php get_template_part('featured', 'banners'); ?>
		<div class="breadcrumbs">
			<?php if(function_exists('bcn_display')) {
				bcn_display();
			} ?>
		</div>			
		<div class="content-wrapper">
			<div class="content">
				<?php get_template_part('tag', 'filter'); ?>
				<?php
					global $wp_query;
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

					query_posts(array(
	                	'posts_per_page' => -1
	                ));

	                get_template_part('loop');
	            ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>