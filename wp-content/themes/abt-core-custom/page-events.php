<?php
/**
* Template Name: Events
*
* @package WordPress
* @subpackage ABT_CORE
* @since ABT Core v1.0
*
*/
get_header(); ?>
<?php $theme_dir = get_stylesheet_directory_uri(); ?>
<div class="content-container">
    <?php get_template_part( 'featured', 'banners'); ?>
    <div class="breadcrumbs">
        <?php if ( function_exists( 'bcn_display' ) ): ?>
            <?php bcn_display(); ?>
        <?php endif; ?>
    </div>
    <div class="content">
        <?php get_template_part('tag', 'filter'); ?>
        <?php wp_reset_query(); ?>
        <?php
            // Get posts from 'People' with specified categories
            $args =
                array(
                    'post_type'      => 'event',
                    'post_status'    => 'publish',
                    'meta_key'       => 'wpcf-event-start-date-and-time',
                    'orderby'        => 'meta_value',
                    'order'          => 'ASC',
                    'posts_per_page' => -1,
                    'meta_query'	=> array(
                        'relation'		=> 'AND',
                            array(
                                'key'	 	=> 'wpcf-event-end-date-and-time',
                                'value'	  	=> strtotime('-7 days'),
                                'compare' 	=> '>=',
                            )
                    ),
                );

        ?>
        <?php query_posts( $args ); ?>
        <?php get_template_part( 'loop', 'event' ); ?>
        <?php wp_reset_query(); ?>
    </div>
</div>
<?php get_footer(); ?>