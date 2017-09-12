<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
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
			<?php get_template_part('tag', 'filter'); ?>

			<?php wp_reset_query(); ?>
			<?php get_template_part('loop'); ?>
			<?php wp_reset_query(); ?>
		</div>
        <div class="pagination">
            <?php
                //add pagination links to bottom of the page
                echo paginate_links();
            ?>
        </div>
	</div>

<?php get_footer(); ?>
