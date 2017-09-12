<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */

get_header(); ?>

	<div class="content-container">
    	<div class="wrapper group">

			<?php if ( abtcore_breadcrumbs_enabled( true ) ) : ?>
	    		<div class="breadcrumbs">
	    			<?php abtcore_the_breadcrumb( $strict = true ); ?>
	    		</div>
    		<?php endif; ?>

        	<div class="content">
				<h1><?php _e( 'Not Found', 'abtcore' ); ?></h1>
				<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'abtcore' ); ?></p>
				<?php get_search_form(); ?>
			</div>

            <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>

		</div>
	</div>

<?php get_footer(); ?>