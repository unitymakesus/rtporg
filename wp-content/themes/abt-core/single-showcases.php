<?php
/**
 * Showcases (Single Entry)
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
					<?php
						$website_name       = types_render_field("showcase_website_name", array("raw"=>"true"));
						$website_address    = types_render_field("showcase_website_address", array("raw"=>"true"));
					?>
					<article class="showcase">
						<header>
							<?php if ( has_post_thumbnail( $post->ID ) ): ?>
	                			<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
	                		<?php endif; ?>

	               			<h1><?php the_title(); ?></h1>
	 					</header>
	                	<?php the_content(); ?>
	                	<footer>
	                		<h3>Website</h3>
	                		<p><strong><?php echo $website_name; ?></strong> - <a href="<?php echo $website_address; ?>"><?php echo $website_address; ?></a></p>
	                	</footer>
					</article>

				<?php endwhile; ?>
			</div>
            <aside class="aside">
				<?php the_submenu(); ?>
				<?php get_sidebar(); ?>
			</aside>
		</div>
	</div>

<?php get_footer(); ?>