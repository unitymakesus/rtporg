<?php
/**
 * The template for displaying Search Results pages.
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

			<div class="content">
			<?php if ( have_posts() ) : ?>
                <h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'abtcore' ), '<mark>' . get_search_query() . '</mark>' ); ?></h1>
                <?php get_template_part( 'loop', 'blog' ); ?>
            <?php else : ?>
                <div class="no-results not-found">
                    <h1 class="entry-title"><?php _e( 'Nothing Found', 'abtcore' ); ?></h1>
                    <section class="entry-content">
                        <p><?php _e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'abtcore' ); ?></p>
                        <?php get_search_form(); ?>
                    </section>
                </div>
            <?php endif; ?>
			</div>

            <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>

		</div>
	</div>

<?php get_footer(); ?>