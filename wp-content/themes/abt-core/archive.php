<?php
/**
 * The template for displaying Archive pages.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */

get_header(); ?>

	<div class="content-container">
    	<div class="wrapper group">

        	<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>

        	<div class="content" id="content">
			<?php if ( have_posts() ) the_post(); ?>
				<h1 class="page-title">
					<?php if ( is_day() ) : ?>
						<?php printf( __( 'Daily Archives: <span>%s</span>', 'abtcore' ), get_the_date() ); ?>
					<?php elseif ( is_month() ) : ?>
						<?php printf( __( 'Monthly Archives: <span>%s</span>', 'abtcore' ), get_the_date('F Y') ); ?>
					<?php elseif ( is_year() ) : ?>
						<?php printf( __( 'Yearly Archives: <span>%s</span>', 'abtcore' ), get_the_date('Y') ); ?>
					<?php else : ?>
						<?php _e( 'Blog Archives', 'abtcore' ); ?>
					<?php endif; ?>
				</h1>

				<?php rewind_posts(); get_template_part('loop'); ?>
			</div>

            <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>

		</div>
	</div>

<?php get_footer(); ?>