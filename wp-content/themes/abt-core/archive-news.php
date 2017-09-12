<?php
/**
 * Template Name: News (Overview)
 *
 * @package WordPress
 * @subpackage ABT_CORE
 * @since ABT Core v1.0
 *
 */

get_header(); ?>

	<div class="content-container">
    	<div class="wrapper group">

        	<div class="breadcrumbs">
			    <?php if(function_exists('bcn_display')) {
			    	bcn_display();
			    } ?>
			</div>

        	<div class="content">
				<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
					<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	                	<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
	                <?php endif; ?>
	                <h1><?php the_title(); ?></h1>
					<?php the_content(); ?>
				<?php endwhile; ?>

				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; ?>
				<?php
					query_posts( array(
						'post_type'   => 'news',
						'post_status' => 'publish',
						'paged'       => $paged,
					) );

					if ( have_posts() ) : ?>

					<ol class="news">

					<?php while ( have_posts() ) : the_post();

					$section_label     = types_render_field("news_section_label", array("raw"=>"true"));
					$name              = types_render_field("news_contact_name", array("raw"=>"true"));
					$company           = types_render_field("news_contact_company", array("raw"=>"true"));
					$phone             = types_render_field("news_contact_phone", array("raw"=>"true"));
					$email             = types_render_field("news_contact_email", array("raw"=>"true"));
					$website           = types_render_field("news_contact_website", array("raw"=>"true"));
					$website_target    = types_render_field("news_contact_website_target", array("raw"=>"true"));
				?>

					<li>
						<article>
							<header>
								<?php if ( has_post_thumbnail( $post->ID ) ): ?>
		                			<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
		                		<?php endif; ?>

		                		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

		                		<?php get_template_part('meta', 'loop'); ?>
							</header>

		                	<?php the_excerpt(); ?>

						</article>
					</li>

				<?php endwhile; ?>

					</ol>

					<?php if(function_exists('wp_pagenavi')) {
					    wp_pagenavi();
					} ?>

				<?php endif; wp_reset_query(); ?>
			</div>

            <aside class="aside">
				<?php the_submenu(); ?>
				<?php get_sidebar(); ?>
			</aside>

    	</div>
	</div>

<?php get_footer(); ?>