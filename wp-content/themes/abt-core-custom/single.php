<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */

get_header(); ?>

    <div class="content-container">
        <div class="breadcrumbs">
            <?php if(function_exists('bcn_display')) {
                bcn_display();
            } ?>
        </div>
        <div class="content-wrapper">
            <div class="content">
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header>
                        <div class="cat-links"><?php the_category( ', ' ); ?></div>
                        <?php if ( is_single() ) : ?>
                            <h2 class="entry-title"><?php the_title(); ?></h2>
                        <?php else : ?>
                            <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'abtcore' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
                        <?php endif; ?>
                        <div class="meta">
                            <span class="by-author">
                                By <?php the_author_posts_link(); ?> <span class="badge <?php echo $user_role; ?>"><?php echo $display_role; ?></span>
                            </span>
                            <span class="timestamp">
                                <?php the_time('M d, Y'); ?>
                            </span>
                        </div>
                    </header>
                    <?php if ( is_archive() || is_search() || $slug == "blog" ) : ?>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php else : ?>
                        <div class="entry-content">
                            <?php //the_post_thumbnail(); ?>
                            <?php the_content( __( 'Continue reading', 'abtcore' ) ); ?>
                        </div>
                    <?php endif; ?>
                </article>
                <div class="pagination">
                    <?php previous_post_link('%link', '&#8592; Previous Article'); ?>
                    <?php next_post_link('%link', 'Next Article &#8594;'); ?>
                </div>
                <section class="newsletter-signup">
                    <?php gravity_form( 16, true, true, false, false, true, 1, true ); ?>
                </section>
            </div>
            <aside class="aside">
                <?php get_sidebar('blog'); ?>
            </aside>
        </div>
    </div>

<?php get_footer(); ?>
