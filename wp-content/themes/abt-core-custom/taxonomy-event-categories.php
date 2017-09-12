<?php
/**
 * Event Categories Archive
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 *
 * 03/04/2015:  Fixed issues with template that prevented events filter from functioning.
 *              Previously this was resetting WP_Query, losing all information about the
 *              requested object(s), namely the event taxonomy/term.
 *
 */
get_header(); ?>
<?php $theme_dir = get_stylesheet_directory_uri(); ?>
<div class="content-container">
	<?php get_template_part( 'featured', 'banners' ); ?>
	<div class="breadcrumbs">
		<?php if ( function_exists( 'bcn_display' ) ): ?>
            <?php bcn_display(); ?>
		<?php endif; ?>
	</div>
	<div class="content">
		<?php get_template_part( 'tag', 'filter' ); ?>
        <?php global $wp_query;  // We're about to modify the global query ?>
		<?php
            // Order events posts by the event start date and time post meta
            $args =
                array(
                    'post_type'      => 'event',
                    'post_status'    => 'publish',
                    'meta_key'       => 'wpcf-event-start-date-and-time',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'posts_per_page' => -1
                );
		?>
        <?php // Merge the above query modifications into WP_Query ?>
        <?php $args = array_merge( $wp_query->query, $args ); ?>
		<?php query_posts( $args ); ?>
		<?php get_template_part( 'loop', 'event' ); ?>
	</div>
</div>
<?php get_footer(); ?>