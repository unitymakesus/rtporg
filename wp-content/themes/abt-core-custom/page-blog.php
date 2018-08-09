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
          	'posts_per_page' => 24,
						'paged' => $paged,
          ));

          get_template_part('loop');
      	?>

				<div class="pagination">
						<?php
						$big = 999999999; // need an unlikely integer
						$translated = __( 'Page', 'mytextdomain' ); // Supply translatable string

						echo paginate_links( array(
							'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
							'format' => '?paged=%#%',
							'current' => max( 1, get_query_var('paged') ),
							'total' => $wp_query->max_num_pages,
		        	'before_page_number' => '<span class="screen-reader-text">'.$translated.' </span>'
						) );
						?>
				</div>

				<?php wp_reset_query(); ?>
			</div>
		</div>
	</div>

<?php get_footer(); ?>
