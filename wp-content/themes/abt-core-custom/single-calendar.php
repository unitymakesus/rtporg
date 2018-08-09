<?php
/**
 * The Template for displaying all single calendars.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 */

get_header();

if ( have_posts() ) : while ( have_posts() ) : the_post();

  $user_id       = get_the_author_meta( 'ID' );
  $user_obj      = get_userdata( $user_id );
  $user_role     = ($user_obj->roles[0] == "contributor") ? "rtp-contributor" : $user_obj->roles[0];
  $display_role  = ($user_role == "administrator") ? "Author" : ucwords(str_replace("-", " ", $user_role));
  $slug          = get_post( $post )->post_name;
  ?>

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
                    </header>
                    <?php if ( is_archive() || is_search() || $slug == "blog" ) : ?>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php else : ?>
                        <div class="entry-content">
                            <?php //the_post_thumbnail(); ?>
                            <?php the_content(); ?>
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

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
