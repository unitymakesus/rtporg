<?php
/**
 * Archive Location
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

get_header(); ?>

	<div class="content-container locations-directory">			
		<div class="content-wrapper">
			<div class="content">					
				<?php // get_template_part('loop'); ?>								
				<?php
					global $wp_query;
					$paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;

					query_posts(array(
	          			'post_type'      => 'location',
	          			'order'          => 'ASC',
	          			'orderby'        => 'title',
	          			'posts_per_page' => -1
	        		));

			        get_template_part('loop', 'print-location');
			    ?>
			</div>
		</div>
	</div>
	<script>
		jQuery(function($){		
			$(document).ready(function() {
				// Unwrap links from categories
				$('.directory td a').contents().unwrap();
			
				// Trigger the file/print
				setTimeout(function() {
					window.print();
				}, 100);
			});
		})
	</script>
<?php get_footer(); ?>