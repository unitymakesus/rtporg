<?php
/**
 * The template for displaying Author Archive pages.
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
			<?php if ( have_posts() ) the_post(); ?>

				<h1 class="page-title author"><?php printf( __( 'Author Archives: %s', 'abtcore' ), "<span class=\"vcard\"><a class=\"url fn n\" href=\"" . get_author_posts_url( get_the_author_meta( 'ID' ) ) . "\" title=\"" . esc_attr( get_the_author() ) . "\" rel=\"me\">" . get_the_author() . "</a></span>" ); ?></h1>

                <?php if ( get_the_author_meta( 'description' ) ) : ?>
					<header id="author-info">
						<div id="author-avatar" class="avatar">
							<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'abtcore_author_bio_avatar_size', 60 ) ); ?>
						</div>
						<div id="author-description">
							<h2><?php printf( __( 'About %s', 'abtcore' ), get_the_author() ); ?></h2>
							<?php the_author_meta( 'description' ); ?>
						</div>
					</header>
				<?php endif; ?>

				<?php rewind_posts(); get_template_part('loop'); ?>
			</div>

            <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>

		</div>
	</div>

<?php get_footer(); ?>