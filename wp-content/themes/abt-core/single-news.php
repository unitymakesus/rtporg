<?php
/**
 * News (Single Entry)
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
					$section_label     = types_render_field("news_section_label", array("raw"=>"true"));
					$name              = types_render_field("news_contact_name", array("raw"=>"true"));
					$company           = types_render_field("news_contact_company", array("raw"=>"true"));
					$phone             = types_render_field("news_contact_phone", array("raw"=>"true"));
					$email             = types_render_field("news_contact_email", array("raw"=>"true"));
					$website           = types_render_field("news_contact_website", array("raw"=>"true"));
					$website_target    = types_render_field("news_contact_website_target", array("raw"=>"true"));
				?>

				<article>
					<header>
						<?php if ( has_post_thumbnail( $post->ID ) ): ?>
                			<figure class="post-image"><?php the_post_thumbnail(); ?></figure>
                		<?php endif; ?>

                		<h1><?php the_title(); ?></h1>
                		<?php get_template_part('meta', 'loop'); ?>
					</header>

                	<?php the_content(); ?>

                	<footer>
	                	<?php if ($section_label) : ?>
	                		<h3><?php echo $section_label; ?></h3>
	                	<?php endif; ?>

                		<div class="vcard">
							<a class="url fn n" href="<?php echo $website; ?>" <?php if ($website_target == "2") : ?>target="_blank"<?php endif; ?>>
								<span class="given-name"><?php echo $name; ?></span>
								<span class="additional-name"></span>
								<span class="family-name"></span>
							</a>

						<?php if ($company) : ?>
							<div class="org"><?php echo $company; ?></div>
						<?php endif; ?>

						<?php if ($email) : ?>
							<a class="email" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
						<?php endif; ?>

						<?php if ($phone) : ?>
							<div class="tel"><?php echo $phone; ?></div>
						<?php endif; ?>
						</div>
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