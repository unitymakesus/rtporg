<?php
/**
 * Template Name: Programs
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

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
		<div class="content">
			<?php wp_reset_query(); ?>
			<?php
				// Get posts from 'People' with specified categories
				$args = array(
					'post_type'      => 'program',
					'post_status'    => 'publish',
					'orderby'        => 'title',
					'order'          => 'ASC',
					'posts_per_page' => -1
				);
			?>
			<?php query_posts($args); ?>
			<?php get_template_part('loop'); ?>
			<?php wp_reset_query; ?>
		</div>
	</div>

<?php get_footer(); ?>
