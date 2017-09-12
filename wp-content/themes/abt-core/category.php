<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
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
				<h1 class="page-title">
					<?php printf( __( 'Category Archives: %s', 'abtcore' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
				</h1>

                <?php $category_description = category_description(); if ( ! empty( $category_description ) ): ?>
					<div class="archive-meta category-description"><?php echo $category_description; ?></div>
                <?php endif; ?>

				<?php get_template_part('loop', 'blog'); ?>
			</div>

            <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>

		</div>
	</div>

<?php get_footer(); ?>