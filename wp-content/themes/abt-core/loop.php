<?php
/**
 * The loop that displays posts.
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v0.9.3
 */
?>

<?php /* If there are no posts to display, such as an empty archive page */ ?>
<?php if ( ! have_posts() ) : ?>
	<div id="post-0" class="post error404 not-found">
		<h2 class="entry-title"><?php _e( 'Not Found', 'abtcore' ); ?></h2>
		<div class="entry-content">
			<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'abtcore' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	</div>
<?php endif; ?>


<?php /* Start the Loop. */ ?>
<?php while ( have_posts() ) : the_post(); ?>


	<?php
		/* For Gallery category!
		=========================================================================================================================================================
		*/
	?>
	<?php if ( in_category( _x('gallery', 'gallery category slug', 'abtcore') ) ) : ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header>
            	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'abtcore' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

                <?php get_template_part('meta', 'loop'); ?>
            </header>

			<div class="entry-content">

			<?php if ( post_password_required() ) : ?>
				<?php the_content(); ?>
			<?php else : ?>
				<?php
					$images = get_children( array( 'post_parent' => $post->ID, 'post_type' => 'attachment', 'post_mime_type' => 'image', 'orderby' => 'menu_order', 'order' => 'ASC', 'numberposts' => 999 ) );
					if ( $images ) :
						$total_images = count( $images );
						$image = array_shift( $images );
						$image_img_tag = wp_get_attachment_image( $image->ID, 'thumbnail' );
				?>
						<div class="gallery-thumb">
							<div class="thumbnail"><a class="size-thumbnail" href="<?php the_permalink(); ?>"><?php echo $image_img_tag; ?></a></div>
							<p><em><?php printf( __( 'This gallery contains <a %1$s>%2$s photos</a>.', 'abtcore' ),
								'href="' . get_permalink() . '" title="' . sprintf( esc_attr__( 'Permalink to %s', 'abtcore' ), the_title_attribute( 'echo=0' ) ) . '" rel="bookmark"',
								$total_images
							); ?></em></p>
                        </div>

				<?php endif; ?>
				<?php abtcore_the_excerpt(); ?>

			<?php endif; ?>
			</div>

			<?php get_template_part('footer', 'loop'); ?>
		</article>

	<?php
		/* For Asides category!
		=========================================================================================================================================================
		*/
	?>
	<?php elseif ( in_category( _x('asides', 'asides category slug', 'abtcore') ) ) : ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php if ( is_archive() || is_search() ) : // Display excerpts for archives and search. ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div>
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading', 'abtcore' ) ); ?>
			</div>
		<?php endif; ?>

			<?php get_template_part('footer', 'loop'); ?>

		</article>

	<?php
		/* For All other posts!
		=========================================================================================================================================================
		*/
	?>

	<?php else : ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header>
            	<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'abtcore' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
				<?php get_template_part('meta', 'loop'); ?>
            </header>


			<?php if ( is_archive() || is_search() ) : // Only display excerpts for archives and search. ?>
                <div class="entry-summary">
                    <?php the_excerpt(); ?>
                </div>
			<?php else : ?>
                <div class="entry-content">
                    <?php the_content( __( 'Continue reading', 'abtcore' ) ); ?>
                </div>
			<?php endif; ?>

			<?php get_template_part('footer', 'loop'); ?>

			<?php //comments_template( '', true ); ?>

		</article>


	<?php endif; // This was the if statement that broke the loop into three parts based on categories. ?>

<?php endwhile; // End the loop. ?>

<?php if(function_exists('wp_pagenavi')): ?>
	<?php wp_pagenavi(); ?>
<?php endif; ?>

<?php /* Display navigation to next/previous pages when applicable */ ?>
<?php /*if (  $wp_query->max_num_pages > 1 ) : ?>
        <nav class="paging below">
            <h2 class="access">Post Navigation</h2>
            <ul>
                <li class="prev"><?php next_posts_link( __( 'Older Posts', 'abtcore' ) ); ?></li>
                <li class="next"><?php previous_posts_link( __( 'Newer Posts', 'abtcore' ) ); ?></li>
            </ul>
        </nav>
<?php endif;*/ ?>