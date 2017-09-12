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
    	<div class="wrapper group">

        	<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>

        	<div class="content" id="content">
			<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                    <header>
                  		<h1 class="entry-title"><?php the_title(); ?></h1>
                        <?php get_template_part('meta', 'article'); ?>
                    </header>

                    <?php if ( has_post_thumbnail( $post->ID ) ): ?>
                		<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
            		<?php endif; ?>

                    <div class="entry-content">
						<?php the_content(); ?>
                    </div>

                    <footer>
						<?php get_template_part('footer', 'article'); ?>
						<?php if ( get_the_author_meta( 'description' ) ) : // If a user has filled out their description, show a bio on their entries  ?>
                        <div id="author-info">
                            <div id="author-avatar" class="avatar">
                                <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'abtcore_author_bio_avatar_size', 60 ) ); ?>
                            </div>
                            <div id="author-description">
                                <h2><?php printf( esc_attr__( 'About %s', 'abtcore' ), get_the_author() ); ?></h2>
                                <?php the_author_meta( 'description' ); ?>
                                <p id="author-link">
                                    <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>">
                                        <?php printf( __( 'View all posts by %s', 'abtcore' ), get_the_author() ); ?>
                                    </a>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                        <nav class="paging below">
            				<h2 class="access">Post Navigation</h2>
                            <ul>
                                <li class="prev"><?php previous_comments_link( __( 'Older Posts', 'abtcore' ) ); ?></li>
                                <li class="next"><?php next_comments_link( __( 'Newer Posts', 'abtcore' ) ); ?></li>
                            </ul>
                        </nav>
					</footer>

                    <?php comments_template( '', true ); ?>

            	</article>

			<?php endwhile; ?>
			</div>

            <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>

		</div>
	</div>

<?php get_footer(); ?>