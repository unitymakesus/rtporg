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
		<div class="breadcrumbs">
		    <?php if(function_exists('bcn_display')) {
		    	bcn_display();
		    } ?>
		</div>			
    	<div class="content-wrapper">
	    	<div class="content">					
				<?php if ( have_posts() ) the_post(); ?>

					<h1 class="author-archive-title"><?php printf( __( 'Articles by %s', 'abtcore' ), '<span>"' . get_the_author() . '"</span>' ); ?></h1>

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

					<section class="social-grid">
						<?php rewind_posts(); get_template_part('loop'); ?>						
					</section>
			</div>

	        <aside class="aside">
				<?php get_sidebar('blog'); ?>
			</aside>
		</div>
	</div>

<?php get_footer(); ?>