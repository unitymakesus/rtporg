<?php
/**
 * The Template for displaying all single posts.
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
  $theme_dir     = get_stylesheet_directory_uri();
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
                            <h1 class="entry-title"><?php the_title(); ?></h1>
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
                        <?php the_post_thumbnail($post->ID, 'medium' ); ?>
                        <div class="panel">
                            <ul class="share rrssb-buttons">
                                <li class="facebook">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" class="popup" target="_blank" rel="nofollow noopener">
                                        <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_facebook.svg" />
                                    </a>
                                </li>
                                <li class="twitter">
                                    <a href="http://twitter.com/home?status=<?php echo urlencode(get_the_title()); ?>%20<?php the_permalink(); ?>" class="popup" target="_blank" rel="nofollow noopener">
                                        <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_twitter.svg" />
                                    </a>
                                </li>
                                <li class="linkedin">
                                    <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>" class="popup" target="_blank" rel="nofollow noopener">
                                        <img class="svg" src="<?php echo $theme_dir; ?>/img/icons/i_linkedin.svg" />
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </header>
                    <?php if ( is_archive() || is_search() || $slug == "blog" ) : ?>
                        <div class="entry-summary">
                            <?php the_excerpt(); ?>
                        </div>
                    <?php else : ?>
                        <div class="entry-content">
                            <?php //the_post_thumbnail(); ?>
                            <?php the_content(); ?>

                            <div class="pagination">
                                <?php previous_post_link('%link', '&#8592; Previous Article'); ?>
                                <?php next_post_link('%link', 'Next Article &#8594;'); ?>
                            </div>
                            <section class="newsletter-signup">
                                <?php do_shortcode("[mc4wp_form id="17597"]"); ?>
                            </section>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        </div>
    </div>

	<?php endwhile; endif; ?>

<?php get_footer(); ?>
