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
        <?php get_template_part('featured', 'banners'); ?>
        <?php get_template_part('tag', 'filter'); ?>
            <?php if ( isset( $sircusViewerPlugin ) && get_query_var( $sircusViewerPlugin->getDomainQueryVar() ) == 'social' ) : ?>

                <?php // Inject social feed items here ?>
                <?php echo do_shortcode( '[sircus-viewer type="search"]' ); ?>

            <?php else: ?>

                <?php
                    // For Wordpress content, let's run through the loop
                    // Our loop will separate out posts by type
                    get_template_part('loop');
                ?>

            <?php endif; ?>

    </div>

<?php get_footer(); ?>